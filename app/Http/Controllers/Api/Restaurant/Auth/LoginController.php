<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\LoginRequest;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;

class LoginController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }
    public function __invoke(LoginRequest $request)
    {
        $authenticatedRestaurant = $this->restaurantService->login($request->validated());
        $authenticatedRestaurant->token = $authenticatedRestaurant->createToken($authenticatedRestaurant["email"])->plainTextToken;
        return response()->apiResponse(200, data: RestaurantResource::make($authenticatedRestaurant));

    }
}
