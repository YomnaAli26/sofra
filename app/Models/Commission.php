<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    use Filterable;

    protected $fillable = [
        'paid', 'date', 'notes',
        'restaurant_id'
    ];
    public array $filterRelations =
        [
           'restaurant'
        ];
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }



}
