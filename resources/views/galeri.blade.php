@extends('layouts.sekolah')
@section('judul', 'Galeri — SMAN 1 Banjar Margo')
@section('isi')
<section class="halaman">
    <h1>Galeri</h1>
    <p>Foto ilustrasi lingkungan belajar. Bukan dokumentasi resmi kegiatan tertentu.</p>
    <div class="galeri besar">
        @foreach ($galeri as $item)
            <figure>
                <a class="buka-foto" href="{{ asset($item->berkas) }}">
                    <img src="{{ asset($item->berkas) }}" alt="{{ $item->judul }}">
                </a>
                <figcaption>{{ $item->judul }} · {{ $item->kategori ?? 'kegiatan' }}</figcaption>
            </figure>
        @endforeach
    </div>
    <dialog id="kotak-foto">
        <img alt="">
        <form method="dialog"><button>Tutup</button></form>
    </dialog>
    <script>
        const kotak = document.getElementById('kotak-foto');
        document.querySelectorAll('.buka-foto').forEach((tautan) => {
            tautan.addEventListener('click', (event) => {
                event.preventDefault();
                kotak.querySelector('img').src = tautan.href;
                kotak.showModal();
            });
        });
    </script>
</section>
@endsection
