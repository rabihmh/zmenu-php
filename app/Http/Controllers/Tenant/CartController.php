<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public CartRepository $cart;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cart = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $items = $this->cart->get();
        return view('tenant.cart.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => 'nullable|int|min:1'
        ]);
        $product = Product::findOrFail($request->post('product_id'));
        $this->cart->add($product, $request->post('quantity'));
        return response()->json([
            'success' => 'Items add successfully'
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'quantity' => 'nullable|int|min:1'
        ]);
        $this->cart->update($request->route('cart'), $request->post('quantity'));
        return response()->json([
            'message' => 'Cart item updated',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->cart->delete($request->route('cart'));
        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
