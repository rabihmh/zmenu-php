<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public Restaurant $restaurant;
    public Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order, $restaurant)
    {
        $this->order = $order;
        $this->restaurant = $restaurant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('order.created.restaurant.' . $this->restaurant->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'order-create';
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {

        $table = Table::findOrfail($this->order->table_id);
        $message = "New Order Created on the table #{$table->table_number}";
        $id = Str::uuid();
        $url = route('tenant.admin.orders.show', $this->order->id);
        $notification = DB::table('notifications')->insertGetId([
            'id' => $id,
            'type' => static::class,
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->id,
            'data' => json_encode(['message' => $message, 'url' => $url]),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return new BroadcastMessage([
            'order' => $this->order,
            'message' => $message,
            'notification_id' => $id,
            'created_at' => now(),
            'url' => $url
        ]);
    }


}
