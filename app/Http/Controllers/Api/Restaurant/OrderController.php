<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Rules\ValidOrderStatus;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {
    }


    public function newOrders()
    {
        $orders = $this->orderService->getNewOrdersForRestaurant();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }
    public function updateOrderStatus(Request $request,$id)
    {
        $validatedData =  $request->validate(['action' => ['required','in:accepted,rejected',new ValidOrderStatus($id,[OrderStatusEnum::PENDING])]]);
        $result = $this->orderService->updateOrderStatusForRestaurant($validatedData,$id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }
    public function confirmOrder(Request $request,$id)
    {
        $validatedData =  $request->validate(['action' => ['required','in:confirmed',new ValidOrderStatus($id,[OrderStatusEnum::DELIVERED])]]);
        $result = $this->orderService->updateOrderStatusForRestaurant($validatedData,$id);
        return !$result['status']
            ? response()->apiResponse($result['code'], message: $result['message'])
            : response()->apiResponse(data: OrderResource::make($result));

    }
    public function currentOrders()
    {
        $orders = $this->orderService->getCurrentOrdersForRestaurant();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }
    public function previousOrders()
    {
        $orders = $this->orderService->getPreviousOrdersForRestaurant();
        return response()->apiResponse(data: OrderResource::collection($orders));

    }



}
