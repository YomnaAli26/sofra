<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{

    protected $fillable = ['comment', 'review', 'client_id', 'restaurant_id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
