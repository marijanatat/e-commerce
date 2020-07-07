<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

Route::get('/', 'ProductController@index')->name('home');
Route::get('/shop','ShopController@index')->name('shop.index');
Route::get('/shop/{product}','ShopController@show')->name('shop.show');
Route::get('/cart','CartController@index')->name('cart.index');
Route::post('/cart','CartController@store')->name('cart.store');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');
Route::delete('/destroy/{product}','CartController@destroy')->name('cart.destroy');

Route::get('/checkout','CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/guestCheckout','CheckoutController@index')->name('guestCheckout.index');
Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::get('empty',function(){
    Cart::destroy();
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ShopController@search')->name('search');

