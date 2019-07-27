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

Route::resource('users', 'UserController')->middleware(['auth']);

Route::resource('categories', 'CategoryController')->middleware(['auth']);

Route::resource('stores', 'StoreController')->middleware(['auth']);

Route::resource('media-store', 'MediaStoreController')->middleware(['auth']);

Route::resource('video-store', 'VideoStoreController')->middleware(['auth']);

Route::get('shop/{storeID}/create-product', 'ProductController@createProduct')->name('createProduct')->middleware(['auth']);

Route::resource('products', 'ProductController')->middleware(['auth']);

Route::resource('media-product', 'MediaProductController')->middleware(['auth']);

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::resource('logo', 'StoreLogoController')->middleware(['auth']);


