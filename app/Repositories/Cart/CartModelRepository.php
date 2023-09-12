<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartModelRepository implements CartRepository
{

    public function get(): Collection
    {
        return Cart::query()->get();
    }

    public function add(Product $product, $quantity = 1)
    {
        Cart::query()->create([
            'cookie_id' => Cart::getCookieID(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    public function update(Product $product, $quantity)
    {
        Cart::query()->where('product_id', '=', $product->id)
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
        return (float)Cart::query()
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');
    }

}
