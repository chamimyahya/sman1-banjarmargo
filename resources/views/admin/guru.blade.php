@extends('layouts.admin')
@section('judul', 'Guru dan tendik')
@section('isi')
<h1>Guru dan tendik</h1>
<form class="formulir" method="post" action="{{ url('/admin/guru') }}">
    @csrf
    <label>Nama <input type="text" name="nama" required></label>
    <label>Jabatan <input type="text" name="jabatan" required></label>
    <label>Tugas <input type="text" name="tugas"></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($guru as $item)
    <article class="baris">
        <div><strong>{{ $item->nama }}</strong><small>{{ $item->jabatan }} · {{ $item->tugas }}</small></div>
        <form method="post" action="{{ url('/admin/guru/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
