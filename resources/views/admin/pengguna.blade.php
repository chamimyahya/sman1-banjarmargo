@extends('layouts.admin')
@section('judul', 'Pengguna')
@section('isi')
<h1>Pengguna admin</h1>
<form class="formulir" method="post" action="{{ url('/admin/pengguna') }}">
    @csrf
    <label>Nama <input type="text" name="name" required></label>
    <label>Email <input type="email" name="email" required></label>
    <label>Kata sandi <input type="password" name="password" required></label>
    <label>Ulangi kata sandi <input type="password" name="password_confirmation" required></label>
    <label>Peran
        <select name="peran">
            <option value="admin">Admin</option>
            <option value="penulis">Penulis</option>
        </select>
    </label>
    @error('email')<p class="salah">{{ $message }}</p>@enderror
    @error('password')<p class="salah">{{ $message }}</p>@enderror
    <button type="submit">Tambah pengguna</button>
</form>
@foreach ($pengguna as $item)
    <article class="baris">
        <div><strong>{{ $item->name }}</strong><small>{{ $item->email }} · {{ $item->peran ?? 'admin' }}</small></div>
        @if ($item->is(auth()->user()))
            <span>Akun ini</span>
        @else
            <form method="post" action="{{ url('/admin/pengguna/'.$item->id.'/hapus') }}">@csrf<button class="bahaya" type="submit">Hapus</button></form>
        @endif
    </article>
@endforeach
@endsection
