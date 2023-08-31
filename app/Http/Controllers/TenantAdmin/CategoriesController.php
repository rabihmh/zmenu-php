<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\DeleteImageTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CategoriesController extends Controller
{
    use UploadImageTrait, DeleteImageTrait;

    public function index()
    {
        $categories = Category::all();
        return view('tenantadmin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('tenantadmin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'photo' => 'required|image|mimes:jpeg,png,jpg',
            ]);

            $imagePath = $this->uploadImage($request->file('photo'));

            $category = new Category([
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['name']),
                'photo' => $imagePath,
            ]);

            $category->save();

            return redirect()->back()->with('success', 'Category added successfully');
        }
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        return view('tenantadmin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg'
        ]);
        $category->name = $request->post('name');
        $category->slug = Str::slug($request->post('name'));
        if ($request->hasFile('photo')) {
            $this->deleteImage($request->file('photo'));
            $photo_path = $this->uploadImage($request->file('photo'));
            $category->photo = $photo_path;
        }
        $category->save();
        return redirect()->route('tenant.admin.categories.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category->photo) {
            $this->deleteImage($category->photo);
        }
        $category->delete();
        return redirect()->route('tenant.admin.categories.index')->with('info', 'Category deleted successfully');

    }
}
