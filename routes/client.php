<?php

use App\Http\Controllers\Api\Client\ProfileController;
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

});

