<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Http\Resources\RestaurantResource;
use App\Services\MealService;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantMealController extends Controller
{
    public function __construct(public RestaurantService $restaurantService,public MealService $mealService)
    {
    }

    public function index()
    {
        $validatedData = request()->validate(['restaurant_id' => 'required','exists:restaurant,id']);
        $meals = $this->restaurantService->getRestaurantMeals($validatedData['restaurant_id']);
        return response()->apiResponse(data:MealResource::collection($meals));
    }
    public function show($id)
    {
        $meal = $this->mealService->showMeal($id);
        return response()->apiResponse(data:MealResource::make($meal));
    }
}
