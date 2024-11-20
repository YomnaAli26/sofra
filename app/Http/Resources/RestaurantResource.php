<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'area' => AreaResource::make($this->area),
            'category' => CategoryResource::make($this->category),
            'min_order' => $this->min_order,
            'delivery_fee' => $this->delivery_fee,
            'contact_phone' => $this->contact_phone,
            'whatsapp_number' => $this->whatsapp_number,
            'image'=> $this->getFirstMediaUrl('restaurant'),
            'token'=>$this->when(isset($this->token),$this->token),
        ];
    }
}
