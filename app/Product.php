<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
