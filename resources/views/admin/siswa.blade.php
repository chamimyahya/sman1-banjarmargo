@extends('layouts.admin')
@section('judul', 'Data siswa')
@section('isi')
<h1>Data siswa</h1>
<p class="catatan">Daftar ini hanya di panel admin. Nama siswa tidak ditampilkan di situs umum.</p>
<form class="formulir" method="post" action="{{ url('/admin/siswa') }}">
    @csrf
    <label>Nama <input type="text" name="nama" required></label>
    <label>Kelas <input type="text" name="kelas" required></label>
    <label>NIS <input type="text" name="nis"></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($siswa as $item)
    <article class="baris">
        <div><strong>{{ $item->nama }}</strong><small>{{ $item->kelas }} · {{ $item->nis }}</small></div>
        <form method="post" action="{{ url('/admin/siswa/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
