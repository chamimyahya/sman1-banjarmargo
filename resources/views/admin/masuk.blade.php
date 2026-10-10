@extends('layouts.sekolah')
@section('judul', 'Masuk admin')
@section('isi')
<section class="halaman sempit">
    <h1>Panel admin</h1>
    <p>Untuk guru atau tata usaha yang mengisi berita dan pengumuman.</p>
    <form class="formulir" method="post" action="{{ url('/admin/masuk') }}">
        @csrf
        <label>Email
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        </label>
        @error('email')<p class="salah">{{ $message }}</p>@enderror
        <label>Kata sandi
            <input type="password" name="password" required>
        </label>
        <button class="tombol" type="submit">Masuk</button>
    </form>
</section>
@endsection
