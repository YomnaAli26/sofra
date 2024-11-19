<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};

class Client extends Model
{

    protected $fillable = [
        'email', 'phone', 'password',
        'name', 'area_id'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
