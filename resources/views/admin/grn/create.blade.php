@extends('admin.layouts.master')
@section('admin.content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">GRN</h5>
        {{-- <a class="btn btn-primary add-btn" href="{{ route('purchase-order.create') }}"><i
                class="ri-add-line align-bottom me-1"></i> Create</a> --}}
    </div>
    <div class="card-body">
        <div class="container-fluid py-4">
            <form id="purchaseForm" action="{{ route('store.grn', $purchaseOrder->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <!-- Selected Products Table -->
                <div class="form-section mt-4">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-list-check text-primary"></i> Create GRN</h5>
                    </div>
                    <p style="margin-top: 10px;"><strong>Supplier:</strong> <span
                            id="selectedSupplier">{{ $purchaseOrder->supplier?->name }}</span></p>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label class="form-label">Receive Date</label>
                        <input type="date" class="form-control" name="receive_date" value="{{ date('Y-m-d') }}"
                            min="{{ date('Y-m-d') }}" />
                        @error('receive_date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <table class="table table-bordered" id="selectedProductsTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Purchase Quantity</th>
                                <th>Accepted Quantity</th>
                                <th>Pending Quantity</th>
                                <th>Receive Quantity</th>
                                <th>Purchase Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseOrder->purchaseOrderItems as $item)
                                @php
                                    $pendingQty = $item->purchase_quantity - $item->received_quantity;
                                @endphp

                                <tr>
                                    <td>{{ $item->product?->name }} >>
                                        {{ $item->productVariant->variant_value_name }}</td>
                                    <td>{{ $item->productVariant->barcode }}</td>
                                    <td>{{ $item->purchase_quantity }}</td>
                                    <td>{{ $item->received_quantity }}</td>
                                    <td>{{ $pendingQty }}</td>
                                    <td><input type="number" value="0" min="0"
                                            name="items[{{ $loop->index }}][receive_quantity]" /></td>
                                    <td>{{ $item->purchase_price }}</td>
                                    <td><span class="subtotal" data-purchase-price="{{ $item->purchase_price }}"></span>
                                    </td>

                                    <input type="hidden" name="items[{{ $loop->index }}][product_variant_id]"
                                        value="{{ $item->product_variant_id }}" />
                                    <input type="hidden" name="items[{{ $loop->index }}][product_subtotal]"
                                        class="product_subtotal" value="0" />
                                    <input type="hidden" name="items[{{ $loop->index }}][purchase_price]"
                                        value="{{ $item->purchase_price }}" />
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Tax</label>
                        <input type="number" class="form-control" name="tax" value="{{ old('tax') }}" />
                        @error('tax')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Discount Type</label>
                        <select class="form-select" name="discount_type">
                            <option>Choose</option>
                            <option value="Amount" {{ old('discount_type') == 'Amount' ? 'selected' : '' }}>Amount</option>
                            <option value="Percentage" {{ old('discount_type') == 'Percentage' ? 'selected' : '' }}>
                                Percentage
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Discount</label>
                        <input type="number" class="form-control" name="discount" value="{{ old('discount') }}" />
                        @error('discount')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Shipping Cost</label>
                        <input type="number" class="form-control" name="shipping_cost"
                            value="{{ old('shipping_cost') }}" />
                        @error('shipping_cost')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}" />
                        @error('note')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-section mt-4">
                    <div class="row">
                        <div class="col-md-4"> <!-- Left side small table -->
                            <div class="form-section-title">
                                <h5 class="mb-0"><i class="bi bi-receipt text-primary"></i> Summary</h5>
                            </div>
                            <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Sub total</th>
                                        <th>Total Quantity</th>
                                        <th>Total Tax</th>
                                        <th>Total Discount</th>
                                        <th>Shipping Cost</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="totalSubtotal">0.00</td>
                                        <td id="totalQuantity">0</td>
                                        <td id="totalTax">0.00</td>
                                        <td id="totalDiscount">0.00</td>
                                        <td id="totalShipping">0.00</td>
                                        <td id="totalPrice">0.00</td>

                                        <!-- Hidden Input Fields for Summary -->
                                        <input type="hidden" name="product_subtotal" id="totalSubtotalInput"
                                            value="0.00">
                                        <input type="hidden" name="total_quantity" id="totalQuantityInput" value="0">
                                        <input type="hidden" name="total_price" id="totalPriceInput" value="0.00">
                                        <input type="hidden" name="total_tax" id="totalTaxInput" value="0.00">
                                        <input type="hidden" name="total_discount" id="totalDiscountInput"
                                            value="0.00">

                                    </tr>
                                </tbody>
                            </table>

                            {{-- <!-- Hidden Input Fields for Summary -->
                            <input type="hidden" name="total_quantity" id="totalQuantityInput" value="0">
                            <input type="hidden" name="total_price" id="totalPriceInput" value="0.00"> --}}
                        </div>
                    </div>
                </div>
                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function calculateTotals() {
            let totalSubtotal = 0;
            let totalQuantity = 0;

            document.querySelectorAll("#selectedProductsTable tbody tr").forEach((row) => {
                let receiveQtyInput = row.querySelector(
                    "input[name^='items'][name$='[receive_quantity]']");
                let purchasePrice = parseFloat(row.cells[6].innerText) || 0; // Purchase Price Column
                let subtotalCell = row.querySelector(".subtotal"); // Subtotal Cell
                let pendingQty = parseFloat(row.cells[4].innerText) || 0; // Pending Quantity Column

                let receiveQty = parseFloat(receiveQtyInput.value) || 0;

                // Debugging: Log values
                console.log('Purchase Price:', purchasePrice, 'Receive Quantity:', receiveQty);

                // Validate that Receive Quantity cannot be more than Pending Quantity
                if (receiveQty > pendingQty) {
                    alert("Receive Quantity cannot be greater than Pending Quantity!");
                    receiveQtyInput.value = pendingQty; // Reset to max allowed value
                    receiveQty = pendingQty;
                }

                let subtotal = receiveQty * purchasePrice;
                subtotalCell.innerText = subtotal.toFixed(2);

                // Update hidden input for subtotal
                row.querySelector("input[name^='items'][name$='[product_subtotal]']").value = subtotal
                    .toFixed(2);

                totalSubtotal += subtotal;
                totalQuantity += receiveQty;
            });

            // Debugging: Log total quantities and subtotals
            console.log('Total Subtotal:', totalSubtotal, 'Total Quantity:', totalQuantity);

            let taxRate = parseFloat(document.querySelector("input[name='tax']").value) || 0;
            let shippingCost = parseFloat(document.querySelector("input[name='shipping_cost']").value) || 0;
            let discount = parseFloat(document.querySelector("input[name='discount']").value) || 0;
            let discountType = document.querySelector("select[name='discount_type']").value;

            let taxAmount = (totalSubtotal * taxRate) / 100;
            let discountAmount = discountType === "Percentage" ? (totalSubtotal * discount) / 100 : discount;
            let total = totalSubtotal + taxAmount + shippingCost - discountAmount;

            // Update HTML Elements
            document.getElementById("totalSubtotal").innerText = totalSubtotal.toFixed(2);
            document.getElementById("totalQuantity").innerText = totalQuantity;
            document.getElementById("totalTax").innerText = `${taxRate.toFixed(2)}% (${taxAmount.toFixed(2)})`;
            document.getElementById("totalDiscount").innerText = discountType === "Percentage" ?
                `${discount.toFixed(2)}% (${discountAmount.toFixed(2)})` : discountAmount.toFixed(2);
            document.getElementById("totalShipping").innerText = shippingCost.toFixed(2);
            document.getElementById("totalPrice").innerText = total.toFixed(2);

            // Update hidden input fields
            document.getElementById("totalQuantityInput").value = totalQuantity;
            document.getElementById("totalSubtotalInput").value = totalSubtotal.toFixed(2);
            document.getElementById("totalPriceInput").value = total.toFixed(2);
            document.getElementById("totalTaxInput").value = taxAmount.toFixed(2);
            document.getElementById("totalDiscountInput").value = discountAmount.toFixed(2);
        }

        // Add event listeners for input fields
        document.querySelectorAll("input[name^='items'][name$='[receive_quantity]']").forEach((input) => {
            input.addEventListener("input", calculateTotals);
        });
        document.querySelector("input[name='tax']").addEventListener("input", calculateTotals);
        document.querySelector("input[name='shipping_cost']").addEventListener("input", calculateTotals);
        document.querySelector("input[name='discount']").addEventListener("input", calculateTotals);
        document.querySelector("select[name='discount_type']").addEventListener("change", calculateTotals);

        // Initial calculation
        calculateTotals();
        document.getElementById("purchaseForm").addEventListener("submit", function(event) {
            let totalReceiveQuantity = 0;
            document.querySelectorAll("input[name^='items'][name$='[receive_quantity]']").forEach(input => {
                totalReceiveQuantity += parseFloat(input.value) || 0;
            });

            if (totalReceiveQuantity === 0) {
                alert("At least one Receive Quantity must be greater than 0!");
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>
@endpush