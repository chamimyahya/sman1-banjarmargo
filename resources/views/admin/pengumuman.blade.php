@extends('layouts.admin')
@section('judul', 'Pengumuman')
@section('isi')
<h1>Pengumuman</h1>
<form class="formulir" method="post" action="{{ url('/admin/pengumuman') }}">
    @csrf
    @include('admin.bidang')
    <button type="submit">Simpan pengumuman</button>
</form>
@foreach ($pengumuman as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <form method="post" action="{{ url('/admin/pengumuman/'.$item->id.'/hapus') }}">
            @csrf
            <button class="bahaya" type="submit">Hapus</button>
        </form>
    </article>
@endforeach
@endsection
