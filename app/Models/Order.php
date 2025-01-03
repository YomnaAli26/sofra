<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Http\Requests\Client\StoreOrderRequest;
use App\Services\PaymentStrategies\PaymentContext;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};
use function PHPUnit\Framework\returnArgument;

class Order extends Model
{
    use Filterable;

    protected $fillable = [
        'address', 'payment_method_id', 'status',
        'notes', 'commission', 'delivery_fee',
        'price', 'total_amount', 'net',
        'client_id', 'restaurant_id'
    ];
    protected $casts = [
        'status' => OrderStatusEnum::class,
    ];

    protected static function boot()
    {
        static::creating(function ($model){
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
            ->withPivot('price', 'quantity', 'special_request')
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

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(PaymentTransaction::class, 'payable');
    }

}
