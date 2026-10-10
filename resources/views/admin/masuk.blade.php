<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk admin — SMAN 1 Banjar Margo</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="halaman-masuk">
    <form class="formulir kartu-masuk" method="post" action="{{ url('/admin/masuk') }}">
        @csrf
        <p class="kecil">SMAN 1 Banjar Margo</p>
        <h1>Masuk admin</h1>
        <label>Email <input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
        @error('email')<p class="salah">{{ $message }}</p>@enderror
        <label>Kata sandi <input type="password" name="password" required></label>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>
