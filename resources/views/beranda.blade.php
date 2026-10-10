@extends('layouts.sekolah')
@section('judul', 'SMAN 1 Banjar Margo')
@section('isi')
<section class="hero-foto">
    <img src="{{ asset('images/gedung.jpg') }}" alt="Gedung SMAN 1 Banjar Margo dengan taman dan pohon palem">
    <div class="hero-teks">
        <p class="kecil">SMA Negeri · Banjar Margo</p>
        <h1>Mewujudkan generasi cerdas, berkarakter, dan berdaya saing.</h1>
        <blockquote>Pendidikan hari ini untuk masa depan yang lebih baik.</blockquote>
        <a class="tombol" href="{{ url('/profil') }}">Lihat profil sekolah</a>
    </div>
</section>

<section class="pintasan">
    <a class="ubin biru" href="{{ url('/ppdb') }}"><span>SPMB</span><small>Penerimaan siswa</small></a>
    <a class="ubin hijau" href="{{ url('/pengumuman') }}"><span>Pengumuman</span><small>Info resmi</small></a>
    <a class="ubin oranye" href="{{ url('/berita') }}"><span>Berita</span><small>Kegiatan sekolah</small></a>
    <a class="ubin ungu" href="{{ url('/galeri') }}"><span>Galeri</span><small>Foto kegiatan</small></a>
    <a class="ubin cyan" href="{{ url('/profil') }}"><span>Profil</span><small>Identitas sekolah</small></a>
    <a class="ubin merah" href="{{ url('/kontak') }}"><span>Kontak</span><small>Alamat dan telepon</small></a>
    <a class="ubin emas" href="{{ url('/admin') }}"><span>Admin</span><small>Kelola konten</small></a>
    <a class="ubin gelap" href="{{ url('/ppdb') }}"><span>PPDB</span><small>Contoh alur daftar</small></a>
</section>

<section class="dua">
    <div>
        <h2>Berita terbaru</h2>
        <div class="kartu-berita">
            @forelse ($berita as $item)
                <a class="berita" href="{{ url('/berita/'.$item->id) }}">
                    <img src="{{ asset($fotoBerita[$loop->index % count($fotoBerita)]) }}" alt="">
                    <span>
                        <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
                        <strong>{{ $item->judul }}</strong>
                        <em>{{ $item->ringkas }}</em>
                    </span>
                </a>
            @empty
                <p>Belum ada berita. Tambah dari panel admin.</p>
            @endforelse
        </div>
    </div>
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
        <p><a class="tombol" href="{{ url('/pengumuman') }}">Semua pengumuman</a></p>
    </div>
</section>

<section class="angka">
    <article><strong>1.245</strong><span>Siswa</span></article>
    <article><strong>86</strong><span>Guru dan staf</span></article>
    <article><strong>A</strong><span>Akreditasi</span></article>
    <article><strong>2006</strong><span>Tahun berdiri</span></article>
</section>

<section class="halaman">
    <h2>Agenda contoh</h2>
    <div class="agenda">
        @foreach ($agenda as $item)
            <article>
                <b>{{ $item['tanggal'] }}</b>
                <strong>{{ $item['judul'] }}</strong>
                <span>{{ $item['tempat'] }}</span>
            </article>
        @endforeach
    </div>
    <p class="catatan">Jadwal di atas contoh, bukan kalender resmi sekolah.</p>
</section>

<section class="halaman">
    <h2>Galeri</h2>
    <div class="galeri">
        <img src="{{ asset('images/kelas.jpg') }}" alt="Suasana ruang kelas">
        <img src="{{ asset('images/lapangan.jpg') }}" alt="Lapangan sekolah">
        <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Perpustakaan">
        <img src="{{ asset('images/laboratorium.jpg') }}" alt="Laboratorium">
        <img src="{{ asset('images/seni.jpg') }}" alt="Kegiatan seni">
        <img src="{{ asset('images/workshop.jpg') }}" alt="Kegiatan di aula">
    </div>
    <p><a class="tombol" href="{{ url('/galeri') }}">Lihat galeri</a></p>
</section>
@endsection
