<?php

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');

Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
Route::group(['middleware' => ['auth']], function () {
Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
});

Route::get('/', 'MicropostsController@index');


// 中略

// ユーザ機能
Route::group(['middleware' => 'auth'], function () {
Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});