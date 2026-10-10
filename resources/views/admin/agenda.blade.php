@extends('layouts.admin')
@section('judul', 'Agenda')
@section('isi')
<h1>Agenda</h1>
<form class="formulir" method="post" action="{{ url('/admin/agenda') }}">
    @csrf
    <label>Tanggal <input type="date" name="tanggal" value="{{ now()->toDateString() }}" required></label>
    <label>Kegiatan <input type="text" name="judul" maxlength="160" required></label>
    <label>Tempat <input type="text" name="tempat" maxlength="160" required></label>
    <button type="submit">Simpan agenda</button>
</form>
@foreach ($agenda as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }} · {{ $item->tempat }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <form method="post" action="{{ url('/admin/agenda/'.$item->id.'/hapus') }}">
            @csrf
            <button class="bahaya" type="submit">Hapus</button>
        </form>
    </article>
@endforeach
@endsection
