<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use App\Services\RestaurantService;
use Illuminate\Http\Request;


class ResetPasswordController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required','exists:restaurants,email'],
            'code' => ['required','exists:restaurants,code'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $this->restaurantService->resetPassword($validated);
        return response()->apiResponse(message: "your password has been reset");

    }
}
