<?php



use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;


Route::get('cities', [MainController::class,'cities']);
Route::get('areas', [MainController::class,'areas']);
Route::get('settings', [MainController::class,'settings']);
Route::post('contact-us', [MainController::class,'contactUs']);
Route::middleware('auth:client,restaurant')->group(function () {
    Route::post('register-fcm-token', [MainController::class,'registerFcmToken']);
    Route::delete('register-fcm-token', [MainController::class,'deleteFcmToken']);

});



