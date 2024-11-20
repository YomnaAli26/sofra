<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};
use Spatie\Translatable\HasTranslations;

class Area extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable = ['name', 'city_id'];
    protected $translatable =['name'];
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
