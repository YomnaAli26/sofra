<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'number' => $this->number,
            'address' => $this->address,
            'notes' => $this->notes,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'price' => $this->price,
            'delivery_fee' => $this->delivery_fee,
            'total_amount' => $this->total_amount,
            'commission' => $this->commission,
            'net' => $this->net,
            'meals' => MealResource::collection($this->meals),
            'client' => ClientResource::make($this->client),

        ];
    }
}
