<?php

use App\Http\Controllers\Api\Restaurant\{CommissionController,
    OfferController,
    OrderController,
    ProfileController,
    MealController
};
use App\Http\Controllers\Api\Restaurant\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    LogoutController,
    ResetPasswordController
};


use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('forgot-password', ForgotPasswordController::class);
Route::patch('reset-password', ResetPasswordController::class);

Route::group(['middleware' => 'auth:restaurant'], function () {

    Route::post('logout', LogoutController::class);
    Route::apiResource('profile', ProfileController::class)->only('show', 'update');

    Route::apiResources([
        'meals' => MealController::class,
        'offers' => OfferController::class,
    ]);

    Route::controller(OrderController::class)->group(function () {
        Route::get('new-orders', 'newOrders');
        Route::get('current-orders', 'currentOrders');
        Route::get('previous-orders', 'previousOrders');
        Route::patch('orders/{order}', 'updateOrderStatus');
        Route::patch('confirm-orders/{order}', 'confirmOrder');
    });

    Route::get('commissions', CommissionController::class);

});

