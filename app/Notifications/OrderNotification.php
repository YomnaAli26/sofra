<?php

namespace App\Notifications;

use App\Models\Client;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class OrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order, public $action)
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
    /*    public function toFcm($notifiable): FcmMessage
        {
            return (new FcmMessage(notification: new FcmNotification(
                title: __('notifications.order_'.$this->action.'_title'),
                body: __('notifications.order_'.$this->action.'_message',[
                    'number'=> $this->order->number,
                    'client_name'=> $this->model->name,
                ]),
            )))
                ->data(['data1' => 'value', 'data2' => 'value2'])
                ->custom([
                    'android' => [
                        'notification' => [
                            'color' => '#0A0A0A',
                            'sound' => 'default',
                        ],
                        'fcm_options' => [
                            'analytics_label' => 'analytics',
                        ],
                    ],
                    'apns' => [
                        'payload' => [
                            'aps' => [
                                'sound' => 'default'
                            ],
                        ],
                        'fcm_options' => [
                            'analytics_label' => 'analytics',
                        ],
                    ],
                ]);
        }*/


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $notifiable instanceof Restaurant ? $senderName = 'client' : $senderName = 'restaurant';
        return [
            'title' => __('notifications.order_' . $this->action . '_title'),
            'message' => __('notifications.order_' . $this->action . '_message', [
                'number' => $this->order->number,
               'sender_name' => $this->order->{$senderName}->name,
            ]),
            'order_id' => $this->order->id,
            $senderName . '_id' => $this->order->{$senderName}->id,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
