# SMAN 1 Banjar Margo

Situs sekolah berbasis Laravel 12, untuk dijalankan di Laragon.

## Pertama kali

Di terminal Laragon:

```
cd C:\laragon\www
git clone https://github.com/chamimyahya/sman1-banjarmargo.git
cd sman1-banjarmargo
composer install
copy .env.example .env
php artisan key:generate
```

Buka http://sman1-banjarmargo.test

PHP minimal 8.2. Kalau `php -v` masih di bawah itu, di Laragon pilih menu PHP lalu versi 8.2 atau lebih baru, lalu ulangi perintah dari folder ini.

## Pembaruan

```
cd C:\laragon\www\sman1-banjarmargo
git pull
```

Kalau ada pesan soal dependensi, jalankan lagi `composer install`.

Halaman yang ada: Beranda, Profil, Pengumuman, Kontak. Teks pengumuman masih contoh.
