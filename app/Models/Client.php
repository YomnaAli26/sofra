<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasFcmTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsTo};
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, HasApiTokens, Notifiable, HasFcmTokens, Filterable;

    protected $casts = [
        'password' => 'hashed'
    ];
    protected $hidden = [
        'password',
    ];
    protected $fillable = [
        'email', 'phone', 'password',
        'name', 'area_id','is_active','lang'
    ];

    private function getDeviceTokens()
    {
        return $this->tokens()->fcm_token;
    }

    public function routeNotificationForFcm(): array
    {
        return $this->getDeviceTokens();
    }

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

    public function generateCode(): void
    {
        $this->code = rand(0000, 9999);
        $this->save();
    }

    public function resetCode(): void
    {
        $this->code = null;
        $this->save();
    }


}
