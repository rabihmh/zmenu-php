<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$restaurant->name}}</title>
    <link rel="apple-touch-icon"
          href="https://assets-dmenu-online.s3.amazonaws.com/1205/5f7ae99cb82f8_WhatsApp-Image-2020-10-04-at-15.52.06.jpeg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('tenant/css/menu.css')}}" rel="stylesheet"/>
    @stack('css')
</head>
<body>
<!-- Ads modal -->
<div id="ads" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="position: fixed;left: 10%;top: 20%;">

    <!-- dialog -->
    <div class="modal-dialog" style="width: 80%;height: 60%;">

        <!-- content -->
        <div class="modal-content"
             style="-webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);box-shadow: 0 3px 9px rgba(0,0,0,.5);border: none;">

            <!-- header -->
            <div class="modal-header">
                <span data-dismiss="modal">
                    <i class="fa fa-times-circle" style="font-size: 30px;"></i>
                </span>
            </div>
            <!-- header -->

        </div>
        <!-- content -->

    </div>
    <!-- dialog -->

</div>
<!-- Ads modal -->
<header class="color-overlay"
        style="background-image: url({{asset('tenant/images/background.jpg')}})">
    <div class="categoryTitle">MENU</div>
    <ul class="nav nav-tabs">
        @foreach($categories as $category)
            <li class="categoriesToggle"><a class="categorySwitch" href="#{{$category->slug}}">{{$category->name}}</a>
            </li>
        @endforeach
    </ul>
</header>
@include('layouts.flash-message')

<div class="big">
    {{$slot}}
    <div class="loader splash" style="display: none;"></div>
</div>


<!-- branches modal -->
<div id="branchesInfo" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- dialog -->
    <div class="modal-dialog">

        <!-- content -->
        <div class="modal-content branches-color-overlay"
             style="background-image: url({{asset('tenant/images/background.jpg')}}); background-size: cover;">

            <!-- header -->
            <div class="modal-header">
                    <span data-dismiss="modal" class="navigation">
                            <i class="glyphicon glyphicon-remove"></i> Close
                    </span>
            </div>
            <!-- header -->

            <!-- body -->
            <div class="modal-body">
                <div style="text-align: center;color: white;font-weight: bold;font-size: 30px;position: relative;">
                    Order Now
                </div>

                <div class="row separator">
                    <hr style="width: 80%;float: none">
                </div>
                @forelse($restaurant->contact_info as $key=>$value)
                    <div style="text-align: center; color: white;">
                        <strong>{{$key}}</strong>
                        <br>
                        <div style="font-size: 15px;padding: 5px 0;">
                            <a href="tel:{{$value}}" target="_blank" style="color: white;">
                                <i class="fa fa-phone my-float"></i> <span>{{$value}}</span>
                            </a>
                        </div>
                    </div>
                    <br>
                @empty
                    <div style="text-align: center; color: white;">
                        <h1>No Data</h1>
                    </div>
                @endforelse
            </div>
            <!-- body -->

        </div>
        <!-- content -->

    </div>
    <!-- dialog -->

</div>
<!-- branches modal -->
<!--Branch div-->
<div class="floatParent">
    <a class="branchesInfo float" href="#" style="background-color: #555;">
        <i class="fa fa-phone my-float"></i>
    </a>
</div>
<!--End Branch div-->
<!--Cart Modal-->
<x-tenant-cart/>
<!--End Card Modal-->
<!-- Cart div -->
<div class="cartParent">
    <a class="cartButton float" href="#" style="background-color: #555;">
        <i class="fa fa-shopping-cart my-float"></i>
        <span id="cartItemCount">{{\App\Facades\Cart::get()->count()}}</span>
        <!-- This span will display the product count -->

    </a>
</div>
<!-- End Cart div -->

<!-- item description modal -->
<div id="itemMoreInfo" class="modal animated bounceIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- dialog -->
    <div class="modal-dialog">

        <!-- content -->
        <div class="modal-content" style="background-color: #f5f5f5;">
            <!-- body -->
            <div class="modal-body" style="overflow-x: hidden;top: 0;bottom: 0;padding: 0">
                <div class="loader splash" style="display: block;"></div>
                <div class="itemModalContent" style="display: none;">
                    <!-- Container for SweetAlert notifications -->
                    <div id="sweetAlertContainer"></div>
                </div>
            </div>
            <!-- body -->
        </div>
        <!-- content -->
    </div>
    <!-- dialog -->

</div>
<!-- item description modal -->

</body>
<script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('tenant/js/ads.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>


    $('.branchesInfo').off('click').on('click', function () {
        $('#branchesInfo').modal('show');
    });
    $('.cartButton').off('click').on('click', function () {
        $('#cartModal').modal('show');
    });

    // if (localStorage.getItem('customerId') != null) {
    //     $.ajax({
    //         method: 'GET',
    //         url: 'Analytics/qrCodeVisit',
    //         data: {
    //             customerId: localStorage.getItem('customerId'),
    //             slug: "naboulsi"
    //         },
    //         success: function (response) {
    //             if (response.success && response.newCustomer) {
    //                 localStorage.setItem('customerId', response.customerId);
    //             }
    //         }
    //     });
    // }
    //
    //
    $(window).scroll(function () {
        var position = $(this).scrollTop();
        $('.category-items-container').each(function () {
            if (position + 500 > $(this).position().top) {
                var categoryId = $(this).attr('id');
                if (!$('a[href="#' + categoryId + '"]').hasClass('active')) {
                    $('.categorySwitch').removeClass('active');
                    $('a[href="#' + categoryId + '"]').addClass('active');
                    $('ul.nav-tabs').scrollLeft($('a[href="#' + categoryId + '"]').offset().left);
                }
            }
        });
    });
</script>
@stack('js')
</html>
