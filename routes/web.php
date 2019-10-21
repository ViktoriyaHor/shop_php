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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@showProduct');

Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/clear-cart', 'CartController@removeAll');
Route::post('/remove-from-cart', 'CartController@removeProduct');
Route::get('/checkout', 'CartController@checkout');
Route::post('/buy', 'CartController@buy');
Route::get('/orders', 'HomeController@orders');


Route::group([
	'prefix'=>'admin',
	'namespace'=>'Admin',
	'middleware'=>['auth', 'admin']
], function(){

	Route::get('/', 'AdminController@index');
	Route::resource('/users', 'UserController');
	Route::resource('/category', 'CategoryController');
	Route::resource('/product', 'ProductController');
	Route::resource('/order', 'OrderController');
	Route::resource('/discount', 'DiscountController');
	Route::post('/edit-recommended', 'ProductController@editRecommended');
	Route::post('/edit-price', 'ProductController@editPrice');
	Route::post('/select-status', 'OrderController@selectStatus');
	Route::get('/order/user/{id}', 'OrderController@userHistory');
    Route::post('/show-products', 'OrderController@showProducts');

});
