<?php

namespace App\Models;


use App\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PaymentTransaction extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'status' => TransactionStatusEnum::class
    ];

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

}
