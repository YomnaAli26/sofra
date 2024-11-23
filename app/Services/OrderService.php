<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;


class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public OrderRepositoryInterface $orderRepository)
    {
    }

    public function processOrder($data)
    {
         $order = $this->orderRepository->createOrder($data);
         return $order;
    }

    public function getCurrentOrders()
    {
        return $this->orderRepository->withRelations(['meals.restaurant'])->getBy([
            'status'=>OrderStatusEnum::ACCEPTED,
            'client_id'=>auth('client')->user()->id,
            ]);
    }

}
