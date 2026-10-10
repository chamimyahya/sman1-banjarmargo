<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\GaleriFoto;
use App\Models\Guru;
use App\Models\Halaman;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Unduhan;
use App\Models\User;
use App\Support\Atur;
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
        ]));

        return back()->with('status', 'Profil sekolah disimpan.');
    }

    public function akademik()
    {
        return view('admin.akademik', [
            'pengantar' => Atur::ambil('akademik_pengantar', $this->bawaanAkademik()),
        ]);
    }

    public function simpanAkademik(Request $request)
    {
        Atur::isi($request->validate([
            'akademik_pengantar' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('status', 'Pengantar akademik disimpan.');
    }

    public function ppdb()
    {
        return view('admin.ppdb', [
            'pengantar' => Atur::ambil('ppdb_pengantar', $this->bawaanPpdb()),
        ]);
    }

    public function simpanPpdb(Request $request)
    {
        Atur::isi($request->validate([
            'ppdb_pengantar' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('status', 'Teks PPDB disimpan.');
    }

    public function guru()
    {
        return view('admin.guru', ['guru' => Guru::query()->orderBy('nama')->get()]);
    }

    public function simpanGuru(Request $request)
    {
        Guru::query()->create($request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'jabatan' => ['required', 'string', 'max:80'],
            'tugas' => ['nullable', 'string', 'max:160'],
        ]));

        return back()->with('status', 'Guru ditambahkan.');
    }

    public function hapusGuru(Guru $guru)
    {
        $guru->delete();

        return back()->with('status', 'Guru dihapus.');
    }

    public function siswa()
    {
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
        Prestasi::query()->create($request->validate([
            'judul' => ['required', 'string', 'max:160'],
            'tingkat' => ['required', 'string', 'max:40'],
            'tahun' => ['required', 'string', 'max:8'],
            'keterangan' => ['nullable', 'string', 'max:400'],
        ]));

        return back()->with('status', 'Prestasi ditambahkan.');
    }

    public function hapusPrestasi(Prestasi $prestasi)
    {
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
            'berkas' => ['required', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        GaleriFoto::query()->create([
            'judul' => $data['judul'],
            'berkas' => $this->simpanBerkas($request, 'berkas'),
        ]);

        return back()->with('status', 'Foto galeri ditambahkan.');
    }

    public function hapusGaleri(GaleriFoto $galeriFoto)
    {
        $this->buangBerkas($galeriFoto->berkas);
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
            'berkas' => $this->simpanBerkas($request, 'berkas'),
        ]);

        return back()->with('status', 'Berkas unduhan ditambahkan.');
    }

    public function hapusUnduhan(Unduhan $unduhan)
    {
        $this->buangBerkas($unduhan->berkas);
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
        return view('admin.pengguna', ['pengguna' => User::query()->orderBy('name')->get()]);
    }

    public function simpanPengguna(Request $request)
    {
        User::query()->create($request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]));

        return back()->with('status', 'Pengguna admin ditambahkan.');
    }

    public function hapusPengguna(User $user)
    {
        abort_if($user->is(auth()->user()) || User::query()->count() < 2, 403);

        $user->delete();

        return back()->with('status', 'Pengguna dihapus.');
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

    private function simpanBerkas(Request $request, string $kolom): string
    {
        $file = $request->file($kolom);
        $ext = strtolower($file->getClientOriginalExtension());
        $nama = now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$ext;
        $dir = public_path('unggah');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $file->move($dir, $nama);

        return 'unggah/'.$nama;
    }

    private function buangBerkas(?string $path): void
    {
        if ($path && str_starts_with($path, 'unggah/')) {
            $penuh = public_path($path);
            if (is_file($penuh)) {
                unlink($penuh);
            }
        }
    }
}
