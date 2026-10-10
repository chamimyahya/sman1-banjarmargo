<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Kunjungan;
use App\Models\Pengumuman;
use App\Models\User;
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
        $hari = collect(range(6, 0))->map(fn (int $i) => now()->startOfDay()->subDays($i));
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
            'berita' => Berita::query()->orderByDesc('tanggal')->take(5)->get(),
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->take(5)->get(),
            'agenda' => Agenda::query()->orderBy('tanggal')->take(5)->get(),
            'cari' => $request->string('q')->trim()->toString(),
            'hasilBerita' => $this->cari(Berita::class, $request),
            'hasilPengumuman' => $this->cari(Pengumuman::class, $request),
        ]);
    }

    public function halamanBerita()
    {
        return view('admin.berita', [
            'berita' => Berita::query()->orderByDesc('tanggal')->get(),
        ]);
    }

    public function halamanPengumuman()
    {
        return view('admin.pengumuman', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->get(),
        ]);
    }

    public function halamanAgenda()
    {
        return view('admin.agenda', [
            'agenda' => Agenda::query()->orderBy('tanggal')->get(),
        ]);
    }

    public function halamanPengaturan()
    {
        return view('admin.pengaturan');
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
        Pengumuman::query()->create($this->naskah($request));

        return back()->with('status', 'Pengumuman ditambahkan.');
    }

    public function hapusPengumuman(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return back()->with('status', 'Pengumuman dihapus.');
    }

    public function simpanBerita(Request $request)
    {
        Berita::query()->create($this->naskah($request));

        return back()->with('status', 'Berita ditambahkan.');
    }

    public function hapusBerita(Berita $berita)
    {
        $berita->delete();

        return back()->with('status', 'Berita dihapus.');
    }

    public function simpanAgenda(Request $request)
    {
        Agenda::query()->create($request->validate([
            'tanggal' => ['required', 'date'],
            'judul' => ['required', 'string', 'max:160'],
            'tempat' => ['required', 'string', 'max:160'],
        ]));

        return back()->with('status', 'Agenda ditambahkan.');
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
