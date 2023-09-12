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
                                    <p>Subtotal</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>Discount</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <p>Remove</p>
                                </div>
                            </div>
                        </div>

                        @foreach($cart->get() as $cart)
                            <div class="cart-single-list">
                                <div class="row align-items-center">
                                    <div class="col-lg-1 col-md-1 col-12">
                                        <a href="product-details.html"><img
                                                src="https://demo.graygrids.com/themes/shopgrids/assets/images/cart/01.jpg"
                                                alt="#"></a>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-12">
                                        <h5 class="product-name"><a href="product-details.html">
                                                Canon EOS M50 Mirrorless Camera</a></h5>
                                        <p class="product-des">
                                            <span><em>Type:</em> Mirrorless</span>
                                            <span><em>Color:</em> Black</span>
                                        </p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <div class="count-input">
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <p>$910.00</p>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-12">
                                        <p>$29.00</p>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-12">
                                        <a class="remove-item" href="javascript:void(0)"><i
                                                class="fas fa-times fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!--/ End Shopping Cart -->
            ${{\App\Facades\CartFacade::total()}}
        </div>
    </div>
    <!-- dialog -->
</div>
<!-- End Cart modal -->
