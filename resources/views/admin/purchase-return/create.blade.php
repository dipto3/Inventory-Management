@extends('admin.layouts.master')
@section('admin.content')
    <div class="container mt-4">
        <h2>Purchase Return</h2>

        <form action="{{ route('purchase-return.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-select" required>
                    <option value="">Select Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Purchase Order</label>
                <select name="purchase_order_id" id="purchase_order_id" class="form-select" required>
                    <option value="">Select Order</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Purchase</label>
                <select name="purchase_id" id="purchase_id" class="form-select" required>
                    <option value="">Select Purchase</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Return Date</label>
                <input type="date" name="return_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div id="purchaseItemsWrapper"></div>
            <div id="perProductDiscount"></div>

            <button type="submit" class="btn btn-primary mt-3">Submit Return</button>
        </form>
    </div>

    <script>
        document.getElementById('supplier_id').addEventListener('change', function() {
            let supplierId = this.value;

            fetch('/get-purchase-orders/' + supplierId)
                .then(res => res.json())
                .then(data => {
                    let orderSelect = document.getElementById('purchase_order_id');
                    orderSelect.innerHTML = '<option value="">Select Order</option>';
                    data.forEach(order => {
                        orderSelect.innerHTML +=
                            `<option value="${order.id}">#${order.id} - ${order.purchase_order_code}</option>`;
                    });

                    document.getElementById('purchase_id').innerHTML =
                        '<option value="">Select Purchase</option>';
                    document.getElementById('purchaseItemsWrapper').innerHTML = '';
                });
        });

        let totalDiscount = 0;
        let totalReceivedQty = 0;

        document.getElementById('purchase_order_id').addEventListener('change', function() {
            let orderId = this.value;

            fetch('/get-purchases/' + orderId)
                .then(res => res.json())
                .then(data => {
                    let purchaseSelect = document.getElementById('purchase_id');
                    purchaseSelect.innerHTML = '<option value="">Select Purchase</option>';
                    data.forEach(p => {
                        purchaseSelect.innerHTML +=
                            `<option value="${p.id}" data-discount="${p.total_discount}" data-totalqty="${p.total_receive_quantity}">
                        #${p.id} - ${p.purchase_code}
                    </option>`;
                    });
                });
        });


        document.getElementById('purchase_id').addEventListener('change', function() {
            let purchaseId = this.value;
            let selectedOption = this.options[this.selectedIndex];

            totalDiscount = parseFloat(selectedOption.dataset.discount || 0);
            totalReceivedQty = parseFloat(selectedOption.dataset.totalqty || 1); // avoid division by zero
            let perProductDiscount = totalDiscount / totalReceivedQty;

            fetch('/get-purchase-items/' + purchaseId)
                .then(res => res.json())
                .then(data => {
                    let wrapper = document.getElementById('purchaseItemsWrapper');
                    wrapper.innerHTML = `<h4>Items</h4>`;
                    data.forEach(item => {
                        let discountedPrice = item.purchase_price - perProductDiscount;
                        wrapper.innerHTML += `
                    <div class="mb-3 border p-2">
                        <strong>${item.product.name}</strong><br>
                        Quantity: ${item.receive_quantity} <br>
                        Price: ${item.purchase_price}<br>
                        Discounted Price: ${discountedPrice.toFixed(2)}<br>
                        <label>Return Qty:</label>
                        <input 
                            type="number" 
                            name="items[${item.id}][quantity]" 
                            class="form-control return-qty-input" 
                            max="${item.receive_quantity}" 
                            data-max="${item.receive_quantity}"
                            data-price="${discountedPrice}"
                            oninput="checkReturnQty(this); calculateTotalAmount();"
                        >
                        <label>Reason:</label>
                        <select name="items[${item.id}][reason_id]" class="form-select">
                            <option value="">Select Reason</option>
                            @foreach ($returnReasons as $reason)
                                <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                            @endforeach
                        </select>
                    </div>
                `;
                    });

                    wrapper.innerHTML += `
                <div class="mt-3">
                    <strong>Total Return Amount: </strong> <span id="totalReturnAmount">0.00</span> <br>
                      <strong>Per Product Discount: </strong> <span id="perProductDiscountAmount">${perProductDiscount}</span>
                    <input type="hidden" name="total_amount" id="totalAmountInput">
                    <input type="hidden" name="per_product_discount" id="" value="${perProductDiscount}">
                  
                </div>
            `;
                });
        });

        function calculateTotalAmount() {
            let total = 0;
            document.querySelectorAll('.return-qty-input').forEach(input => {
                let qty = parseFloat(input.value) || 0;
                let price = parseFloat(input.dataset.price) || 0;
                total += qty * price;
            });

            document.getElementById('totalReturnAmount').innerText = total.toFixed(2);
            document.getElementById('totalAmountInput').value = total.toFixed(2);
        }



        // Validation function
        function checkReturnQty(input) {
            const maxQty = parseInt(input.getAttribute('data-max'));
            const enteredQty = parseInt(input.value);

            if (enteredQty > maxQty) {
                alert(`Return quantity cannot be greater than received quantity (${maxQty})`);
                input.value = maxQty;
            } else if (enteredQty < 0) {
                alert(`Return quantity cannot be negative`);
                input.value = '';
            }
        }
    </script>
@endsection
