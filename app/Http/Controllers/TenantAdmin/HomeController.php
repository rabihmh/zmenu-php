<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Managers\DatabaseManager;
use App\Managers\TenantDataManger;
use App\Models\Order;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @throws BindingResolutionException
     */

    public function index(): View
    {
        $tenantDatabaseName = TenantDataManger::getTenantRestaurant()->database_options['db_name'];
        $now = now();

        DatabaseManager::switchConnection($tenantDatabaseName);

        $ordersCountByStatus = Order::query()
            ->select('status', DB::raw('COUNT(*) as count'))
            ->whereMonth('created_at', $now->month)
            ->groupBy('status')
            ->get();
        $orders_count = $ordersCountByStatus->sum('count');

        $earnings = Order::query()
            ->where('status', 'completed')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('total');

        $earningsByMonth = Order::query()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as earnings')
            ->where('status', 'completed')
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->pluck('earnings')
            ->toArray();

        DatabaseManager::switchBackToMainConnection();

        return view('tenantadmin.home', compact('ordersCountByStatus', 'orders_count', 'earnings', 'earningsByMonth'));
    }
}
