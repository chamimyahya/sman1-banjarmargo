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
        <textarea name="sejarah" rows="4" required>{{ old('sejarah', $profil['sejarah']) }}</textarea>
    </label>
    <label>Visi
        <textarea name="visi" rows="3" required>{{ old('visi', $profil['visi']) }}</textarea>
    </label>
    <label>Misi
        <textarea name="misi" rows="3" required>{{ old('misi', $profil['misi']) }}</textarea>
    </label>
    <label>Sambutan kepala sekolah
        <textarea name="sambutan" rows="3" required>{{ old('sambutan', $profil['sambutan']) }}</textarea>
    </label>
    <button type="submit">Simpan profil</button>
</form>
@endsection
