<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model ,Relations\HasMany};

class PaymentMethod extends Model
{
    protected $fillable =[
        'name',
        'is_active',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
