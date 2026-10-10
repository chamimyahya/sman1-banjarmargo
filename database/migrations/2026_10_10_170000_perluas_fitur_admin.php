<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->string('kategori')->default('kegiatan');
            $table->string('status')->default('terbit');
            $table->string('gambar')->nullable();
        });
        Schema::table('pengumuman', function (Blueprint $table) {
            $table->boolean('penting')->default(false);
            $table->boolean('tampil_beranda')->default(true);
        });
        Schema::table('agenda', function (Blueprint $table) {
            $table->string('kategori')->default('sekolah');
            $table->text('deskripsi')->nullable();
        });
        Schema::table('prestasi', function (Blueprint $table) {
            $table->string('kategori')->default('akademik');
            $table->string('berkas')->nullable();
        });
        Schema::table('galeri_foto', function (Blueprint $table) {
            $table->string('kategori')->default('kegiatan');
        });
        Schema::table('guru', function (Blueprint $table) {
            $table->string('mapel')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('aktif')->default(true);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('peran')->default('admin');
        });
        Schema::table('pesan', function (Blueprint $table) {
            $table->text('balasan')->nullable();
            $table->boolean('diarsipkan')->default(false);
        });
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('berkas')->nullable();
            $table->timestamps();
        });
        Schema::create('menu_situs', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('tautan');
            $table->unsignedInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengurus');
        Schema::dropIfExists('menu_situs');
        Schema::dropIfExists('fasilitas');
    }
};
