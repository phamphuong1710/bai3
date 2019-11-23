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

Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Route::get('/chat', 'ChatController@index');

Route::get('/messages', 'ChatController@fetchMessages');

Route::post('/messages', 'ChatController@sendMessage');

Route::resource('/', 'HomeController');

Route::get('products/{slug}', 'SingleProductController@product')->name('product-single');

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/archive/{slug}', 'ArchiveController@product')->name('archive');

Route::get('/all-store', 'ArchiveController@allStore')->name('all-store');

Route::get('/search', 'FilterController@search')->name('search');

Route::get('/ajax-search', 'FilterController@getStore');

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

Route::get('/buy-group/{id}', 'CartController@createBuyGroup')->name('buy-group');

Route::get('/cart', 'CartController@cart')->name('cart');

Route::put('/update-cart/{id}', 'CartController@updateCart')->name('update-cart');

Route::get('/checkout', 'CartController@checkout')->name('checkout');

Route::get('/user-login', 'Admin\AuthController@login')->name('user-login');

Route::get('/user-register', 'Admin\AuthController@register')->name('user-register');

Route::middleware(['auth'])->group(function () {

    Route::get('order-detail/{id}','OrderController@order')->name('order-template');

    Route::resource('order','OrderController');

    Route::resource('roles','Admin\RoleController');

    Route::resource('users', 'Admin\UserController');

    Route::get('/user/{id}/edit', 'Admin\UserController@getEditUserTemplate')->name('edit-user');

    Route::resource('users', 'Admin\UserController');

    Route::resource('categories', 'Admin\CategoryController');

    Route::resource('stores', 'Admin\StoreController');

    Route::resource('media-store', 'Admin\MediaController');

    Route::resource('video-store', 'VideoStoreController');

    Route::get('shop/{storeID}/create-product', 'Admin\ProductController@createProduct')->name('createProduct');

    Route::get('/product', 'Admin\ProductController@getAllProduct')->name('listProduct');

    Route::resource('products', 'Admin\ProductController');

    Route::post('/image-slider', 'Admin\LogoController@createImageSlider');

    Route::resource('logo', 'Admin\LogoController');

    Route::resource('library', 'Admin\ImageLibraryController');

    Route::post('/search-store', 'SearchController@searchStore');

    Route::post('/search-product', 'SearchController@searchProduct');

    Route::post( '/search-product-category', 'SearchController@filterByCategory');

    Route::post( '/search-product-user', 'SearchController@searchProductByUser');

    Route::post( '/search-category-user', 'SearchController@filterByCategoryUser');

    Route::post( '/filter-store', 'SearchController@filterStore');

    Route::post( '/search-user', 'SearchController@searchUser');

    Route::post( '/filter-user', 'SearchController@filterUser');

    Route::post( '/search-category', 'SearchController@searchCategory');

    Route::post( '/filter-category', 'SearchController@filterCategory');

    Route::resource('slider', 'Admin\SliderController');

    Route::post('/comment-product', 'CommentController@createProductComment');

    Route::post('/comment-store', 'CommentController@createStoreComment');

    Route::resource('note', 'Admin\NotificationController');
});

