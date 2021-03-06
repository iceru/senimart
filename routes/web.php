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

Route::get('/projects', 'ProjectsController@index')->name('projects.index');
Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');

Route::get('/artworks', 'ArtworksController@index')->name('artworks.index');
Route::get('/artwork/{artwork}', 'ArtworksController@show')->name('artworks.show');
Route::get('/search', 'ArtworksController@search')->name('search');

Route::get('/artists', 'ArtistsController@index')->name('artists.index');
Route::get('/artist/{artist}', 'ArtistsController@show');

Route::get('/about', 'ContactFormController@index')->name('contact.index');
Route::post('/about', 'ContactFormController@store')->name('contact.store');

Route::middleware('auth')->group(function() {
    Route::get('/user', 'ProfileController@edit')->name('profile.edit');
    Route::patch('/user', 'ProfileController@update')->name('profile.update');
    
    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
    Route::get('/user/address', 'AddressController@index')->name('address.index');
    Route::get('/user/address/new', 'AddressController@new')->name('address.new');
    Route::post('/user/address/submit', 'AddressController@add')->name('address.add');
    Route::get('/user/address/{id}', 'AddressController@edit')->name('address.edit');
    Route::patch('/user/address/update/{id}', 'AddressController@update')->name('address.update');
    Route::get('/user/address/{id}/delete', 'AddressController@delete')->name('address.delete');
    Route::post('/checkout/address/new', 'AddressController@add')->name('address.checkoutadd');
});

Route::get('/findCity', 'AddressController@findCity');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{artwork}', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/wishlist', 'CartController@wishindex')->name('cart.wishindex');
Route::get('/cart/wishlist/{artwork}', 'CartController@wishlist')->name('cart.wishlist');
Route::delete('/cart/wishlist/{artwork}', 'CartController@rmwish')->name('cart.rmwish');

Route::get('/my-wishlist', 'WishlistController@index')->name('wishlist.index');
Route::post('/my-wishlist', 'WishlistController@store')->name('wishlist.store');
Route::get('/my-wishlist/{wishlist}', 'WishlistController@destroy')->name('wishlist.destroy');;

Route::get('/checkout', 'SalesController@checkout')->name('sales.checkout');
Route::get('/checkout/{id}', 'SalesController@show');
Route::get('/checkout/remove/{id}', 'SalesController@destroy')->name('sales.remove');
Route::put('/checkout/address/{id}', 'SalesController@address')->name('sales.address');


Route::get('/checkCost', 'ShippingController@checkCost');
Route::get('/shipping', 'ShippingController@addShip');
Route::post('/addShippingAddress', 'ShippingController@addAddress');
Route::post('/addShipCost', 'ShippingController@addShipCost');

Route::post('/finish', function () {
    return redirect()->route('home');
})->name('payment.finish');
Route::get('/pay', 'PaymentController@newPay');
Route::get('/payment/{id}', 'PaymentController@show');
Route::get('/payment/{id}/cancel', 'PaymentController@cancel');
Route::post('/notif/handler', 'PaymentController@notifHandler')->name('notif.handler');
// Route::get('admin/artists', 'AdminArtistsController@index')->name('adminartists.index');
// Route::get('admin/artists/create', 'AdminArtistsController@create')->name('artists.create');
// Route::post('admin/artists', 'AdminArtistsController@store')->name('artists.store');
// Route::get('admin/artists/{artist}/edit', 'AdminArtistsController@edit')->name('artists.edit');
// Route::patch('admin/artists/{artist}', 'AdminArtistsController@update')->name('artists.update');
// Route::delete('admin/artists/{artist}', 'AdminArtistsController@destroy')->name('artists.destroy');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('/google/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');;

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
