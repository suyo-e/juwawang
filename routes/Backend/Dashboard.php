<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'Access\User\UserController@index')->name('dashboard');
