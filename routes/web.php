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
Route::get('products/{slug}', 'SingleProductController@product')->name('product-single');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/archive/{slug}', 'ArchiveController@product')->name('archive');

Route::get('/all-store', 'ArchiveController@allStore')->name('all-store');

Route::post('/search', 'FilterController@search')->name('search');

Route::post('/search/product', 'FilterController@searchProduct')->name('search-product');

Route::post('/store/search-product', 'FilterController@searchProductInStore')->name('search-product-in-store');

Route::get('/store/rating/{rating}', 'FilterController@filterStoreByRating')->name('filter-rating-store');

Route::get('/product/rating/{rating}', 'FilterController@filterProductByRating')->name('filter-rating-product');

Route::post('/rating-product', 'RatingController@product')->name('rating-product');

Route::post('/rating-store', 'RatingController@store')->name('rating-store');

Route::get('/store/{slug}', 'StoreSingleController@store')->name('store');

Route::get('/products/discount/{discount}', 'ArchiveController@productDiscount')->name('discount');

Route::post('/add-to-cart', 'CartController@addToCart')->name('add-to-cart');

Route::delete('/delete-cart/{id}', 'CartController@deleteCartDetail')->name('delete-cart');

Route::get('/cart', 'CartController@cart')->name('cart');

Route::put('/update-cart/{id}', 'CartController@updateCart')->name('update-cart');

Route::get('/checkout', 'CartController@checkout')->name('checkout');

Route::get('/user-login', 'AuthController@login')->name('user-login');

Route::get('/user-register', 'AuthController@register')->name('user-register');

Route::middleware(['auth'])->group(function () {

    Route::get('order-detail/{id}','OrderController@order')->name('order-template');

    Route::resource('order','OrderController');

    Route::resource('roles','RoleController');

    Route::resource('users', 'UserController');

    Route::get('/user/{id}/edit', 'UserController@getEditUserTemplate')->name('edit-user');

    Route::resource('users', 'UserController');

    Route::resource('categories', 'CategoryController');

    Route::resource('stores', 'StoreController');

    Route::resource('media-store', 'MediaController');

    Route::resource('video-store', 'VideoStoreController');

    Route::get('shop/{storeID}/create-product', 'ProductController@createProduct')->name('createProduct');

    Route::get('product', 'ProductController@getAllProduct')->name('listProduct');

    Route::resource('products', 'ProductController');

    Route::post('/image-slider', 'LogoController@createImageSlider');

    Route::resource('logo', 'LogoController');

    Route::resource('library', 'ImageLibraryController');

    Route::post('/search-store', 'SearchController@searchStore');

    Route::post('/search-product', 'SearchController@searchProduct');

    Route::post( '/search-category', 'SearchController@filterByCategory');

    Route::post( '/search-product-user', 'SearchController@searchProductByUser');

    Route::post( '/search-category-user', 'SearchController@filterByCategoryUser');

    Route::post( '/filter-store', 'SearchController@filterStore');

    Route::post( '/search-user', 'SearchController@searchUser');

    Route::post( '/filter-user', 'SearchController@filterUser');

    Route::post( '/search-category', 'SearchController@searchCategory');

    Route::post( '/filter-category', 'SearchController@filterCategory');

    Route::resource('slider', 'SliderController');

    Route::post('/comment-product', 'CommentController@createProductComment');

    Route::post('/comment-store', 'CommentController@createStoreComment');

    Route::resource('note', 'NotificationController');
});












