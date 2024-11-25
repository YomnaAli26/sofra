<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreOrderRequest;
use App\Http\Resources\MealResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\RestaurantResource;
use App\Rules\ValidOrderStatus;
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
        $result = $this->orderService->processOrder($request->validated());

        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(201, data: OrderResource::make($result['data']));

    }
    public function show($id)
    {
        $result = $this->orderService->showOrder($id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }

    public function updateOrderStatus(Request $request,$id)
    {
       $validatedData =  $request->validate(['action' => ['required','in:canceled,delivered',new ValidOrderStatus($id)]]);
       $result = $this->orderService->updateOrderStatus($validatedData,$id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }

    public function currentOrders()
    {
        $orders = $this->orderService->getCurrentOrders();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }
    public function previousOrders()
    {
        $orders = $this->orderService->getPreviousOrders();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }



}
