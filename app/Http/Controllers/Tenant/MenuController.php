<?php

namespace App\Http\Controllers\Tenant;

use App\Events\CustomerSeated;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $tableNumber = $request->route('table_number');

        // Check if the customer is already seated (using a session variable)
        //if (!$request->session()->has('customer_seated_' . $tableNumber)) {
            $table = Table::where('table_number', $tableNumber)->first();
            event(new CustomerSeated($table));

            // Mark the customer as seated in the session
            $request->session()->put('customer_seated_' . $tableNumber, true);
        //}

        return view('tenant.menu.index');
    }

    public function list(): JsonResponse
    {
        $products = Category::query()->select(['id', 'name', 'slug'])->with('products')->get();
        return response()->json([
            'products' => $products
        ], 200);
    }

    public function show(Request $request): JsonResponse
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
