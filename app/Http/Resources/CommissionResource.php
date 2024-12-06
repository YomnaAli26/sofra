<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'restaurant_sales' => $this['restaurant_sales'],
            'app_commission' => $this['app_commission'],
            'paid' => $this['restaurant_paid'],
            'rest' => $this['app_commission'] - $this['restaurant_paid'],
        ];
    }
}
