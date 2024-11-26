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
            'id' => $this->id,
            'restaurant_sales' => $this->restaurantSales,
            'net' => $this->net,
            'paid' => $this->paid,
            'app_commission' => $this->appCommission,
            'rest' => $this->rest,

        ];
    }
}
