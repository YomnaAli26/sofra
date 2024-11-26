<?php

use App\Http\Controllers\Api\Restaurant\{OfferController, OrderController, ProfileController, MealController};
use App\Http\Controllers\Api\Restaurant\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    LogoutController,
    ResetPasswordController};


use Illuminate\Support\Facades\Route;

Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);
Route::post('forgot-password',ForgotPasswordController::class);
Route::patch('reset-password',ResetPasswordController::class);

Route::group(['middleware' => 'auth:restaurant'], function () {

    Route::post('logout',LogoutController::class);
    Route::apiResource('profile',ProfileController::class)->only('show','update');

    Route::apiResources([
        'meals'=> MealController::class,
        'offers'=> OfferController::class,
        ]);

    Route::get('new-orders',[OrderController::class,'newOrders']);
    Route::get('current-orders',[OrderController::class,'currentOrders']);
    Route::get('previous-orders',[OrderController::class,'previousOrders']);
    Route::patch('orders/{order}',[OrderController::class,'updateOrderStatus']);
    Route::patch('confirm-orders/{order}',[OrderController::class,'confirmOrder']);

});

