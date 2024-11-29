<?php

namespace App\Http\Controllers\Api\Client;

use App\Enums\OrderStatusEnum;
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
        $result = $this->orderService->processOrderForClient($request->validated());

        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(201, data: OrderResource::make($result['data']));

    }
    public function show($id)
    {
        $result = $this->orderService->showOrderForClient($id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }

    public function updateOrderStatus(Request $request,$id)
    {
       $validatedData =  $request->validate(['action' => ['required','in:canceled,delivered',new ValidOrderStatus($id,[OrderStatusEnum::ACCEPTED])]]);
       $result = $this->orderService->updateOrderStatusForClient($validatedData,$id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }

    public function currentOrders()
    {
        $orders = $this->orderService->getCurrentOrdersForClient();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }
    public function previousOrders()
    {
        $orders = $this->orderService->getPreviousOrdersForClient();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }



}
