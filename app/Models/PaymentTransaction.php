<?php

namespace App\Models;


use App\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'status' => TransactionStatusEnum::class
    ];

}
