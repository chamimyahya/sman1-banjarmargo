<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'SMAN 1 Banjar Margo')</title>
    <link rel="stylesheet" href="{{ asset('css/sekolah.css') }}">
</head>
<body>
    <header class="atas">
        <div class="bar">
            <span>Jl. Lintas Timur Km 159, Bujuk Agung, Banjar Margo</span>
            <span>0812-7900-0664 · smanegeri1banjarmargo@yahoo.co.id</span>
        </div>
        <div class="nav">
            <a class="merek" href="{{ url('/') }}">
                <strong>SMAN 1 Banjar Margo</strong>
                <small>Berilmu, Berkarakter, Berprestasi</small>
            </a>
            <nav>
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/profil') }}">Profil</a>
                <a href="{{ url('/pengumuman') }}">Pengumuman</a>
                <a href="{{ url('/kontak') }}">Kontak</a>
            </nav>
        </div>
    </header>
    <main>@yield('isi')</main>
    <footer>
        <p>SMAN 1 Banjar Margo · NPSN 10810271 · Akreditasi A</p>
        <p>Jl. Lintas Timur Km 159, Bujuk Agung, Tulang Bawang, Lampung</p>
    </footer>
</body>
</html>
