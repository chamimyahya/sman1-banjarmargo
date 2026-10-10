@extends('layouts.sekolah')
@section('judul', 'PPDB — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman sempit">
    <h1>PPDB</h1>
    <p>{{ $pengantar }}</p>
    @if ($tahun)<p><strong>Tahun ajaran:</strong> {{ $tahun }}</p>@endif
    @if ($syarat)<h2>Syarat</h2><p class="isi">{{ $syarat }}</p>@endif
    @if ($jadwal)<h2>Jadwal</h2><p class="isi">{{ $jadwal }}</p>@endif
    <ol class="langkah">
        <li>Pantau pengumuman di situs dan papan sekolah.</li>
        <li>Siapkan kartu keluarga, ijazah atau surat keterangan, dan pas foto.</li>
        <li>Daftar lewat kanal yang ditulis di pengumuman resmi.</li>
        <li>Tanyakan wali kelas atau tata usaha bila data tidak cocok.</li>
    </ol>
    <p>Telepon tata usaha: <a href="tel:081279000664">0812-7900-0664</a></p>
</section>
@endsection
