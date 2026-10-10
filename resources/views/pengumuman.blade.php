@extends('layouts.sekolah')
@section('judul', 'Pengumuman — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Pengumuman</h1>
    @foreach ($pengumuman as $item)
        <article class="kartu">
            <small>{{ $item['tanggal'] }}</small>
            <h2><a href="{{ url('/pengumuman/'.$item['id']) }}">{{ $item['judul'] }}</a></h2>
            <p>{{ $item['ringkas'] }}</p>
        </article>
    @endforeach
</section>
@endsection
