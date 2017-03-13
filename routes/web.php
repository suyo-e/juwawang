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
