<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartModelRepository implements CartRepository
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('product_id', $product->id)->first();
        if (!$item) {
            $cart = Cart::query()->create([
                'cookie_id' => Cart::getCookieID(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($cart);
            return $cart;
        }
        return $item->increment('quantity', $quantity);
    }

    public function update($id, $quantity)
    {
        Cart::query()->where('id', '=', $id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($id)
    {
        Cart::query()
            ->where('id', '=', $id)
            ->delete();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total(): float
    {
//        return (float)Cart::query()
//            ->join('products', 'products.id', '=', 'carts.product_id')
//            ->selectRaw('SUM(products.price * carts.quantity) as total')
//            ->value('total');
        return (float)$this->get()->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

}
