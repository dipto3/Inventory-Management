@extends('admin.layouts.master')
@section('admin.content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Purchase</h5>
        </div>
        <div class="container-fluid py-4">
            <form id="purchaseForm" action="{{ route('purchase-order.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Purchase Information -->
                <div class="form-section">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-info-circle text-primary"></i> Purchase Information</h5>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Supplier</label>
                            <select class="selectpicker" id="supplierSelect" name="supplier" data-live-search="true">
                                <option value="">Choose</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Product</label>
                            <select class="selectpicker" id="productSelect" data-live-search="true">
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
                            <input type="date" class="form-control" name="purchase_date" value="{{ date('Y-m-d') }}"
                                min="{{ date('Y-m-d') }}">
                        </div>

                    </div>

                </div>

                <!-- Selected Products Table -->
                <div class="form-section mt-4">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-list-check text-primary"></i> Selected Products</h5>
                    </div>
                    <p style="margin-top: 10px;"><strong>Supplier:</strong> <span id="selectedSupplier">None</span></p>


                    <div id="credit-info" class="text-green-600 text-sm my-2"></div>
                    <div id="credit-user-info" class="">
                    </div>
                    <input type="hidden" name="credit_amount" id="credit_amount_input">
                    <input type="hidden" name="credit_used" id="credit_used_input">
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

                <div class="form-section mt-4">
                    <div class="row">
                        <div class="col-md-4"> <!-- Left side small table -->
                            <div class="form-section-title">
                                <h5 class="mb-0"><i class="bi bi-receipt text-primary"></i> Summary</h5>
                            </div>
                            <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Total Qty</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="summarySupplier">None</td>
                                        <td id="totalQuantity">0</td>
                                        <td id="totalPrice">0.00</td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Hidden Input Fields for Summary -->
                            <input type="hidden" name="total_quantity" id="totalQuantityInput" value="0">
                            <input type="hidden" name="total_price" id="totalPriceInput" value="0.00">
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

    <style>

    </style>
@endsection
@push('scripts')
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
                <input type="hidden" class="subtotal-input" name="products[${productId}][subtotal]" value="${purchasePrice}">
                
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
                    $(this).find('.subtotal-input').val(subtotal); // Hidden input update

                    totalAmount += parseFloat(subtotal);
                    totalQuantity += quantity;
                });

                // credit_amount
                const creditAmount = parseFloat($('#credit_amount_input').val()) || 0;
                const netTotal = Math.max(totalAmount - creditAmount, 0);


                const creditUsed = Math.min(creditAmount, totalAmount);
                $('#credit_used_input').val(creditUsed.toFixed(2));
                if (creditUsed > 0) {
                    $('#credit-user-info').text(`You are using ৳${creditUsed.toFixed(2)} from your credit.`)
                        .addClass('text-success');
                } else {
                    $('#credit-user-info').text('').addClass('hidden');
                }
                $('#totalPrice').text(netTotal.toFixed(2));
                $('#totalPriceInput').val(netTotal.toFixed(2));

                $('#totalQuantity').text(totalQuantity);
                $('#totalQuantityInput').val(totalQuantity);
            }
            // Remove row when the "Remove" button is clicked
            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove(); // Remove the closest row to the clicked button
                calculateSubtotal(); // Recalculate totals after removal
            });
        });


        $('#supplierSelect').on('change', function() {
            const supplierId = $(this).val();

            if (supplierId) {
                fetch(`/supplier/${supplierId}/credit`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.length > 0) {
                            // Show the credit info in UI
                            $('#credit-info').html(
                                data.map(c => `
                            <div>
                                <strong class="text-success">Credit: ${c.credit_amount}</strong> 
                              
                            </div>
                        `).join('')
                            );

                            // optionally add it to hidden input for form submit
                            $('#credit_amount_input').val(data[0].credit_amount);
                        } else {
                            $('#credit-info').html('');
                            $('#credit_amount_input').val('');
                        }
                    });
            }
        });
    </script>
@endpush
