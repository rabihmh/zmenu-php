<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        return view('tenant.menu.index');
    }

    public function list()
    {
        $products = Category::query()->select(['id', 'name','slug'])->with('products')->get();
        return response()->json([
            'products' => $products
        ], 200);
    }
}
