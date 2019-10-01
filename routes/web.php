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

Route::get('/', function () {
    return redirect()->route('home-index');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/lang/{lang}', 'Admin\AdminController@changeLang')->name('admin-change-lang');

    Route::get('/index', 'Admin\AdminController@index')->name('admin-index');
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/lang/{lang}', 'Home\HomeController@changeLang')->name('home-change-lang');

	Route::get('/index', 'Home\HomeController@index')->name('home-index');
	Route::get('/profile', 'Home\HomeController@getProfile')->name('home-profile');
});
