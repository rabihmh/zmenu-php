<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Managers\TenantDataManger;
use App\Models\Category;
use App\Models\Product;
use App\Traits\DeleteImageTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use UploadImageTrait, DeleteImageTrait;

    /**
     * Display a listing of the resource.
     * @throws BindingResolutionException
     */
    public function index()
    {
        $restaurant_id = TenantDataManger::getTenantRestaurant()->id;
        $products = Cache::rememberForever('products_with_category_' . $restaurant_id, function () {
            return Product::with('category:id,name')->get();
        });
        return view('tenantadmin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @throws BindingResolutionException
     */
    public function create()
    {
        $restaurant_id = TenantDataManger::getTenantRestaurant()->id;

        $categories = Cache::get('categories_' . $restaurant_id);
        //$categories = Category::query()->select('id', 'slug')->orderBy('id','ASC')->get();
        return view('tenantadmin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws BindingResolutionException
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => 'required|string',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/', // Example: 10.99
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ];

        $customMessages = [
            'category_id.exists' => 'The selected category does not exist.',
            'price.regex' => 'The price must be a valid number with up to two decimal places.'
        ];

        $request->validate($rules, $customMessages);

        $productsData = $request->except('photo');

        if ($request->hasFile('photo')) {
            $image_path = $this->uploadImage($request->file('photo'), Str::slug(TenantDataManger::getTenantRestaurant()->name),'products');
            $productsData['photo'] = $image_path;
        }

        Product::create($productsData);

        return redirect()->back()->with('success', 'Product Created Successfully');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('category:id,name')->findOrFail($id);
        $categories = Category::all();
        return view('tenantadmin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @throws BindingResolutionException
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $product = Product::findOrFail($id);
        $product_data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $this->deleteImage($product->photo);
            $newImagePath = $this->uploadImage($request->file('photo'), Str::slug(TenantDataManger::getTenantRestaurant()->name),'products');
            $product_data['photo'] = $newImagePath;
        }
        $product->update($product_data);
        return redirect()->route('tenant.admin.categories.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->photo) {
            $this->deleteImage($product->photo);
        }
        $product->delete();
        return redirect()->route('tenant.admin.products.index')->with('info', 'Product deleted successfully');

    }
}
