<?php

namespace App\Managers;

use DirectoryIterator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    public static function switchConnection($db_name): void
    {
        DB::purge('mysql');
        Config::set('database.connections.tenant.database', $db_name);
        Config::set('database.connections.tenant.username', 'root');
        Config::set('database.connections.tenant.password', '');
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
    }

    public static function migrateTenantMigrations(): void
    {
        $dir = new DirectoryIterator(database_path('migrations/tenants'));
        foreach ($dir as $file) {
            if ($file->isFile()) {
                Artisan::call('migrate', [
                    '--path' => 'database/migrations/tenants/' . $file->getFilename(),
                    '--force' => true
                ]);
            }
        }
    }

    public static function switchBackToMainConnection(): void
    {
        DB::disconnect('tenant');
        DB::connection('mysql')->reconnect();
        DB::setDefaultConnection('mysql');
    }

}
