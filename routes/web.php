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
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/lang/{lang}', 'Home\HomeController@changeLang')->name('home_change_lang');

    Route::get('/index', 'Home\HomeController@index')->name('home_index');
    
    Route::get('/profile', 'Home\HomeController@getProfile')->middleware('auth')->name('home_profile');
    Route::post('/profile-ava', 'Home\ProfileController@updateAvatar')->middleware('auth')->name('home_profile_ava');

    Route::post('/search', 'Home\BookingController@search')->name('home_search');

    Route::get('/booking/{id}', 'Home\BookingController@getBookingForm')->middleware('auth')->name('home_booking');
    Route::post('/booking-rooms', 'Home\BookingController@booking')->middleware('auth')->name('home_booking_post');
});
