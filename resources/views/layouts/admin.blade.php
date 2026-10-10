<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Admin') — SMAN 1 Banjar Margo</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <input id="bukamenu" class="bukamenu" type="checkbox">
    <aside class="samping">
        <a class="merek" href="{{ url('/admin') }}">
            <strong>SMAN 1</strong>
            <small>Banjar Margo</small>
        </a>
        <nav>
            <a href="{{ url('/admin') }}" @class(['aktif' => request()->is('admin')])>Dasbor</a>
            <a href="{{ url('/admin/berita') }}" @class(['aktif' => request()->is('admin/berita')])>Berita</a>
            <a href="{{ url('/admin/pengumuman') }}" @class(['aktif' => request()->is('admin/pengumuman')])>Pengumuman</a>
            <a href="{{ url('/admin/agenda') }}" @class(['aktif' => request()->is('admin/agenda')])>Agenda</a>
            <a href="{{ url('/admin/pesan') }}" @class(['aktif' => request()->is('admin/pesan')])>Pesan</a>
            <a href="{{ url('/galeri') }}">Galeri</a>
            <a href="{{ url('/admin/pengaturan') }}" @class(['aktif' => request()->is('admin/pengaturan')])>Pengaturan</a>
        </nav>
        <a class="ke-situs" href="{{ url('/') }}">Lihat situs</a>
    </aside>
    <div class="lembar">
        <header class="puncak">
            <label class="tombol-menu" for="bukamenu">Menu</label>
            <form class="cari" method="get" action="{{ url('/admin') }}">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari berita atau pengumuman">
            </form>
            <div class="akun">
                <span id="jam"></span>
                <strong>{{ auth()->user()->name }}</strong>
                <form method="post" action="{{ url('/admin/keluar') }}">
                    @csrf
                    <button type="submit">Keluar</button>
                </form>
            </div>
        </header>
        <main>
            @if (session('status'))<p class="status">{{ session('status') }}</p>@endif
            @yield('isi')
        </main>
    </div>
    <script>
        const jam = document.getElementById('jam');
        const tulis = () => { jam.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }); };
        tulis();
        setInterval(tulis, 10000);
    </script>
</body>
</html>
