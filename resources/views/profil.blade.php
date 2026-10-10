@extends('layouts.sekolah')
@section('judul', 'Profil — '.$profil['nama'])
@section('isi')
<section class="halaman">
    <h1>{{ $profil['nama'] }}</h1>
    <p>{{ $profil['sejarah'] }}</p>
    <ul>
        <li>Kepala sekolah: {{ $profil['kepala'] }}</li>
        <li>NPSN {{ $profil['npsn'] }}</li>
        <li>Akreditasi {{ $profil['akreditasi'] }}</li>
        <li>{{ $profil['alamat'] }}</li>
        <li>{{ $profil['telepon'] }} · {{ $profil['email'] }}</li>
    </ul>
</section>
@endsection
