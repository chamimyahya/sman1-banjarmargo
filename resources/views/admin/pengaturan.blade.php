@extends('layouts.admin')
@section('judul', 'Pengaturan')
@section('isi')
<h1>Pengaturan</h1>
<form class="formulir" method="post" action="{{ url('/admin/sandi') }}">
    @csrf
    <h2>Ganti kata sandi</h2>
    <label>Kata sandi baru <input type="password" name="password" required></label>
    <label>Ulangi kata sandi <input type="password" name="password_confirmation" required></label>
    @error('password')<p class="salah">{{ $message }}</p>@enderror
    <button type="submit">Simpan kata sandi</button>
</form>
@endsection
