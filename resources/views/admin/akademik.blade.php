@extends('layouts.admin')
@section('judul', 'Akademik')
@section('isi')
<h1>Akademik</h1>
<p class="catatan">Teks ini tampil di halaman akademik situs. Daftar mata pelajaran tetap gambaran umum SMA.</p>
<form class="formulir" method="post" action="{{ url('/admin/akademik') }}">
    @csrf
    <label>Pengantar
        <textarea name="akademik_pengantar" rows="6" required>{{ old('akademik_pengantar', $pengantar) }}</textarea>
    </label>
    <button type="submit">Simpan</button>
</form>
@endsection
