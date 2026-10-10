@extends('layouts.admin')
@section('judul', 'Pesan masuk')
@section('isi')
<h1>Pesan masuk</h1>
<p class="catatan">Pesan dari formulir kontak. Tidak terkirim ke surel.</p>
@forelse ($pesan as $item)
    <article class="baris">
        <div>
            <small>{{ $item->created_at->translatedFormat('d F Y H:i') }} · {{ $item->nama }} · {{ $item->kontak }}</small>
            <strong>{{ $item->isi }}</strong>
        </div>
        <form method="post" action="{{ url('/admin/pesan/'.$item->id.'/hapus') }}">
            @csrf
            <button class="bahaya" type="submit">Hapus</button>
        </form>
    </article>
@empty
    <p>Belum ada pesan.</p>
@endforelse
@endsection
