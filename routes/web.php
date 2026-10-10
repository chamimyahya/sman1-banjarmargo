<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SitusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitusController::class, 'beranda']);
Route::view('/profil', 'profil');
Route::view('/kontak', 'kontak');
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
    Route::post('/admin/keluar', [AdminController::class, 'keluar']);
    Route::post('/admin/pengumuman', [AdminController::class, 'simpanPengumuman']);
    Route::post('/admin/pengumuman/{pengumuman}/hapus', [AdminController::class, 'hapusPengumuman']);
    Route::post('/admin/berita', [AdminController::class, 'simpanBerita']);
    Route::post('/admin/berita/{berita}/hapus', [AdminController::class, 'hapusBerita']);
    Route::post('/admin/sandi', [AdminController::class, 'sandi']);
});
