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
            'fotoBerita' => ['images/workshop.jpg', 'images/ujian.jpg', 'images/kelas.jpg'],
            'agenda' => [
                ['tanggal' => '12 Okt', 'judul' => 'Contoh rapat orang tua', 'tempat' => 'Aula sekolah'],
                ['tanggal' => '18 Okt', 'judul' => 'Contoh lomba kelas', 'tempat' => 'Lapangan'],
                ['tanggal' => '25 Okt', 'judul' => 'Contoh pembagian rapor', 'tempat' => 'Diumumkan wali kelas'],
            ],
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
