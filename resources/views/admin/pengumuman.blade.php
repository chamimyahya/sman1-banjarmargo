@extends('layouts.admin')
@section('judul', 'Pengumuman')
@section('isi')
<h1>{{ $ubah ? 'Ubah pengumuman' : 'Pengumuman' }}</h1>
<form class="formulir" method="post" action="{{ $ubah ? url('/admin/pengumuman/'.$ubah->id) : url('/admin/pengumuman') }}">
    @csrf
    @include('admin.bidang')
    <button type="submit">{{ $ubah ? 'Simpan perubahan' : 'Simpan pengumuman' }}</button>
</form>
@foreach ($pengumuman as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <div class="aksi-baris">
            <a href="{{ url('/admin/pengumuman/'.$item->id.'/ubah') }}">Ubah</a>
            <form method="post" action="{{ url('/admin/pengumuman/'.$item->id.'/hapus') }}">
                @csrf
                <button class="bahaya" type="submit">Hapus</button>
            </form>
        </div>
    </article>
@endforeach
@endsection
