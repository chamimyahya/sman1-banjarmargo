@extends('layouts.sekolah')
@section('judul', $item['judul'])
@section('isi')
<section class="halaman">
    <p><a href="{{ url('/pengumuman') }}">Kembali ke pengumuman</a></p>
    <small>{{ $item['tanggal'] }}</small>
    <h1>{{ $item['judul'] }}</h1>
    <p>{{ $item['isi'] }}</p>
    <p class="catatan">Teks ini contoh. Ganti dengan pengumuman resmi sekolah.</p>
</section>
@endsection
