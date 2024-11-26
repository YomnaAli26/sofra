<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Events\OrderEvent;
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

    public function showOrder($id): array
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'client_id' => auth('client')->user()->id,
        ]);

       return $order ?? [
           'code' => 404,
           'status' => false,
           'message'=>'invalid order id'

       ];
    }

    public function updateOrderStatus($data,$id)
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'client_id' => auth('client')->user()->id,
        ]);
        $order->update([
            'status' => OrderStatusEnum::from($data['action']),
        ]);
        return $order->refresh()->load('meals.restaurant');

    }

    public function processOrder($data): array
    {
         return $this->orderRepository->createOrder($data);
    }

    public function getCurrentOrders()
    {
        return $this->orderRepository->withRelations(['meals.restaurant','client.area'])->getBy([
            'status' => OrderStatusEnum::ACCEPTED,
            'client_id'=> auth('client')->user()->id,
            ]);
    }
    public function getPreviousOrders()
    {

        return $this->orderRepository->withRelations(['meals.restaurant','client.area'])->whereIn( 'status' ,[
            OrderStatusEnum::COMPLETED,
            OrderStatusEnum::CANCELED,
            ])->filter(function ($order)
        {
            return $order->where('client_id',auth('client')->user()->id);
        });
    }

    public function getNewOrdersForRestaurant()
    {

        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
            ])->getBy([
            'status' => OrderStatusEnum::PENDING,
            'restaurant_id'=> auth('restaurant')->user()->id,
        ]);
    }

    public function getCurrentOrdersForRestaurant()
    {

        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
            ])->getBy([
            'status' => OrderStatusEnum::DELIVERED,
            'restaurant_id'=> auth('restaurant')->user()->id,
        ]);
    }

    public function getPreviousOrdersForRestaurant()
    {
        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
        ])->whereIn( 'status' ,[
            OrderStatusEnum::COMPLETED,
            OrderStatusEnum::REJECTED,
        ])->filter(function ($order)
        {
            return $order->where('restaurant_id',auth('restaurant')->user()->id);
        });
    }
    public function updateOrderStatusForRestaurant($data,$id)
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'restaurant_id' => auth('restaurant')->user()->id,
        ]);
        $order->update([
            'status' => OrderStatusEnum::from($data['action']),
        ]);
        return $order->refresh()->load('meals.restaurant');

    }
}
