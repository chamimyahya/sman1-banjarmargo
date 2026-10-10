<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Ekskul;
use App\Models\GaleriFoto;
use App\Models\Guru;
use App\Models\Halaman;
use App\Models\Pengaturan;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
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

        Agenda::query()->updateOrCreate(
            ['judul' => 'Contoh rapat orang tua'],
            ['tanggal' => '2026-10-12', 'tempat' => 'Aula sekolah'],
        );
        Agenda::query()->updateOrCreate(
            ['judul' => 'Contoh lomba kelas'],
            ['tanggal' => '2026-10-18', 'tempat' => 'Lapangan'],
        );
        Agenda::query()->updateOrCreate(
            ['judul' => 'Contoh pembagian rapor'],
            ['tanggal' => '2026-10-25', 'tempat' => 'Diumumkan wali kelas'],
        );

        foreach ([
            'nama' => 'SMAN 1 Banjar Margo',
            'motto' => 'Berilmu, Berkarakter, Berprestasi',
            'kepala' => 'Darma Asmarawati',
            'npsn' => '10810271',
            'akreditasi' => 'A',
            'telepon' => '0812-7900-0664',
            'email' => 'smanegeri1banjarmargo@yahoo.co.id',
            'alamat' => 'Jl. Lintas Timur Km 159, Bujuk Agung, Banjar Margo, Tulang Bawang, Lampung 34595',
            'sejarah' => 'Sekolah negeri di Bujuk Agung, Kecamatan Banjar Margo, Kabupaten Tulang Bawang. Berdiri 12 Juli 2006.',
            'akademik_pengantar' => 'Belajar lima hari, Senin sampai Jumat, sehari penuh. Daftar mata pelajaran ini gambaran umum, bukan jadwal resmi semester berjalan.',
            'ppdb_pengantar' => 'Halaman ini contoh alur. Syarat, jadwal, dan tautan resmi penerimaan siswa diumumkan oleh sekolah.',
        ] as $kunci => $nilai) {
            Pengaturan::query()->firstOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        }

        Guru::query()->firstOrCreate(
            ['nama' => 'Darma Asmarawati'],
            ['jabatan' => 'Kepala sekolah', 'tugas' => 'Pimpinan sekolah'],
        );

        foreach ([
            ['Pramuka', 'Wajib', 'Latihan rutin, baris-berbaris, dan bakti lingkungan.'],
            ['Paskibra', 'Bela negara', 'Pasukan pengibar bendera untuk upacara sekolah.'],
            ['PMR', 'Sosial', 'Pertolongan pertama saat kegiatan lapangan.'],
            ['Rohani Islam', 'Keagamaan', 'Kajian dan kultum pada hari besar Islam.'],
            ['OSIS', 'Organisasi', 'Mengurus kegiatan dan aspirasi siswa.'],
            ['Futsal', 'Olahraga', 'Latihan teknik dan pertandingan antar kelas.'],
            ['Bola voli', 'Olahraga', 'Tim putra dan putri.'],
            ['Pencak silat', 'Olahraga', 'Dasar bela diri dan disiplin.'],
            ['Paduan suara', 'Seni', 'Latihan vokal untuk upacara dan pentas.'],
            ['Tari', 'Seni', 'Tari daerah Lampung untuk acara sekolah.'],
        ] as [$nama, $bidang, $teks]) {
            Ekskul::query()->firstOrCreate(
                ['nama' => $nama],
                ['bidang' => $bidang, 'teks' => $teks],
            );
        }

        Prestasi::query()->firstOrCreate(
            ['judul' => 'Contoh prestasi, ganti dengan data resmi'],
            ['tingkat' => 'Contoh', 'tahun' => '2026', 'keterangan' => 'Hapus baris ini jika bukan prestasi yang benar-benar diraih.'],
        );

        foreach ([
            ['Gedung sekolah', 'images/gedung.jpg'],
            ['Ruang kelas', 'images/kelas.jpg'],
            ['Lapangan', 'images/lapangan.jpg'],
            ['Perpustakaan', 'images/perpustakaan.jpg'],
            ['Laboratorium', 'images/laboratorium.jpg'],
            ['Seni', 'images/seni.jpg'],
            ['Aula', 'images/workshop.jpg'],
            ['Ujian', 'images/ujian.jpg'],
        ] as [$judul, $berkas]) {
            GaleriFoto::query()->firstOrCreate(
                ['judul' => $judul],
                ['berkas' => $berkas],
            );
        }

        Halaman::query()->firstOrCreate(
            ['slug' => 'sejarah'],
            ['judul' => 'Sejarah singkat', 'isi' => 'SMAN 1 Banjar Margo berdiri pada 12 Juli 2006 di Bujuk Agung, Banjar Margo, Tulang Bawang.'],
        );
    }
}
