<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Events\OrderEvent;
use App\Models\Order;
use App\Models\Restaurant;
use App\Repositories\Interfaces\OrderRepositoryInterface;


class OrderService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(public OrderRepositoryInterface $orderRepository)
    {
        parent::__construct($orderRepository);

    }

    public function showOrderForClient($id): array
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'client_id' => auth('client')->user()->id,
        ]);

        return $order ?? [
            'code' => 404,
            'status' => false,
            'message' => 'invalid order id'

        ];
    }

    public function updateOrderStatusForClient($data, $id)
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'client_id' => auth('client')->user()->id,
        ]);
        $order->update([
            'status' => OrderStatusEnum::from($data['action']),
        ]);
        $order = $order->refresh()->load('meals.restaurant');
        OrderEvent::dispatch($order, $data['action'], 'restaurant');
        return $order;

    }

    public function processOrderForClient($data): array
    {
        return $this->orderRepository->createOrder($data);
    }

    public function getCurrentOrdersForClient()
    {
        return $this->orderRepository->withRelations(['meals.restaurant', 'client.area'])->getBy([
            'status' => OrderStatusEnum::ACCEPTED,
            'client_id' => auth('client')->user()->id,
        ]);
    }

    public function getPreviousOrdersForClient()
    {

        return $this->orderRepository->withRelations(['meals.restaurant', 'client.area'])
            ->whereIn('status', [OrderStatusEnum::COMPLETED, OrderStatusEnum::CANCELED,])
            ->getBy(['restaurant_id' => auth('restaurant')->user()->id]);

    }

    public function getNewOrdersForRestaurant()
    {

        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
        ])->getBy([
            'status' => OrderStatusEnum::PENDING,
            'restaurant_id' => auth('restaurant')->user()->id,
        ]);
    }

    public function getCurrentOrdersForRestaurant()
    {

        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
        ])->getBy([
            'status' => OrderStatusEnum::DELIVERED,
            'restaurant_id' => auth('restaurant')->user()->id,
        ]);
    }

    public function getPreviousOrdersForRestaurant()
    {
        return $this->orderRepository->withRelations(['meals.restaurant.area.city',
            'meals.restaurant.category',
            'client.area',
        ])->whereIn('status', [OrderStatusEnum::COMPLETED, OrderStatusEnum::REJECTED,])
            ->getBy(['restaurant_id' => auth('restaurant')->user()->id]);
    }

    public function updateOrderStatusForRestaurant($data, $id)
    {
        $order = $this->orderRepository->withRelations(['meals.restaurant'])->findBy([
            'id' => $id,
            'restaurant_id' => auth('restaurant')->user()->id,
        ]);
        $order->update([
            'status' => OrderStatusEnum::from($data['action']),
        ]);
        $order = $order->refresh()->load('meals.restaurant');
        OrderEvent::dispatch($order, $data['action'], 'client');
        return $order;

    }
}
