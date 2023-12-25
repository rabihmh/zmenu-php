<x-tenant-admin-layout title="Order #{{$order->number}}">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10 col-xl-8">
            <div class="card" style="border-radius: 10px;">
                <div class="card-header px-4 py-5 d-flex justify-content-between align-items-center">
                    <h5 class="text-muted mb-0">Table #<span
                            style="color: #a8729a;">{{$order->table->table_number}}</span>!</h5>
                    @if ($order->status === 'pending')
                        <div>Status: <span class="badge badge-primary"
                                           id="order-status">{{ ucfirst($order->status) }}</span></div>
                    @elseif ($order->status === 'completed')
                        <div>Status: <span class="badge badge-success"
                                           id="order-status">{{ ucfirst($order->status) }}</span></div>
                    @elseif ($order->status === 'canceled')
                        <div>Status: <span class="badge badge-danger"
                                           id="order-status">{{ ucfirst($order->status) }}</span></div>
                    @elseif ($order->status === 'prepared')
                        <div>Status: <span class="badge badge-warning"
                                           id="order-status">{{ ucfirst($order->status) }}</span></div>

                    @else
                        <div>Status: {{ ucfirst($order->status) }}</div>
                    @endif
                </div>
                <div class="card-body p-4">
                    @foreach($order->products as $product)
                        <div class="card shadow-0 border mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img style="height: 100px;width: 100px"
                                             src="{{asset('storage/'.$product->photo)}}"
                                             class="img-fluid" alt="{{$product->name}}">
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0">{{$product->name}}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">${{$product->price}}</p>
                                    </div>

                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">Qty: {{$product->order_item->quantity}}</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                        <p class="text-muted mb-0 small">
                                            ${{$product->price * $product->order_item->quantity}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between pt-2">
                        <p class="fw-bold mb-0">Order Details</p>
                        <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> ${{$order->total}}</p>
                    </div>

                    <div class="d-flex justify-content-between pt-2">
                        <p class="text-muted mb-0">Order Number : {{$order->number}}</p>
                        <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $0</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="text-muted mb-0">Invoice Date : {{$order->created_at->diffForHumans()}}</p>
                    </div>

                </div>
                <div class="card-footer border-0 px-4 py-5"
                     style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                        paid: <span class="h2 mb-0 ms-2">${{$order->total}}</span></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4 mb-4 button-wrapper">

        @if ($order->status === 'pending')
            <button class="mark-prepared-btn btn btn-primary text-center">Mark as
                Prepared
            </button>
        @elseif ($order->status === 'prepared')
            <button class="mark-complete-btn btn btn-primary text-center">Mark as
                Complete
            </button>
        @endif
        @if($order->status!=='canceled')
            <button class="mark-canceled-btn btn btn-danger text-center">Mark as
                Canceled
            </button>
        @endif
    </div>
    @push('js')
        <script>
            $(document).ready(function () {
                // Initialize the order status
                let orderStatus = '{{ $order->status }}';

                // Function to update the UI based on the new status
                function updateUI(newStatus) {
                    // Update the order status at the top of the page
                    $('#order-status').text(newStatus);

                    // Check and update buttons and their visibility
                    updateButtonVisibility(newStatus);
                }

                // Function to update button visibility
                function updateButtonVisibility(newStatus) {
                    switch (newStatus) {
                        case 'prepared':
                            $('.mark-prepared-btn').hide();
                            addCompleteButton();
                            break;
                        case 'canceled':
                            $('.mark-canceled-btn').hide();
                            break;
                        case 'completed':
                            $('.mark-complete-btn').hide();
                            break;
                        default:
                            break;
                    }
                }

                // Function to create and add the "Mark as Complete" button
                function addCompleteButton() {
                    const completeButton = $('<button>')
                        .addClass('mark-complete-btn btn btn-primary text-center')
                        .text('Mark as Complete')
                        .click(function () {
                            markOrderStatus('completed');
                        });
                    $('.button-wrapper').append(completeButton);
                }

                // Click event handler for "Mark as Prepared" and "Mark as Complete" buttons
                $('.mark-prepared-btn, .mark-complete-btn').click(function () {
                    const status = $(this).hasClass('mark-prepared-btn') ? 'prepared' : 'completed';
                    markOrderStatus(status);
                });

                // Click event handler for "Mark as Canceled" button
                $('.mark-canceled-btn').click(function () {
                    markOrderStatus('canceled');
                });

                // Function to send the AJAX request to update the order status
                function markOrderStatus(status) {
                    $.ajax({
                        url: `{{ route('tenant.admin.orders.mark.as', $order->id) }}`,
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: status
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: `Order marked as ${status}`,
                            });
                            updateUI(status);
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: `Error marking order as ${status}`,
                                text: error,
                            });
                        },
                    });
                }
            });
        </script>
    @endpush

</x-tenant-admin-layout>
