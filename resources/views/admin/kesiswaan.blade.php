@extends('layouts.admin')
@section('judul', 'Kesiswaan')
@section('isi')
<h1>Pengurus OSIS</h1>
<p class="catatan">Ekstrakurikuler tetap di menu Ekstrakurikuler. Di sini hanya pengurus.</p>
<form class="formulir" method="post" action="{{ url('/admin/kesiswaan') }}">
    @csrf
    <label>Nama <input type="text" name="nama" required></label>
    <label>Jabatan <input type="text" name="jabatan" required></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($pengurus as $item)
    <article class="baris">
        <div><strong>{{ $item->nama }}</strong><small>{{ $item->jabatan }}</small></div>
        <form method="post" action="{{ url('/admin/kesiswaan/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
