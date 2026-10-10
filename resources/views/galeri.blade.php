@extends('layouts.sekolah')
@section('judul', 'Galeri — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Galeri</h1>
    <p>Foto ilustrasi lingkungan belajar. Bukan dokumentasi resmi kegiatan tertentu.</p>
    <div class="galeri besar">
        <figure><img src="{{ asset('images/gedung.jpg') }}" alt="Tampak depan gedung sekolah"><figcaption>Gedung sekolah</figcaption></figure>
        <figure><img src="{{ asset('images/kelas.jpg') }}" alt="Ruang kelas"><figcaption>Ruang kelas</figcaption></figure>
        <figure><img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan"><figcaption>Lapangan</figcaption></figure>
        <figure><img src="{{ asset('images/perpustakaan.jpg') }}" alt="Perpustakaan"><figcaption>Perpustakaan</figcaption></figure>
        <figure><img src="{{ asset('images/laboratorium.jpg') }}" alt="Laboratorium"><figcaption>Laboratorium</figcaption></figure>
        <figure><img src="{{ asset('images/seni.jpg') }}" alt="Kegiatan seni"><figcaption>Seni</figcaption></figure>
        <figure><img src="{{ asset('images/workshop.jpg') }}" alt="Aula"><figcaption>Aula</figcaption></figure>
        <figure><img src="{{ asset('images/ujian.jpg') }}" alt="Suasana ujian di kelas"><figcaption>Ujian</figcaption></figure>
    </div>
</section>
@endsection
