<?php

namespace App\Models;

use App\Enums\RestaurantStatusEnum;
use App\Traits\Filterable;
use App\Traits\HasFcmTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Restaurant extends Model implements HasMedia
{
    use HasFactory, HasApiTokens, InteractsWithMedia, Filterable, Notifiable, HasFcmTokens;

    protected $casts = [
        'password' => 'hashed',
        'status' => RestaurantStatusEnum::class,
    ];
    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'name', 'email', 'phone', 'password',
        'area_id', 'category_id', 'min_order',
        'delivery_fee', 'status', 'avg_rate',
        'contact_phone', 'whatsapp_number'
    ];
    public array $filterRelations =
        [
            'area',
            'meals',
            'offers',
            'reviews',
        ];
    protected $attributes = [
        'status' => 0,
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

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
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

    public function getImagePathAttribute(): string
    {
        return $this->getFirstMediaUrl('restaurants') ?: asset('images/default.png');
    }


}
