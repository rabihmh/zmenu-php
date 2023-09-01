<x-tenant-admin-layout title="Categories">
    @push('css')
        <!-- Custom styles for this page -->
        <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
        <style>
            .image-container {
                max-height: 100px;
                overflow: hidden;
            }

            .category-image {
                max-height: 100px;
                width: auto;
            }

        </style>
    @endpush

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-center">Products</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('tenant.admin.products.create')}}" class="btn btn-primary">Add Products</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <div class="image-container">
                                    <img class="category-image" src="{{asset('storage/uploads/'.$product->photo)}}">
                                </div>
                            </td>
                            <td class="d-flex">
                                <a href="{{route('tenant.admin.products.edit',$product->id)}}"
                                   class=" mr-4 btn btn-success">Edit</a>
                                <form action="{{route('tenant.admin.products.destroy',$product->id)}}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('js')
        <!-- Page level plugins -->
        <script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('dashboard/js/demo/datatables-demo.js')}}"></script>
    @endpush

</x-tenant-admin-layout>
