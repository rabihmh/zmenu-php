<?php

namespace App\Notifications;

use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerSeatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Table $table;
    public Restaurant $restaurant;

    public function __construct(Table $table, Restaurant $restaurant)
    {
        $this->table = $table;
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

    /**
     * @throws BindingResolutionException
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('customer.seated.restaurant.' . $this->restaurant->id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'customer-seat';
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $message = "New Customer Seated on the table #{$this->table->table_number}";
        $uuid = Str::uuid();

        $notification = DB::table('notifications')->insertGetId([
            'id' => $uuid,
            'type' => static::class,
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->id,
            'data' => json_encode(['message' => $message, 'url' => null]),
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return new BroadcastMessage([
            'message' => $message,
            'url' => null,
            'notification_id' => $uuid,
            'created_at' => now()
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
