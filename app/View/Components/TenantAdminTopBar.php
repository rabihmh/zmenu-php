<?php

namespace App\View\Components;

use App\Managers\DatabaseManager;
use App\Managers\TenantDataManger;
use Closure;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class TenantAdminTopBar extends Component
{
    protected ?Collection $notifications;
    protected $unreadCount;

    /**
     * Create a new component instance.
     * @throws BindingResolutionException
     */

    public function __construct()
    {
        try {
            DatabaseManager::switchConnection(TenantDataManger::getTenantRestaurant()->database_options['db_name']);
            $this->notifications = DB::connection('tenant')
                ->table('notifications')
                ->whereNull('read_at')
                ->select('id', 'data', 'created_at')
                ->latest('created_at')
                ->limit(5)
                ->get();

            $this->unreadCount = DB::connection('tenant')
                ->table('notifications')
                ->whereNull('read_at')
                ->count();

            DatabaseManager::switchBackToMainConnection();


        } catch (\Exception $exception) {
            $this->notifications = collect();
            $this->unreadCount = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant-admin-top-bar', [
            'notifications' => $this->notifications,
            'unread_notifications_count' => $this->unreadCount
        ]);
    }
}
