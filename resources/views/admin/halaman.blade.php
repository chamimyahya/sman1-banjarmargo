@extends('layouts.admin')
@section('judul', 'Halaman statis')
@section('isi')
<h1>Halaman statis</h1>
<form class="formulir" method="post" action="{{ url('/admin/halaman') }}">
    @csrf
    <label>Judul <input type="text" name="judul" required></label>
    <label>Isi <textarea name="isi" rows="6" required></textarea></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($halaman as $item)
    <article class="baris">
        <div><strong>{{ $item->judul }}</strong><small><a href="{{ url('/halaman/'.$item->slug) }}">/halaman/{{ $item->slug }}</a></small></div>
        <form method="post" action="{{ url('/admin/halaman/'.$item->slug.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
