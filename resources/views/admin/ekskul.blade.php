@extends('layouts.admin')
@section('judul', 'Ekstrakurikuler')
@section('isi')
<h1>Ekstrakurikuler</h1>
<form class="formulir" method="post" action="{{ url('/admin/ekskul') }}">
    @csrf
    <label>Nama <input type="text" name="nama" required></label>
    <label>Bidang <input type="text" name="bidang" required></label>
    <label>Keterangan <textarea name="teks" rows="3" required></textarea></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($ekskul as $item)
    <article class="baris">
        <div><strong>{{ $item->nama }}</strong><small>{{ $item->bidang }} · {{ $item->teks }}</small></div>
        <form method="post" action="{{ url('/admin/ekskul/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
