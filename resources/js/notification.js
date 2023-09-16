function updateNotificationDropdown(data) {
    let notification_count = parseInt(document.querySelector('#notification-count').textContent);
    notification_count++;
    document.querySelector('#notification-count').textContent = notification_count;
    const dropdown = document.querySelector('.main-notification-list');

    const notificationHTML = `
        <a class="dropdown-item d-flex align-items-center" href="${data.url || `/?notification_id=${data.notification_id}`}">
            <div class="mr-3">
                <div class="icon-circle bg-success">
                    <i class="fas fa-info text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">${moment(data.created_at).fromNow()}</div>
                <span class="font-weight-bold">${data.message}</span>
            </div>
        </a>
    `;
    dropdown.insertAdjacentHTML('afterbegin', notificationHTML);
}


// Channel 1: customer.seated.restaurant
let channel1 = Echo.private(`customer.seated.restaurant.${restaurant_id}`);
channel1.listen('.customer-seat', function (data) {
    updateNotificationDropdown(data);
});

// Channel 2: order.created.restaurant
let channel2 = Echo.private(`order.created.restaurant.${restaurant_id}`);
channel2.listen('.order-create', function (data) {
    updateNotificationDropdown(data);
    // You can also handle additional logic specific to order-create events here.
    alert(data.url);
});
/*
channel.notification((notification) => {});
*/
