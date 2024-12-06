<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Order extends Model
{
    protected $fillable = [
        'address', 'payment_method', 'status',
        'notes', 'commission', 'delivery_fee',
        'price', 'total_amount','net',
        'client_id', 'restaurant_id'
    ];
    protected $casts =[
        'status'=> OrderStatusEnum::class,
    ];

    protected static function boot()
    {
        static::creating(function ($model) {
            $model->number = static::generateOrderNumber();

        });
        parent::boot();
    }
    public static function generateOrderNumber(): string
    {
        return 'ORD-' . date('YmdHis');
    }

    public function scopeStatus(Builder $builder, $status): Builder
    {
        return $builder->where('status', $status);
    }

    public function meals(): BelongsToMany
    {
        return $this->belongsToMany(Meal::class)
            ->withPivot('price','quantity','special_request')
            ->withTimestamps();
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
