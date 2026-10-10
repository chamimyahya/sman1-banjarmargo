@extends('layouts.sekolah')
@section('judul', 'Pengumuman — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Pengumuman</h1>
    @forelse ($pengumuman as $item)
        <article class="kartu">
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <h2><a href="{{ url('/pengumuman/'.$item->id) }}">{{ $item->judul }}</a></h2>
            <p>{{ $item->ringkas }}</p>
        </article>
    @empty
        <p>Belum ada pengumuman.</p>
    @endforelse
</section>
@endsection
