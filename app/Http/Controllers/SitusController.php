<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekskul;
use App\Models\Fasilitas;
use App\Models\GaleriFoto;
use App\Models\Guru;
use App\Models\Halaman;
use App\Models\MenuSitus;
use App\Models\Pengurus;
use App\Models\Pengumuman;
use App\Models\Pesan;
use App\Models\Prestasi;
use App\Models\Unduhan;
use App\Support\Atur;
use Illuminate\Http\Request;
use Throwable;

class SitusController extends Controller
{
    public function beranda()
    {
        return view('beranda', [
            'pengumuman' => $this->aman(fn () => Pengumuman::query()->where('tampil_beranda', true)->orderByDesc('tanggal')->take(4)->get(), fn () => Pengumuman::query()->orderByDesc('tanggal')->take(4)->get()),
            'berita' => $this->aman(fn () => Berita::query()->where('status', 'terbit')->orderByDesc('tanggal')->take(3)->get(), fn () => Berita::query()->orderByDesc('tanggal')->take(3)->get()),
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
            'berita' => $this->aman(fn () => Berita::query()->where('status', 'terbit')->orderByDesc('tanggal')->get(), fn () => Berita::query()->orderByDesc('tanggal')->get()),
        ]);
    }

    public function bacaBerita(Berita $berita)
    {
        abort_if($berita->status === 'draf', 404);

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

    public function profil()
    {
        return view('profil', [
            'profil' => Atur::banyak([
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
            ]),
        ]);
    }

    public function akademik()
    {
        return view('akademik', [
            'pengantar' => Atur::ambil('akademik_pengantar', 'Belajar lima hari, Senin sampai Jumat, sehari penuh. Daftar mata pelajaran ini gambaran umum, bukan jadwal resmi semester berjalan.'),
            'jadwal' => Atur::ambil('akademik_jadwal', 'Jadwal pelajaran resmi diumumkan wali kelas.'),
        ]);
    }

    public function kesiswaan()
    {
        return view('kesiswaan', [
            'ekskul' => $this->aman(fn () => Ekskul::query()->orderBy('nama')->get()),
            'pengurus' => $this->aman(fn () => Pengurus::query()->orderBy('jabatan')->get()),
        ]);
    }

    public function guru()
    {
        return view('guru', ['guru' => $this->aman(fn () => Guru::query()->where('aktif', true)->orderBy('nama')->get(), fn () => Guru::query()->orderBy('nama')->get())]);
    }

    public function prestasi()
    {
        return view('prestasi', ['prestasi' => $this->aman(fn () => Prestasi::query()->orderByDesc('tahun')->get())]);
    }

    public function galeri()
    {
        return view('galeri', ['galeri' => $this->aman(fn () => GaleriFoto::query()->latest()->get())]);
    }

    public function ppdb()
    {
        return view('ppdb', [
            'pengantar' => Atur::ambil('ppdb_pengantar', 'Halaman ini contoh alur. Syarat dan jadwal resmi diumumkan oleh sekolah.'),
            'tahun' => Atur::ambil('ppdb_tahun', ''),
            'syarat' => Atur::ambil('ppdb_syarat', ''),
            'jadwal' => Atur::ambil('ppdb_jadwal', ''),
        ]);
    }

    public function unduhan()
    {
        return view('unduhan', ['unduhan' => $this->aman(fn () => Unduhan::query()->latest()->get())]);
    }

    public function fasilitas()
    {
        return view('fasilitas', ['fasilitas' => $this->aman(fn () => Fasilitas::query()->orderBy('nama')->get())]);
    }

    public function halaman(Halaman $halaman)
    {
        return view('halaman', ['halaman' => $halaman]);
    }

    private function aman(callable $ambil, ?callable $cadangan = null)
    {
        try {
            return $ambil();
        } catch (Throwable) {
            if ($cadangan) {
                try {
                    return $cadangan();
                } catch (Throwable) {
                    return collect();
                }
            }

            return collect();
        }
    }
}
