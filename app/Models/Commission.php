<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{

    protected $fillable = [
        'paid', 'date', 'notes',
        'restaurant_id'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function restaurantSales(): Attribute
    {
        return Attribute::get(fn() => $this->restaurant
            ? $this->restaurant->orders->where('status', OrderStatusEnum::DELIVERED)->pluck('total_amount')->sum()
            : 0
        );
    }

    public function net(): Attribute
    {
        return Attribute::get(fn() => $this->restaurant
            ? $this->restaurant->orders->where('status', OrderStatusEnum::DELIVERED)->pluck('net')->sum()
            : 0
        );
    }

    public function appCommission(): Attribute
    {
        return Attribute::get(fn() => $this->restaurant
            ? $this->restaurant->orders->where('status', OrderStatusEnum::DELIVERED)->pluck('commission')->sum()
            : 0
        );
    }

    public function paid(): Attribute
    {
        return Attribute::get(function () {
            return $this->where('restaurant_id', auth('restaurant')->user()->id)->sum('paid');
        });

    }

    public function rest(): Attribute
    {
        return Attribute::get(fn() => $this->appCommission - $this->paid);
    }

}
