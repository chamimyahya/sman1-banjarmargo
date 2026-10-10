<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SitusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitusController::class, 'beranda']);
Route::view('/profil', 'profil');
Route::view('/akademik', 'akademik');
Route::view('/kesiswaan', 'kesiswaan');
Route::view('/kontak', 'kontak');
Route::post('/kontak', [SitusController::class, 'kirimPesan']);
Route::view('/galeri', 'galeri');
Route::view('/ppdb', 'ppdb');
Route::get('/pengumuman', [SitusController::class, 'pengumuman']);
Route::get('/pengumuman/{pengumuman}', [SitusController::class, 'bacaPengumuman']);
Route::get('/berita', [SitusController::class, 'berita']);
Route::get('/berita/{berita}', [SitusController::class, 'bacaBerita']);

Route::get('/admin/masuk', [AdminController::class, 'form'])->name('login');
Route::post('/admin/masuk', [AdminController::class, 'masuk']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dasbor']);
    Route::get('/admin/berita', [AdminController::class, 'halamanBerita']);
    Route::get('/admin/berita/{berita}/ubah', [AdminController::class, 'ubahBerita']);
    Route::post('/admin/berita/{berita}', [AdminController::class, 'perbaruiBerita']);
    Route::get('/admin/pengumuman', [AdminController::class, 'halamanPengumuman']);
    Route::get('/admin/pengumuman/{pengumuman}/ubah', [AdminController::class, 'ubahPengumuman']);
    Route::post('/admin/pengumuman/{pengumuman}', [AdminController::class, 'perbaruiPengumuman']);
    Route::get('/admin/agenda', [AdminController::class, 'halamanAgenda']);
    Route::get('/admin/agenda/{agenda}/ubah', [AdminController::class, 'ubahAgenda']);
    Route::post('/admin/agenda/{agenda}', [AdminController::class, 'perbaruiAgenda']);
    Route::get('/admin/pesan', [AdminController::class, 'halamanPesan']);
    Route::post('/admin/pesan/{pesan}/hapus', [AdminController::class, 'hapusPesan']);
    Route::get('/admin/pengaturan', [AdminController::class, 'halamanPengaturan']);
    Route::post('/admin/keluar', [AdminController::class, 'keluar']);
    Route::post('/admin/pengumuman', [AdminController::class, 'simpanPengumuman']);
    Route::post('/admin/pengumuman/{pengumuman}/hapus', [AdminController::class, 'hapusPengumuman']);
    Route::post('/admin/berita', [AdminController::class, 'simpanBerita']);
    Route::post('/admin/berita/{berita}/hapus', [AdminController::class, 'hapusBerita']);
    Route::post('/admin/agenda', [AdminController::class, 'simpanAgenda']);
    Route::post('/admin/agenda/{agenda}/hapus', [AdminController::class, 'hapusAgenda']);
    Route::post('/admin/sandi', [AdminController::class, 'sandi']);
});
