<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    public function dasbor()
    {
        return view('admin.dasbor', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->get(),
            'berita' => Berita::query()->orderByDesc('tanggal')->get(),
        ]);
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
