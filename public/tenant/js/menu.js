$(document).ready(function () {
    $('.big>div.loader').show();

    // Function to load menu items
    function loadMenuItems() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            method: 'POST',
            url: menuItemsListRoute,
            async: false,
            success: function (data) {
                $('.big>div.loader').hide();
                displayMenuItems(data.products);
            },
            error: function (data) {
                alert(data);
            }
        });
    }

    // Function to display menu items
    function displayMenuItems(categories) {
        const $itemsListGrid = $('.items-list-grid');
        categories.forEach(function (category) {
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
                                <img class="item-img-element" src="${assetUrl}/${product.photo}" alt="${product.name}">
                            </div>
                        </div>
                    </li>`;
                categoryHtml += productHtml;
            });
            categoryHtml += '</ul></div>';
            $itemsListGrid.append(categoryHtml);
        });
    }

    // Load menu items on page load
    loadMenuItems();

    $('.itemMoreInfo').off('click').on('click', function () {
        var itemId = $(this).data('id');
        $('#itemMoreInfo').modal('show');
        $('#itemMoreInfo .modal-body .loader').show();
        $('#itemMoreInfo .modal-body .itemModalContent').hide();
        loadItemDetails(itemId);
    });

    function loadItemDetails(itemId) {
        $.ajax({
            method: 'GET',
            url: menuItemRoute,
            data: {
                itemId: itemId,
            },
            success: function (response) {
                displayItemDetails(response.product);
            }
        });
    }

    // Function to display item details
    function displayItemDetails(product) {
        const backgroundUrl = `${assetUrl}/${product.photo}`;
        let descriptionHtml = '';
        if (product.description !== null) {
            descriptionHtml = `<div class="row item-description">
                <i class="glyphicon glyphicon-info-sign" style="padding-right: 5px;color: #333;"></i>
                <p style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">Description</p>
                <div style="color: rgba(0, 0, 0, 0.8);font-size: 15px;word-wrap: break-word;"><p>${product.description}</p></div>
                <div class="item-labels">
                </div>
            </div>`;
        }
        const ratingsHtml = `
            <div class="row item-reviews">
                <span style="font-size: 15px;padding-right: 5px;color: #333;">★</span>
                <p style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">Ratings</p>
                <div id="feedbackForm">
                    <hr>
                    <div class="feedbackMessage" style="color: #333;display: inline-block">
                        Leave your rating
                    </div>
                    <div class="rating">
                <label>
                    <input type="radio" name="item_rating" value="1">
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="item_rating" value="2">
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="item_rating" value="3">
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="item_rating" value="4">
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
                <label>
                    <input type="radio" name="item_rating" value="5">
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                </label>
            </div>
                </div>
            </div>`;
        const content = `
<div class="itemInfoHeader" style="background:url(${backgroundUrl}); background-size: cover; background-repeat: no-repeat;"></div>

            <div class="itemInfoMain">
                <div class="row" style="color: white;font-weight: bold;font-size: 30px;position: relative;padding: 0 10%;width: 98%;display: inline-block;">
                    <div style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">${product.name}</div>
                </div>
                <span data-dismiss="modal">
                    <i class="fa fa-times-circle" style="font-size: 30px;"></i>
                </span>
                <div class="row" style="color: white;font-weight: bold;font-size: 30px;position: relative;padding: 0 10%;width: 84%;display: inline-block;">
                    <div style="font-weight: bold;font-size: 15px;max-width: 90%;display: inline-block;color: #333;">
                        ${product.price} <span>$</span>
                    </div>
                </div>
            </div>
            <div class="itemInfoContent">
                ${descriptionHtml}
                ${ratingsHtml}
            </div>`;
        $('#itemMoreInfo .modal-body .loader').hide();
        $('#itemMoreInfo .modal-body .itemModalContent').show();
        $('#itemMoreInfo .modal-body .itemModalContent').html(content);
        // if (localStorage.getItem('customerId') != null) {
        //     $('#feedbackForm').show();
        //
        //     $.ajax({
        //         method: 'GET',
        //         url: 'Analytics/itemVisit',
        //         data: {
        //             itemId: itemId,
        //             customerId: localStorage.getItem('customerId'),
        //             slug: "{restaurant_domain}"
        //         },
        //         success: function () {
        //         }
        //     });
        // } else {
        //     $('#feedbackForm').hide();
        // }
    }
});
$('input[name="item_rating"]').off('change').on('change', function(){
    $('#itemMoreInfo .modal-body .loader').show();
    var feedbackMessage = '';

    if($(this).val() == 5){
        feedbackMessage = "I love it";
    }
    else if($(this).val() == 4){
        feedbackMessage = "I like it";
    }
    else if($(this).val() == 3){
        feedbackMessage = "It is good";
    }
    else if($(this).val() == 2){
        feedbackMessage = "I don't like it";
    }
    else if($(this).val() == 1){
        feedbackMessage = "I hate it";
    }

    $('.rating').html(feedbackMessage);

    $.ajax({
        method: 'GET',
        url: '/'+'naboulsi'+'/customerFeedback',
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
