@extends('layouts.admin')
@section('judul', 'Pesan masuk')
@section('isi')
<h1>{{ $arsip ? 'Arsip pesan' : 'Pesan masuk' }}</h1>
<p class="catatan">Balasan hanya tersimpan di panel ini, tidak dikirim ke surel.</p>
<p><a href="{{ url($arsip ? '/admin/pesan' : '/admin/pesan?arsip=1') }}">{{ $arsip ? 'Lihat kotak masuk' : 'Lihat arsip' }}</a></p>
@forelse ($pesan as $item)
    <article class="baris">
        <div>
            <small>{{ $item->created_at->translatedFormat('d F Y H:i') }} · {{ $item->nama }} · {{ $item->kontak }} · {{ $item->dibaca_pada ? 'Sudah dibaca' : 'Belum dibaca' }}</small>
            <strong>{{ $item->isi }}</strong>
            @if ($item->balasan)<small>Balasan: {{ $item->balasan }}</small>@endif
            <form method="post" action="{{ url('/admin/pesan/'.$item->id.'/balas') }}">
                @csrf
                <textarea name="balasan" rows="2" placeholder="Tulis balasan untuk arsip">{{ $item->balasan }}</textarea>
                <button type="submit">Simpan balasan</button>
            </form>
        </div>
        <div class="aksi-baris">
            @unless ($item->dibaca_pada)
                <form method="post" action="{{ url('/admin/pesan/'.$item->id.'/baca') }}">@csrf<button type="submit">Tandai dibaca</button></form>
            @endunless
            <form method="post" action="{{ url('/admin/pesan/'.$item->id.'/arsip') }}">@csrf<button type="submit">{{ $item->diarsipkan ? 'Keluarkan' : 'Arsipkan' }}</button></form>
            <form method="post" action="{{ url('/admin/pesan/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
        </div>
    </article>
@empty
    <p>Tidak ada pesan.</p>
@endforelse
@endsection
