let channel2 = Echo.private(`order.created.restaurant.${restaurant_id}`);
channel2.listen('.order-create', function (data) {
    const tableBody = document.querySelector('.table-body');
    const orderShowRoute = routeShow.replace(':order_id', data.order.id);

    const newOrder = `
        <tr class="cell-1">
            <td>#${data.order.number}</td>
            <td>Table #${data.order.table.table_number}</td>
            <td><span class="badge badge-success">${data.order.status}</span></td>
            <td>${data.order.total}</td>
            <td>${moment(data.created_at).fromNow()}</td>
            <td><a href="${orderShowRoute}" class="btn btn-primary">Show</a></td>
        </tr>
    `;

    tableBody.insertAdjacentHTML('afterbegin', newOrder);
});
