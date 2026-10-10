@extends('layouts.admin')
@section('judul', 'Pengaturan')
@section('isi')
<h1>Pengaturan</h1>
<form class="formulir" method="post" action="{{ url('/admin/identitas') }}" enctype="multipart/form-data">
    @csrf
    <h2>Identitas situs</h2>
    <label>Deskripsi singkat untuk pencarian
        <input type="text" name="seo" value="{{ old('seo', $seo) }}" maxlength="180">
    </label>
    <label>Instagram <input type="text" name="instagram" value="{{ old('instagram', $instagram) }}"></label>
    <label>Facebook <input type="text" name="facebook" value="{{ old('facebook', $facebook) }}"></label>
    <label>YouTube <input type="text" name="youtube" value="{{ old('youtube', $youtube) }}"></label>
    <label>Logo <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"></label>
    @if ($logo)<p><img src="{{ asset($logo) }}" alt="Logo" style="height:48px"></p>@endif
    <button type="submit">Simpan identitas</button>
</form>
<form class="formulir" method="post" action="{{ url('/admin/sandi') }}">
    @csrf
    <h2>Ganti kata sandi</h2>
    <label>Kata sandi baru <input type="password" name="password" required></label>
    <label>Ulangi kata sandi <input type="password" name="password_confirmation" required></label>
    @error('password')<p class="salah">{{ $message }}</p>@enderror
    <button type="submit">Simpan kata sandi</button>
</form>
@endsection
