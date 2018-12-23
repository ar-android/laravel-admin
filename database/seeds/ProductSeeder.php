<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
}
