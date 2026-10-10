@extends('layouts.admin')
@section('judul', 'Berita')
@section('isi')
<h1>Berita</h1>
<form class="formulir" method="post" action="{{ url('/admin/berita') }}">
    @csrf
    @include('admin.bidang')
    <button type="submit">Simpan berita</button>
</form>
@foreach ($berita as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <form method="post" action="{{ url('/admin/berita/'.$item->id.'/hapus') }}">
            @csrf
            <button class="bahaya" type="submit">Hapus</button>
        </form>
    </article>
@endforeach
@endsection
