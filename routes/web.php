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
    return redirect()->route('home_index');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin|root']], function () {
    Route::get('/lang/{lang}', 'Admin\AdminController@changeLang')->name('admin_change_lang');

    Route::get('/index', 'Admin\AdminController@index')->name('admin_index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/index', 'Admin\UserController@index')->name('admin_users_index');
        Route::post('/update/{id}', 'Admin\UserController@update')->name('admin_users_update');
    });

    Route::group(['prefix' => 'hotels'], function () {
        Route::get('/index', 'Admin\HotelController@index')->name('admin_hotels_index');
        Route::post('/store', 'Admin\HotelController@store')->name('admin_hotels_store');
        Route::post('/update/{id}', 'Admin\HotelController@update')->name('admin_hotels_update');
        Route::post('/delete/{id}', 'Admin\HotelController@destroy')->name('admin_hotels_delete');
    });

    Route::group(['prefix' => 'countries'], function () {
        Route::get('/index', 'Admin\CountryController@index')->name('admin_countries_index');
        Route::post('/store', 'Admin\CountryController@store')->name('admin_countries_store');
        Route::post('/update/{id}', 'Admin\CountryController@update')->name('admin_countries_update');
    });

    Route::group(['prefix' => 'cities'], function () {
        Route::get('/index', 'Admin\CityController@index')->name('admin_cities_index');
        Route::post('/store', 'Admin\CityController@store')->name('admin_cities_store');
        Route::post('/update/{id}', 'Admin\CityController@update')->name('admin_cities_update');
    });
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/lang/{lang}', 'Home\HomeController@changeLang')->name('home_change_lang');

    Route::get('/index', 'Home\HomeController@index')->name('home_index');
    
    Route::get('/profile', 'Home\HomeController@getProfile')->middleware('auth')->name('home_profile');

    Route::post('/search', 'Home\BookingController@search')->name('home_search');
});
