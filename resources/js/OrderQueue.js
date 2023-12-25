let channel2 = Echo.private(`order.created.restaurant.${restaurant_id}`);
channel2.listen('.order-create', function (data) {

    const tableBody = document.querySelector('.table-body');
    const orderShowRoute = routeShow.replace(':order_id', data.order.id);
    const modal_container = document.querySelector('#modal-container');
    const newOrder = `
        <tr class="cell-1">
            <td>#${data.order.number}</td>
            <td>Table #${data.order.table.table_number}</td>
            <td><span class="badge badge-success">${data.order.status}</span></td>
            <td>${data.order.total}</td>
            <td>${moment(data.created_at).fromNow()}</td>
            <td>
                <button type="button" class="btn btn-light" data-mdb-toggle="modal"data-mdb-target="#Order_${data.order.id}">
                        <i class="fas fa-info me-2"></i> Get info
                </button>
            </td>
        </tr>
    `;
    tableBody.insertAdjacentHTML('afterbegin', newOrder);

    const newModal = `
        <div class="modal fade" id="Order_${data.order.id}" tabindex="-1" aria-labelledby="order_${data.order.id}_Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start text-black p-4">
                        <h5 class="modal-title text-uppercase mb-5" id="order_${data.order.id}_Label">Table #${data.order.table.table_number}</h5>
                        <p class="mb-0" style="color: #35558a;">Products summary</p>
                        <hr class="mt-2 mb-4"
                            style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                        ${generateProductSummary(data.order.products)}
                        <hr class="mt-4 mb-4"
                            style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                        <div class="d-flex justify-content-between">
                            <p class="fw-bold">Total</p>
                            <p class="fw-bold" style="color: #35558a;">$${data.order.total}</p>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                        <a href="${orderShowRoute}" class="btn btn-primary btn-lg mb-1" style="background-color: #35558a;">
                            Show order
                        </a>
                    </div>
                </div>
            </div>
        </div>
    `;
    modal_container.insertAdjacentHTML('afterbegin', newModal);
});

function generateProductSummary(products) {
    let productSummary = '';
    products.forEach((product) => {
        productSummary += `
            <div class="d-flex justify-content-between">
                <p class="fw-bold mb-0">${product.name} (Qty: ${product.order_item.quantity})</p>
                <p class="text-muted mb-0">$${product.price * product.order_item.quantity}</p>
            </div>`;
    });
    return productSummary;
}

