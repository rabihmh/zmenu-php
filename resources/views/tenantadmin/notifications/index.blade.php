<x-tenant-admin-layout title="Notifications">
    <h1 class="h3 mb-2 text-gray-800 text-center">Categories</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex" >
            <form class="mr-3" action="{{route('tenant.admin.notifications.markAllRead')}}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Mark All As Read</button>
            </form>
            <form action="{{route('tenant.admin.notifications.deleteAll')}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete All Notifications</button>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Read at</th>
                        <th>Created at</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th>Read at</th>
                        <th>Created at</th>
                        <th>Options</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{$notification->type}}</td>
                            <td>{{$notification->data['message']}}</td>
                            <td>{{$notification->read_at}}</td>
                            <td>{{$notification->created_at}}</td>

                            <td class="d-flex">
                                @if($notification->data['url'])
                                    <a href="{{$notification->data['url']}}"
                                       class=" mr-4 btn btn-primary">Action</a>
                                @endif
                                <form action="{{route('tenant.admin.notifications.destroy',$notification->id)}}"
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
