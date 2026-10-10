@extends('layouts.admin')
@section('judul', 'Fasilitas')
@section('isi')
<h1>Fasilitas</h1>
<form class="formulir" method="post" action="{{ url('/admin/fasilitas') }}" enctype="multipart/form-data">
    @csrf
    <label>Nama <input type="text" name="nama" required></label>
    <label>Kategori <input type="text" name="kategori" placeholder="Ruang kelas, lab, lapangan" required></label>
    <label>Deskripsi <textarea name="deskripsi" rows="3" required></textarea></label>
    <label>Foto <input type="file" name="berkas" accept=".jpg,.jpeg,.png,.webp"></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($fasilitas as $item)
    <article class="baris">
        <div><strong>{{ $item->nama }}</strong><small>{{ $item->kategori }}</small></div>
        <form method="post" action="{{ url('/admin/fasilitas/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
