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
    <h2>Kegiatan</h2>
    <div class="agenda">
        <article><b>Wajib</b><strong>Pramuka</strong><span>Latihan rutin, baris-berbaris, dan bakti lingkungan di sekitar sekolah.</span></article>
        <article><b>Bela negara</b><strong>Paskibra</strong><span>Pasukan pengibar bendera untuk upacara sekolah dan hari besar.</span></article>
        <article><b>Sosial</b><strong>PMR</strong><span>Pertolongan pertama dan pendampingan saat kegiatan lapangan.</span></article>
        <article><b>Keagamaan</b><strong>Rohani Islam</strong><span>Kajian, pesantren kilat, dan kultum pada hari besar Islam.</span></article>
        <article><b>Organisasi</b><strong>OSIS</strong><span>Wadah siswa mengurus kegiatan, aspirasi, dan tata tertib bersama.</span></article>
        <article><b>Olahraga</b><strong>Futsal</strong><span>Latihan teknik dan pertandingan persahabatan antar kelas.</span></article>
        <article><b>Olahraga</b><strong>Bola voli</strong><span>Tim putra dan putri untuk lomba sekolah dan kecamatan.</span></article>
        <article><b>Olahraga</b><strong>Pencak silat</strong><span>Dasar bela diri, disiplin, dan persiapan kejuaraan pelajar.</span></article>
        <article><b>Seni</b><strong>Paduan suara</strong><span>Latihan vokal untuk upacara, peringatan, dan pentas sekolah.</span></article>
        <article><b>Seni</b><strong>Tari</strong><span>Kreasi dan tari daerah Lampung untuk acara adat dan lomba.</span></article>
    </div>
</section>
@endsection
