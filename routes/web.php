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

Route::middleware(['role:Admin'])->name('dashboard.')->prefix('dashboard')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('products', 'ProductController');

});

Route::get('user/profile', 'UserController@profile')->name('users.profile');
Route::post('user/profile', 'UserController@updateProfile')->name('users.profile.update');

Route::get('order', 'HomeController@order')->name('order.landing.index');
Route::get('order/cart', 'HomeController@cart')->name('order.landing.cart');
Route::post('order/add-to-cart', 'HomeController@addToCart')->name('order.landing.add-to-cart');
Route::get('order/remove-from-cart/{id}', 'HomeController@removeFromCart')->name('order.landing.remove-from-cart');
Route::post('order/checkout', 'HomeController@checkout')->name('order.landing.checkout');

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
