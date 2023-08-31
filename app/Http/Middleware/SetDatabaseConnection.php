<?php

namespace App\Http\Middleware;

use App\Managers\DatabaseManager;
use App\Models\Restaurant;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $host = $request->getHost();

            $restaurant = Restaurant::where('domain', $host)->firstOrFail();

            app()->instance('restaurant.active', $restaurant);
            DatabaseManager::switchConnection($restaurant->database_options['db_name']);

        } catch (ModelNotFoundException $exception) {
            abort(404, 'No Restaurant Found');
        }
        return $next($request);
    }
}
