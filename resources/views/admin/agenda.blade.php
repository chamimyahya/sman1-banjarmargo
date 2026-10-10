@extends('layouts.admin')
@section('judul', 'Agenda')
@section('isi')
<h1>{{ $ubah ? 'Ubah agenda' : 'Agenda' }}</h1>
<form class="formulir" method="post" action="{{ $ubah ? url('/admin/agenda/'.$ubah->id) : url('/admin/agenda') }}">
    @csrf
    <label>Tanggal <input type="date" name="tanggal" value="{{ old('tanggal', $ubah ? $ubah->tanggal->toDateString() : now()->toDateString()) }}" required></label>
    <label>Kegiatan <input type="text" name="judul" maxlength="160" value="{{ old('judul', $ubah->judul ?? '') }}" required></label>
    <label>Tempat <input type="text" name="tempat" maxlength="160" value="{{ old('tempat', $ubah->tempat ?? '') }}" required></label>
    <button type="submit">{{ $ubah ? 'Simpan perubahan' : 'Simpan agenda' }}</button>
</form>
@foreach ($agenda as $item)
    <article class="baris">
        <div>
            <small>{{ $item->tanggal->translatedFormat('d F Y') }} · {{ $item->tempat }}</small>
            <strong>{{ $item->judul }}</strong>
        </div>
        <div class="aksi-baris">
            <a href="{{ url('/admin/agenda/'.$item->id.'/ubah') }}">Ubah</a>
            <form method="post" action="{{ url('/admin/agenda/'.$item->id.'/hapus') }}">
                @csrf
                <button class="bahaya" type="submit">Hapus</button>
            </form>
        </div>
    </article>
@endforeach
@endsection
