<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;

class SitusController extends Controller
{
    public function beranda()
    {
        return view('beranda', [
            'pengumuman' => Pengumuman::query()->orderByDesc('tanggal')->take(4)->get(),
            'berita' => Berita::query()->orderByDesc('tanggal')->take(3)->get(),
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
}
