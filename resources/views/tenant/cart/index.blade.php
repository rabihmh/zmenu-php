<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
<section class="h-100" style="background-color: #eee;">
    <div class="container h-100 py-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    <a class="btn btn-primary"
                       href="{{ route('tenant.home', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain(),]) }}">Go
                        Back</a>
                </div>
                @foreach($items as $item)
                    <div class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img
                                        src="{{asset('storage/'.$item->product->photo)}}"
                                        class="img-fluid rounded-3" alt="{{$item->product->photo}}">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <input class="item-quantity form-control form-control-sm"
                                           data-id="{{$item->id}}"
                                           min="0"
                                           name="quantity"
                                           value="{{$item->quantity}}"
                                           type="number"/>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">${{$item->product->price*$item->quantity}}</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end ">
                                    <a href="#" class="text-danger remove-item" data-item-id="{{$item->id}}"><i
                                            class="fas fa-trash fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <form
                            action="{{route('tenant.checkout',['tenant'=>getSubdomain(),'table_number' => request()->route('table_number')])}}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block btn-lg">Checkout</button>
                        </form>
                        <span class="alert alert-primary ">Total: <span>${{\App\Facades\Cart::total()}}</span></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script>

    (function ($) {
        $(document).ready(function () {
            $('.item-quantity').on('change', function (e) {
                let itemId = $(this).data('id');
                let quantity = $(this).val();

                $.ajax({
                    url: "{{ route('tenant.cart.update', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain(), 'cart' => ':itemId']) }}".replace(':itemId', itemId),
                    method: 'put',
                    data: {
                        quantity: quantity,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        alert('Cart item updated successfully.');
                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Error updating cart item.';
                        alert(errorMessage);
                    }
                });
            });

            $('.remove-item').on('click', function (e) {
                let itemId = $(this).data('item-id');
                let itemPrice = parseFloat($(`[data-id="${itemId}"]`).closest('.card').find('.col-md-3.col-lg-2.col-xl-2.offset-lg-1 h5').text().replace('$', ''));
                $.ajax({
                    url: "{{ route('tenant.cart.destroy', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain(), 'cart' => ':itemId']) }}".replace(':itemId', itemId),
                    method: 'delete',
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    success: response => {
                        $(`[data-id="${itemId}"]`).closest('.card').remove();
                        alert('Item Removed Successfully');
                        updateCartTotal(itemPrice);

                    },
                    error: function (xhr, status, error) {
                        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Error removing cart item.';
                        alert(errorMessage);
                    }
                });
            });
            function updateCartTotal(itemPrice) {
                let currentTotal = parseFloat($('#cart-total span').text().replace('$', ''));
                let newTotal = currentTotal - itemPrice;
                $('#cart-total span').text('$' + newTotal.toFixed(2));
            }
        });
    })(jQuery);
</script>
</body>
</html>
