<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'admin.dashboard')->name('dashboard');

Route::resource('/cities', 'CityController');
Route::resource('/areas', 'AreaController');
Route::resource('/categories', 'CategoryController');
Route::resource('/offers', 'OfferController');
Route::resource('/contact-us', 'ContactController')
    ->only(['index', 'destroy']);
Route::resource('/commissions', 'CommissionController');
Route::resource('/payment-methods', 'PaymentMethodController');
Route::resource('/orders', 'OrderController')
    ->only(['index', 'show']);


Route::get('/users/change-password', 'UserController@changePasswordForm')
    ->name('users.change-password.form');

Route::patch('/users/change-password', 'UserController@changePassword')
    ->name('users.change-password.update');

Route::resource('/users', 'UserController');

Route::patch('/restaurants/{restaurant}/toggle', 'RestaurantController@toggle')
    ->name('restaurants.toggle');
Route::resource('/restaurants', 'RestaurantController');


Route::patch('/clients/{client}/toggle', 'ClientController@toggle')
    ->name('clients.toggle');
Route::resource('/clients', 'ClientController');


Route::get('settings', 'SettingController@index')->name("settings.index");
Route::put('settings', 'SettingController@update')->name("settings.update");
