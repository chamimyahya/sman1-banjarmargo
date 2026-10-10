@extends('layouts.admin')
@section('judul', 'Profil sekolah')
@section('isi')
<h1>Profil sekolah</h1>
<form class="formulir" method="post" action="{{ url('/admin/profil') }}">
    @csrf
    @foreach (['nama' => 'Nama sekolah', 'motto' => 'Motto', 'kepala' => 'Kepala sekolah', 'npsn' => 'NPSN', 'akreditasi' => 'Akreditasi', 'telepon' => 'Telepon', 'email' => 'Surel', 'alamat' => 'Alamat'] as $kunci => $label)
        <label>{{ $label }}
            <input type="text" name="{{ $kunci }}" value="{{ old($kunci, $profil[$kunci]) }}" required>
        </label>
    @endforeach
    <label>Sejarah singkat
        <textarea name="sejarah" rows="5" required>{{ old('sejarah', $profil['sejarah']) }}</textarea>
    </label>
    <button type="submit">Simpan profil</button>
</form>
@endsection
