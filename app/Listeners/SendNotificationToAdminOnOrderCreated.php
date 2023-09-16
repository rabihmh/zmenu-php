<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Support\Facades\Notification;

class SendNotificationToAdminOnOrderCreated
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
    public function handle(OrderCreate $event): void
    {
        $order = $event->order;
        $admin = app()->make('restaurant.user.active');
        $restaurant = app()->make('restaurant.active');
        Notification::send($admin, new OrderCreatedNotification($order, $restaurant));
    }
}
