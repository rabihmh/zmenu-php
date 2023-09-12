var channel = Echo.private(`customer.seated.restaurant.${restaurant_id}`);
channel.listen('.customer-seat', function (data) {

    let notification_count = parseInt(document.querySelector('#notification-count').textContent);
    notification_count++
    document.querySelector('#notification-count').textContent = notification_count;
    const dropdown = document.querySelector('.main-notification-list');


    const notificationHTML = `
        <a class="dropdown-item d-flex align-items-center" href="?notification_id=${data.notification_id}">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-info text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div
                                class="small text-gray-500">${moment(data.created_at).fromNow()}</div>
                            <span class="font-weight-bold">${data.message}</span>
                        </div>
                    </a>
                    `;
    dropdown.insertAdjacentHTML('afterbegin', notificationHTML)
})
/*
channel.notification((notification) => {});
*/
