<x-tenant-admin-layout title="Table - {{$table->table_number}}">
    <h1 class="text-center">Edit Table - {{$table->table_number}}</h1>
    <form action="{{route('tenant.admin.tables.update',$table->id)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Table Number</label>
            <input type="number" class="form-control" name="table_number" value="{{$table->table_number}}">
        </div>
        @error('table_number')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Table Description</label>
            <textarea type="text" class="form-control"
                      name="description">{{$table->description}}</textarea>
        </div>
        @error('description')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Table Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{$table->capacity}}">
        </div>
        @error('capacity')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <div class="mb-3">
            <label for="name" class="form-label">Table QR Code</label>
            <img src="{{asset('storage/'.$table->qr_code_path)}}" alt="{{$table->table_number}}">
        </div>

        <button type="submit" class="btn btn-primary">update</button>
    </form>
</x-tenant-admin-layout>
