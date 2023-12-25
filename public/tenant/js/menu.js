$(document).ready(function () {
    const $categorySwitch = $('.categorySwitch');
    const $itemsListGrid = $('.items-list-grid');
    const $categoryTitle = $('.categoryTitle');
    const $colorOverlay = $('.color-overlay');
    const $itemModalContent = $('.itemModalContent');
    const $itemMoreInfo = $('#itemMoreInfo');
    const $itemModalLoader = $('#itemMoreInfo .modal-body .loader');
    const $itemModalContentInner = $('#itemMoreInfo .modal-body .itemModalContent');
    const $cartItemCount = $('#cartItemCount');
    const $sweetAlertContainer = $('#sweetAlertContainer');

    $categorySwitch.off('click').on('click', function () {
        const $this = $(this);
        const categoryId = $this.data('id');
        const categoryName = $this.data('name');
        const categoryImg = $this.data('img');
        const headerBanner = categoryImg !== '' ? assetUrl + 'storage/' + categoryImg : assetUrl + 'tenant/images/background.jpg';

        $categoryTitle.html("• " + categoryName + " •");
        $colorOverlay.css('background-image', "url('" + headerBanner + "')");
        $('.big>div.items').hide();
        $('.big>div.loader').show();

        $.ajax({
            method: 'GET',
            url: menuItemsListRoute,
            data: {categoryId},
            success: function (data) {
                $('.big>div.loader').hide();
                $('.big>div.items').show();
                $itemsListGrid.empty();
                const $ul = $('<ul class="list-group"></ul');
                data.products.forEach(product => {
                    const productHtml = `
                        <li class="list-group-item itemMoreInfo" data-id="${product.id}">
                            <div class="column item-image left">
                                <div style="position: relative;">
                                    <img src="${assetUrl}storage/${product.photo}" alt="${product.name}">
                                </div>
                            </div>
                            <div class="column item-data middle">
                                <div class="item-name">${product.name}</div>
                                <div class="item-price">${product.price} <span>$</span></div>
                            </div>
                            <div class="column right">
                                <button class="btn itemInfo">
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </button>
                            </div>
                        </li>`;
                    $ul.append(productHtml);
                });
                $itemsListGrid.append($ul);
            }
        });
    });
    $('ul.nav-tabs>li').first().find('a').trigger('click');

    $(document).on('click', '.itemMoreInfo', function () {
        const itemId = $(this).data('id');
        $itemMoreInfo.modal('show');
        $itemModalLoader.show();
        $itemModalContentInner.hide();
        loadItemDetails(itemId);
    });

    function loadItemDetails(itemId) {
        $.ajax({
            method: 'GET',
            url: menuItemRoute,
            data: {itemId},
            success: function (response) {
                displayItemDetails(response.product);
            }
        });
    }

    function displayItemDetails(product) {
        const backgroundUrl = `${assetUrl}storage/${product.photo}`;
        const descriptionHtml = product.description ? `
            <div class="row item-description">
                <i class="glyphicon glyphicon-info-sign" style="padding-right: 5px;color: #333;"></i>
                <p style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">Description</p>
                <div style="color: rgba(0, 0, 0, 0.8);font-size: 15px;word-wrap: break-word;"><p>${product.description}</p></div>
                <div class="item-labels"></div>
            </div>` : '';

        const ratingsHtml = `
            <div class="row item-reviews">
                <span style="font-size: 15px;padding-right: 5px;color: #333;">★</span>
                <p style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">Ratings</p>
                <div id="feedbackForm">
                    <hr>
                    <div class="feedbackMessage" style="color: #333;display: inline-block">Leave your rating</div>
                    <div class="rating">
                        <label><input type="radio" name="item_rating" value="1"><span class="icon">★</span></label>
                        <label><input type="radio" name="item_rating" value="2"><span class="icon">★</span><span class="icon">★</span></label>
                        <label><input type="radio" name="item_rating" value="3"><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span></label>
                        <label><input type="radio" name="item_rating" value="4"><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span></label>
                        <label><input type="radio" name="item_rating" value="5"><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span><span class="icon">★</span></label>
                    </div>
                </div>
            </div>`;

        const content = `
            <div class="itemInfoHeader" style="background:url(${backgroundUrl}); background-size: cover; background-repeat: no-repeat;"></div>
            <div class="itemInfoMain">
                <div class="row" style="color: white;font-weight: bold;font-size: 30px;position: relative;padding: 0 10%;width: 98%;display: inline-block;">
                    <div style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">${product.name}</div>
                </div>
                <span data-dismiss="modal"><i class="fa fa-times-circle" style="font-size: 30px;"></i></span>
                <div class="row" style="color: white;font-weight: bold;font-size: 30px;position: relative;padding: 0 10%;width: 84%;display: inline-block;">
                    <div style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">${product.price} <span>$</span></div>
                </div>
            </div>
            <div class="itemInfoContent">
                ${descriptionHtml}
                ${ratingsHtml}
                <div style="margin-bottom: 10px">
                    <label for="name" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" value="1" placeholder="Enter quantity">
                </div>
                <div class="text-center" style="margin-top: 50px"><a href="#" id="addToCartButton" data-id="${product.id}" class="myBTN">Add to Cart</a></div>
            </div>`;

        $itemModalLoader.hide();
        $itemModalContentInner.show();
        $itemModalContentInner.html(content);
        $('#addToCartButton').on('click', function () {
            const productId = $(this).data('id');
            const quantity = $('#quantity').val();

            $.ajax({
                method: 'POST',
                url: addToCartRoute,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {product_id: productId, quantity: quantity},
                success: function (response) {
                    const cartItemCount = parseInt($cartItemCount.text());
                    $cartItemCount.text(cartItemCount + 1);
                    $itemMoreInfo.modal('hide');
                    showSwalNotificationInModal('Success', 'Item added to cart!', 'success');
                },
                error: function (error) {
                    $itemMoreInfo.modal('hide');
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while adding the item to cart.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }
            });

        });

    }

    function showSwalNotificationInModal(title, text, icon) {
        const swalContainer = $sweetAlertContainer;

        Swal.fire({
            title,
            text,
            icon,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then(() => {
            swalContainer.empty();
        });

        swalContainer.appendTo($itemModalContent);
    }

    $('input[name="item_rating"]').off('change').on('change', function () {
        $('#itemMoreInfo .modal-body .loader').show();
        var feedbackMessage = '';

        if ($(this).val() == 5) {
            feedbackMessage = "I love it";
        } else if ($(this).val() == 4) {
            feedbackMessage = "I like it";
        } else if ($(this).val() == 3) {
            feedbackMessage = "It is good";
        } else if ($(this).val() == 2) {
            feedbackMessage = "I don't like it";
        } else if ($(this).val() == 1) {
            feedbackMessage = "I hate it";
        }

        $('.rating').html(feedbackMessage);

        $.ajax({
            method: 'GET',
            url: '/' + 'naboulsi' + '/customerFeedback',
            data: {
                customerId: localStorage.getItem('customerId'),
                slug: "naboulsi",
                itemId: "3634",
                rating: $(this).val(),
                feedback: feedbackMessage
            },
            success: function (response) {
                $('#itemMoreInfo .modal-body .loader').hide();
            }
        });
    });

});
