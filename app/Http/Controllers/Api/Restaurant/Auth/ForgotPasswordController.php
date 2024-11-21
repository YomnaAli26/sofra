<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;

use App\Services\RestaurantService;
use Illuminate\Http\Request;



class ForgotPasswordController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate(['email' => ['required','exists:restaurants,email'],]);
        $this->restaurantService->forgotPassword($request->email);
        return response()->apiResponse(message: "we send otp code on your email check it");

    }
}
