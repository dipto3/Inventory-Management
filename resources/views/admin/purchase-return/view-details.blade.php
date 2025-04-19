@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchase Returrn Items</h5>
            {{-- <a class="btn btn-primary" href="{{ route('purchase-return.create') }}">
                <i class="bi bi-plus-lg me-2"></i>Add Return
            </a> --}}
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form id="purchaseForm" action="" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Selected Products Table -->
                    <div class="form-section">

                        <p style=""><strong>Supplier: {{ $purchaseReturn->supplier?->name }}</strong>
                            <span id="selectedSupplier"></span>
                        </p>
                        <div class="col-md-6" style="margin-bottom: 10px;">
                            <label class="form-label">Return Date : {{ $purchaseReturn->return_date }}
                            </label> <br>
                            <label class="form-label">Approval status : {{ $purchaseReturn->is_approved == 0 ? 'Pending' : ($purchaseReturn->is_approved == 1 ? 'Approved' : 'Rejected') }}

                            </label>


                        </div>
                        <table class="table table-bordered" id="selectedProductsTable">
                            <thead>
                                <tr>
                                    <th>Purchase Code</th>
                                    <th>Purchase Order Code</th>
                                    <th>Product</th>
                                    <th>Barcode</th>
                                    <th>Return Quantity</th>
                                    <th>Discount value</th>
                                    <th>Per Product Discount</th>
                                    <th>Purchase Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchaseReturn->purchaseReturnItems as $item)
                                    @php
                                        // (Product Price / Purchase Grand Total) × Total Discount
                                        $perProductDiscount =
                                            ($item->unit_price / $item->purchaseReturn?->purchase?->grand_total) *
                                            $item->purchaseReturn?->purchase?->total_discount;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->purchaseReturn?->purchase?->purchase_code }}</td>
                                        <td>{{ $item->purchaseReturn?->purchaseOrder?->purchase_order_code }}</td>
                                        <td>
                                            {{ $item->purchaseItem?->product?->name }}
                                            @if ($item->purchaseItem->productVariant?->variant_value_name != null)
                                                - Variant : {{ $item->purchaseItem->productVariant?->variant_value_name }}
                                            @endif
                                        </td>
                                        <td>{{ $item->purchaseItem->productVariant?->barcode }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            {{ $item->purchaseReturn?->purchase?->discount_value }}
                                        </td>
                                        <td> {{ number_format($perProductDiscount, 2) }}
                                        </td>
                                        <td>
                                            {{ $item->unit_price }}
                                        </td>
                                        <td>
                                            {{ ceil($item->unit_price - $perProductDiscount) * $item->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Submit Buttons -->
                    <div class="text-end mt-4">

                        <button type="submit" class="btn btn-primary">Back to return</button>
                    </div>
                </form>

                @if ($purchaseReturn->is_approved != 1)
                    <form action="{{ route('approve.purchase.return', $purchaseReturn->id) }}" method="post">
                        @csrf
                        <select name="is_approved" id="" class="form-select">
                            <option value="0"{{ $purchaseReturn->is_approved == 0 ? 'selected' : '' }}>Pending
                            </option>
                            <option value="1"{{ $purchaseReturn->is_approved == 1 ? 'selected' : '' }}>Approved
                            </option>
                            <option value="2"{{ $purchaseReturn->is_approved == 2 ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                    </form>
                @endif
            </div>
        </div>
    @endsection
