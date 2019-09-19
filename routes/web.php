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

Route::group(['prefix' => 'home'], function () {
	Route::get('/index', 'Home\HomeController@index')->name('home-index');
});
