@extends('layouts.admin')
@section('judul', 'Akademik')
@section('isi')
<h1>Akademik</h1>
<p class="catatan">Teks ini tampil di halaman akademik situs. Daftar mata pelajaran tetap gambaran umum SMA.</p>
<form class="formulir" method="post" action="{{ url('/admin/akademik') }}">
    @csrf
    <label>Pengantar
        <textarea name="akademik_pengantar" rows="5" required>{{ old('akademik_pengantar', $pengantar) }}</textarea>
    </label>
    <label>Catatan jadwal
        <textarea name="akademik_jadwal" rows="4" required>{{ old('akademik_jadwal', $jadwal) }}</textarea>
    </label>
    <button type="submit">Simpan</button>
</form>
@endsection
