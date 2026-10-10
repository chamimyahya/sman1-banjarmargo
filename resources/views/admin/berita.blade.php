@extends('layouts.admin')
@section('judul', 'Berita')
@section('isi')
<h1>{{ $ubah ? 'Ubah berita' : 'Berita' }}</h1>
<form class="formulir" method="post" action="{{ $ubah ? url('/admin/berita/'.$ubah->id) : url('/admin/berita') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.bidang')
    <label>Kategori
        <select name="kategori">
            @foreach (['kegiatan' => 'Kegiatan', 'akademik' => 'Akademik', 'prestasi' => 'Prestasi', 'umum' => 'Umum'] as $nilai => $label)
                <option value="{{ $nilai }}" @selected(old('kategori', $ubah->kategori ?? 'kegiatan') === $nilai)>{{ $label }}</option>
            @endforeach
        </select>
    </label>
    <label>Status
        <select name="status">
            <option value="terbit" @selected(old('status', $ubah->status ?? 'terbit') === 'terbit')>Terbit</option>
            <option value="draf" @selected(old('status', $ubah->status ?? 'terbit') === 'draf')>Draf</option>
        </select>
    </label>
    <label>Gambar <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp"></label>
    <button type="submit">{{ $ubah ? 'Simpan perubahan' : 'Simpan berita' }}</button>
</form>
@foreach ($berita as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }} · {{ $item->kategori }} · {{ $item->status }}</small>
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
