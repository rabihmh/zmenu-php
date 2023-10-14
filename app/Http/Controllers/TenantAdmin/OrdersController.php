<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()
            ->with(['table', 'products'],)
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

    public function markAsComplete(string $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();
        return response()->json(['message' => 'Order marked as complete']);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
