<x-tenant-admin-layout title="Orders">
    @push('css')
        <style>
            @import url('https://fonts.googleapis.com/css?family=Assistant');

            body {
                background: #eee;
                font-family: Assistant, sans-serif;
            }

            .cell-1 {
                border-collapse: separate;
                border-spacing: 0 4em;
                background: #fff;
                border-bottom: 5px solid transparent;
                background-clip: padding-box;
            }

            thead {
                background: #dddcdc;
            }

            .toggle-btn {
                width: 40px;
                height: 21px;
                background: grey;
                border-radius: 50px;
                padding: 3px;
                cursor: pointer;
                -webkit-transition: all 0.3s 0.1s ease-in-out;
                -moz-transition: all 0.3s 0.1s ease-in-out;
                -o-transition: all 0.3s 0.1s ease-in-out;
                transition: all 0.3s 0.1s ease-in-out;
            }

            .toggle-btn > .inner-circle {
                width: 15px;
                height: 15px;
                background: #fff;
                border-radius: 50%;
                -webkit-transition: all 0.3s 0.1s ease-in-out;
                -moz-transition: all 0.3s 0.1s ease-in-out;
                -o-transition: all 0.3s 0.1s ease-in-out;
                transition: all 0.3s 0.1s ease-in-out;
            }

            .toggle-btn.active {
                background: blue !important;
            }

            .toggle-btn.active > .inner-circle {
                margin-left: 19px;
            }
        </style>
    @endpush
    <h2 class="text-center">Queue Orders</h2>
    <div class="mt-5">
        <div class="d-flex row">
            <div class="col-md-10">
                <div class="rounded">
                    <div class="table-responsive table-borderless">
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Order #</th>
                                <th>Table #</th>
                                <th>status</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            @foreach($orders as $order)
                                <tr class="cell-1">
                                    <td>#{{$order->number}}</td>
                                    <td>Table #{{$order->table->table_number}}</td>
                                    <td><span class="badge badge-success">{{$order->status}}</span></td>
                                    <td>${{$order->total}}</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td><a href="{{route('tenant.admin.orders.show',$order->id)}}"
                                           class="btn btn-primary">Show</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            const routeShow = "{{ route('tenant.admin.orders.show', ':order_id') }}";
        </script>
        @vite(['resources/js/app.js','resources/js/OrderQueue.js'])
    @endpush
</x-tenant-admin-layout>
