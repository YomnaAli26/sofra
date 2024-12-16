<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Events\OrderEvent;
use App\Repositories\Interfaces\{MealRepositoryInterface,
    OrderRepositoryInterface,
    RestaurantRepositoryInterface};
use Illuminate\Support\{Arr, Facades\DB};


class OrderService extends BaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public OrderRepositoryInterface      $orderRepository,
        public RestaurantRepositoryInterface $restaurantRepository,
        public MealRepositoryInterface       $mealRepository,
    )
    {
        parent::__construct($orderRepository);

    }

    public function createOrder($data): array
    {

        DB::beginTransaction();
        try {
            $restaurant = $this->restaurantRepository->find($data['restaurant_id']);
            $orderPrice = collect($data['meals'])->map(function ($meal) {
                $mealModel = $this->mealRepository->find($meal['meal_id']);
                return $mealModel->price * $meal['quantity'];
            })->sum();
            $commission = settings()['commission_value'];
            $commission = $orderPrice * $commission;
            $deliveryFee = $restaurant->delivery_fee;
            $total = $orderPrice + $deliveryFee;

            $orderData = Arr::except($data, 'meals');
            $orderData['price'] = $orderPrice;
            $orderData['commission'] = $commission;
            $orderData['delivery_fee'] = $deliveryFee;
            $orderData['total_amount'] = $total;
            $orderData['net'] = $total - $commission;

            if ($total < $restaurant->min_order) {
                return [
                    'code' => 422,
                    'status' => false,
                    'message' => 'The total price of the order must be greater than ' . $restaurant->min_order,
                ];
            }

            $order = $this->orderRepository->create($orderData);
            $order->meals()->attach(
                collect($data['meals'])->mapWithKeys(function ($meal) {
                    return [
                        $meal['meal_id'] => [
                            'price' => $this->mealRepository->find($meal['meal_id'])->price,
                            'quantity' => $meal['quantity'],
                            'special_request' => $meal['special_request'] ?? '',
                        ]
                    ];
                })->toArray()
            );
            DB::commit();
            $order = $order->fresh(['meals.restaurant', 'restaurant']);
            OrderEvent::dispatch($order, "created", 'restaurant');
            return [
                'status' => true,
                'data' => $order,
            ];


        } catch (\Throwable $exception) {

            DB::rollBack();
            return [
                'code' => 404,
                'status' => false,
                'message' => $exception->getMessage(),
            ];

        }
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
            ->whereIn('status', [OrderStatusEnum::DELIVERED, OrderStatusEnum::CANCELED,])
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
        ])->whereIn('status', [OrderStatusEnum::DELIVERED, OrderStatusEnum::REJECTED,])
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

    public function print()
    {

    }
}
