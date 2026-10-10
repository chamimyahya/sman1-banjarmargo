@extends('layouts.admin')
@section('judul', 'Media')
@section('isi')
<h1>Media</h1>
<p class="catatan">Berkas yang diunggah untuk berita, galeri, guru, dan unduhan. Menghapus berkas di sini dapat membuat foto di halaman lain pecah.</p>
@forelse ($berkas as $nama)
    <article class="baris">
        <div><strong>{{ $nama }}</strong></div>
        <form method="post" action="{{ url('/admin/media/hapus') }}">
            @csrf
            <input type="hidden" name="nama" value="{{ $nama }}">
            <button class="bahaya" type="submit">Hapus</button>
        </form>
    </article>
@empty
    <p>Belum ada berkas unggahan.</p>
@endforelse
@endsection
