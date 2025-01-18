@extends('admin.layouts.master')
@section('admin.content')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="barcode-container">
                                <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode" class="img-fluid mb-2" />
                                <div class="barcode text-center">{{ $variant->barcode }}</div>
                            </div>
                            <button class="btn btn-outline-secondary">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Product</th>
                                    <td>{{ $product->name }} | Variant : {{ $variant->variant_value_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Category</th>
                                    <td>{{ $product->subcategories->pluck('name')->implode(', ') }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ $product->brand }}</td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td>{{ $product->unit }}</td>
                                </tr>
                                <tr>
                                    <th>SKU</th>
                                    <td>{{ $product->sku }}</td>
                                </tr>
                                <tr>
                                    <th>Minimum Qty</th>
                                    <td>{{ $variant->quantity_alert }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $variant->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>0.00 %</td>
                                </tr>
                                <tr>
                                    <th>Discount Type</th>
                                    <td>{{ $product->discount_type }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Value</th>
                                    <td>{{ $product->discount_value }}</td>
                                </tr>
                                <tr>
                                    <th>Tax Type</th>
                                    <td>{{ $product->tax_type }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $variant->prices?->first()->price }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><span class="badge {{ $product->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                                        </span></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        @foreach ($product->getMedia() as $media)
                            <img src="{{ $media->getUrl() }}" alt="Product Image"
                                class="product-image img-fluid rounded mb-3">
                        @endforeach
                        <p class="text-center text-muted small">
                            {{ basename($product->getFirstMediaUrl()) }}<br>
                            <span class="text-secondary">581kb</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-image {
            max-height: 300px;
            object-fit: contain;
        }

        .barcode-container {
            max-width: 200px;
        }
    </style>
@endsection
