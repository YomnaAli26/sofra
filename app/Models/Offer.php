<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};


class Offer extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Filterable;

    protected $fillable =[
        'name', 'description',
        'from', 'to', 'restaurant_id'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function getImagePathAttribute(): string
    {
        return $this->getFirstMediaUrl('offers');
    }


}
