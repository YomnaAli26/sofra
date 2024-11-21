<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\ProfileRequest;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    public function update(ProfileRequest $request)
    {
        $updatedData = $this->restaurantService->updateProfileData($request->validated(), auth('restaurant')->user()->id);
        return response()->apiResponse(data: RestaurantResource::make($updatedData));

    }

    public function show()
    {
        $profileData = $this->restaurantService->showProfileData(auth('restaurant')->user()->id);
        return response()->apiResponse(data: RestaurantResource::make($profileData));

    }
}
