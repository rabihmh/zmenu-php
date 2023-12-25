<?php

namespace App\Http\Middleware;

use App\Managers\DatabaseManager;
use App\Managers\TenantDataManger;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $notification_id = $request->query('notification_id');
        if ($notification_id !== null) {
            $notification_id = trim($notification_id, "'");
            if ($notification_id) {
                DatabaseManager::switchConnection(TenantDataManger::getTenantRestaurant()->database_options['db_name']);
                $notification = DB::connection('tenant')
                    ->table('notifications')
                    ->where('id', $notification_id)
                    ->first();

                if ($notification) {
                    DB::connection('tenant')
                        ->table('notifications')
                        ->where('id', $notification_id)
                        ->update(['read_at' => now()]);
                }
                DatabaseManager::switchBackToMainConnection();
            }
        }
        return $next($request);
    }

}
