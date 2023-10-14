<?php

namespace App\Http\Controllers\Tenant;

use App\Events\OrderCreate;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request): RedirectResponse
    {
        $items = Cart::get();
        if ($items->isEmpty()) {
            return redirect()->route('tenant.home', ['tenant' => getSubdomain(), 'table_number' => $request->route('table_number')])->with('error', 'Cart Is Empty');
        }
        $table = Table::where('table_number', $request->route('table_number'))->firstOrFail();
        DB::beginTransaction();
        try {
            $order = Order::create([
                'table_id' => $table->id,
                'total' => Cart::total(),
                'status' => 'pending'
            ]);
            $order->load('table');

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }
            DB::commit();
            event(new OrderCreate($order));
        } catch (\Throwable $exception) {
            DB::rollBack();
            return redirect()->route('tenant.home', ['tenant' => getSubdomain(), 'table_number' => $request->route('table_number')])->with('error', 'An Error occurred during the checkout ');
        }
        return redirect()->route('tenant.home', ['tenant' => getSubdomain(), 'table_number' => $request->route('table_number')])->with('success', 'Order is being processed');
    }

}
