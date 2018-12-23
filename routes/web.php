<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function(){
	Route::view('/', 'admin.index')->name('admin.index');
	Route::resource('users', 'UserController');
	Route::view('/products', 'admin.products')->name('admin.products');
	Route::resource('products', 'ProductController');
	Route::resource('category', 'ProductCategoryController');
});
