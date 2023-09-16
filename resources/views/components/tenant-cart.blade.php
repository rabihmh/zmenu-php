<!-- Cart modal -->
<div id="cartModal" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel"
     aria-hidden="true">
    <!-- dialog -->
    <div class="modal-dialog" style="background: #0e76e6">
        <div class="modal-header">
                    <span data-dismiss="modal" class="navigation">
                            <i class="glyphicon glyphicon-remove"></i> Close
                    </span>
        </div>
        <div class="modal-body">
            <!-- Shopping Cart -->
            <div class="shopping-cart section">
                <div class="container">
                    <div class="cart-list-head">
                        <!-- Cart List Title -->
                        <div class="cart-list-title">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-12">

                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <p>Product Name</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Quantity</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Price</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Subtotal</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <p>Remove</p>
                                </div>
                            </div>
                        </div>

                        @foreach($items as $item)
                            <div class="cart-single-list">
                                <div class="row align-items-center">
                                    <div class="col-lg-1 col-md-1 col-12">
                                        <a href="#"><img
                                                src="{{asset('storage/'.$item->products->photo)}}"
                                                alt="#"></a>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-12">
                                        <h5 class="product-name"><a href="#">{{$item->products->name}}</a></h5>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="count-input">
                                            <input type="number" value="{{$item->quantity}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <p>${{$item->products->price}}</p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <p>${{$item->products->price * $item->quantity}}</p>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-12">
                                        <form method="POST"
                                              action="{{route('tenant.cart.destroy',['tenant'=>getSubdomain(),'table_number' => request()->route('table_number'),'cart'=>$item->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button style="margin-left: 5px;margin-top: 0px" type="submit"
                                                    class="btn btn-danger">Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <span>Total: ${{$total}}</span>
                        <form
                            action="{{route('tenant.checkout',['tenant'=>getSubdomain(),'table_number' => request()->route('table_number')])}}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ End Shopping Cart -->

        </div>
    </div>
    <!-- dialog -->
</div>
<!-- End Cart modal -->
