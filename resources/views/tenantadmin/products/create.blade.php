<x-tenant-admin-layout title="Add Product">
    <h2 class="text-center">Add Product</h2>
    <form action="{{ route('tenant.admin.products.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Category</label>
            <select class="form-control form-select" name="category_id">
                <option disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->slug}}</option>
                @endforeach
            </select>
        </div>
        @error('category_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your Product Name">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Product Description</label>
            <textarea type="text" class="form-control" name="description"
                      placeholder="Enter your Product Description"></textarea>
        </div>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Product Price</label>
            <input type="number" class="form-control" name="price" step="0.1" placeholder="Enter your Product Price">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Category photo</label>
            <input type="file" class="form-control-file" name="photo">
        </div>
        @error('photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
    </form>
</x-tenant-admin-layout>
