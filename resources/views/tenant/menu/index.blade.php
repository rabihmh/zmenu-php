<x-tenant-layout>
    @push('css')
        <style>
            .list-group-item .item-description {
                font-size: 11px;
                height: 30px;
                margin-bottom: 10px;
                text-overflow: ellipsis;
                overflow: hidden;
                word-wrap: break-word;
                width: 90%;
            }

            .list-group-item .item-image {
                padding: 10px 0;
                width: 25%;
                display: table-cell;
                vertical-align: middle;
                text-align: right;
            }

            .list-group-item .item-data {
                width: 55%;
                display: table-cell;
                vertical-align: middle;
            }

            .list-group-item .item-price {
                margin: 10px 0;
                font-weight: 500;
            }

            .list-group-item .item-name {
                margin: 10px 0;
                font-weight: normal;
                font-size: 15px;
                padding: 0;
            }

            .list-group-item {
                height: auto;
                display: grid;
                border: 0;
                padding: 0;
                width: 100%;
                align-content: center;
                align-items: center;
                background: transparent;
                margin: 15px 0;
            }

            .column {
                display: table;
                background: white;
                border-radius: 5px;
                padding: 0 4%;
            }

            .list-group-item .item-image > div {
                width: 25px;
                margin: inherit;
                padding-top: 0;
                bottom: 0;
                right: 2%;
                left: inherit;
            }

            .list-group-item .item-image > div > img {
                display: inline-block;
                position: relative;
                width: 15px;
                height: 15px;
                overflow: hidden;
                border-radius: 50%;
                box-shadow: 0px 0px 0px 1px rgb(0 0 0 / 7%);
            }

            .list-group-item .item-flag {
                bottom: -2px;
                left: -5px;
            }

            .category-items-container {
                padding: 0 5%;
            }

            .category-title {
                font-size: 20px;
                font-weight: normal;
                text-transform: uppercase;
            }

            .item-img-element {
                border-radius: 8px;
                width: 100px;
                height: 100px;
                border: 1px solid #d9d9d9;
            }
        </style>

    @endpush
    <div id="menu-items">
        <div class="items-list-grid">

        </div>
    </div>
    @push('js')
        <script>

            $('.big>div.loader').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                method: 'POST',
                url: '{{ route('tenant.menu.items', getSubdomain())}}',
                async: false,
                success: function (data) {
                    $('.big>div.loader').hide();

                    var $itemsListGrid = $('.items-list-grid');

                    data.products.forEach(function (category) {
                        var categoryHtml = `
                <div class="category-items-container" id="${category.slug}">
                    <span class="category-title">${category.name}</span>
                    <ul class="list-group">`;
                        category.products.forEach(function (product) {
                            var productHtml = `
                    <li class="list-group-item itemMoreInfo" data-id="${product.id}">
                        <div class="column">
                            <div class="item-data">
                                <div class="item-name">${product.name}</div>
                                <div class="item-description">${product.description}</div>
                                <div class="item-price">${product.price}<span>$</span></div>
                            </div>
                            <div class="item-image">
                                <img class="item-img-element" src="{{ asset('storage/uploads/') }}/${product.photo}" alt="${product.name}">
                            </div>
                        </div>
                    </li>`;
                            categoryHtml += productHtml;
                        });
                        categoryHtml += '</ul></div>';
                        $itemsListGrid.append(categoryHtml);
                    });
                },
                error: function (data) {
                    alert(data);
                }
            });
        </script>
        {{--            <script>--}}
        {{--                $(document).ready(function() {--}}
        {{--                    $('.itemMoreInfo').off('click').on('click', function(){--}}
        {{--                        var itemId = $(this).data('id');--}}

        {{--                        $('#itemMoreInfo').modal('show');--}}
        {{--                        $('#itemMoreInfo .modal-body .loader').show();--}}
        {{--                        $('#itemMoreInfo .modal-body .itemModalContent').hide();--}}

        {{--                        $.ajax({--}}
        {{--                            method: 'GET',--}}
        {{--                            url: "/"+"naboulsi" + "/menu/" + itemId,--}}
        {{--                            data: {--}}
        {{--                                itemId: itemId,--}}
        {{--                                slug: "naboulsi"--}}
        {{--                            },--}}
        {{--                            success: function (response) {--}}
        {{--                                $('#itemMoreInfo .modal-body .loader').hide();--}}
        {{--                                $('#itemMoreInfo .modal-body .itemModalContent').show();--}}
        {{--                                $('#itemMoreInfo .modal-body .itemModalContent').html(response);--}}
        {{--                                if (localStorage.getItem('customerId') != null) {--}}
        {{--                                    $('#feedbackForm').show();--}}

        {{--                                    $.ajax({--}}
        {{--                                        method: 'GET',--}}
        {{--                                        url: 'Analytics/itemVisit',--}}
        {{--                                        data: {--}}
        {{--                                            itemId: itemId,--}}
        {{--                                            customerId: localStorage.getItem('customerId'),--}}
        {{--                                            slug: "naboulsi"--}}
        {{--                                        },--}}
        {{--                                        success: function () {--}}
        {{--                                        }--}}
        {{--                                    });--}}
        {{--                                }--}}
        {{--                                else{--}}
        {{--                                    $('#feedbackForm').hide();--}}
        {{--                                }--}}
        {{--                            }--}}
        {{--                        });--}}
        {{--                    });--}}
        {{--                });--}}

        {{--            </script>--}}
    @endpush
</x-tenant-layout>
