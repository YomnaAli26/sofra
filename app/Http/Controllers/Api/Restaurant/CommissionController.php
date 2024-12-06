<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommissionResource;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function __construct(public RestaurantService $restaurantService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $restaurantSales = $this->restaurantService->restaurantSales();
        $appCommissionFromRestaurant = $this->restaurantService->appCommissionFromRestaurant();
        $restaurantPaid = $this->restaurantService->restaurantPaid();
        $data = [
            'restaurant_sales' => $restaurantSales,
            'app_commission' => $appCommissionFromRestaurant,
            'restaurant_paid' => $restaurantPaid,
        ];
        return response()->apiResponse(data: CommissionResource::make($data));

    }
}
