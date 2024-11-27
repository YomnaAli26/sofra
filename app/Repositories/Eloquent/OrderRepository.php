<?php

namespace App\Repositories\Eloquent;


use App\Events\OrderEvent;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function __construct(public Order $order)
    {
        parent::__construct($order);
    }

    public function createOrder($data)
    {
        DB::beginTransaction();
        try {

            $restaurant = Restaurant::where('id', $data['restaurant_id'])->first();
            $orderPrice = collect($data['meals'])->map(function ($meal) {
                $mealModel = Meal::query()->find($meal['meal_id']);
                return $mealModel->price * $meal['quantity'];
            })->sum();
            $commission = Setting::where('key', 'commission_value')->first()->value;
            $commission = $orderPrice * $commission;
            $deliveryFee = $restaurant->value('delivery_fee');
            $total = $orderPrice + $deliveryFee;

            $orderData = Arr::except($data, 'meals');
            $orderData['price'] = $orderPrice;
            $orderData['commission'] = $commission;
            $orderData['delivery_fee'] = $deliveryFee;
            $orderData['total_amount'] = $total;
            $orderData['net'] = $total - $commission;

            if ($total < $restaurant->value('min_order')) {
                return [
                    'code'=> 422,
                    'status' => false,
                    'message'=>   'The total price of the order must be greater than ' . $restaurant->min_order,
                ];
            }

            $order = $this->order->create($orderData);
            $order->meals()->attach(
                collect($data['meals'])->mapWithKeys(function ($meal) {
                    return [
                        $meal['meal_id'] => [
                            'price' => Meal::query()->find($meal['meal_id'])->price,
                            'quantity' => $meal['quantity'],
                            'special_request' =>  $meal['special_request'] ?? '',
                        ]
                    ];
                })->toArray()
            );
            DB::commit();
            $order = $order->fresh(['meals.restaurant','restaurant']);
            OrderEvent::dispatch($order,"created",'restaurant');
            return [
                'status' => true,
                'data'=> $order,
            ];


        } catch (\Throwable $exception) {

            DB::rollBack();
            return [
                'code'=> 404,
                'status' => false,
                'message'=>   $exception->getMessage(),
            ];

        }
    }
}
