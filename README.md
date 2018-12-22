# Laravel Admin Template
![Laravel Admin Sidebar Template](https://github.com/ar-android/laravel-admin/raw/master/screenshoot.png)

Project ini adalah contoh laravel admin dengan menggunakan boostrap 4. Pada web ini sudah tersedia fungsional standar untuk kebutuhan admin.

Ikuti langkah - langkah berikut ini untuk menjalan contoh project laravel admin ini.

## Pastikan ENV Database
Untuk seting database terserah bisa menggunakan mysql atau sqlite. Disini untuk testing - testing saja saya lebih suka menggunakan sqlite. Berikut ini contoh properti ENV saya.

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=/Users/mymacbook/dev/web/laravel-admin/database/db.sqlite
DB_USERNAME=homestead
DB_PASSWORD=secret
```

## Migrasi Database
Setelah seting environment atau linkungan kerja laravel jangan lupa untuk menjalankan database migrasi dengan menjalankan perintah berikut ini.

```
php artisan migrate
```

## Admin Middleware
Pada project ini sudah tersedia admin middleware yang berguna untuk  mengenali apakah user yang sedang login itu user admin atau user member seperti biasa. Pada contoh route penggunaanya adalah seperti ini.

```php
Route::view('admin', 'admin.index')->middleware('admin');
```

## User Role
Ketika user register secara default role nya akan di seting user biasa. Jadi user tidak bisa mengakses halaman admin. Dan ketika login user akan di redirect ke halaman home setelah login.

Sebelum menjalankan user registration silahkan jalankan db seed untuk membuat database default untuk user role.

```
php artisan db:seed
```

## Mengubah User Role
Untuk mengupdate user kamu sekarang menjadi user admin jalankan perintah berikut ini.
```
php artisan tinker
```
Setelah itu copykan code berikut ini untuk mengupdate data user dengan id 1 menjadi memiliki admin role.
```php
\App\User::find(1)->update(['user_role_id' => 1]);
```
