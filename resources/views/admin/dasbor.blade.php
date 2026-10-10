@extends('layouts.admin')
@section('judul', 'Dasbor')
@section('isi')
@php
    $maks = max(1, $seri->max('jumlah'));
    $jarak = max(1, $seri->count() - 1);
    $titik = $seri->values()->map(function ($item, $i) use ($maks, $jarak) {
        $x = 24 + ($i * (560 / $jarak));
        $y = 150 - ($item['jumlah'] / $maks) * 120;
        return round($x, 1).','.round($y, 1);
    })->implode(' ');
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
        <svg viewBox="0 0 600 180" role="img" aria-label="Grafik kunjungan tujuh hari">
            <polyline fill="none" stroke="#7c3aed" stroke-width="3" points="{{ $titik }}"></polyline>
        </svg>
        <div class="sumbu">
            @foreach ($seri as $item)
                <span>{{ $item['label'] }}</span>
            @endforeach
        </div>
        <p class="catatan">Angka ini hitungan buka halaman situs, bukan siswa atau guru.</p>
    </article>
    <article class="panel">
        <h2>Aksi cepat</h2>
        <div class="aksi">
            <a href="{{ url('/admin/berita') }}">Tulis berita</a>
            <a href="{{ url('/admin/pengumuman') }}">Tulis pengumuman</a>
            <a href="{{ url('/admin/agenda') }}">Tambah agenda</a>
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
            <p><small>{{ $item->tanggal->translatedFormat('d M') }}</small> {{ $item->judul }}</p>
        @empty
            <p>Belum ada berita.</p>
        @endforelse
    </article>
    <article class="panel">
        <h2>Pengumuman</h2>
        @forelse ($pengumuman as $item)
            <p><small>{{ $item->tanggal->translatedFormat('d M') }}</small> {{ $item->judul }}</p>
        @empty
            <p>Belum ada pengumuman.</p>
        @endforelse
    </article>
    <article class="panel">
        <h2>Agenda</h2>
        @forelse ($agenda as $item)
            <p><small>{{ $item->tanggal->translatedFormat('d M') }}</small> {{ $item->judul }}</p>
        @empty
            <p>Belum ada agenda.</p>
        @endforelse
    </article>
</section>
@endsection
