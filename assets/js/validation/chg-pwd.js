const supplier = document.getElementById('supplier');
const exFrom = document.getElementById('ex_order');
const errorElement = document.getElementById('error');

exFrom.addEventListener('submitOrder', (e) => {
    let messages = [];
    if (supplier.value === '' || supplier.value == null) {
        messages.push('Select the Supplier');
    }
    if (messages.length > 0) {
        e.preventDefault();
        errorElement.innerText = messages.join(', ');
    }
});