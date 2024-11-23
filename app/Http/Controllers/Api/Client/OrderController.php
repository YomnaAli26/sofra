<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreOrderRequest;
use App\Http\Resources\MealResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RestaurantResource;
use App\Services\MealService;
use App\Services\OrderService;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->processOrder($request->validated());
        return response()->apiResponse(201, data: OrderResource::make($order));
    }

    public function currentOrders()
    {
        $orders = $this->orderService->getCurrentOrders();
        return response()->apiResponse(data: OrderResource::collection($orders));


    }

}
