# Operasi Pengolahan Data
Dalam sebuah admin panel fitur standar yang biasa di lakukan adalah fitur CRUD ( Create, Read, Update, Delete). Intinya dalam operasi itu adalah kita bisa menambahkan data, melihat, mengedit dan menghapus data.

Berikut ini adalah panduan singkat jika ingin membuat operasi CRUD dengan menggunakan resource controller pada laravel.

## Membuat Model
Pada contoh kali ini saya gunakan untuk mengolah data produk. Jadi kita akan menambahkan, melihat, mengedit dan menghapus data produk. Ikuti langkah - langkah berikut ini.

Pertama buat model dan migrasi database dengan menjalankan perintah berikut ini.
```bash
php artisan make:model Product -m
```

Pada folder `database/migrations` buka file migrations yang namanya mengandung kata ini `create_products_table` dan kemudian buat migrationya seperti ini.
```php
Schema::create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('category_id');
    $table->string('images');
    $table->string('name');
    $table->string('descriptions');
    $table->string('variants');
    $table->integer('price');
    $table->integer('stock');
    $table->timestamps();
});
```

Jangan lupa tambahkan field fillable pada class Product pada folder `app/Product.php` seperti berikut ini.
```php
class Product extends Model
{
    protected $fillable = [
        	'category_id',
        	'images',
        	'name',
        	'descriptions',
        	'variants',
        	'price',
        	'stock',
        ];
}
```

Sekarang jalankan migrasinya dengan perintah berikut ini:
```bash
php artisan migrate
```

## Membuat Controller Product
Setelah database selesai kita urus sekarang lanjutkan untuk mengurus controller. Silahkan ikuti langkah berikut ini untuk membuat controler.

Buat `ProductController` dengan menjalankan perintah berikut ini:
```bash
php artisan make:controller Admin/ProductController -r --model=Product
```

Sudah membuat controllernya sekarang kita buat routenya. Pada route ini kita menambahkan middleware dan juga group untuk admin.
```php
Route::group(['prefix' => '/admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function(){
	Route::resource('products', 'ProductController');
});
```

## Membuat Product Seed
Sebelum kita memulai untuk membuat tampilan untuk operasi CRUD kita buat dulu contoh data yang akan kita olah. Pada laravel dikenal dengan Database Seeder.

Jalankan perintah berikut ini untuk membuat database seeder:
```bash
php artisan make:seeder ProductSeeder
```

Class untuk `ProductSeeder` akan digenerate pada folder `database/seeds`. Dan buat contoh data product pada class ProductSeeder seperti berikut ini :
```php
public function run()
{
    Product::create([
    	'category_id' => 1,
    	'images' => 'path/to/img/product1.jpg',
    	'name' => 'Sepatu Adidas',
    	'descriptions' => 'Sepatu sports branded untuk anak milenial yang kece',
    	'variants' => 'Merah, Hitam, Kuning, Biru, Putih',
    	'price' => 750000,
    	'stock' => 30
    ]);
}
```

Sekarang jalankan database seeder dengan menjalankan perintah berikut ini :
```bash
composer dump-autoload
php artisan db:seed --class=ProductSeeder
```
Jika proses seeder berhasil akan muncul pesan seperti berikut ini.
```
Database seeding completed successfully.
```