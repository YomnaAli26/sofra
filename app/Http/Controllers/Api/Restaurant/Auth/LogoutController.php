<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LogoutController extends Controller
{

    public function __invoke(Request $request)
    {
        $request->user('client')->currentAccessToken()->delete();
        return response()->apiResponse(message: "Logged out successfully");
    }
}
