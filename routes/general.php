<?php


use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;

Route::controller(MainController::class)->group(function () {
    Route::get('cities', 'cities');
    Route::get('areas', 'areas');
    Route::get('settings', 'settings');
    Route::post('contact-us', 'contactUs');
});

Route::middleware('auth:client,restaurant')->group(function () {
    Route::controller(MainController::class)->group(function () {

        Route::post('register-fcm-token', 'registerFcmToken');
        Route::delete('delete-fcm-token', 'deleteFcmToken');
    });
    Route::apiResource('notifications', NotificationController::class)->only(['index', 'show']);

});



