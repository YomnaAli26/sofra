<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};

class Area extends Model
{

    protected $fillable = ['name', 'city_id'];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
