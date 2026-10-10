@extends('layouts.sekolah')
@section('judul', $halaman->judul)
@section('isi')
<section class="halaman">
    <h1>{{ $halaman->judul }}</h1>
    <p class="isi">{{ $halaman->isi }}</p>
</section>
@endsection
