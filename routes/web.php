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

Route::get('/', 'HomeController@index')->name('home');
Route::view('/about', 'about')->name('about.index');

Route::get('/projects', 'ProjectsController@index')->name('projects.index');
Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');

Route::get('/artworks', 'ArtworksController@index')->name('artworks.index');
Route::get('/artwork/{artwork}', 'ArtworksController@show')->name('artworks.show');
Route::get('/search', 'ArtworksController@search')->name('search');

Route::get('/artists', 'ArtistsController@index')->name('artists.index');
Route::get('/artist/{artist}', 'ArtistsController@show');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{artwork}', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/wishlist', 'CartController@wishindex')->name('cart.wishindex');
Route::get('/cart/wishlist/{artwork}', 'CartController@wishlist')->name('cart.wishlist');
Route::delete('/cart/wishlist/{artwork}', 'CartController@rmwish')->name('cart.rmwish');

Route::get('/checkout', 'SalesController@checkout')->name('sales.checkout');
Route::get('/checkout/{id}', 'SalesController@show');
Route::get('/checkout/remove/{id}', 'SalesController@destroy');
Route::put('/checkout/address/{id}', 'SalesController@address')->name('sales.address');

Route::get('/payment/{id}', 'PaymentController@show');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
