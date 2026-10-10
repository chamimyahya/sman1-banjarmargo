@extends('layouts.sekolah')
@section('judul', 'Kontak — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Kontak</h1>
    <p>Telepon: <a href="tel:081279000664">0812-7900-0664</a></p>
    <p>Surel: <a href="mailto:smanegeri1banjarmargo@yahoo.co.id">smanegeri1banjarmargo@yahoo.co.id</a></p>
    <p>Jl. Lintas Timur Km 159, Bujuk Agung, Kec. Banjar Margo, Kab. Tulang Bawang, Lampung 34595.</p>
    @if (session('status'))<p class="status">{{ session('status') }}</p>@endif
    <form class="formulir" method="post" action="{{ url('/kontak') }}">
        @csrf
        <h2>Kirim pesan</h2>
        <p class="catatan">Pesan masuk ke panel admin sekolah di komputer ini, bukan ke surel.</p>
        <label>Nama
            <input type="text" name="nama" value="{{ old('nama') }}" maxlength="80" required>
        </label>
        <label>Telepon atau surel
            <input type="text" name="kontak" value="{{ old('kontak') }}" maxlength="120" required>
        </label>
        <label>Pesan
            <textarea name="isi" rows="5" maxlength="2000" required>{{ old('isi') }}</textarea>
        </label>
        @if ($errors->any())<p class="salah">Lengkapi nama, kontak, dan isi pesan.</p>@endif
        <button class="tombol" type="submit">Kirim</button>
    </form>
</section>
@endsection
