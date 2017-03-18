<?php

/**
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', 'LanguageController@swap');

/* ----------------------------------------------------------------------- */

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/Frontend/');

});

/* ----------------------------------------------------------------------- */

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    includeRouteFiles(__DIR__.'/Backend/');

    Route::resource('collects', 'CollectController');
    Route::resource('orders', 'OrderController');
    Route::resource('products', 'ProductController');
    Route::resource('industries', 'IndustryController');
    Route::resource('categories', 'CategoryController');
    Route::resource('banners', 'BannerController');
    Route::resource('profiles', 'ProfileController');
});

$router->get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' );
$router->get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' );

#Route::get('login', 'Frontend\UserController@login');
#Route::get('register', 'Frontend\UserController@register');






Route::get('admin/profiles', ['as'=> 'admin.profiles.index', 'uses' => 'Backend\ProfileController@index']);
Route::post('admin/profiles', ['as'=> 'admin.profiles.store', 'uses' => 'Backend\ProfileController@store']);
Route::get('admin/profiles/create', ['as'=> 'admin.profiles.create', 'uses' => 'Backend\ProfileController@create']);
Route::put('admin/profiles/{profiles}', ['as'=> 'admin.profiles.update', 'uses' => 'Backend\ProfileController@update']);
Route::patch('admin/profiles/{profiles}', ['as'=> 'admin.profiles.update', 'uses' => 'Backend\ProfileController@update']);
Route::delete('admin/profiles/{profiles}', ['as'=> 'admin.profiles.destroy', 'uses' => 'Backend\ProfileController@destroy']);
Route::get('admin/profiles/{profiles}', ['as'=> 'admin.profiles.show', 'uses' => 'Backend\ProfileController@show']);
Route::get('admin/profiles/{profiles}/edit', ['as'=> 'admin.profiles.edit', 'uses' => 'Backend\ProfileController@edit']);






Route::get('admin/products', ['as'=> 'admin.products.index', 'uses' => 'Backend\ProductController@index']);
Route::post('admin/products', ['as'=> 'admin.products.store', 'uses' => 'Backend\ProductController@store']);
Route::get('admin/products/create', ['as'=> 'admin.products.create', 'uses' => 'Backend\ProductController@create']);
Route::put('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Backend\ProductController@update']);
Route::patch('admin/products/{products}', ['as'=> 'admin.products.update', 'uses' => 'Backend\ProductController@update']);
Route::delete('admin/products/{products}', ['as'=> 'admin.products.destroy', 'uses' => 'Backend\ProductController@destroy']);
Route::get('admin/products/{products}', ['as'=> 'admin.products.show', 'uses' => 'Backend\ProductController@show']);
Route::get('admin/products/{products}/edit', ['as'=> 'admin.products.edit', 'uses' => 'Backend\ProductController@edit']);


Route::get('admin/information', ['as'=> 'admin.information.index', 'uses' => 'Backend\InformationController@index']);
Route::post('admin/information', ['as'=> 'admin.information.store', 'uses' => 'Backend\InformationController@store']);
Route::get('admin/information/create', ['as'=> 'admin.information.create', 'uses' => 'Backend\InformationController@create']);
Route::put('admin/information/{information}', ['as'=> 'admin.information.update', 'uses' => 'Backend\InformationController@update']);
Route::patch('admin/information/{information}', ['as'=> 'admin.information.update', 'uses' => 'Backend\InformationController@update']);
Route::delete('admin/information/{information}', ['as'=> 'admin.information.destroy', 'uses' => 'Backend\InformationController@destroy']);
Route::get('admin/information/{information}', ['as'=> 'admin.information.show', 'uses' => 'Backend\InformationController@show']);
Route::get('admin/information/{information}/edit', ['as'=> 'admin.information.edit', 'uses' => 'Backend\InformationController@edit']);
