<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\RestaurantResource;
use App\Services\MealService;
use App\Services\OfferService;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    public function index()
    {

        $restaurants = $this->restaurantService->getRestaurants();
        return response()->apiResponse(data:RestaurantResource::collection($restaurants));
    }
    public function show($id)
    {
        $restaurant = $this->restaurantService->showResource($id);
        return response()->apiResponse(data:RestaurantResource::make($restaurant));
    }

    public function getOffers(OfferService $offerService)
    {
        $offers = $offerService->getData(['restaurant'],true);
        return response()->apiResponse(data:OfferResource::collection($offers));

    }

}
