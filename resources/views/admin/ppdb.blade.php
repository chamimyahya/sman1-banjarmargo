@extends('layouts.admin')
@section('judul', 'PPDB')
@section('isi')
<h1>PPDB</h1>
<p class="catatan">Bukan formulir pendaftaran. Teks ini menjelaskan alur dan mengarah ke pengumuman resmi.</p>
<form class="formulir" method="post" action="{{ url('/admin/ppdb') }}">
    @csrf
    <label>Pengantar
        <textarea name="ppdb_pengantar" rows="6" required>{{ old('ppdb_pengantar', $pengantar) }}</textarea>
    </label>
    <button type="submit">Simpan</button>
</form>
@endsection
