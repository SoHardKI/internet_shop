<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MainController@index')->name('main.index');
Route::get('/category/{category}', 'CategoryController@show')->name('main.category');
Route::get('/{category}/{product}', 'ProductController@show')->name('main.product');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/checkout', 'CartController@checkoutCart')->name('cart.checkout');
