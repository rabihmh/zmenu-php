<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRestaurantExists
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('web');
        if (!$user->restaurant && $request->route()->getName() !== "tenant.admin.restaurant.create" && $request->route()->getName() !== "tenant.admin.restaurant.store") {
            return redirect()->route('tenant.admin.restaurant.create');
        }
        return $next($request);
    }
}
