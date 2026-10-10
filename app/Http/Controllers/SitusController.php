<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Pesan;
use Illuminate\Http\Request;

class SitusController extends Controller
{
    public function beranda()
    {
        return view('beranda', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->take(4)->get(),
            'berita' => Berita::query()->orderByDesc('tanggal')->take(3)->get(),
            'fotoBerita' => ['images/workshop.jpg', 'images/ujian.jpg', 'images/kelas.jpg'],
            'agenda' => Agenda::query()->orderBy('tanggal')->take(6)->get(),
        ]);
    }

    public function pengumuman()
    {
        return view('pengumuman', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->get(),
        ]);
    }

    public function bacaPengumuman(Pengumuman $pengumuman)
    {
        return view('pengumuman-baca', ['item' => $pengumuman]);
    }

    public function berita()
    {
        return view('berita', [
            'berita' => Berita::query()->orderByDesc('tanggal')->get(),
        ]);
    }

    public function bacaBerita(Berita $berita)
    {
        return view('berita-baca', ['item' => $berita]);
    }

    public function kirimPesan(Request $request)
    {
        Pesan::query()->create($request->validate([
            'nama' => ['required', 'string', 'max:80'],
            'kontak' => ['required', 'string', 'max:120'],
            'isi' => ['required', 'string', 'max:2000'],
        ]));

        return back()->with('status', 'Pesan tersimpan di panel admin. Untuk hal mendesak, telepon sekolah.');
    }
}
