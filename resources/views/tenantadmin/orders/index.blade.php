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
                                    @if ($order->status === 'pending')
                                        <td><span class="badge badge-primary">{{ucfirst($order->status)}}</span></td>

                                    @elseif ($order->status === 'completed')
                                        <td><span class="badge badge-success">{{ucfirst($order->status)}}</span></td>
                                    @elseif ($order->status === 'canceled')
                                        <td><span class="badge badge-danger">{{ucfirst($order->status)}}</span></td>

                                    @elseif ($order->status === 'prepared')
                                        <td><span class="badge badge-warning">{{ucfirst($order->status)}}</span></td>
                                    @endif
                                    <td>${{$order->total}}</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td class="d-flex ">
                                        <button type="button" class="btn btn-light mr-2" data-mdb-toggle="modal"
                                                data-mdb-target="#Order_{{$order->id}}">
                                            <i class="fas fa-info me-2"></i> Get info
                                        </button>
                                        <form id="{{$order->id}}" method="POST"
                                              action="{{route('tenant.admin.orders.destroy',$order->id)}}">
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
        </div>
    </div>
    <div id="modal-container">
        @foreach($orders as $order)
            <!-- Modal -->
            <div class="modal fade" id="Order_{{$order->id}}" tabindex="-1" aria-labelledby="order_{{$order->id}}_Label"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-start text-black p-4">
                            <h5 class="modal-title text-uppercase mb-5" id="Order_{{$order->id}}_Label">Table
                                #{{$order->table->table_number}}</h5>
                            <p class="mb-0" style="color: #35558a;">Products summary</p>
                            <hr class="mt-2 mb-4"
                                style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                            @foreach($order->products as $product)
                                <div class="d-flex justify-content-between">
                                    <p class="fw-bold mb-0">{{$product->name}} (Qty:{{$product->order_item->quantity}}
                                        )</p>
                                    <p class="text-muted mb-0">
                                        ${{$product->price * $product->order_item->quantity }}</p>
                                </div>
                            @endforeach
                            <hr class="mt-4 mb-4"
                                style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                            <div class="d-flex justify-content-between">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold" style="color: #35558a;">${{$order->total}}</p>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                            <a href="{{route('tenant.admin.orders.show',$order->id)}}"
                               class="btn btn-primary btn-lg mb-1"
                               style="background-color: #35558a;">
                                Show order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{$orders->withQueryString()->links()}}
    </div>
    @push('js')
        <script>
            $(document).on('click', 'button[data-mdb-toggle="modal"]', function () {
                let targetModal = $(this).data('mdb-target');
                $(targetModal).modal('show');
            });
        </script>
    @endpush
</x-tenant-admin-layout>
