@extends('layouts.admin')
@section('judul', 'Pengumuman')
@section('isi')
<h1>{{ $ubah ? 'Ubah pengumuman' : 'Pengumuman' }}</h1>
<form class="formulir" method="post" action="{{ $ubah ? url('/admin/pengumuman/'.$ubah->id) : url('/admin/pengumuman') }}">
    @csrf
    @include('admin.bidang')
    <label class="centang"><input type="checkbox" name="penting" value="1" @checked(old('penting', $ubah->penting ?? false))> Pengumuman penting</label>
    <label class="centang"><input type="checkbox" name="tampil_beranda" value="1" @checked(old('tampil_beranda', $ubah->tampil_beranda ?? true))> Tampil di beranda</label>
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
