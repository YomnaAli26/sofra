<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreMealRequest;
use App\Http\Requests\Restaurant\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Services\MealService;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function __construct(public MealService $mealService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = $this->mealService->getRestaurantMeals();
        return response()->apiResponse(data: MealResource::collection($meals));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMealRequest $request)
    {
        $meal = $this->mealService->storeResource($request->validated());
        return response()->apiResponse(status: 201,data: MealResource::make($meal));

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $meal = $this->mealService->showResource($id);
        return response()->apiResponse(data: MealResource::make($meal));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMealRequest $request,  $id)
    {
        $meal = $this->mealService->updateResource($id,$request->validated());
        return response()->apiResponse(status: 200,data: MealResource::make($meal));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->mealService->deleteResource($id);
        return response()->apiResponse(204);
    }
}
