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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/category/{slug}', 'HomeController@category')->name('category');
Route::get('/product/{slug}', 'HomeController@product')->name('product');

Route::get('logout','Auth\LoginController@logout');

Route::group(["middleware" => ["is_thisAdmin","auth"]],function (){
    Route::group(["namespace" => "Admin"], function (){
        Route::resource("admin-users","UsersController");
        Route::resource("admin-category","CategoryController");
        Route::resource("admin-products","ProductController");
        Route::resource("admin-orders","OrderController");
    });
});


Route::group(['prefix' => 'basket'], function () {
    Route::get('/', 'BasketController@index')->name('basket');

    Route::post('/create', 'BasketController@create')->name('basket.create');
    Route::delete('/destroy', 'BasketController@destroy')->name('basket.destroy');
    Route::patch('/update/{rowid}', 'BasketController@update')->name('basket.update');
});

Route::get('/payment', 'PaymentController@index')->name('payment');
Route::post('/successful', 'PaymentController@pay')->name('pay');



Route::get('/orders', 'OrderController@index')->name('orders');
Route::get('/orders/{id}', 'OrderController@detail')->name('order');

Route::resource('profile', 'UserDetailController')->middleware('auth');
