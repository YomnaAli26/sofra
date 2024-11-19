<?php

namespace App\Repositories\Eloquent;

use App\Models\Restaurant;
use App\Models\User;
use App\Repositories\Interfaces\RestaurantRepositoryInterface;

class RestaurantRepository extends BaseRepository implements RestaurantRepositoryInterface
{
    public function __construct(Restaurant $restaurant)
    {
        parent::__construct($restaurant);
    }
}
