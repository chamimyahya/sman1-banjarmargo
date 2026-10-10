@extends('layouts.sekolah')
@section('judul', 'SMAN 1 Banjar Margo')
@section('isi')
<section class="hero">
    <p class="kecil">SMA Negeri · Banjar Margo</p>
    <h1>Mewujudkan generasi cerdas, berkarakter, dan berdaya saing.</h1>
    <p>Pendidikan hari ini untuk masa depan yang lebih baik.</p>
    <a class="tombol" href="{{ url('/profil') }}">Lihat profil sekolah</a>
</section>
<section class="kotak">
    <article><strong>1.245</strong><span>Siswa</span></article>
    <article><strong>86</strong><span>Guru</span></article>
    <article><strong>A</strong><span>Akreditasi</span></article>
    <article><strong>2006</strong><span>Berdiri</span></article>
</section>
<section class="dua">
    <div class="daftar">
        <h2>Pengumuman</h2>
        @forelse ($pengumuman as $item)
            <a href="{{ url('/pengumuman/'.$item->id) }}">
                <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
                <strong>{{ $item->judul }}</strong>
            </a>
        @empty
            <p>Belum ada pengumuman.</p>
        @endforelse
    </div>
    <div class="daftar">
        <h2>Berita</h2>
        @forelse ($berita as $item)
            <a href="{{ url('/berita/'.$item->id) }}">
                <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
                <strong>{{ $item->judul }}</strong>
            </a>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </div>
</section>
@endsection
