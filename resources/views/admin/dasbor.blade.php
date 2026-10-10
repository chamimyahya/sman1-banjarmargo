@extends('layouts.sekolah')
@section('judul', 'Admin — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <div class="judul-bar">
        <h1>Panel admin</h1>
        <form method="post" action="{{ url('/admin/keluar') }}">
            @csrf
            <button class="tombol senyap" type="submit">Keluar</button>
        </form>
    </div>
    @if (session('status'))<p class="status">{{ session('status') }}</p>@endif

    <div class="dua">
        <form class="formulir" method="post" action="{{ url('/admin/pengumuman') }}">
            @csrf
            <h2>Pengumuman baru</h2>
            @include('admin.bidang')
            <button class="tombol" type="submit">Simpan pengumuman</button>
        </form>
        <form class="formulir" method="post" action="{{ url('/admin/berita') }}">
            @csrf
            <h2>Berita baru</h2>
            @include('admin.bidang')
            <button class="tombol" type="submit">Simpan berita</button>
        </form>
    </div>

    <h2>Pengumuman</h2>
    @foreach ($pengumuman as $item)
        <article class="kartu baris">
            <div>
                <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
                <strong>{{ $item->judul }}</strong>
            </div>
            <form method="post" action="{{ url('/admin/pengumuman/'.$item->id.'/hapus') }}">
                @csrf
                <button class="tombol bahaya" type="submit">Hapus</button>
            </form>
        </article>
    @endforeach

    <h2>Berita</h2>
    @foreach ($berita as $item)
        <article class="kartu baris">
            <div>
                <small>{{ $item->tanggal->translatedFormat('d F Y') }}</small>
                <strong>{{ $item->judul }}</strong>
            </div>
            <form method="post" action="{{ url('/admin/berita/'.$item->id.'/hapus') }}">
                @csrf
                <button class="tombol bahaya" type="submit">Hapus</button>
            </form>
        </article>
    @endforeach

    <h2>Agenda</h2>
    <form class="formulir" method="post" action="{{ url('/admin/agenda') }}">
        @csrf
        <label>Tanggal
            <input type="date" name="tanggal" value="{{ now()->toDateString() }}" required>
        </label>
        <label>Kegiatan
            <input type="text" name="judul" maxlength="160" required>
        </label>
        <label>Tempat
            <input type="text" name="tempat" maxlength="160" required>
        </label>
        <button class="tombol" type="submit">Simpan agenda</button>
    </form>
    @foreach ($agenda as $item)
        <article class="kartu baris">
            <div>
                <small>{{ $item->tanggal->translatedFormat('d F Y') }} · {{ $item->tempat }}</small>
                <strong>{{ $item->judul }}</strong>
            </div>
            <form method="post" action="{{ url('/admin/agenda/'.$item->id.'/hapus') }}">
                @csrf
                <button class="tombol bahaya" type="submit">Hapus</button>
            </form>
        </article>
    @endforeach

    <form class="formulir" method="post" action="{{ url('/admin/sandi') }}">
        @csrf
        <h2>Ganti kata sandi</h2>
        <label>Kata sandi baru
            <input type="password" name="password" required>
        </label>
        <label>Ulangi kata sandi
            <input type="password" name="password_confirmation" required>
        </label>
        @error('password')<p class="salah">{{ $message }}</p>@enderror
        <button class="tombol" type="submit">Simpan kata sandi</button>
    </form>
</section>
@endsection
