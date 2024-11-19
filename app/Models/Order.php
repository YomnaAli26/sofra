<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo,HasMany};

class Order extends Model
{

    protected $fillable = [
        'address', 'payment_method', 'status',
        'notes', 'commission', 'delivery_fee',
        'total_amount', 'client_id', 'restaurant_id'
    ];

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
