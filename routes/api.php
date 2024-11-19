<?php

use App\Http\Controllers\Api\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/cities', [MainController::class,'cities']);
Route::get('/settings', [MainController::class,'settings']);
Route::post('/contact-us', [MainController::class,'contactUs']);
