@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchases</h5>
            {{-- <a class="btn btn-primary add-btn" href="{{ route('purchase-order.create') }}"><i
                class="ri-add-line align-bottom me-1"></i> Create</a> --}}
        </div>
        <div class="card-body">
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
                                            <th>Discount Type</th>
                                            <th>Total Discount</th>
                                            <th>Shipping Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="totalSubtotal">{{ $purchase->product_subtotal }}</td>
                                            <td id="totalQuantity">{{ $purchase->total_receive_quantity }}</td>
                                            <td id="totalTax">{{ $purchase->total_tax }}</td>
                                            <td id="totalDiscount">{{ $purchase->discount_type }}</td>
                                            <td id="totalDiscount">{{ $purchase->total_discount }}</td>
                                            <td id="totalShipping">{{ $purchase->total_shipping_cost }}</td>
                                            <td id="totalPrice">{{ $purchase->grand_total }}</td>
    
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

    </div>

@endsection

