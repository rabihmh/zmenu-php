<?php

namespace App\Listeners;

use App\Events\RestaurantCreatedEvent;
use DirectoryIterator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RestaurantCreatedListener
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
        $db_name = 'tenancy_restaurant'."_{$restaurant->name}";
        DB::statement("CREATE DATABASE IF NOT EXISTS  `{$db_name}`");
        $restaurant->database_options = [
            'db_username' => 'root',
            'db_password' => '',
            'db_port' => '3306',
            'db_name' => $db_name,
        ];
        $restaurant->save();
        DB::purge('mysql');
        Config::set('database.connections.tenant.database', $db_name);
        Config::set('database.connections.tenant.username', 'root');
        Config::set('database.connections.tenant.password', '');
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
        $dir = new DirectoryIterator(database_path('migrations/tenants'));
        foreach ($dir as $file) {
            if ($file->isFile()) {
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/tenants/' . $file->getFilename(),
                    '--force' => true
                ]);
            }
        }
        DB::disconnect('tenant');
        DB::connection('mysql')->reconnect();
        DB::setDefaultConnection('mysql');
    }
}
