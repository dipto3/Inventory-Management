@extends('admin.layouts.master')
@section('admin.content')
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">New Purchase</h4>
            <a href="{{ route('purchase.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Purchases
            </a>
        </div>
        <div class="container-fluid py-4">
            <form id="purchaseForm" action="{{ route('purchase.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Purchase Information -->
                <div class="form-section">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-info-circle text-primary"></i> Purchase Information</h5>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Supplier</label>
                            <select class="form-select selectpicker" id="supplierSelect" name="supplier"
                                data-live-search="true">
                                <option value="">Choose</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Product</label>
                            <select class="form-select selectpicker" id="productSelect" data-live-search="true">
                                <option value="">Choose</option>
                                @foreach ($productVariants as $variant)
                                    <option value="{{ $variant->id }}"
                                        data-name="{{ $variant->product->name }} >> {{ $variant->variant_value_name }}"
                                        data-price="{{ $variant->prices->first()->price ?? 0 }}"
                                        data-barcode="{{ $variant->barcode }}"
                                        data-purchase-price="{{ $variant->prices->first()->purchase_price ?? 0 }}">
                                        {{ $variant->product->name }} >> {{ $variant->variant_value_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Purchase Date</label>
                            <input type="date" class="form-control" name="purchase_date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Purchase Code</label>
                            <input type="text" class="form-control" name="purchase_code"
                                value="{{ old('purchase_code') }}" placeholder="Enter Purchase Code" />
                            @error('purchase_code')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Selected Products Table -->
                <div class="form-section mt-4">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-list-check text-primary"></i> Selected Products</h5>
                    </div>
                    <p style="margin-top: 10px;"><strong>Supplier:</strong> <span id="selectedSupplier">None</span></p>
                    <table class="table table-bordered" id="selectedProductsTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Purchase Quantity</th>
                                <th>Selling Price</th>
                                <th>Purchase Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be added dynamically -->
                        </tbody>
                    </table>
                </div>
                <!-- Summary Section -->
                <div class="mt-4">
                    <h5><i class="bi bi-receipt text-primary"></i> Summary</h5>
                    <p><strong>Supplier:</strong> <span id="summarySupplier">None</span></p>
                    <p><strong>Total Quantity:</strong> <span id="totalQuantity">0</span></p>
                    <p><strong>Total Price:</strong> <span id="totalPrice">0.00</span></p>

                    <!-- Hidden Input Fields for Summary -->
                    <input type="hidden" name="total_quantity" id="totalQuantityInput" value="0">
                    <input type="hidden" name="total_price" id="totalPriceInput" value="0.00">
                </div>


                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Purchase</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        console.log("jQuery Loaded");

        // Supplier selection update
        $('#supplierSelect').change(function() {
            let selectedSupplier = $(this).find('option:selected').text();
            $('#selectedSupplier').text(selectedSupplier !== "Choose" ? selectedSupplier : "None");
            $('#summarySupplier').text(selectedSupplier !== "Choose" ? selectedSupplier : "None");
        });

        // Product selection and addition to table
        $('#productSelect').change(function() {
            const selectedOption = $(this).find('option:selected');
            const productId = parseInt(selectedOption.val(), 10);
            const productName = selectedOption.data('name');
            const sellingPrice = selectedOption.data('price') || 0;
            const purchasePrice = selectedOption.data('purchase-price') || 0;
            const barcode = selectedOption.data('barcode') || '';

            if (productId && productId !== "") {
                if ($(`tr[data-product-id="${productId}"]`).length === 0) {
                    // Append new row to the table
                    const newRow = `
                    <tr data-product-id="${productId}">
                        <td>${productName}</td>
                        <td><input type="text" class="form-control" name="products[${productId}][barcode]" value="${barcode}" readonly></td>
                        <td><input type="number" class="form-control quantity" name="products[${productId}][quantity]" value="1" min="1"></td>
                        <td><input type="number" class="form-control selling-price" name="products[${productId}][selling_price]" value="${sellingPrice}" step="0.01"></td>
                        <td><input type="number" class="form-control purchase-price" name="products[${productId}][purchase_price]" value="${purchasePrice}" step="0.01"></td>
                        <td class="subtotal">${purchasePrice}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-product"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>`;

                    $('#selectedProductsTable tbody').append(newRow);
                    calculateSubtotal();
                } else {
                    alert("This product is already added!");
                }
            }

            $(this).val(''); // Reset dropdown after selection
        });

        // Remove product from table
        $(document).on('click', '.remove-product', function() {
            $(this).closest('tr').remove();
            calculateSubtotal();
        });

        // Update subtotal when quantity or purchase price is changed
        $(document).on('input', '.quantity, .purchase-price', function() {
            calculateSubtotal();
        });

        // Function to calculate total price and total quantity
        function calculateSubtotal() {
            let totalAmount = 0;
            let totalQuantity = 0;

            $('tr[data-product-id]').each(function() {
                const quantity = parseFloat($(this).find('.quantity').val()) || 0;
                const purchasePrice = parseFloat($(this).find('.purchase-price').val()) || 0;
                const subtotal = (quantity * purchasePrice).toFixed(2);

                $(this).find('.subtotal').text(subtotal);
                totalAmount += parseFloat(subtotal);
                totalQuantity += quantity;
            });

            $('#totalQuantity').text(totalQuantity);
            $('#totalPrice').text(totalAmount.toFixed(2));

            // Update hidden input fields
            $('#totalQuantityInput').val(totalQuantity);
            $('#totalPriceInput').val(totalAmount.toFixed(2));
        }
    });
</script>
