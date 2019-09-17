<?php

Route::get('/', function () {
    return redirect()->route('home-index');
});

Auth::routes();

Route::group(['prefix' => 'home'], function () {
	Route::get('/index', 'Home\HomeController@index')->name('home-index');
});