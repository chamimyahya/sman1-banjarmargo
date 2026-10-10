@extends('layouts.sekolah')
@section('judul', 'Guru dan tendik — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Guru dan tendik</h1>
    <div class="agenda">
        @forelse ($guru as $item)
            <article><strong>{{ $item->nama }}</strong><span>{{ $item->jabatan }}</span><span>{{ $item->tugas }}</span></article>
        @empty
            <p>Belum ada data guru.</p>
        @endforelse
    </div>
</section>
@endsection
