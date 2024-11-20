<?php

use App\Http\Controllers\Api\Restaurant\Auth\{ForgotPasswordController,
    LoginController,
    RegisterController,
    LogoutController,
    ResetPasswordController};

use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;

Route::post('register',RegisterController::class);
Route::post('login',LoginController::class);
Route::post('forgot-password',ForgotPasswordController::class);
Route::patch('reset-password',ResetPasswordController::class);
Route::get('cities', [MainController::class,'cities']);
Route::get('areas', [MainController::class,'areas']);
Route::get('settings', [MainController::class,'settings']);
Route::post('contact-us', [MainController::class,'contactUs']);

Route::group(['middleware' => 'auth:restaurant'], function () {
    Route::post('logout',LogoutController::class);

});

