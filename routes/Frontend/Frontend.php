<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index')->middleware('auth');
Route::get('/home', 'FrontendController@index')->name('home')->middleware('auth');
Route::get('/class', 'ClassController@index')->name('class')->middleware('auth');
Route::get('/information', 'InformationController@index')->name('information')->middleware('auth');
Route::get('/information/show', 'InformationController@show')->name('information.show')->middleware('auth');
Route::get('/user', 'UserController@show')->name('user')->middleware('auth');
Route::post('/upload', 'FrontendController@upload')->name('upload')->middleware('auth');
Route::patch('/upload', 'FrontendController@upload')->name('upload')->middleware('auth');

Route::get('/users/edit', 'UserController@edit')->name('users.show')->middleware('auth');
Route::post('/users/update', 'UserController@update')->name('users.update')->middleware('auth');
Route::get('/users/password', 'UserController@password')->name('users.password')->middleware('auth');
Route::post('/users/resetPassword', 'UserController@resetPassword')->name('users.resetPassword');

Route::get('/products/categories', 'ProductController@categories')->name('products.categories')->middleware('auth');
Route::get('/products/create', 'ProductController@create')->name('products.create')->middleware('auth');
Route::get('/products', 'ProductController@index')->name('products.index')->middleware('auth');
Route::get('/products/show', 'ProductController@show')->name('products.show')->middleware('auth');
Route::post('/products/store', 'ProductController@store')->name('products.store')->middleware('auth');
Route::get('/products/delete', 'ProductController@delete')->name('products.delete')->middleware('auth');
Route::get('/products/edit', 'ProductController@edit')->name('products.edit')->middleware('auth');
Route::post('/products/update', 'ProductController@update')->name('products.update')->middleware('auth');

Route::get('/collects', 'CollectController@index')->name('collects.index')->middleware('auth');
Route::post('/collects/store', 'CollectController@store')->name('collects.store')->middleware('auth');
Route::get('/collects/like', 'CollectController@like')->name('collects.like')->middleware('auth');
Route::get('/collects/collect', 'CollectController@collect')->name('collects.collect')->middleware('auth');

Route::get('/orders', 'OrderController@index')->name('orders.index')->middleware('auth');
Route::get('/orders/show', 'OrderController@show')->name('orders.show')->middleware('auth');
Route::get('/orders/create', 'OrderController@create')->name('orders.create')->middleware('auth');
Route::post('/orders/store', 'OrderController@store')->name('orders.store')->middleware('auth');
Route::get('/orders/success', 'OrderController@success')->name('orders.success')->middleware('auth');
Route::get('/profiles/create', 'ProfileController@create')->name('profiles.create')->middleware('auth');
Route::get('/profiles/show', 'ProfileController@show')->name('profiles.show')->middleware('auth');
Route::post('/profiles/store', 'ProfileController@store')->name('profiles.store')->middleware('auth');
#Route::get('/profiles/recommand', 'ProfileController@recommand')->name('profiles.recommand')->middleware('auth');

Route::get('/sellers/create', 'SellerController@create')->name('sellers.create')->middleware('auth');
Route::get('/sellers/show', 'SellerController@show')->name('sellers.show')->middleware('auth');
Route::post('/sellers/store', 'SellerController@store')->name('sellers.store')->middleware('auth');

Route::get('/sellers', 'SellerController@index')->name('sellers.index')->middleware('auth');
Route::get('/sellers/edit', 'SellerController@edit')->name('sellers.edit')->middleware('auth');
Route::post('/sellers/update', 'SellerController@update')->name('sellers.update')->middleware('auth');

Route::get('/industries', 'IndustryController@index')->name('industries.index')->middleware('auth');
Route::get('/industries/edit', 'IndustryController@edit')->name('industries.edit')->middleware('auth');
Route::get('/industries/show', 'IndustryController@show')->name('industries.show')->middleware('auth');
Route::post('/industries/update', 'IndustryController@update')->name('industries.update')->middleware('auth');

Route::get('/categories', 'ApiController@index')->name('api.categories');
Route::get('/verify', 'ApiController@verify')->name('api.verify');
Route::get('/api/feedback', 'ApiController@feedback')->name('api.feedback');

Route::get('macros', 'FrontendController@macros')->name('macros');
Route::get('forget', 'FrontendController@forget')->name('forget');
Route::get('setting', 'FrontendController@setting')->name('setting')->middleware('auth');
Route::get('about', 'FrontendController@about')->name('about')->middleware('auth');
Route::get('feedback', 'FrontendController@feedback')->name('feedback')->middleware('auth');
Route::get('share', 'FrontendController@share')->name('share');

Route::get('/user/score', 'UserController@score')->name('score')->middleware('auth');
Route::get('/user/scoreList', 'UserController@scoreList')->name('scoreList')->middleware('auth');

Route::get('shareRegister', 'FrontendController@shareRegister')->name('shareRegister');
Route::get('success', 'FrontendController@success')->name('success');

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
