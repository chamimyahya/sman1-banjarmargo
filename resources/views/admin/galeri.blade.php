@extends('layouts.admin')
@section('judul', 'Galeri')
@section('isi')
<h1>Galeri</h1>
<form class="formulir" method="post" action="{{ url('/admin/galeri') }}" enctype="multipart/form-data">
    @csrf
    <label>Judul <input type="text" name="judul" required></label>
    <label>Kategori
        <select name="kategori">
            <option value="kegiatan">Kegiatan</option>
            <option value="fasilitas">Fasilitas</option>
            <option value="prestasi">Prestasi</option>
        </select>
    </label>
    <label>Foto <input type="file" name="berkas" accept=".jpg,.jpeg,.png,.webp" required></label>
    <button type="submit">Unggah</button>
</form>
@foreach ($galeri as $item)
    <article class="baris">
        <div>
            <img src="{{ asset($item->berkas) }}" alt="" style="width:72px;height:52px;object-fit:cover;border-radius:8px">
            <strong>{{ $item->judul }}</strong>
        </div>
        <form method="post" action="{{ url('/admin/galeri/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
