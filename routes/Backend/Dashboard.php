<?php

/**
 * All route names are prefixed with 'admin.'.
 */
//Route::get('dashboard', 'Access\User\UserController@index')->name('dashboard');
Route::get('/', 'Access\User\UserController@profile')->name('dashboard');
Route::get('/product/recommand', 'ProductController@recommand')->name('products.recommand');
