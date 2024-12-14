<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\{AuthenticatedSessionController,
    RegisteredUserController,
    PasswordResetLinkController,
    PasswordController,
    NewPasswordController,
    ConfirmablePasswordController,
};

Route::middleware('guest:web')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});



Route::group(['middleware' => ['auto-check-permission','auth:web']],function (){


    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

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
