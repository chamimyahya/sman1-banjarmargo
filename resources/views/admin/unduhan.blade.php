@extends('layouts.admin')
@section('judul', 'Unduhan')
@section('isi')
<h1>Unduhan</h1>
<form class="formulir" method="post" action="{{ url('/admin/unduhan') }}" enctype="multipart/form-data">
    @csrf
    <label>Judul <input type="text" name="judul" required></label>
    <label>Berkas <input type="file" name="berkas" accept=".pdf,.doc,.docx,.zip" required></label>
    <button type="submit">Unggah</button>
</form>
@foreach ($unduhan as $item)
    <article class="baris">
        <div><strong>{{ $item->judul }}</strong><small><a href="{{ asset($item->berkas) }}">Unduh</a></small></div>
        <form method="post" action="{{ url('/admin/unduhan/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
