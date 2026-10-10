<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@sman1banjarmargo.sch.id'],
            ['name' => 'Admin Sekolah', 'password' => 'banjarmargo'],
        );

        Pengumuman::query()->updateOrCreate(
            ['judul' => 'Contoh pengumuman PPDB'],
            [
                'tanggal' => '2026-10-10',
                'ringkas' => 'Ini contoh. Ganti dengan jadwal resmi penerimaan siswa baru.',
                'isi' => 'Pengumuman ini hanya contoh agar halaman sudah terisi. Jadwal, syarat, dan tautan resmi PPDB diumumkan oleh sekolah.',
            ],
        );

        Pengumuman::query()->updateOrCreate(
            ['judul' => 'Contoh pemberitahuan kegiatan'],
            [
                'tanggal' => '2026-10-08',
                'ringkas' => 'Contoh kabar kegiatan siswa. Belum pengumuman resmi.',
                'isi' => 'Hapus contoh ini dari panel admin, lalu tulis pengumuman yang benar-benar dikeluarkan sekolah.',
            ],
        );

        Berita::query()->updateOrCreate(
            ['judul' => 'Contoh berita kegiatan sekolah'],
            [
                'tanggal' => '2026-10-06',
                'ringkas' => 'Contoh kabar. Belum berita resmi SMAN 1 Banjar Margo.',
                'isi' => 'Tulis berita kegiatan sekolah dari panel admin. Teks ini sengaja ditandai sebagai contoh.',
            ],
        );
    }
}
