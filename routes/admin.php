<?php

use Illuminate\Support\Facades\Route;

Route::view('/','admin.dashboard')->name('dashboard');
Route::resource('/cities','CityController');
Route::resource('/areas','AreaController');
Route::resource('/categories','CategoryController');
Route::resource('/offers','OfferController');
Route::resource('/contact-us','ContactController')->only(['index','destroy']);
Route::resource('/restaurant-payments','CommissionController');
Route::resource('/posts','PostController');
Route::resource('/clients','ClientController');
Route::get('/admins/change-password','AdminController@changePassword')->name('change-password');
Route::resource('/admins','AdminController');
Route::resource('/roles','RoleController')->except(['show']);
Route::resource('/permissions','PermissionController');
Route::resource('/donation-requests','DonationRequestController');
Route::resource('/contact-us','ContactController')->only(['index','destroy']);
Route::resource('/profile','ProfileController')->only(['edit','update']);
Route::patch('clients/{id}/toggle-status', 'ClientController@toggleStatus')->name('clients.toggleStatus');
Route::get('settings', 'SettingController@index')->name("settings.index");
Route::put('settings', 'SettingController@put')->name("settings.update");
