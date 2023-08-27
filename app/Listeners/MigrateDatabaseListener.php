<?php

namespace App\Listeners;

use App\Events\RestaurantCreatedEvent;
use App\Managers\DatabaseManager;
use Illuminate\Support\Facades\DB;

class MigrateDatabaseListener
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
    public function handle(RestaurantCreatedEvent $event): void
    {
        $restaurant = $event->restaurant;
        $db_name = 'tenancy_restaurant' . "_{$restaurant->name}";

        DB::statement("CREATE DATABASE IF NOT EXISTS `{$db_name}`");

        $restaurant->database_options = [
            'db_username' => 'root',
            'db_password' => '',
            'db_port' => '3306',
            'db_name' => $db_name,
        ];

        $restaurant->save();
        DatabaseManager::switchConnection($db_name);
        DatabaseManager::migrateTenantMigrations();
        DatabaseManager::switchBackToMainConnection();

    }
}
