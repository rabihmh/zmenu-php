<?php

namespace App\Http\Controllers\Tenant;

use App\Events\CustomerSeated;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    private function getActiveRestaurant()
    {
        return app()->make('restaurant.active');
    }

    public function index(Request $request): View
    {
        $tableNumber = $request->route('table_number');

        // Check if the customer is already seated (using a session variable)
        if (!$request->session()->has('customer_seated_' . $tableNumber)) {
            $table = Table::where('table_number', $tableNumber)->first();
            event(new CustomerSeated($table));

            // Mark the customer as seated in the session
            $request->session()->put('customer_seated_' . $tableNumber, true);
        }

        return view('tenant.menu.index');
    }

    /**
     * @throws BindingResolutionException
     */
    public function list(Request $request): JsonResponse
    {
        $category_id = $request->get('categoryId');
        $cacheKey = "products_of_category_${category_id}_restaurant_{$this->getActiveRestaurant()->id}";
        Category::query()->findOr($category_id, function () {
            return response()->json([
                'message' => 'Category Not Fount'
            ], 404);
        });

        $products = Cache::rememberForever($cacheKey, function () use ($category_id) {
            return Product::query()->where('category_id', $category_id)->get();
        });
        return response()->json([
            'products' => $products
        ], 200);
    }

    /**
     * @throws BindingResolutionException
     */
    public function show(Request $request): JsonResponse
    {
        $product_id = $request->get('itemId');
        $cacheKey = "product_{$product_id}_restaurant_{$this->getActiveRestaurant()->id}";

        $product = Cache::rememberForever($cacheKey, function () use ($product_id) {
            try {
                return Product::findOrFail($product_id);
            } catch (ModelNotFoundException) {
                return null;
            }
        });

        if ($product) {
            return response()->json(['product' => $product], 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

}
