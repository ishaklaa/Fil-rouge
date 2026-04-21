const div = document.getElementById('activitiesDiv');
const orderDiv = document.getElementById('orderDiv');

function startClock() {
    const el = document.getElementById('clock');

    setInterval(() => {
        el.textContent = new Date().toLocaleString();
    }, 1000); // updates every second
}


function moveToOrder(x) {
    x.forEach(add => {
        add.addEventListener('click', (e) => {
            const Addbutton = e.target;
            Addbutton.disabled = true;
            Addbutton.classList.add('opacity-50', 'cursor-not-allowed');
            const card = e.target.parentElement;
            const infos = card.children[1];
            const qty = infos.children[2];
            const title = infos.children[0].textContent;
            const price1 = infos.children[1].textContent;
            const price2 = price1.split(' ');
            const price = price2[2];
            const actID = infos.children[3].textContent;
            const quantity = qty.children[0].textContent;
            if (quantity > 0) {
                const wrapper = document.createElement('div');
                wrapper.className = "actInOder bg-beige-100 rounded-xl px-4 py-3 border border-beige-200 flex items-center gap-3";
                const info = document.createElement('div');
                info.className = "flex-1 min-w-0";
                const titleEl = document.createElement('p');
                titleEl.className = "text-sm font-medium text-brown-400 truncate";
                titleEl.textContent = title;
                const priceEl = document.createElement('p');
                priceEl.className = "text-xs text-brown-200 mt-0.5";
                priceEl.textContent = 'price : ' + price;
                const controls = document.createElement('div');
                controls.className = "flex items-center gap-1.5";
                /*const btnClass = "w-7 h-7 rounded-lg border border-beige-300 bg-white text-brown-300 font-bold flex items-center justify-center hover:bg-brown-300 hover:text-white hover:border-brown-300 transition-all";*/
                const minusBtn = document.createElement('button');
                minusBtn.className = "minusBtn w-7 h-7 rounded-lg border border-beige-300 bg-white text-brown-300 font-bold flex items-center justify-center hover:bg-brown-300 hover:text-white hover:border-brown-300 transition-all";
                minusBtn.textContent = '−';
                minusBtn.setAttribute('onclick', 'decreaseQTY(event)');

                const qtySpan = document.createElement('span');
                qtySpan.className = "text-sm font-semibold text-brown-400 w-5 text-center";
                qtySpan.textContent = 1;
                const plusBtn = document.createElement('button');
                plusBtn.className = "plusBtn w-7 h-7 rounded-lg border border-beige-300 bg-white text-brown-300 font-bold flex items-center justify-center hover:bg-brown-300 hover:text-white hover:border-brown-300 transition-all";
                plusBtn.textContent = '+';
                plusBtn.setAttribute('onclick', 'increaseQTY(event)');

                const deleteBtn = document.createElement('button');
                deleteBtn.className = "deleteBtn w-7 h-7 rounded-lg bg-red-50 text-red-400 flex items-center justify-center hover:bg-red-400 hover:text-white transition-all text-xs font-bold";
                deleteBtn.textContent = '✕';
                deleteBtn.setAttribute('onclick', 'removeOrder(event)');
                let activityId = document.createElement('span');
                activityId.className = "hidden";
                activityId.textContent = actID;
                info.appendChild(titleEl);
                info.appendChild(priceEl);
                info.appendChild(activityId);
                controls.appendChild(minusBtn);
                controls.appendChild(qtySpan);
                controls.appendChild(plusBtn);
                wrapper.appendChild(info);
                wrapper.appendChild(controls);
                wrapper.appendChild(deleteBtn);
                orderDiv.appendChild(wrapper);
                IncreaseTotalAndSubtotalCalculate(price);


            }
        })
    });

}

function IncreaseTotalAndSubtotalCalculate(price) {
    let disc = document.getElementById('discount');
    let discount1 = disc.textContent.split(' ');
    let discount = parseInt(discount1[1]);
    let subTotal = document.getElementById('subTotal');
    let TotalAmount = document.getElementById('TotalAmount');
    let discountValue = document.getElementById('discountValue');
    if (discount >= 0 && discount <= 100) {
        let total = parseInt(subTotal.textContent) + parseInt(price);
        if (total <= 0) {
            subTotal.textContent = 0;
            discountValue.textContent = 0;
            TotalAmount.textContent = 0;
            return;
        }
        subTotal.textContent = total;
        let discountAmount = (total * discount) / 100;
        discountValue.textContent = discountAmount;
        TotalAmount.textContent = total - discountAmount;
    } else if (discount < 0 || discount > 100) {
        let total = parseInt(subTotal.textContent) + parseInt(price);
        let discountAmount = 0;
        discountValue.textContent = discountAmount;
        TotalAmount.textContent = total - discountAmount;
        subTotal.textContent = total;
        TotalAmount.textContent = total;
    }
}

function decreaseTotalAndSubtotalCalculate(price) {
    let disc = document.getElementById('discount');
    let discount1 = disc.textContent.split(' ');
    let discount = parseInt(discount1[1]);
    let subTotal = document.getElementById('subTotal');
    let TotalAmount = document.getElementById('TotalAmount');
    let discountValue = document.getElementById('discountValue');
    if (discount >= 0 && discount <= 100) {
        let total = parseInt(subTotal.textContent) - parseInt(price);
        subTotal.textContent = total;
        let discountAmount = (total * discount) / 100;
        discountValue.textContent = discountAmount;
        TotalAmount.textContent = total - discountAmount;
    } else if (discount < 0 || discount > 100) {
        let total = parseInt(subTotal.textContent) - parseInt(price);
        let discountAmount = 0;
        discountValue.textContent = discountAmount;
        TotalAmount.textContent = total - discountAmount;
        subTotal.textContent = total;
        TotalAmount.textContent = total;
    }
}

function removeOrder(e) {
    const card = e.target.parentElement;
    const info = card.children[0];
    let price1 = parseInt(info.children[1].textContent.split(' ')[2]);
    let quantity = parseInt(card.children[1].children[1].textContent);
    let price = price1 * quantity;
    const OrderCardId = info.children[2].textContent;
    const addButton = document.querySelectorAll('.AddOrder')
    addButton.forEach(btn => {
        const card = btn.parentElement;
        const info = card.children[1];
        const CardId = info.children[3].textContent;
        if (OrderCardId === CardId) {
            card.children[2].disabled = false;
            card.children[2].classList.remove('opacity-50', 'cursor-not-allowed');
        }
    });
    decreaseTotalAndSubtotalCalculate(price)
    e.target.parentElement.remove();
}

function increaseQTY(e) {
    const card = e.target.parentElement.parentElement;
    let minusBtn = card.children[1].children[0];
    if (minusBtn.disabled = true) {
        minusBtn.disabled = false;
        minusBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
    const info = card.children[0];
    let quantityHolder = card.children[1].children[1];
    let quantityInOrder = parseInt(quantityHolder.textContent);
    const OrderCardId = info.children[2].textContent;
    const activityCard = document.querySelectorAll('.activityCard')
    activityCard.forEach(card => {
        const info = card.children[1];
        const CardId = info.children[3].textContent;
        if (OrderCardId === CardId) {
            let quantity = info.children[2].textContent.split(' ');
            let qty = parseInt(quantity[2]);
            if (quantityInOrder < qty) {

                quantityHolder.textContent = quantityInOrder + 1;
                const price1 = info.children[1].textContent;
                const price2 = price1.split(' ');
                const price = price2[2];
                IncreaseTotalAndSubtotalCalculate(price);

            } else {
                e.target.disabled = true;
                e.target.classList.add('opacity-50', 'cursor-not-allowed')
            }
        }
    });
}

function decreaseQTY(e) {
    const card = e.target.parentElement.parentElement;
    let plusBtn = card.children[1].children[2];
    if (plusBtn.disabled = true) {
        plusBtn.disabled = false;
        plusBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
    const info = card.children[0];
    let quantityHolder = card.children[1].children[1];
    let quantityInOrder = parseInt(quantityHolder.textContent);
    const OrderCardId = info.children[2].textContent;
    const activityCard = document.querySelectorAll('.activityCard')
    activityCard.forEach(card => {
        const info = card.children[1];
        const CardId = info.children[3].textContent;
        if (OrderCardId === CardId) {
            let quantity = info.children[2].textContent.split(' ');
            let qty = parseInt(quantity[2]);
            if (quantityInOrder > 1) {

                quantityHolder.textContent = quantityInOrder - 1;
                const price1 = info.children[1].textContent;
                const price2 = price1.split(' ');
                const price = price2[2];
                decreaseTotalAndSubtotalCalculate(price);

            } else {
                e.target.disabled = true;
                e.target.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    });


}

function getActivities() {
    fetch('/cashier/activity')
        .then(res => {
            if (!res.ok) {
                console.error('Request failed:', res.status);
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data.activities.length) {
                const NoActivity = document.createElement('div');
                NoActivity.className = "col-span-full flex flex-col items-center justify-center py-20 text-beige-400 gap-3";
                const text = document.createElement('p');
                text.className = "text-sm";
                text.textContent = 'No activity found!'
                NoActivity.appendChild(text);
                div.appendChild(NoActivity);
            }
            data.activities.forEach(activity => {
                const card = document.createElement('div');
                card.className = "activityCard bg-white rounded-2xl p-4 border border-beige-200 shadow-sm flex flex-col gap-3 hover:-translate-y-1 hover:shadow-md transition-all relative overflow-hidden h-fit";
                const decorateLine = document.createElement('div');
                decorateLine.className = "absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-brown-100 to-brown-300";
                const infos = document.createElement('div');
                let title = document.createElement('p');
                title.className = "font-playfair font-semibold text-brown-400 leading-tight";
                title.textContent = activity.title;
                let price = document.createElement('p');
                price.className = "font-medium text-brown-300";
                price.textContent = 'price : ' + activity.price + ' ';
                let qty = document.createElement('p');
                qty.className = "font-medium text-brown-300";
                qty.textContent = 'Qty : '
                let SAR = document.createElement('span');
                SAR.className = "text-beige-400 text-xs font-normal";
                SAR.textContent = 'SAR';
                let QTY = document.createElement('span');
                QTY.className = "font-medium text-brown-300";
                QTY.textContent = activity.quantity;

                let activityId = document.createElement('span');
                activityId.className = "hidden";
                activityId.textContent = activity.id;

                const AddButton = document.createElement('button');
                AddButton.className = "AddOrder mt-auto w-full bg-brown-300 hover:bg-brown-400 text-white rounded-xl py-2 text-sm font-medium flex items-center justify-center gap-2 transition-all hover:scale-[1.02]";
                AddButton.setAttribute('id', "addToOrder");
                AddButton.textContent = 'Add to Order';


                card.appendChild(decorateLine);
                price.appendChild(SAR);
                qty.appendChild(QTY);
                infos.appendChild(title);
                infos.appendChild(price);
                infos.appendChild(qty);
                infos.appendChild(activityId);
                card.appendChild(infos);
                card.appendChild(AddButton);
                if (!activity.is_available) {
                    AddButton.remove();
                    const unavailable = document.createElement('p');
                    unavailable.className = "text-center text-sm text-red-400 font-medium mt-auto";
                    unavailable.textContent = 'Unavailable';
                    card.appendChild(unavailable);
                }
                div.appendChild(card);

            });
            const addOrder = document.querySelectorAll('.AddOrder');
            moveToOrder(addOrder);


        })
        .catch(err => console.error(err));
}

function discountModify() {
    const discountModifyBtn = document.getElementById('discountModify');
    let discountInput = document.getElementById('discountInput');
    let discount = document.getElementById('discount');
    discountModifyBtn.addEventListener('click', () => {
        if (discountInput.value.trim() === '') {
            discountInput.value = 0;
        }
        discount.textContent = 'Discount ' + discountInput.value + ' %';
        IncreaseTotalAndSubtotalCalculate(0)

    });
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-5 right-5 px-4 py-3 rounded-xl z-[100] text-white text-sm font-medium shadow-lg transition-all ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
}

function removeAfterCheckout() {
    let activitiesDiv = document.getElementById("orderDiv");
    let price = 0;
    Array.from(activitiesDiv.children).forEach(act => {
        const info = act.children[0];
        let price1 = parseInt(info.children[1].textContent.split(' ')[2]);
        let quantity = parseInt(act.children[1].children[1].textContent);
        price = price + (price1 * quantity);
        const OrderCardId = info.children[2].textContent;
        const addButton = document.querySelectorAll('.AddOrder')
        addButton.forEach(btn => {
            const card = btn.parentElement;
            const info = card.children[1];
            const CardId = info.children[3].textContent;
            if (OrderCardId === CardId) {
                card.children[2].disabled = false;
                card.children[2].classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });


    });
    decreaseTotalAndSubtotalCalculate(price)

}
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
    window.location.reload();

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



function appInit() {
    startClock();
    getActivities()
    discountModify()

}

appInit();
