@extends('layouts.admin')
@section('judul', 'Dasbor')
@section('isi')
@php
    $foto = ['images/workshop.jpg', 'images/ujian.jpg', 'images/kelas.jpg', 'images/gedung.jpg'];
    $warna = ['merah', 'biru', 'hijau', 'oranye', 'ungu'];
    $maks = max(1, $seri->max('jumlah'));
    $jarak = max(1, $seri->count() - 1);
    $kiri = 46; $kanan = 610; $atas = 18; $bawah = 168;
    $koordinat = $seri->values()->map(function ($item, $i) use ($maks, $jarak, $kiri, $kanan, $atas, $bawah) {
        return [
            'x' => round($kiri + ($i * (($kanan - $kiri) / $jarak)), 1),
            'y' => round($bawah - ($item['jumlah'] / $maks) * ($bawah - $atas), 1),
            'label' => $item['label'],
            'jumlah' => $item['jumlah'],
        ];
    });
    $titik = $koordinat->map(fn ($p) => $p['x'].','.$p['y'])->implode(' ');
    $area = $kiri.','.$bawah.' '.$titik.' '.($koordinat->last()['x'] ?? $kanan).','.$bawah;
@endphp
<section class="atas-dasbor">
    <article class="spanduk">
        <div>
            <p>Selamat datang, {{ auth()->user()->name }}</p>
            <h1>SMAN 1 BANJAR MARGO</h1>
            <p>Kelola konten website sekolah dari panel ini.</p>
            <a class="tombol-lihat" href="{{ url('/') }}">Lihat website</a>
        </div>
        <img src="{{ asset('images/gedung.jpg') }}" alt="Gedung SMAN 1 Banjar Margo">
    </article>
    <article class="kartu-jam">
        <p id="tanggal-besar">{{ now()->translatedFormat('l, d F Y') }}</p>
        <strong id="jam-besar">{{ now()->timezone('Asia/Jakarta')->format('H:i:s') }}</strong>
        <span>WIB</span>
        <blockquote>Pendidikan hari ini untuk masa depan yang lebih baik</blockquote>
    </article>
</section>
<section class="kartu-angka">
    <article class="biru"><b></b><div><strong>{{ $jumlahBerita }}</strong><span>Berita</span></div></article>
    <article class="hijau"><b></b><div><strong>{{ $jumlahPengumuman }}</strong><span>Pengumuman</span></div></article>
    <article class="kuning"><b></b><div><strong>{{ $jumlahAgenda }}</strong><span>Agenda</span></div></article>
    <article class="ungu"><b></b><div><strong>8</strong><span>Galeri</span></div></article>
    <article class="merah"><b></b><div><strong>{{ number_format($hariIni, 0, ',', '.') }}</strong><span>Pengunjung hari ini</span><small>{{ $selisih === null ? 'Belum ada data kemarin' : ($selisih >= 0 ? '+' : '').$selisih.'% dari kemarin' }}</small></div></article>
</section>
<section class="kisi">
    <article class="panel">
        <div class="kepala-panel"><h2>Statistik kunjungan website</h2><span>7 hari</span></div>
        <svg class="grafik" viewBox="0 0 640 210" role="img" aria-label="Grafik kunjungan tujuh hari">
            <text x="8" y="22" fill="#9a93ad" font-size="11">{{ $maks }}</text>
            <text x="8" y="96" fill="#9a93ad" font-size="11">{{ (int) round($maks / 2) }}</text>
            <text x="8" y="172" fill="#9a93ad" font-size="11">0</text>
            <line x1="46" y1="18" x2="610" y2="18" stroke="#efeaf8"></line>
            <line x1="46" y1="93" x2="610" y2="93" stroke="#efeaf8"></line>
            <line x1="46" y1="168" x2="610" y2="168" stroke="#efeaf8"></line>
            <polygon points="{{ $area }}" fill="#ddd6fe"></polygon>
            <polyline fill="none" stroke="#7c3aed" stroke-width="3" points="{{ $titik }}"></polyline>
            @foreach ($koordinat as $p)
                <circle cx="{{ $p['x'] }}" cy="{{ $p['y'] }}" r="4" fill="#fff" stroke="#7c3aed" stroke-width="2"></circle>
            @endforeach
        </svg>
        <div class="sumbu">
            @foreach ($koordinat as $p)
                <span>{{ $p['label'] }}</span>
            @endforeach
        </div>
        <p class="catatan">Hitungan buka halaman situs. Bukan jumlah siswa.</p>
    </article>
    <article class="panel">
        <h2>Akses cepat</h2>
        <div class="akses">
            <a class="biru" href="{{ url('/admin/berita') }}">Tulis berita</a>
            <a class="merah" href="{{ url('/admin/pengumuman') }}">Buat pengumuman</a>
            <a class="kuning" href="{{ url('/admin/agenda') }}">Tambah agenda</a>
            <a class="ungu" href="{{ url('/galeri') }}">Lihat galeri</a>
            <a class="hijau" href="{{ url('/ppdb') }}">Kelola PPDB</a>
            <a class="biru-muda" href="{{ url('/admin/pesan') }}">Pesan masuk</a>
        </div>
    </article>
</section>
@if ($cari !== '')
<section class="panel">
    <h2>Hasil cari “{{ $cari }}”</h2>
    @forelse ($hasilBerita as $item)
        <p><a href="{{ url('/admin/berita/'.$item->id.'/ubah') }}">Berita: {{ $item->judul }}</a></p>
    @empty
    @endforelse
    @forelse ($hasilPengumuman as $item)
        <p><a href="{{ url('/admin/pengumuman/'.$item->id.'/ubah') }}">Pengumuman: {{ $item->judul }}</a></p>
    @empty
        @if ($hasilBerita->isEmpty())<p>Tidak ada yang cocok.</p>@endif
    @endforelse
</section>
@endif
<section class="tiga">
    <article class="panel">
        <div class="kepala-panel"><h2>Berita terbaru</h2><a href="{{ url('/admin/berita') }}">Lihat semua</a></div>
        @forelse ($berita as $item)
            <a class="berita-mini" href="{{ url('/admin/berita/'.$item->id.'/ubah') }}">
                <img src="{{ asset($foto[$loop->index % count($foto)]) }}" alt="">
                <span>
                    <strong>{{ $item->judul }}</strong>
                    <small>{{ $item->tanggal->translatedFormat('d M Y') }}</small>
                </span>
            </a>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </article>
    <article class="panel">
        <div class="kepala-panel"><h2>Pengumuman terbaru</h2><a href="{{ url('/admin/pengumuman') }}">Lihat semua</a></div>
        @forelse ($pengumuman as $item)
            <a class="pengumuman-mini" href="{{ url('/admin/pengumuman/'.$item->id.'/ubah') }}">
                <i class="{{ $warna[$loop->index % count($warna)] }}"></i>
                <span>
                    <strong>{{ $item->judul }}</strong>
                    <small>{{ $item->tanggal->translatedFormat('d M Y') }}</small>
                </span>
            </a>
        @empty
            <p>Belum ada pengumuman.</p>
        @endforelse
    </article>
    <article class="panel">
        <div class="kepala-panel"><h2>Agenda terdekat</h2><a href="{{ url('/admin/agenda') }}">Lihat semua</a></div>
        @forelse ($agenda as $item)
            <a class="agenda-mini" href="{{ url('/admin/agenda/'.$item->id.'/ubah') }}">
                <time><b>{{ $item->tanggal->format('d') }}</b><small>{{ $item->tanggal->translatedFormat('M') }}</small></time>
                <span>
                    <strong>{{ $item->judul }}</strong>
                    <small>{{ $item->tempat }}</small>
                </span>
            </a>
        @empty
            <p>Belum ada agenda.</p>
        @endforelse
    </article>
</section>
@endsection
