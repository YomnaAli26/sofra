<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    public function showRestaurant($id)
    {
        $restaurant = $this->restaurantService->showRestaurant($id);
        return response()->apiResponse(data:RestaurantResource::make($restaurant));
    }

    public function getRestaurants()
    {
        $restaurants = $this->restaurantService->getRestaurants();
        return response()->apiResponse(data:RestaurantResource::collection($restaurants));
    }

    public function getMealsRestaurant()
    {
        $validatedData = request()->validate(['restaurant_id' => 'required','exists:restaurant,id']);
        $meals = $this->restaurantService->getMealsRestaurant($validatedData['restaurant_id']);
        return response()->apiResponse(data:MealResource::collection($meals));
    }
}
