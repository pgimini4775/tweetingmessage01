<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MicropostsController@index');

    //以下新規登録機能
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

    //以下ログイン、ログアウト機能
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::group(['prefix' => 'users/{id}'], function () { 
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        
    });
    Route::group(['prefix' => 'favorites/{id}'], function () { 
        Route::post('favo', 'FavoritesController@store')->name('user.favo');
        Route::delete('unfavo', 'FavoritesController@destroy')->name('user.unfavo');
        Route::get('favorite', 'UsersController@favorite')->name('users.favorite');
        Route::get('favo_user', 'UsersController@favo_user')->name('users.favo_user');
        Route::post('good', 'NicesController@store')->name('user.good');
        Route::delete('bad', 'NicesController@destroy')->name('user.bad');
    });
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
    
    Route::post('/upload', 'HomeController@upload');
    
    
});

