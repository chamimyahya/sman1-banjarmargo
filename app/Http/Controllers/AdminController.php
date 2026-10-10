<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\GaleriFoto;
use App\Models\Kunjungan;
use App\Models\Pengumuman;
use App\Models\Pesan;
use App\Models\Prestasi;
use App\Models\User;
use App\Support\Atur;
use App\Support\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Throwable;

class AdminController extends Controller
{
    public function form()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }

        return view('admin.masuk');
    }

    public function masuk(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($data, true)) {
            return back()
                ->withErrors(['email' => 'Email atau kata sandi salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/admin');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/masuk');
    }

    public function dasbor(Request $request)
    {
        $hari = collect(range(29, 0))->map(fn (int $i) => now()->startOfDay()->subDays($i));
        try {
            $peta = Kunjungan::query()->get()->mapWithKeys(
                fn (Kunjungan $baris) => [$baris->tanggal->toDateString() => $baris->jumlah],
            );
        } catch (Throwable) {
            $peta = collect();
        }
        $seri = $hari->map(fn ($tgl) => [
            'label' => $tgl->translatedFormat('D'),
            'jumlah' => (int) ($peta[$tgl->toDateString()] ?? 0),
        ]);
        $hariIni = (int) ($peta[now()->toDateString()] ?? 0);
        $kemarin = (int) ($peta[now()->subDay()->toDateString()] ?? 0);

        return view('admin.dasbor', [
            'seri' => $seri,
            'hariIni' => $hariIni,
            'selisih' => $kemarin > 0 ? (int) round((($hariIni - $kemarin) / $kemarin) * 100) : null,
            'jumlahBerita' => Berita::query()->count(),
            'jumlahPengumuman' => Pengumuman::query()->count(),
            'jumlahAgenda' => Agenda::query()->whereDate('tanggal', '>=', now()->toDateString())->count(),
            'jumlahGaleri' => $this->jumlahAman(GaleriFoto::class),
            'jumlahPrestasi' => $this->jumlahAman(Prestasi::class),
            'berita' => Berita::query()->orderByDesc('tanggal')->take(5)->get(),
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->take(5)->get(),
            'agenda' => Agenda::query()->whereDate('tanggal', '>=', now()->toDateString())->orderBy('tanggal')->take(5)->get(),
            'cari' => $request->string('q')->trim()->toString(),
            'hasilBerita' => $this->cari(Berita::class, $request),
            'hasilPengumuman' => $this->cari(Pengumuman::class, $request),
        ]);
    }

    public function halamanBerita()
    {
        return view('admin.berita', [
            'berita' => Berita::query()->orderByDesc('tanggal')->get(),
            'ubah' => null,
        ]);
    }

    public function ubahBerita(Berita $berita)
    {
        return view('admin.berita', [
            'berita' => Berita::query()->orderByDesc('tanggal')->get(),
            'ubah' => $berita,
        ]);
    }

    public function halamanPengumuman()
    {
        return view('admin.pengumuman', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->get(),
            'ubah' => null,
        ]);
    }

    public function ubahPengumuman(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->get(),
            'ubah' => $pengumuman,
        ]);
    }

    public function halamanAgenda()
    {
        return view('admin.agenda', [
            'agenda' => Agenda::query()->orderBy('tanggal')->get(),
            'ubah' => null,
        ]);
    }

    public function ubahAgenda(Agenda $agenda)
    {
        return view('admin.agenda', [
            'agenda' => Agenda::query()->orderBy('tanggal')->get(),
            'ubah' => $agenda,
        ]);
    }

    public function halamanPesan(Request $request)
    {
        $arsip = $request->boolean('arsip');

        return view('admin.pesan', [
            'pesan' => Pesan::query()->where('diarsipkan', $arsip)->latest()->get(),
            'arsip' => $arsip,
        ]);
    }

    public function halamanPengaturan()
    {
        abort_if(auth()->user()->peran === 'penulis', 403);

        return view('admin.pengaturan', [
            'seo' => Atur::ambil('seo', 'Situs SMAN 1 Banjar Margo'),
            'instagram' => Atur::ambil('instagram', ''),
            'facebook' => Atur::ambil('facebook', ''),
            'youtube' => Atur::ambil('youtube', ''),
            'logo' => Atur::ambil('logo', ''),
        ]);
    }

    public function simpanIdentitas(Request $request)
    {
        abort_if(auth()->user()->peran === 'penulis', 403);
        $data = $request->validate([
            'seo' => ['nullable', 'string', 'max:180'],
            'instagram' => ['nullable', 'string', 'max:160'],
            'facebook' => ['nullable', 'string', 'max:160'],
            'youtube' => ['nullable', 'string', 'max:160'],
            'logo' => ['nullable', 'file', 'max:2048', 'mimes:jpg,jpeg,png,webp'],
        ]);
        $isi = [
            'seo' => $data['seo'] ?? '',
            'instagram' => $data['instagram'] ?? '',
            'facebook' => $data['facebook'] ?? '',
            'youtube' => $data['youtube'] ?? '',
        ];
        if ($request->hasFile('logo')) {
            Berkas::buang(Atur::ambil('logo'));
            $isi['logo'] = Berkas::simpan($request->file('logo'));
        }
        Atur::isi($isi);

        return back()->with('status', 'Identitas situs disimpan.');
    }

    private function jumlahAman(string $model): int
    {
        try {
            return $model::query()->count();
        } catch (Throwable) {
            return 0;
        }
    }

    private function cari(string $model, Request $request)
    {
        $kata = str_replace(['%', '_'], ['\\%', '\\_'], $request->string('q')->trim()->toString());
        if ($kata === '') {
            return collect();
        }

        return $model::query()
            ->where('judul', 'like', '%'.$kata.'%')
            ->orderByDesc('tanggal')
            ->take(8)
            ->get();
    }

    public function simpanPengumuman(Request $request)
    {
        Pengumuman::query()->create($this->dataPengumuman($request));

        return back()->with('status', 'Pengumuman ditambahkan.');
    }

    public function perbaruiPengumuman(Request $request, Pengumuman $pengumuman)
    {
        $pengumuman->update($this->dataPengumuman($request));

        return redirect('/admin/pengumuman')->with('status', 'Pengumuman diperbarui.');
    }

    public function hapusPengumuman(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return back()->with('status', 'Pengumuman dihapus.');
    }

    public function simpanBerita(Request $request)
    {
        Berita::query()->create($this->dataBerita($request));

        return back()->with('status', 'Berita ditambahkan.');
    }

    public function perbaruiBerita(Request $request, Berita $berita)
    {
        $berita->update($this->dataBerita($request, $berita));

        return redirect('/admin/berita')->with('status', 'Berita diperbarui.');
    }

    public function hapusBerita(Berita $berita)
    {
        Berkas::buang($berita->gambar);
        $berita->delete();

        return back()->with('status', 'Berita dihapus.');
    }

    public function simpanAgenda(Request $request)
    {
        Agenda::query()->create($this->dataAgenda($request));

        return back()->with('status', 'Agenda ditambahkan.');
    }

    public function perbaruiAgenda(Request $request, Agenda $agenda)
    {
        $agenda->update($this->dataAgenda($request));

        return redirect('/admin/agenda')->with('status', 'Agenda diperbarui.');
    }

    public function hapusAgenda(Agenda $agenda)
    {
        $agenda->delete();

        return back()->with('status', 'Agenda dihapus.');
    }

    public function sandi(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        /** @var User $user */
        $user = $request->user();
        $user->password = $data['password'];
        $user->save();

        return back()->with('status', 'Kata sandi diganti.');
    }

    public function hapusPesan(Pesan $pesan)
    {
        $pesan->delete();

        return back()->with('status', 'Pesan dihapus.');
    }

    public function bacaPesan(Pesan $pesan)
    {
        $pesan->update(['dibaca_pada' => now()]);

        return back();
    }

    public function arsipPesan(Pesan $pesan)
    {
        $pesan->update(['diarsipkan' => ! $pesan->diarsipkan]);

        return back()->with('status', 'Arsip pesan diperbarui.');
    }

    public function balasPesan(Request $request, Pesan $pesan)
    {
        $data = $request->validate(['balasan' => ['required', 'string', 'max:2000']]);
        $pesan->update([
            'balasan' => $data['balasan'],
            'dibaca_pada' => $pesan->dibaca_pada ?? now(),
        ]);

        return back()->with('status', 'Balasan disimpan di panel. Tidak dikirim ke surel pengirim.');
    }

    private function dataAgenda(Request $request): array
    {
        return $request->validate([
            'tanggal' => ['required', 'date'],
            'judul' => ['required', 'string', 'max:160'],
            'tempat' => ['required', 'string', 'max:160'],
            'kategori' => ['required', 'in:sekolah,akademik,kesiswaan,rapat'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    private function dataPengumuman(Request $request): array
    {
        $data = $this->naskah($request);
        $data['penting'] = $request->boolean('penting');
        $data['tampil_beranda'] = $request->boolean('tampil_beranda');

        return $data;
    }

    private function dataBerita(Request $request, ?Berita $lama = null): array
    {
        $data = $this->naskah($request);
        $tambah = $request->validate([
            'kategori' => ['required', 'in:kegiatan,akademik,prestasi,umum'],
            'status' => ['required', 'in:terbit,draf'],
            'gambar' => ['nullable', 'file', 'max:4096', 'mimes:jpg,jpeg,png,webp'],
        ]);
        $data['kategori'] = $tambah['kategori'];
        $data['status'] = $tambah['status'];
        if ($request->hasFile('gambar')) {
            Berkas::buang($lama?->gambar);
            $data['gambar'] = Berkas::simpan($request->file('gambar'));
        }

        return $data;
    }

    private function naskah(Request $request): array
    {
        return $request->validate([
            'tanggal' => ['required', 'date'],
            'judul' => ['required', 'string', 'max:160'],
            'ringkas' => ['required', 'string', 'max:220'],
            'isi' => ['required', 'string', 'max:5000'],
        ]);
    }
}
