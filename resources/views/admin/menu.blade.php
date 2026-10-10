@extends('layouts.admin')
@section('judul', 'Menu situs')
@section('isi')
<h1>Menu situs</h1>
<p class="catatan">Jika ada menu di sini, menu itu yang tampil di header situs. Kosongkan semua untuk kembali ke menu bawaan.</p>
<form class="formulir" method="post" action="{{ url('/admin/menu') }}">
    @csrf
    <label>Label <input type="text" name="label" required></label>
    <label>Tautan <input type="text" name="tautan" placeholder="/profil" required></label>
    <button type="submit">Tambah</button>
</form>
@foreach ($menu as $item)
    <article class="baris">
        <div><strong>{{ $item->label }}</strong><small>{{ $item->tautan }}</small></div>
        <div class="aksi-baris">
            <form method="post" action="{{ url('/admin/menu/'.$item->id.'/naik') }}">@csrf<button type="submit">Naik</button></form>
            <form method="post" action="{{ url('/admin/menu/'.$item->id.'/turun') }}">@csrf<button type="submit">Turun</button></form>
            <form method="post" action="{{ url('/admin/menu/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
        </div>
    </article>
@endforeach
@endsection
