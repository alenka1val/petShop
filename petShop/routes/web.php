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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    Session()->forget('products');
    Session()->save();
    return redirect()->route('home');
    //return view('welcome');
});

Auth::routes();

Route::get('/users/list/', 'UserController@list');
Route::get('orders/list/{page}', 'OrderController@list');
Route::delete('orders/{order}', 'OrderController@destroy');
Route::post('products/', 'ProductController@store');
Route::post('products/{product}/upload', 'ProductController@upload');
Route::get('products/{product}/photos', 'ProductController@photoList');
Route::get('products/{product}/edit', 'ProductController@edit');
Route::put('products/{product}', 'ProductController@update');
Route::get('products/list/{page}', 'ProductController@list');
Route::delete('/products/{product}', 'ProductController@destroy')->name('product.destroy');
Route::delete('/products/{product}/photo/{photo}', 'ProductController@destroyPhoto');


Route::get('/home', 'HomeController@index')->name('home');

Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/product/{product}/show', 'ProductController@show')->name('product.show');
Route::get('/product/{product}/prestore', 'ProductController@prestore')->name('product.prestore');

Route::get('/order', 'OrderController@index')->name('order.index');
Route::get('/order/{product}/plus', 'OrderController@plus')->name('order.plus');
Route::get('/order/{product}/minus', 'OrderController@minus')->name('order.minus');
Route::get('/order/{product}/delete', 'OrderController@deleteSession')->name('order.deleteSession');
Route::get('/order/create', 'OrderController@create')->name('order.create');
Route::get('/order/create2', 'OrderController@create2')->name('order.create2');
Route::post('/order/store', 'OrderController@store')->name('order.store');

Route::get('/admin', 'HomeController@admin')->name('user.admin');

Route::middleware('auth')->group(function () {
    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/user/{user}/show', 'UserController@show')->name('user.show');
    Route::get('/user/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/{user}/update', 'UserController@update')->name('user.update');
});


