<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,BelongsToMany};

class Meal extends Model
{

    protected $fillable = [
        'name', 'description', 'price',
        'offer_price', 'restaurant_id', 'preparation_time'
    ];


    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

}
