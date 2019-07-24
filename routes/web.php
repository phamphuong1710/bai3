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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('categories', 'CategoryController');

Route::resource('stores', 'StoreController');

Route::resource('media-store', 'MediaStoreController');

Route::resource('video-store', 'VideoStoreController');

Route::resource('products', 'ProductController');

Route::resource('media-product', 'MediaProductController');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::resource('logo', 'StoreLogoController');
