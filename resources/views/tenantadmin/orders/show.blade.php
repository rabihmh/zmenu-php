<x-tenant-admin-layout title="Orders">

    <div class="text-center">
        <h3>Table #{{$order->table->table_number}}</h3>
        <h4>Total : ${{$order->total}}</h4>
        <p>Status : {{$order->status}}</p>
        Items:

        <ul>
            @foreach($order->products as $product)
                <li>
                    <span>{{$product->name}}</span>
                    <img height="50" src="{{asset('storage/'.$product->photo)}}">
                    <br>
                    <span>Price : ${{$product->price}}</span>
                    <span>Quantity : {{$product->order_item->quantity}}</span>
                    <hr>
                </li>
            @endforeach
        </ul>
        <button class="mark-complete-btn btn btn-primary" data-order-id="{{ $order->id }}">Mark as Complete</button>

    </div>
    @push('js')
        <script>

            $(document).ready(function () {
                $('.mark-complete-btn').click(function () {
                    const orderId = $(this).data('order-id');

                    $.ajax({
                        url: '{{route('tenant.admin.orders.mark.as.complete',['order'=>':orderId'])}}'.replace(':orderId', orderId),
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            console.log('Order marked as complete');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error marking order as complete:', error);
                        },
                    });
                });
            });

        </script>
    @endpush
</x-tenant-admin-layout>
