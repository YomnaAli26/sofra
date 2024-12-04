<?php

use Illuminate\Support\Facades\Route;

Route::view('/','admin.dashboard')->name('dashboard');

Route::resource('/cities','CityController');
Route::resource('/areas','AreaController');
Route::resource('/categories','CategoryController');
Route::resource('/offers','OfferController');
Route::resource('/restaurant-payments','CommissionController');
Route::resource('/contact-us','ContactController')->only(['index','destroy']);

Route::get('settings', 'SettingController@index')->name("settings.index");
Route::put('settings', 'SettingController@update')->name("settings.update");
