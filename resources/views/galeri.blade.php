@extends('layouts.sekolah')
@section('judul', 'Galeri — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Galeri</h1>
    <p>Foto ilustrasi lingkungan belajar. Bukan dokumentasi resmi kegiatan tertentu.</p>
    <div class="galeri besar">
        @foreach ($galeri as $item)
            <figure>
                <img src="{{ asset($item->berkas) }}" alt="{{ $item->judul }}">
                <figcaption>{{ $item->judul }}</figcaption>
            </figure>
        @endforeach
    </div>
</section>
@endsection
