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
    Route::resource('information', 'InformationController');
    Route::resource('feedback', 'FeedbackController');
    Route::resource('icons', 'IconController');
    Route::resource('scores', 'ScoreController');

    Route::get('profile/verify', 'ProfileController@verify')->name('profile.verify');

    Route::get('profile', 'Access\User\UserController@profile')->name('profile');
    Route::get('industry', 'Access\User\UserController@industry')->name('industry');

    Route::get('stats/users', 'StatsController@users')->name('stats.users');
    Route::get('stats/products', 'StatsController@products')->name('stats.products');
    Route::get('stats/orders', 'StatsController@orders')->name('stats.orders');
});

$router->get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' );
$router->get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' );

#Route::get('login', 'Frontend\UserController@login');
#Route::get('register', 'Frontend\UserController@register');




Route::get('admin/settings', ['as'=> 'admin.settings.index', 'uses' => 'Backend\SettingController@index']);
Route::post('admin/settings', ['as'=> 'admin.settings.store', 'uses' => 'Backend\SettingController@store']);
Route::get('admin/settings/create', ['as'=> 'admin.settings.create', 'uses' => 'Backend\SettingController@create']);
Route::put('admin/settings/{settings}', ['as'=> 'admin.settings.update', 'uses' => 'Backend\SettingController@update']);
Route::patch('admin/settings/{settings}', ['as'=> 'admin.settings.update', 'uses' => 'Backend\SettingController@update']);
Route::delete('admin/settings/{settings}', ['as'=> 'admin.settings.destroy', 'uses' => 'Backend\SettingController@destroy']);
Route::get('admin/settings/{settings}', ['as'=> 'admin.settings.show', 'uses' => 'Backend\SettingController@show']);
Route::get('admin/settings/{settings}/edit', ['as'=> 'admin.settings.edit', 'uses' => 'Backend\SettingController@edit']);
