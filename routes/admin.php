<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:web')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


Route::group(['middleware' => ['auto-check-permission', 'auth:web']], function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::resource('/cities', 'CityController');
    Route::resource('/areas', 'AreaController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/offers', 'OfferController');
    Route::resource('/commissions', 'CommissionController');
    Route::resource('/payment-methods', 'PaymentMethodController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/orders', 'OrderController')
        ->only(['index', 'show']);
    Route::resource('/contact-us', 'ContactController')
        ->only(['index', 'destroy']);

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

});
