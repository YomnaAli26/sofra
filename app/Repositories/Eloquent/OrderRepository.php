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

}
