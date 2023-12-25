<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = DB::table('notifications')->get();

        $notifications->each(function ($notification) {
            $notification->data = json_decode($notification->data, true);

            switch ($notification->type) {
                case 'App\Notifications\CustomerSeatedNotification':
                    $notification->type = 'Customer Seat';
                    break;
                case 'App\Notifications\OrderCreatedNotification':
                    $notification->type = 'Order Create';
                    break;
            }
        });
        return view('tenantadmin.notifications.index', compact('notifications'));
    }

//    public function show(string $id): View
//    {
//        $notification = DB::table('notifications')->where('id', $id)->first();
//        return view('tenantadmin.notifications.show', compact('notification'));
//    }

    public function destroy(string $id): RedirectResponse
    {
        DB::table('notifications')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Notification deleted successfully');
    }

    public function markAllAsRead(): RedirectResponse
    {
        DB::table('notifications')->whereNull('read_at')->update([
            'read_at' => now()
        ]);
        return redirect()->back()->with('success', 'All notifications are read');
    }

    public function deleteAll(): RedirectResponse
    {
        DB::table('notifications')->delete();
        return redirect()->route('tenant.admin.home')->with('success', 'All notifications are deleted');


    }
}
