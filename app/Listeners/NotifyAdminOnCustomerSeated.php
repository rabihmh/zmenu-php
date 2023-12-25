<?php

namespace App\Listeners;

use App\Events\CustomerSeated;
use App\Notifications\CustomerSeatedNotification;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Notification;

class NotifyAdminOnCustomerSeated
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
     * @throws BindingResolutionException
     */
    public function handle(CustomerSeated $event): void
    {
        $table = $event->table;
        $admin = app()->make('restaurant.user.active');
        $restaurant = app()->make('restaurant.active');
        Notification::send($admin, new CustomerSeatedNotification($table, $restaurant));
        //mark the table as occupied
        $table->update([
            'status' => 'occupied'
        ]);
        $table->save();
    }
}
