<?php

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');






Route::get('/', 'MicropostsController@index');
// 中略
// ユーザ機能
Route::group(['middleware' => 'auth'], function () {
Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});

    Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    Route::group(['prefix' => 'users/{id}'], function () {
        
        /*プロフィール画像*/
        Route::get('/profile','ProfileController@index');
        Route::post('/profile','ProfileController@store');
        /*プロフィール画像*/
        
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('favoriteings', 'UsersController@favoriteings')->name('users.favoriteings');
    });
    
    
Route::group(['prefix' => 'microposts/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
         Route::get('favorites', 'FavoritesController@favorites')->name('microposts.favorites');
    });
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});

    Route::post( '/', 'PostsController@create');
    

