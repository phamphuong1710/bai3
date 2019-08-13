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

Route::resource('/', 'HomeController');

Route::resource('users', 'UserController')->middleware(['auth']);

Route::resource('categories', 'CategoryController')->middleware(['auth']);

Route::resource('stores', 'StoreController')->middleware(['auth']);

Route::resource('media-store', 'MediaStoreController')->middleware(['auth']);

Route::resource('video-store', 'VideoStoreController')->middleware(['auth']);

Route::get('shop/{storeID}/create-product', 'ProductController@createProduct')->name('createProduct')->middleware(['auth']);

Route::get('product', 'ProductController@getAllProductByUser')->name('listProduct')->middleware(['auth']);

Route::get('products/{slug}', 'SingleProductController@product')->name('product-single');

Route::resource('products', 'ProductController')->middleware(['auth']);

Route::resource('media-product', 'MediaProductController')->middleware(['auth']);

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::resource('logo', 'LogoController')->middleware(['auth']);

Route::resource('library', 'ImageLibraryController')->middleware(['auth']);

Route::post('/search-store', 'SearchController@searchStore')->middleware(['auth']);

Route::post('/search-product', 'SearchController@searchProduct')->middleware(['auth']);

Route::post( '/search-category', 'SearchController@filterByCategory')->middleware(['auth']);

Route::post( '/search-product-user', 'SearchController@searchProductByUser')->middleware(['auth']);

Route::post( '/search-category-user', 'SearchController@filterByCategoryUser')->middleware(['auth']);

Route::post( '/filter-store', 'SearchController@filterStore')->middleware(['auth']);

Route::post( '/search-user', 'SearchController@searchUser')->middleware(['auth']);

Route::post( '/filter-user', 'SearchController@filterUser')->middleware(['auth']);

Route::post( '/search-category', 'SearchController@searchCategory')->middleware(['auth']);

Route::post( '/filter-category', 'SearchController@filterCategory')->middleware(['auth']);

Route::get('/archive/{slug}', 'ArchiveController@product')->name('archive');

Route::post('/search', 'FilterController@search')->name('search');
