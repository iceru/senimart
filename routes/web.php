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
Route::view('/about', 'about');
Route::get('/projects', 'ProjectsController@index');

Route::get('/artworks', 'ArtworksController@index')->name('artworks.index');
Route::get('/artwork/{artwork}', 'ArtworksController@show')->name('artworks.show');

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

Route::post('/finish', function () {
    return redirect()->route('home');
})->name('payment.finish');
Route::get('/payment/{id}', 'PaymentController@show');
Route::post('/notif/handler', 'PaymentController@notifHandler')->name('notif.handler');
// Route::get('admin/artists', 'AdminArtistsController@index')->name('adminartists.index');
// Route::get('admin/artists/create', 'AdminArtistsController@create')->name('artists.create');
// Route::post('admin/artists', 'AdminArtistsController@store')->name('artists.store');
// Route::get('admin/artists/{artist}/edit', 'AdminArtistsController@edit')->name('artists.edit');
// Route::patch('admin/artists/{artist}', 'AdminArtistsController@update')->name('artists.update');
// Route::delete('admin/artists/{artist}', 'AdminArtistsController@destroy')->name('artists.destroy');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
