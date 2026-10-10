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
            <span class="lencana">BM</span>
            <span>
                <strong>SMAN 1 BANJAR MARGO</strong>
                <small>Admin Panel</small>
            </span>
        </a>
        <nav>
            <a href="{{ url('/admin') }}" @class(['aktif' => request()->is('admin')])>Dasbor</a>
            <a href="{{ url('/admin/berita') }}" @class(['aktif' => request()->is('admin/berita*')])>Berita</a>
            <a href="{{ url('/admin/pengumuman') }}" @class(['aktif' => request()->is('admin/pengumuman*')])>Pengumuman</a>
            <a href="{{ url('/admin/agenda') }}" @class(['aktif' => request()->is('admin/agenda*')])>Agenda</a>
            <a href="{{ url('/admin/pesan') }}" @class(['aktif' => request()->is('admin/pesan')])>Pesan masuk</a>
            <a href="{{ url('/profil') }}">Profil sekolah</a>
            <a href="{{ url('/akademik') }}">Akademik</a>
            <a href="{{ url('/kesiswaan') }}">Kesiswaan</a>
            <a href="{{ url('/galeri') }}">Galeri</a>
            <a href="{{ url('/ppdb') }}">PPDB</a>
            <a href="{{ url('/admin/pengaturan') }}" @class(['aktif' => request()->is('admin/pengaturan')])>Pengaturan</a>
        </nav>
        <div class="kaki-samping">
            <span class="avatar">{{ mb_substr(auth()->user()->name, 0, 1) }}</span>
            <span>
                <strong>{{ auth()->user()->name }}</strong>
                <small>Administrator</small>
            </span>
            <form method="post" action="{{ url('/admin/keluar') }}">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </aside>
    <div class="lembar">
        <header class="puncak">
            <label class="tombol-menu" for="bukamenu">Menu</label>
            <form class="cari" method="get" action="{{ url('/admin') }}">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari menu, berita, pengumuman">
            </form>
            <div class="akun">
                <strong>{{ auth()->user()->name }}</strong>
            </div>
        </header>
        <main>
            @if (session('status'))<p class="status">{{ session('status') }}</p>@endif
            @yield('isi')
        </main>
    </div>
    <script>
        const jam = document.getElementById('jam-besar');
        const tanggal = document.getElementById('tanggal-besar');
        const tulis = () => {
            const sekarang = new Date();
            if (jam) jam.textContent = sekarang.toLocaleTimeString('id-ID', { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
            if (tanggal) tanggal.textContent = sekarang.toLocaleDateString('id-ID', { timeZone: 'Asia/Jakarta', weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
        };
        tulis();
        setInterval(tulis, 1000);
    </script>
</body>
</html>
