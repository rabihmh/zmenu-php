<x-tenant-admin-layout title="Table - {{$table->table_number}}">
    <h1 class="text-center">Table #{{$table->table_number}}</h1>
    <div class="mb-3">
        <label for="name" class="form-label">Table Number</label>
        <input type="number" class="form-control" value="{{$table->table_number}}" disabled>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Table Description</label>
        <textarea type="text" class="form-control" disabled>{{$table->description??'-----------'}}</textarea>
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Table Capacity</label>
        <input type="number" class="form-control" disabled value="{{$table->capacity}}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Table QR Code</label>
        <img src="{{asset('storage/'.$table->qr_code_path)}}" alt="{{$table->table_number}}">
    </div>
</x-tenant-admin-layout>
