@extends('layouts.sekolah')
@section('judul', 'Guru dan tendik — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Guru dan tendik</h1>
    <div class="agenda">
        @forelse ($guru as $item)
            <article>
                @if ($item->foto)<img src="{{ asset($item->foto) }}" alt="" style="width:72px;height:72px;object-fit:cover;border-radius:12px">@endif
                <strong>{{ $item->nama }}</strong>
                <span>{{ $item->jabatan }}{{ $item->mapel ? ' · '.$item->mapel : '' }}</span>
                <span>{{ $item->tugas }}</span>
            </article>
        @empty
            <p>Belum ada data guru.</p>
        @endforelse
    </div>
</section>
@endsection
