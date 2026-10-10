<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique();
            $table->text('nilai')->nullable();
            $table->timestamps();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('tugas')->nullable();
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelas');
            $table->string('nis')->nullable();
            $table->timestamps();
        });

        Schema::create('ekskul', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang');
            $table->text('teks');
            $table->timestamps();
        });

        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('tingkat');
            $table->string('tahun', 8);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('berkas');
            $table->timestamps();
        });

        Schema::create('unduhan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('berkas');
            $table->timestamps();
        });

        Schema::create('halaman', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('judul');
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halaman');
        Schema::dropIfExists('unduhan');
        Schema::dropIfExists('galeri_foto');
        Schema::dropIfExists('prestasi');
        Schema::dropIfExists('ekskul');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('pengaturan');
    }
};
