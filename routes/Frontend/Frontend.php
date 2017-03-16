<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/home', 'FrontendController@index')->name('home');
Route::get('/class', 'ClassController@index')->name('class');
Route::get('/information', 'InformationController@index')->name('information');
Route::get('/user', 'UserController@show')->name('user')->middleware('auth');
Route::post('/upload', 'FrontendController@upload')->name('upload');

Route::get('/users/edit', 'UserController@edit')->name('users.show')->middleware('auth');
Route::post('/users/update', 'UserController@update')->name('users.update')->middleware('auth');
Route::get('/users/password', 'UserController@password')->name('users.password')->middleware('auth');

Route::get('/products/categories', 'ProductController@categories')->name('products.categories')->middleware('auth');
Route::get('/products/create', 'ProductController@create')->name('products.create')->middleware('auth');
Route::get('/products', 'ProductController@index')->name('products.index')->middleware('auth');
Route::get('/products/show', 'ProductController@show')->name('products.show')->middleware('auth');
Route::post('/products/store', 'ProductController@store')->name('products.store')->middleware('auth');
Route::get('/collects', 'CollectController@index')->name('collects.index')->middleware('auth');
Route::post('/collects/store', 'CollectController@store')->name('collects.store')->middleware('auth');
Route::get('/orders', 'OrderController@index')->name('orders.index')->middleware('auth');
Route::get('/orders/create', 'OrderController@create')->name('orders.create')->middleware('auth');
Route::post('/orders/store', 'OrderController@store')->name('orders.store')->middleware('auth');
Route::get('/orders/success', 'OrderController@success')->name('orders.success')->middleware('auth');
Route::get('/profiles/create', 'ProfileController@create')->name('profiles.create')->middleware('auth');
Route::get('/profiles/show', 'ProfileController@show')->name('profiles.show')->middleware('auth');
Route::post('/profiles/store', 'ProfileController@store')->name('profiles.store')->middleware('auth');

Route::get('/sellers/create', 'SellerController@create')->name('sellers.create')->middleware('auth');
Route::get('/sellers/show', 'SellerController@show')->name('sellers.show')->middleware('auth');
Route::post('/sellers/store', 'SellerController@store')->name('sellers.store')->middleware('auth');
Route::get('/sellers', 'SellerController@index')->name('sellers.index');

Route::get('/categories', 'CategoryApiController@index')->name('api.categories');

Route::get('macros', 'FrontendController@macros')->name('macros');
Route::get('setting', 'FrontendController@setting')->name('setting');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {

    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});
