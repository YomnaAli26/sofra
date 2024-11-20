<?php

namespace App\Http\Controllers\Api\Restaurant\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RegisterRequest;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;


class RegisterController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    public function __invoke(RegisterRequest $request)
    {

        $registeredRestaurant = $this->restaurantService->register($request->validated());
        $registeredRestaurant->token = $registeredRestaurant->createToken($registeredRestaurant->email)->plainTextToken;
        return response()->apiResponse(201, data: RestaurantResource::make($registeredRestaurant));
    }
}
