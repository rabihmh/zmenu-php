<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\DeleteImageTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use UploadImageTrait, DeleteImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category:id,name')->get();
        return view('tenantadmin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->select('id', 'slug')->get();
        return view('tenantadmin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string|max:255',
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
            $image_path = $this->uploadImage($request->file('photo'));
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
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'photo' => 'required|image|mimes:jpeg,png,jpg'
        ]);
        $product = Product::findOrFail($id);
        $product_data = $request->except('photo');
        if ($request->hasFile('photo')) {
            $this->deleteImage($product->photo);
            $newImagePath = $this->uploadImage($request->file('photo'));
            $product_data['photo'] = $newImagePath;
        }
        $product->update($product_data);
        return redirect()->route('tenant.admin.categories.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($product->photo) {
            $this->deleteImage($product->photo);
        }
        $product->delete();
        return redirect()->route('tenant.admin.categories.index')->with('info', 'Product deleted successfully');

    }
}
