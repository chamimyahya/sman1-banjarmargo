@extends('layouts.sekolah')
@section('judul', $item->judul)
@section('isi')
<section class="halaman">
    <p><a href="{{ url('/pengumuman') }}">Kembali ke pengumuman</a></p>
    <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
    <h1>{{ $item->judul }}</h1>
    <p class="isi">{{ $item->isi }}</p>
</section>
@endsection
