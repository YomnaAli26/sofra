<?php

use App\Http\Controllers\Api\Restaurant\{OfferController,ProfileController};
use App\Http\Controllers\Api\Restaurant\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    LogoutController,
    ResetPasswordController};
use App\Http\Controllers\Api\Restaurant\MealController;

use Illuminate\Support\Facades\Route;

Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);
Route::post('forgot-password',ForgotPasswordController::class);
Route::patch('reset-password',ResetPasswordController::class);

Route::group(['middleware' => 'auth:restaurant'], function () {
    Route::post('logout',LogoutController::class);
    Route::get('profile',[ProfileController::class,'show']);
    Route::put('profile',[ProfileController::class,'update']);
    Route::apiResources([
        'meals'=> MealController::class,
        'offers'=> OfferController::class,
        ]);
});

