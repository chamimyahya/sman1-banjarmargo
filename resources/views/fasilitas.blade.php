@extends('layouts.sekolah')
@section('judul', 'Fasilitas — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Fasilitas</h1>
    <div class="galeri besar">
        @forelse ($fasilitas as $item)
            <figure>
                @if ($item->berkas)<img src="{{ asset($item->berkas) }}" alt="{{ $item->nama }}">@endif
                <figcaption><strong>{{ $item->nama }}</strong> · {{ $item->kategori }}<br>{{ $item->deskripsi }}</figcaption>
            </figure>
        @empty
            <p>Data fasilitas belum diisi.</p>
        @endforelse
    </div>
</section>
@endsection
