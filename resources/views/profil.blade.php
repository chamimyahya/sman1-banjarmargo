@extends('layouts.sekolah')
@section('judul', 'Profil — '.$profil['nama'])
@section('isi')
<section class="halaman">
    <h1>{{ $profil['nama'] }}</h1>
    <p>{{ $profil['sejarah'] }}</p>
    <h2>Visi</h2>
    <p>{{ $profil['visi'] }}</p>
    <h2>Misi</h2>
    <p>{{ $profil['misi'] }}</p>
    <h2>Sambutan kepala sekolah</h2>
    <p>{{ $profil['sambutan'] }}</p>
    <ul>
        <li>Kepala sekolah: {{ $profil['kepala'] }}</li>
        <li>NPSN {{ $profil['npsn'] }}</li>
        <li>Akreditasi {{ $profil['akreditasi'] }}</li>
        <li>{{ $profil['alamat'] }}</li>
        <li>{{ $profil['telepon'] }} · {{ $profil['email'] }}</li>
    </ul>
</section>
@endsection
