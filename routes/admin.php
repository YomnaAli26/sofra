<?php

use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

Route::view('/','admin.dashboard')->name('dashboard');

Route::resource('/cities','CityController');
Route::resource('/areas','AreaController');
Route::resource('/categories','CategoryController');
Route::resource('/offers','OfferController');
Route::resource('/contact-us','ContactController')->only(['index','destroy']);
Route::resource('/commissions','CommissionController');
Route::resource('/restaurants','RestaurantController');
Route::resource('/payment-methods','PaymentMethodController');

Route::get('/orders/{order}/print', [OrderController::class, 'printOrder'])->name('orders.print');
Route::resource('/orders','OrderController')->only(['index','show']);

Route::patch('/clients/{client}/toggle','ClientController@toggle')->name('clients.toggle');
Route::resource('/clients','ClientController');
Route::get('settings', 'SettingController@index')->name("settings.index");
Route::put('settings', 'SettingController@update')->name("settings.update");
