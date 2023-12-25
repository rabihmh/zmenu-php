<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = Order::query()
            ->with(['table', 'products'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('tenantadmin.orders.index', compact('orders'));
    }

    public function queue(): View
    {
        $orders = Order::query()
            ->with(['table', 'products'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('tenantadmin.orders.queue', compact('orders'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['table', 'products'])->findOrFail($id);
        return view('tenantadmin.orders.show', compact('order'));
    }

    public function markOrderAs(Request $request, string $id): JsonResponse
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'status' => [
                'required',
                Rule::in(['completed', 'canceled', 'prepared']),
            ],
        ]);

        $order->status = $validatedData['status'];
        $order->save();

        return response()->json(['message' => "Order marked as {$validatedData['status']}"], 200);
    }

    public function destroy(string $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $id)->get();

        if (!$orderItems->isEmpty()) {
            foreach ($orderItems as $item) {
                $item->delete();
            }
        }

        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully');
    }
}
