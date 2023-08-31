<?php

namespace App\Http\Middleware;

use App\Managers\DatabaseManager;
use App\Managers\TenantDataManger;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SwitchDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $restaurant = TenantDataManger::getTenantRestaurant();
            DatabaseManager::switchConnection($restaurant->database_options['db_name']);
        }
        return $next($request);
    }
}
