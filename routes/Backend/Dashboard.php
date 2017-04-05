<?php

/**
 * All route names are prefixed with 'admin.'.
 */
//Route::get('dashboard', 'Access\User\UserController@index')->name('dashboard');
Route::get('/', 'Access\User\UserController@profile')->name('dashboard');
