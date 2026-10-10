@extends('layouts.admin')
@section('judul', 'Berita')
@section('isi')
<h1>{{ $ubah ? 'Ubah berita' : 'Berita' }}</h1>
<form class="formulir" method="post" action="{{ $ubah ? url('/admin/berita/'.$ubah->id) : url('/admin/berita') }}">
    @csrf
    @include('admin.bidang')
    <button type="submit">{{ $ubah ? 'Simpan perubahan' : 'Simpan berita' }}</button>
</form>
@foreach ($berita as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <div class="aksi-baris">
            <a href="{{ url('/admin/berita/'.$item->id.'/ubah') }}">Ubah</a>
            <form method="post" action="{{ url('/admin/berita/'.$item->id.'/hapus') }}">
                @csrf
                <button class="bahaya" type="submit">Hapus</button>
            </form>
        </div>
    </article>
@endforeach
@endsection
