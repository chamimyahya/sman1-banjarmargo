# SMAN 1 Banjar Margo

Situs sekolah berbasis Laravel 12 untuk Laragon.

## Pembaruan

```
cd C:\laragon\www\sman1-banjarmargo
git pull
composer install
if not exist database\database.sqlite type nul > database\database.sqlite
php artisan migrate --seed
```

Buka http://sman1-banjarmargo.test

Panel admin: http://sman1-banjarmargo.test/admin

Masuk pertama (contoh, segera diganti):

- Email: admin@sman1banjarmargo.sch.id
- Kata sandi: banjarmargo
