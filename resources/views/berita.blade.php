@extends('layouts.sekolah')
@section('judul', 'Berita — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Berita</h1>
    @forelse ($berita as $item)
        <article class="kartu">
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <h2><a href="{{ url('/berita/'.$item->id) }}">{{ $item->judul }}</a></h2>
            <p>{{ $item->ringkas }}</p>
        </article>
    @empty
        <p>Belum ada berita.</p>
    @endforelse
</section>
@endsection
