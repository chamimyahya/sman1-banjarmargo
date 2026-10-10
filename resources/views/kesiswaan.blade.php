@extends('layouts.sekolah')
@section('judul', 'Kesiswaan — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <p class="kecil">Kesiswaan</p>
    <h1>Pramuka, organisasi, dan panggung sekolah</h1>
    <p>Di samping pelajaran, siswa diajak menjaga tata tertib, berorganisasi, dan mengolah bakat. Daftar kegiatan ini dapat disesuaikan pembina.</p>
</section>
<section class="dua">
    <img class="foto-lebar" src="{{ asset('images/lapangan.jpg') }}" alt="Ilustrasi lapangan rumput sekolah">
    <div>
        <p class="kecil">OSIS</p>
        <h2>Suara siswa, diurus siswa</h2>
        <p>OSIS membantu wali kelas mengurus upacara, lomba kelas, dan aspirasi yang layak diteruskan ke kesiswaan. Pramuka diharapkan diikuti seluruh siswa. Kegiatan lain dipilih sesuai minat dan kuota pembina, dan tidak menggantikan jam pelajaran wajib.</p>
    </div>
</section>
<section class="halaman">
    <h2>Pengurus OSIS</h2>
    <div class="agenda">
        @forelse ($pengurus as $item)
            <article><b>{{ $item->jabatan }}</b><strong>{{ $item->nama }}</strong></article>
        @empty
            <p>Pengurus belum diisi dari panel admin.</p>
        @endforelse
    </div>
    <h2>Kegiatan</h2>
    <div class="agenda">
        @forelse ($ekskul as $item)
            <article><b>{{ $item->bidang }}</b><strong>{{ $item->nama }}</strong><span>{{ $item->teks }}</span></article>
        @empty
            <p>Belum ada kegiatan.</p>
        @endforelse
    </div>
</section>
@endsection
