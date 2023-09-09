<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('tenant.menu.index');
    }

    public function list()
    {
        $products = Category::query()->select(['id', 'name', 'slug'])->with('products')->get();
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function show(Request $request)
    {

        try {
            $product = Product::findOrFail($request->get('itemId'));
            return response()->json([
                'product' => $product
            ], 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
    }
}
