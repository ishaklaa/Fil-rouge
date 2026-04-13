function showReceipt(id) {
    fetch('/cashier/receipt', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            id: id,
        })
    })
        .then(res => {
                if (!res.ok) {
                    return res.json().then(err => {
                        throw err;
                    }).catch(() => {
                        throw {message: 'Server error (500)'};
                    });
                }
                return res.json();
            }
        )
        .then(data => {
            let subtotal = 0 ;
            let discount = data.discount;
            const receipt = document.getElementById('receipt');

            data.activities.forEach(activity => {
                subtotal = subtotal + (activity.price * activity.pivot.quantity);
                const row = document.createElement('div');
                row.className = 'flex justify-between text-sm';

                const left = document.createElement('span');
                left.className = 'text-brown-300';

                const nameText = document.createTextNode(activity.title + ' ');

                const qty = document.createElement('span');
                qty.className = 'text-beige-400';
                qty.textContent = 'x' + activity.pivot.quantity;

                left.appendChild(nameText);
                left.appendChild(qty);

                const right = document.createElement('span');
                right.className = 'font-medium text-brown-400';
                right.textContent = activity.price + ' SAR';

                row.appendChild(left);
                row.appendChild(right);
                receipt.appendChild(row);
            })
            const receiptSubtotal = document.getElementById('receiptSubtotal');
            const receiptDiscount = document.getElementById('receiptDiscount');
            const receiptDiscountValue = document.getElementById('receiptDiscountValue');
            const total = document.getElementById('total');
            receiptSubtotal.textContent = subtotal;
            receiptDiscount.textContent = 'Discount ' + discount + ' %';
            let discountAmount = (subtotal * discount) / 100;
            receiptDiscountValue.textContent =discountAmount;
            total.textContent = subtotal - discountAmount;
            document.getElementById('receipt-modal').classList.remove('hidden');


        })
        .catch(err => console.error(err));
}
function closeModal() {
    const receiptSubtotal = document.getElementById('receiptSubtotal');
    const receiptDiscount = document.getElementById('receiptDiscount');
    const receiptDiscountValue = document.getElementById('receiptDiscountValue');
    const total = document.getElementById('total');
    const receipt = document.getElementById('receipt');
    receipt.textContent='';

    receiptSubtotal.textContent = 0 + " SAR";
    receiptDiscount.textContent = 'Discount 0 %';
    let discountAmount = 0 + " SAR";
    receiptDiscountValue.textContent =discountAmount;
    total.textContent = 0 + " SAR";
    document.getElementById('receipt-modal').classList.add('hidden');

}

function checkOut() {
    let discount = parseInt(document.getElementById('discount').textContent.split(' ')[1]);

    let orders = [];
    let activitiesDiv = document.getElementById("orderDiv");
    if (activitiesDiv.children.length <= 0) {
        showToast('nothing to checkout', 'error');
        return
    }
    Array.from(activitiesDiv.children).forEach(act => {
        let id = parseInt(act.children[0].children[2].textContent);
        let qty = parseInt(act.children[1].children[1].textContent);
        orders.push({
            id: id,
            qty: qty
        })
    })

    fetch('/cashier/checkout', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            orders: orders,
            discount: discount
        })
    })
        .then(res => {
            if (!res.ok) {
                return res.json().then(err => {
                    throw err;
                }).catch(() => {
                    throw {message: 'Server error (500)'};
                });
            }
            return res.json();
        })
        .then(data => {
            if (data.errors) {
                data.errors.forEach(error => showToast(error, 'error'));
            } else {

                showToast(data.message, 'success');
                removeAfterCheckout();
                activitiesDiv.textContent = '';
                showReceipt(data.orderId);

            }
        })
        .catch(err => console.error(err));
}
