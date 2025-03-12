@extends('admin.layouts.master')
@section('admin.content')
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">New Purchase</h4>
            <a href="{{ route('purchase-order.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Back to Purchases
            </a>
        </div>
        <div class="container-fluid py-4">
            <form id="purchaseForm" action="" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Selected Products Table -->
                <div class="form-section mt-4">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-list-check text-primary"></i> View Purchase Details</h5>
                    </div>
                    <p style="margin-top: 10px;"><strong>Supplier:{{ $purchase->purchaseOrder->supplier->name }}</strong>
                        <span id="selectedSupplier"></span>
                    </p>
                    <div class="col-md-6" style="margin-bottom: 10px;">
                        <label class="form-label">Receive Date :
                            {{ \Carbon\Carbon::parse($purchase->receive_date)->format('d F, y') }}</label>

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
                              
                                <th>Purchase Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->purchaseItems as $item)
                                <tr>
                                    <td>{{ $item->product?->name }}</td>
                                    <td>{{ $item->productVariant?->barcode }}</td>
                                    <td>{{ $item->receive_quantity }}</td>
                                    
                                    <td>{{ $item->purchase_price }}</td>
                                    <td>{{ $item->subtotal }}
                                    </td>
                                </tr>
                            @endforeach
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



                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
                <!-- Submit Buttons -->
                <div class="text-end mt-4">

                    <button type="submit" class="btn btn-primary">Back to purchase</button>
                </div>
            </form>
        </div>
    </div>
@endsection
