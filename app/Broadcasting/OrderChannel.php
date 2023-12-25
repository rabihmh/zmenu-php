<?php

namespace App\Broadcasting;

use App\Models\User;

class OrderChannel
{
    /**
     * Create a new channel instance.
     */
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user): array|bool
    {
        return $user->id === $this->order->id;
    }
}
