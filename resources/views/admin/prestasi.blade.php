@extends('layouts.admin')
@section('judul', 'Prestasi')
@section('isi')
<h1>Prestasi</h1>
<p class="catatan">Hanya isi prestasi yang benar-benar diraih sekolah. Hapus contoh bawaan.</p>
<form class="formulir" method="post" action="{{ url('/admin/prestasi') }}" enctype="multipart/form-data">
    @csrf
    <label>Judul <input type="text" name="judul" required></label>
    <label>Kategori
        <select name="kategori">
            <option value="akademik">Akademik</option>
            <option value="nonakademik">Nonakademik</option>
        </select>
    </label>
    <label>Tingkat <input type="text" name="tingkat" required></label>
    <label>Tahun <input type="text" name="tahun" maxlength="8" required></label>
    <label>Keterangan <textarea name="keterangan" rows="3"></textarea></label>
    <label>Foto <input type="file" name="berkas" accept=".jpg,.jpeg,.png,.webp"></label>
    <button type="submit">Simpan</button>
</form>
@foreach ($prestasi as $item)
    <article class="baris">
        <div><strong>{{ $item->judul }}</strong><small>{{ $item->tingkat }} · {{ $item->tahun }}</small></div>
        <form method="post" action="{{ url('/admin/prestasi/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
    </article>
@endforeach
@endsection
