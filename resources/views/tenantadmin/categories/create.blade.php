<x-tenant-admin-layout title="Add Category">
    <h2 class="text-center">Add Category</h2>
    <form id="restaurant-form" action="{{ route('tenant.admin.categories.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Category Name">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Category photo</label>
            <input type="file" class="form-control-file" name="photo">
        </div>
        @error('profile_photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
    </form>

</x-tenant-admin-layout>
