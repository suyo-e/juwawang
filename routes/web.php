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

    Route::get('profile/verify', 'ProfileController@verify')->name('profile.verify');

    Route::get('profile', 'Access\User\UserController@profile')->name('profile');
    Route::get('industry', 'Access\User\UserController@industry')->name('industry');
});

$router->get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' );
$router->get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' );

#Route::get('login', 'Frontend\UserController@login');
#Route::get('register', 'Frontend\UserController@register');


Route::get('admin/scores', ['as'=> 'admin.scores.index', 'uses' => 'Backend\ScoreController@index']);
Route::post('admin/scores', ['as'=> 'admin.scores.store', 'uses' => 'Backend\ScoreController@store']);
Route::get('admin/scores/create', ['as'=> 'admin.scores.create', 'uses' => 'Backend\ScoreController@create']);
Route::put('admin/scores/{scores}', ['as'=> 'admin.scores.update', 'uses' => 'Backend\ScoreController@update']);
Route::patch('admin/scores/{scores}', ['as'=> 'admin.scores.update', 'uses' => 'Backend\ScoreController@update']);
Route::delete('admin/scores/{scores}', ['as'=> 'admin.scores.destroy', 'uses' => 'Backend\ScoreController@destroy']);
Route::get('admin/scores/{scores}', ['as'=> 'admin.scores.show', 'uses' => 'Backend\ScoreController@show']);
Route::get('admin/scores/{scores}/edit', ['as'=> 'admin.scores.edit', 'uses' => 'Backend\ScoreController@edit']);
