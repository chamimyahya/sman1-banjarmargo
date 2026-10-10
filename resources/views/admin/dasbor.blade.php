@extends('layouts.admin')
@section('judul', 'Dasbor')
@section('isi')
@php
    $maks = max(1, $seri->max('jumlah'));
    $jarak = max(1, $seri->count() - 1);
    $koordinat = $seri->values()->map(function ($item, $i) use ($maks, $jarak) {
        return [
            'x' => round(24 + ($i * (552 / $jarak)), 1),
            'y' => round(136 - ($item['jumlah'] / $maks) * 108, 1),
            'label' => $item['label'],
            'jumlah' => $item['jumlah'],
        ];
    });
    $titik = $koordinat->map(fn ($p) => $p['x'].','.$p['y'])->implode(' ');
    $area = '24,148 '.$titik.' '.($koordinat->last()['x'] ?? 576).',148';
@endphp
<section class="sambutan">
    <div>
        <p>Selamat datang kembali</p>
        <h1>{{ auth()->user()->name }}</h1>
        <p>{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
</section>
<section class="kartu-angka">
    <article>
        <span>Kunjungan hari ini</span>
        <strong>{{ number_format($hariIni, 0, ',', '.') }}</strong>
        <small>{{ $selisih === null ? 'Belum ada data kemarin' : ($selisih >= 0 ? '+' : '').$selisih.'% dari kemarin' }}</small>
    </article>
    <article>
        <span>Berita</span>
        <strong>{{ $jumlahBerita }}</strong>
        <small>Tersimpan di situs</small>
    </article>
    <article>
        <span>Pengumuman</span>
        <strong>{{ $jumlahPengumuman }}</strong>
        <small>Tersimpan di situs</small>
    </article>
    <article>
        <span>Agenda mendatang</span>
        <strong>{{ $jumlahAgenda }}</strong>
        <small>Hari ini dan setelahnya</small>
    </article>
</section>
<section class="kisi">
    <article class="panel">
        <h2>Kunjungan 7 hari</h2>
        <svg class="grafik" viewBox="0 0 600 180" role="img" aria-label="Grafik kunjungan tujuh hari">
            <line x1="24" y1="28" x2="576" y2="28" stroke="#efeaf8"></line>
            <line x1="24" y1="82" x2="576" y2="82" stroke="#efeaf8"></line>
            <line x1="24" y1="136" x2="576" y2="136" stroke="#efeaf8"></line>
            <polygon points="{{ $area }}" fill="#ddd6fe"></polygon>
            <polyline fill="none" stroke="#7c3aed" stroke-width="3" points="{{ $titik }}"></polyline>
            @foreach ($koordinat as $p)
                <circle cx="{{ $p['x'] }}" cy="{{ $p['y'] }}" r="4" fill="#7c3aed"></circle>
            @endforeach
        </svg>
        <div class="sumbu">
            @foreach ($koordinat as $p)
                <span>{{ $p['label'] }}<br>{{ $p['jumlah'] }}</span>
            @endforeach
        </div>
        <p class="catatan">Angka ini hitungan buka halaman situs, bukan siswa atau guru. Buka beranda, lalu muat ulang dasbor.</p>
    </article>
    <article class="panel">
        <h2>Aksi cepat</h2>
        <div class="aksi">
            <a href="{{ url('/admin/berita') }}">Tulis berita</a>
            <a href="{{ url('/admin/pengumuman') }}">Tulis pengumuman</a>
            <a href="{{ url('/admin/agenda') }}">Tambah agenda</a>
            <a href="{{ url('/admin/pesan') }}">Pesan masuk</a>
            <a href="{{ url('/') }}">Lihat situs</a>
        </div>
    </article>
</section>
@if ($cari !== '')
<section class="panel">
    <h2>Hasil cari “{{ $cari }}”</h2>
    @forelse ($hasilBerita as $item)
        <p><a href="{{ url('/berita/'.$item->id) }}">Berita: {{ $item->judul }}</a></p>
    @empty
    @endforelse
    @forelse ($hasilPengumuman as $item)
        <p><a href="{{ url('/pengumuman/'.$item->id) }}">Pengumuman: {{ $item->judul }}</a></p>
    @empty
        @if ($hasilBerita->isEmpty())<p>Tidak ada yang cocok.</p>@endif
    @endforelse
</section>
@endif
<section class="tiga">
    <article class="panel">
        <h2>Berita terbaru</h2>
        @forelse ($berita as $item)
            <p class="butir"><small>{{ $item->tanggal->translatedFormat('d M') }}</small><span>{{ $item->judul }}</span></p>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </article>
    <article class="panel">
        <h2>Pengumuman</h2>
        @forelse ($pengumuman as $item)
            <p class="butir"><small>{{ $item->tanggal->translatedFormat('d M') }}</small><span>{{ $item->judul }}</span></p>
        @empty
            <p>Belum ada pengumuman.</p>
        @endforelse
    </article>
    <article class="panel">
        <h2>Agenda</h2>
        @forelse ($agenda as $item)
            <p class="butir"><small>{{ $item->tanggal->translatedFormat('d M') }}</small><span>{{ $item->judul }}</span></p>
        @empty
            <p>Belum ada agenda.</p>
        @endforelse
    </article>
</section>
@endsection
