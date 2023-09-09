<x-tenant-admin-layout title="Add Table">
    <h2 class="text-center">Add Table</h2>
    <form action="{{ route('tenant.admin.tables.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Table Number</label>
            <input type="number" class="form-control" name="table_number" value="{{old('table_number')}}"
                   placeholder="Table - 1">
        </div>
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Table Description</label>
            <textarea type="text" class="form-control"  name="description"
                      placeholder="Enter your Table Description">{{old('description')}}</textarea>
        </div>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Table Capacity</label>
            <input type="number" class="form-control" name="capacity" value="{{old('capacity')}}" placeholder="Enter your Table Capacity">
        </div>
        @error('capacity')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <br>
        <button type="submit" id="submit-button" class=" mt-2 btn btn-primary">Submit</button>
    </form>
</x-tenant-admin-layout>
