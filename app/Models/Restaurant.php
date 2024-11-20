<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'name', 'email', 'phone', 'logo',
        'area_id', 'min_order', 'delivery_fee',
        'status', 'avg_rate', 'contact_phone',
        'whatsapp_number'
    ];

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

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
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

}
