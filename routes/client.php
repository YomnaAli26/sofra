<?php

use App\Http\Controllers\Api\Client\{OrderController,
    ReviewController,
    RestaurantMealController,
    ProfileController,
    RestaurantController};

use App\Http\Controllers\Api\Client\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    LogoutController,
    ResetPasswordController};


use Illuminate\Support\Facades\Route;

Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);
Route::post('forgot-password',ForgotPasswordController::class);
Route::patch('reset-password',ResetPasswordController::class);


Route::group(['middleware' => 'auth:client'], function () {

    Route::post('logout',LogoutController::class);
    Route::get('profile',[ProfileController::class,'show']);
    Route::put('profile',[ProfileController::class,'update']);

    Route::apiResource('restaurants',RestaurantController::class)->only(['index','show']);
    Route::apiResource('restaurant-meals',RestaurantMealController::class)->only(['index','show']);
    Route::apiResource('restaurant-reviews',ReviewController::class)->only(['index','store']);

    Route::apiResource('orders',OrderController::class)->only(['store','show']);
    Route::patch('orders/{order}',[OrderController::class,'updateOrderStatus']);
    Route::get('current-orders',[OrderController::class,'currentOrders']);
    Route::get('previous-orders',[OrderController::class,'previousOrders']);

});

