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

    Route::get('profile/verify', 'ProfileController@verify')->name('profile.verify');
});

$router->get( '/_debugbar/assets/stylesheets', '\Barryvdh\Debugbar\Controllers\AssetController@css' );
$router->get( '/_debugbar/assets/javascript', '\Barryvdh\Debugbar\Controllers\AssetController@js' );

#Route::get('login', 'Frontend\UserController@login');
#Route::get('register', 'Frontend\UserController@register');


Route::get('admin/feedback', ['as'=> 'admin.feedback.index', 'uses' => 'Backend\FeedbackController@index']);
Route::post('admin/feedback', ['as'=> 'admin.feedback.store', 'uses' => 'Backend\FeedbackController@store']);
Route::get('admin/feedback/create', ['as'=> 'admin.feedback.create', 'uses' => 'Backend\FeedbackController@create']);
Route::put('admin/feedback/{feedback}', ['as'=> 'admin.feedback.update', 'uses' => 'Backend\FeedbackController@update']);
Route::patch('admin/feedback/{feedback}', ['as'=> 'admin.feedback.update', 'uses' => 'Backend\FeedbackController@update']);
Route::delete('admin/feedback/{feedback}', ['as'=> 'admin.feedback.destroy', 'uses' => 'Backend\FeedbackController@destroy']);
Route::get('admin/feedback/{feedback}', ['as'=> 'admin.feedback.show', 'uses' => 'Backend\FeedbackController@show']);
Route::get('admin/feedback/{feedback}/edit', ['as'=> 'admin.feedback.edit', 'uses' => 'Backend\FeedbackController@edit']);
