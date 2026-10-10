<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Fasilitas;
use App\Models\GaleriFoto;
use App\Models\Guru;
use App\Models\Halaman;
use App\Models\MenuSitus;
use App\Models\Pengurus;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Unduhan;
use App\Models\User;
use App\Support\Atur;
use App\Support\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ModulController extends Controller
{
    public function profil()
    {
        return view('admin.profil', [
            'profil' => Atur::banyak($this->bawaanProfil()),
        ]);
    }

    public function simpanProfil(Request $request)
    {
        Atur::isi($request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'motto' => ['required', 'string', 'max:160'],
            'kepala' => ['required', 'string', 'max:120'],
            'npsn' => ['required', 'string', 'max:20'],
            'akreditasi' => ['required', 'string', 'max:80'],
            'telepon' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:120'],
            'alamat' => ['required', 'string', 'max:240'],
            'sejarah' => ['required', 'string', 'max:2000'],
            'visi' => ['required', 'string', 'max:500'],
            'misi' => ['required', 'string', 'max:1000'],
            'sambutan' => ['required', 'string', 'max:1000'],
        ]));

        return back()->with('status', 'Profil sekolah disimpan.');
    }

    public function akademik()
    {
        return view('admin.akademik', [
            'pengantar' => Atur::ambil('akademik_pengantar', $this->bawaanAkademik()),
            'jadwal' => Atur::ambil('akademik_jadwal', 'Jadwal pelajaran resmi diumumkan wali kelas.'),
        ]);
    }

    public function simpanAkademik(Request $request)
    {
        Atur::isi($request->validate([
            'akademik_pengantar' => ['required', 'string', 'max:2000'],
            'akademik_jadwal' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('status', 'Pengantar akademik disimpan.');
    }

    public function ppdb()
    {
        return view('admin.ppdb', [
            'pengantar' => Atur::ambil('ppdb_pengantar', $this->bawaanPpdb()),
            'tahun' => Atur::ambil('ppdb_tahun', now()->year.'/'.(now()->year + 1)),
            'syarat' => Atur::ambil('ppdb_syarat', 'Syarat resmi diumumkan sekolah.'),
            'jadwal' => Atur::ambil('ppdb_jadwal', 'Jadwal resmi diumumkan sekolah.'),
        ]);
    }

    public function simpanPpdb(Request $request)
    {
        Atur::isi($request->validate([
            'ppdb_pengantar' => ['required', 'string', 'max:2000'],
            'ppdb_tahun' => ['required', 'string', 'max:20'],
            'ppdb_syarat' => ['required', 'string', 'max:2000'],
            'ppdb_jadwal' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('status', 'Teks PPDB disimpan.');
    }

    public function guru()
    {
        return view('admin.guru', ['guru' => Guru::query()->orderBy('nama')->get()]);
    }

    public function simpanGuru(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'jabatan' => ['required', 'string', 'max:80'],
            'tugas' => ['nullable', 'string', 'max:160'],
            'mapel' => ['nullable', 'string', 'max:80'],
            'foto' => ['nullable', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        Guru::query()->create([
            'nama' => $data['nama'],
            'jabatan' => $data['jabatan'],
            'tugas' => $data['tugas'] ?? '',
            'mapel' => $data['mapel'] ?? '',
            'aktif' => $request->boolean('aktif'),
            'foto' => $request->hasFile('foto') ? Berkas::simpan($request->file('foto')) : null,
        ]);

        return back()->with('status', 'Guru ditambahkan.');
    }

    public function hapusGuru(Guru $guru)
    {
        $guru->delete();
        Berkas::buang($guru->foto);

        return back()->with('status', 'Guru dihapus.');
    }

    public function siswa()
    {
        abort_if(auth()->user()->peran === 'penulis', 403);

        return view('admin.siswa', ['siswa' => Siswa::query()->orderBy('kelas')->orderBy('nama')->get()]);
    }

    public function simpanSiswa(Request $request)
    {
        Siswa::query()->create($request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'kelas' => ['required', 'string', 'max:20'],
            'nis' => ['nullable', 'string', 'max:30'],
        ]));

        return back()->with('status', 'Siswa ditambahkan.');
    }

    public function hapusSiswa(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('status', 'Siswa dihapus.');
    }

    public function ekskul()
    {
        return view('admin.ekskul', ['ekskul' => Ekskul::query()->orderBy('nama')->get()]);
    }

    public function simpanEkskul(Request $request)
    {
        Ekskul::query()->create($request->validate([
            'nama' => ['required', 'string', 'max:80'],
            'bidang' => ['required', 'string', 'max:40'],
            'teks' => ['required', 'string', 'max:400'],
        ]));

        return back()->with('status', 'Ekstrakurikuler ditambahkan.');
    }

    public function hapusEkskul(Ekskul $ekskul)
    {
        $ekskul->delete();

        return back()->with('status', 'Ekstrakurikuler dihapus.');
    }

    public function prestasi()
    {
        return view('admin.prestasi', ['prestasi' => Prestasi::query()->orderByDesc('tahun')->get()]);
    }

    public function simpanPrestasi(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:160'],
            'tingkat' => ['required', 'string', 'max:40'],
            'tahun' => ['required', 'string', 'max:8'],
            'kategori' => ['required', 'in:akademik,nonakademik'],
            'keterangan' => ['nullable', 'string', 'max:400'],
            'berkas' => ['nullable', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        Prestasi::query()->create([
            'judul' => $data['judul'],
            'tingkat' => $data['tingkat'],
            'tahun' => $data['tahun'],
            'kategori' => $data['kategori'],
            'keterangan' => $data['keterangan'] ?? '',
            'berkas' => $request->hasFile('berkas') ? Berkas::simpan($request->file('berkas')) : null,
        ]);

        return back()->with('status', 'Prestasi ditambahkan.');
    }

    public function hapusPrestasi(Prestasi $prestasi)
    {
        Berkas::buang($prestasi->berkas);
        $prestasi->delete();

        return back()->with('status', 'Prestasi dihapus.');
    }

    public function galeri()
    {
        return view('admin.galeri', ['galeri' => GaleriFoto::query()->latest()->get()]);
    }

    public function simpanGaleri(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:120'],
            'kategori' => ['required', 'in:kegiatan,fasilitas,prestasi'],
            'berkas' => ['required', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        GaleriFoto::query()->create([
            'judul' => $data['judul'],
            'kategori' => $data['kategori'],
            'berkas' => Berkas::simpan($request->file('berkas')),
        ]);

        return back()->with('status', 'Foto galeri ditambahkan.');
    }

    public function hapusGaleri(GaleriFoto $galeriFoto)
    {
        Berkas::buang($galeriFoto->berkas);
        $galeriFoto->delete();

        return back()->with('status', 'Foto dihapus.');
    }

    public function unduhan()
    {
        return view('admin.unduhan', ['unduhan' => Unduhan::query()->latest()->get()]);
    }

    public function simpanUnduhan(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:160'],
            'berkas' => ['required', 'file', 'max:8192', 'mimes:pdf,doc,docx,zip'],
        ]);
        Unduhan::query()->create([
            'judul' => $data['judul'],
            'berkas' => Berkas::simpan($request->file('berkas')),
        ]);

        return back()->with('status', 'Berkas unduhan ditambahkan.');
    }

    public function hapusUnduhan(Unduhan $unduhan)
    {
        Berkas::buang($unduhan->berkas);
        $unduhan->delete();

        return back()->with('status', 'Unduhan dihapus.');
    }

    public function halaman()
    {
        return view('admin.halaman', ['halaman' => Halaman::query()->orderBy('judul')->get()]);
    }

    public function simpanHalaman(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:160'],
            'isi' => ['required', 'string', 'max:5000'],
        ]);
        $slug = Str::slug($data['judul']);
        if ($slug === '') {
            $slug = 'halaman';
        }
        if (Halaman::query()->where('slug', $slug)->exists()) {
            $slug .= '-'.Str::lower(Str::random(4));
        }
        Halaman::query()->create([
            'slug' => $slug,
            'judul' => $data['judul'],
            'isi' => $data['isi'],
        ]);

        return back()->with('status', 'Halaman disimpan.');
    }

    public function hapusHalaman(Halaman $halaman)
    {
        $halaman->delete();

        return back()->with('status', 'Halaman dihapus.');
    }

    public function pengguna()
    {
        abort_if(auth()->user()->peran === 'penulis', 403);

        return view('admin.pengguna', ['pengguna' => User::query()->orderBy('name')->get()]);
    }

    public function simpanPengguna(Request $request)
    {
        User::query()->create($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'peran' => ['required', 'in:admin,penulis'],
        ]));

        return back()->with('status', 'Pengguna admin ditambahkan.');
    }

    public function hapusPengguna(User $user)
    {
        abort_if($user->is(auth()->user()) || User::query()->count() < 2, 403);

        $user->delete();

        return back()->with('status', 'Pengguna dihapus.');
    }

        return back()->with('status', 'Pengguna dihapus.');
    }

    public function fasilitas()
    {
        return view('admin.fasilitas', ['fasilitas' => Fasilitas::query()->orderBy('nama')->get()]);
    }

    public function simpanFasilitas(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'kategori' => ['required', 'string', 'max:40'],
            'deskripsi' => ['required', 'string', 'max:500'],
            'berkas' => ['nullable', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        Fasilitas::query()->create([
            'nama' => $data['nama'],
            'kategori' => $data['kategori'],
            'deskripsi' => $data['deskripsi'],
            'berkas' => $request->hasFile('berkas') ? Berkas::simpan($request->file('berkas')) : null,
        ]);

        return back()->with('status', 'Fasilitas ditambahkan.');
    }

    public function hapusFasilitas(Fasilitas $fasilitas)
    {
        Berkas::buang($fasilitas->berkas);
        $fasilitas->delete();

        return back()->with('status', 'Fasilitas dihapus.');
    }

    public function menu()
    {
        return view('admin.menu', ['menu' => MenuSitus::query()->orderBy('urutan')->get()]);
    }

    public function simpanMenu(Request $request)
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:40'],
            'tautan' => ['required', 'string', 'max:160'],
        ]);
        MenuSitus::query()->create([
            'label' => $data['label'],
            'tautan' => $data['tautan'],
            'urutan' => (int) MenuSitus::query()->max('urutan') + 1,
            'aktif' => true,
        ]);

        return back()->with('status', 'Menu ditambahkan.');
    }

    public function hapusMenu(MenuSitus $menu)
    {
        $menu->delete();

        return back()->with('status', 'Menu dihapus.');
    }

    public function urutMenu(MenuSitus $menu, string $arah)
    {
        abort_unless(in_array($arah, ['naik', 'turun'], true), 404);
        $lain = MenuSitus::query()
            ->where('urutan', $arah === 'naik' ? '<' : '>', $menu->urutan)
            ->orderBy('urutan', $arah === 'naik' ? 'desc' : 'asc')
            ->first();
        if ($lain) {
            $sementara = $menu->urutan;
            $menu->update(['urutan' => $lain->urutan]);
            $lain->update(['urutan' => $sementara]);
        }

        return back();
    }

    public function kesiswaan()
    {
        return view('admin.kesiswaan', ['pengurus' => Pengurus::query()->orderBy('jabatan')->get()]);
    }

    public function simpanPengurus(Request $request)
    {
        Pengurus::query()->create($request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'jabatan' => ['required', 'string', 'max:80'],
        ]));

        return back()->with('status', 'Pengurus ditambahkan.');
    }

    public function hapusPengurus(Pengurus $pengurus)
    {
        $pengurus->delete();

        return back()->with('status', 'Pengurus dihapus.');
    }

    public function media()
    {
        $dir = public_path('unggah');
        $berkas = collect(is_dir($dir) ? scandir($dir) : [])
            ->reject(fn ($nama) => str_starts_with((string) $nama, '.'))
            ->values();

        return view('admin.media', ['berkas' => $berkas]);
    }

    public function hapusMedia(Request $request)
    {
        $nama = basename((string) $request->input('nama'));
        abort_unless($nama !== '' && $nama !== '.' && $nama !== '..', 404);
        Berkas::buang('unggah/'.$nama);

        return back()->with('status', 'Berkas dihapus dari penyimpanan.');
    }

    private function bawaanProfil(): array
    {
        return [
            'nama' => 'SMAN 1 Banjar Margo',
            'motto' => 'Berilmu, Berkarakter, Berprestasi',
            'kepala' => 'Darma Asmarawati',
            'npsn' => '10810271',
            'akreditasi' => 'A',
            'telepon' => '0812-7900-0664',
            'email' => 'smanegeri1banjarmargo@yahoo.co.id',
            'alamat' => 'Jl. Lintas Timur Km 159, Bujuk Agung, Banjar Margo, Tulang Bawang, Lampung 34595',
            'sejarah' => 'Sekolah negeri di Bujuk Agung. Berdiri 12 Juli 2006.',
            'visi' => 'Sekolah yang berilmu, berkarakter, dan berprestasi.',
            'misi' => 'Menyelenggarakan pembelajaran lima hari dan kegiatan siswa yang tertib.',
            'sambutan' => 'Selamat datang di situs SMAN 1 Banjar Margo.',
        ];
    }

    private function bawaanAkademik(): string
    {
        return 'Belajar lima hari, Senin sampai Jumat, sehari penuh. Daftar mata pelajaran di halaman ini gambaran umum, bukan jadwal resmi semester berjalan.';
    }

    private function bawaanPpdb(): string
    {
        return 'Halaman ini contoh alur. Syarat, jadwal, dan tautan resmi penerimaan siswa diumumkan oleh sekolah.';
    }
}
