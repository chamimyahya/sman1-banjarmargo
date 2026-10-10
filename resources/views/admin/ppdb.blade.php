@extends('layouts.admin')
@section('judul', 'PPDB')
@section('isi')
<h1>PPDB</h1>
<p class="catatan">Bukan formulir pendaftaran. Teks ini menjelaskan alur dan mengarah ke pengumuman resmi.</p>
<form class="formulir" method="post" action="{{ url('/admin/ppdb') }}">
    @csrf
    <label>Tahun ajaran <input type="text" name="ppdb_tahun" value="{{ old('ppdb_tahun', $tahun) }}" required></label>
    <label>Pengantar
        <textarea name="ppdb_pengantar" rows="4" required>{{ old('ppdb_pengantar', $pengantar) }}</textarea>
    </label>
    <label>Syarat
        <textarea name="ppdb_syarat" rows="4" required>{{ old('ppdb_syarat', $syarat) }}</textarea>
    </label>
    <label>Jadwal
        <textarea name="ppdb_jadwal" rows="4" required>{{ old('ppdb_jadwal', $jadwal) }}</textarea>
    </label>
    <button type="submit">Simpan</button>
</form>
@endsection
