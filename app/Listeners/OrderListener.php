<?php

namespace App\Listeners;

use App\Events\OrderEvent;
use App\Models\Restaurant;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderEvent $event): void
    {
        if ($event->model instanceof Restaurant)
        {
            $event->order->restaurant->notify(new OrderNotification($event->order,$event->action,$event->model));
        }
        else
        {
            $event->order->client->notify(new OrderNotification($event->order,$event->action,$event->model));

        }
    }
}
