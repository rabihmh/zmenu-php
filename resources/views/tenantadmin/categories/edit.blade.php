<x-tenant-admin-layout title="Edit Category">
    <h2 class="text-center">Edit Category</h2>
    <form id="restaurant-form" action="{{ route('tenant.admin.categories.update',$category->id) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}"
                   placeholder="Enter your Category Name">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Category photo</label>
            <input type="file" class="form-control-file" name="photo">
            <img width="100" src="{{asset('storage/uploads/'.$category->photo)}}">
        </div>
        @error('profile_photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
    </form>
</x-tenant-admin-layout>
