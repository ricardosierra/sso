<?php

/**
 * Routes which is neccessary for the SSO server.
 */

Route::middleware(['api', \Illuminate\Session\Middleware\StartSession::class])->prefix('api/sso')->group(function () {
    Route::post('login', 'App\Controllers\ServerController@login');
    Route::post('logout', 'App\Controllers\ServerController@logout');
    Route::get('attach', 'App\Controllers\ServerController@attach');
    Route::get('userInfo', 'App\Controllers\ServerController@userInfo');
});

Route::get('login', 'App\Controllers\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Controllers\LoginController@login');
