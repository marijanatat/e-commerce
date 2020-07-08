<?php

use FarhanWazir\GoogleMaps\GMaps;
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

// Route::middleware('auth')->group(function(){
//     Route::get('/my-profile', 'UsersController@edit')->name('users.edit')->middleware('auth');
// });

Route::get('/my-profile', 'UsersController@edit')->name('users.edit')->middleware('auth');
Route::patch('/my-profile', 'UsersController@update')->name('users.update')->middleware('auth');
Route::get('/my-orders', 'OrdersController@index')->name('orders.index')->middleware('auth');
Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show')->middleware('auth');

Route::post('/paypal-checkout', 'CheckoutController@paypalCheckout')->name('checkout.paypal');
//Route::view('/about','about');
Route::get('/map', 'MapController@index');

Route::get('/about', function(){
   
    $config['center'] = 'Somborska 38,Odžaci, Serbia';
    $config['zoom'] = '10';
    $config['map_heigh'] = '100px';
    $config['scrollwheel'] = false;


    $gmap = new GMaps();
    $gmap->initialize($config);

    // $marker['position']='Somborska,Odžaci';
    // $marker['infowindow_content']='Somborska 38';
    // GMaps::add_marker($marker);


    //$map = GMaps::create_map();
    $map = $gmap->create_map();

    // echo $map['js'];
    // echo $map['html'];

    return view('about',compact('map'));
});
