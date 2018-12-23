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
	Product::truncate();
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

## Read Product
Yang pertama kita akan buat operasi READ atau menampilkan data dari product yang telah kita buat contoh datanya tadi. 

Yang pertama kita buat tampilan HTML nya pada folder `resources/views/admin/products/index.blade.php` dan isinya seperti berikut ini.
```php
@extends('layouts.admin')

@section('content')
<div class="line"></div>
<h2>Products</h2>
<table class="table table-inverse">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Stock</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->price }}</td>
			<td>{{ $product->stock }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-sm btn-info">View</button>
				<button type="button" class="btn btn-sm btn-warning">Edit</button>
				<button type="button" class="btn btn-sm btn-danger">Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection
```

Kemudian pada controller `ProductController` pada method `index` buat seperti ini.
```php
public function index()
{
    return view('admin.products.index', [
        'products' => Product::all(),
    ]);
}
```

Sekarang coba cuka url <a href="http://localhost/admin/products">localhost/admin/products</a> maka kira - kira tampilanya seperti dibawah ini.

![Laravel Admin Sidebar Template](https://github.com/ar-android/laravel-admin/raw/master/screenshoot/index-product.png)

## Create Product
Yang pertama untuk create buat button untuk membuka halaman create. Tambahkan html berikut ini di atas table untuk contoh read product diatas.
```html
<div class="row">
	<div class="col-md-8">
		<h2>Products</h2>
	</div>
	<div class="col-md-4">
		<a href="{{route('products.create')}}">
	  		<button type="button" class="btn btn-primary float-right">Create</button>
		</a>
	</div>
</div>
```

