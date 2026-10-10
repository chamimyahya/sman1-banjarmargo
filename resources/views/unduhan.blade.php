@extends('layouts.sekolah')
@section('judul', 'Unduhan — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Unduhan</h1>
    @forelse ($unduhan as $item)
        <article class="kartu"><h2><a href="{{ asset($item->berkas) }}">{{ $item->judul }}</a></h2></article>
    @empty
        <p>Belum ada berkas.</p>
    @endforelse
</section>
@endsection
