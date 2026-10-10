# SMAN 1 Banjar Margo

Situs sekolah berbasis Laravel 12 untuk Laragon.

## Pembaruan

```
cd C:\laragon\www\sman1-banjarmargo
git pull
mysql -u root -e "CREATE DATABASE IF NOT EXISTS sman1_banjarmargo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate --seed
```

Buka http://sman1-banjarmargo.test

Panel admin: http://sman1-banjarmargo.test/admin

Masuk pertama (contoh, segera diganti):

- Email: admin@sman1banjarmargo.sch.id
- Kata sandi: banjarmargo
