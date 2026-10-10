@extends('layouts.sekolah')
@section('judul', 'Prestasi — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Prestasi</h1>
    <div class="agenda">
        @forelse ($prestasi as $item)
            <article><b>{{ $item->tahun }} · {{ $item->tingkat }}</b><strong>{{ $item->judul }}</strong><span>{{ $item->keterangan }}</span></article>
        @empty
            <p>Belum ada prestasi yang diumumkan.</p>
        @endforelse
    </div>
</section>
@endsection
