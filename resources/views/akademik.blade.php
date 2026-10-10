@extends('layouts.sekolah')
@section('judul', 'Akademik — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <p class="kecil">Akademik</p>
    <h1>Belajar lima hari, dari pagi sampai selesai</h1>
    <p>Mata pelajaran mengikuti struktur SMA yang ditetapkan pemerintah dan dapat berubah sesuai kurikulum tahun berjalan. Daftar ini gambaran umum, bukan jadwal resmi semester ini.</p>
    <div class="agenda">
        <article><strong>5 hari</strong><span>Senin sampai Jumat</span></article>
        <article><strong>Sehari penuh</strong><span>Bukan sistem masuk siang</span></article>
        <article><strong>Fiber optik</strong><span>Internet sekolah dan jaringan bersama</span></article>
    </div>
</section>
<section class="halaman">
    <h2>Peta pelajaran</h2>
    <div class="agenda">
        <article>
            <strong>Umum</strong>
            <ul>
                <li>Pendidikan Agama dan Budi Pekerti</li>
                <li>Pendidikan Pancasila</li>
                <li>Bahasa Indonesia</li>
                <li>Matematika</li>
                <li>Bahasa Inggris</li>
                <li>Sejarah</li>
                <li>PJOK</li>
                <li>Informatika</li>
                <li>Seni dan Prakarya</li>
            </ul>
        </article>
        <article>
            <strong>Pilihan sains</strong>
            <ul>
                <li>Fisika</li>
                <li>Kimia</li>
                <li>Biologi</li>
            </ul>
        </article>
        <article>
            <strong>Pilihan sosial</strong>
            <ul>
                <li>Ekonomi</li>
                <li>Geografi</li>
                <li>Sosiologi</li>
                <li>Antropologi</li>
            </ul>
        </article>
    </div>
    <p class="catatan">Peminatan dipilih bersama wali kelas sesuai daya tampung dan minat siswa.</p>
</section>
<section class="halaman">
    <h2>Tempat belajar</h2>
    <div class="galeri">
        <figure><img src="{{ asset('images/kelas.jpg') }}" alt="Ilustrasi ruang kelas"><figcaption>Ruang kelas, belajar tatap muka.</figcaption></figure>
        <figure><img src="{{ asset('images/laboratorium.jpg') }}" alt="Ilustrasi laboratorium"><figcaption>Praktik sains di laboratorium.</figcaption></figure>
        <figure><img src="{{ asset('images/perpustakaan.jpg') }}" alt="Ilustrasi perpustakaan"><figcaption>Membaca di perpustakaan.</figcaption></figure>
    </div>
</section>
@endsection
