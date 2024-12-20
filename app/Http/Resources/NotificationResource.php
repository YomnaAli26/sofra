<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'notification' => [
                'title' => $this->data["title_".app()->getLocale()],
                'message' => $this->data["message_".app()->getLocale()],
                'order_id' => $this->data['order_id'],
                'created_at' => $this->data['created_at'],
            ],
            'is_read' => $this->when($this->read_at, true, false),
        ];
    }
}
