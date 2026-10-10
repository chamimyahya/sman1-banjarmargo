<?php

use Illuminate\Support\Facades\Route;

$pengumuman = [
    [
        'id' => 'ppdb-contoh',
        'tanggal' => '10 Oktober 2026',
        'judul' => 'Contoh pengumuman PPDB',
        'ringkas' => 'Ini contoh. Ganti dengan jadwal resmi penerimaan siswa baru.',
        'isi' => 'Pengumuman ini hanya contoh agar halaman Laravel sudah terisi. Jadwal, syarat, dan tautan resmi PPDB diumumkan oleh sekolah.',
    ],
    [
        'id' => 'libur-contoh',
        'tanggal' => '8 Oktober 2026',
        'judul' => 'Contoh pemberitahuan kegiatan',
        'ringkas' => 'Contoh kabar kegiatan siswa. Belum pengumuman resmi.',
        'isi' => 'Ganti teks ini di routes/web.php sampai panel admin dibuat.',
    ],
];

Route::get('/', function () use ($pengumuman) {
    return view('beranda', ['pengumuman' => $pengumuman]);
});

Route::view('/profil', 'profil');

Route::get('/pengumuman', function () use ($pengumuman) {
    return view('pengumuman', ['pengumuman' => $pengumuman]);
});

Route::get('/pengumuman/{id}', function (string $id) use ($pengumuman) {
    $item = collect($pengumuman)->firstWhere('id', $id);
    abort_if($item === null, 404);

    return view('pengumuman-baca', ['item' => $item]);
});

Route::view('/kontak', 'kontak');
