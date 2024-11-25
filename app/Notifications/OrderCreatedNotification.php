<?php

namespace App\Notifications;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order,public Client $client)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'=> __('notifications.order_created_title'),
            'message'=> __('notifications.order_created_message',[
                'number'=> $this->order->number,
                'client_name'=> $this->client->name,
            ]),
            'order_id' => $this->order->id,
            'client_id' => $this->client->id,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
