<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
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
    public function handle(OrderCreatedEvent $event): void
    {
        $event->order->restaurant->notify(new OrderCreatedNotification($event->order,request()->user('client')));
    }
}
