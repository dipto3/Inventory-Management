@extends('admin.layouts.master')
@section('admin.content')
    <div class="col-md-12 py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
            <div>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Main Product Details -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header  py-3">
                        <h5 class="mb-0">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="barcode-container text-center">
                                <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode" class="img-fluid mb-2"
                                    style="max-height: 80px;" />
                                <div class="barcode font-monospace small">{{ $variant->barcode }}</div>
                            </div>
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-printer"></i> Print Barcode
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" style="font-size: 1.2rem;">
                                <tbody>
                                    <tr>
                                        <th class="" style="width: 30%">Product Name</th>
                                        <td>{{ $product->name }}
                                            @if ($variant->variant_value_name)
                                                | Variant: <span
                                                    class="badge bg-info">{{ $variant->variant_value_name }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">Category</th>
                                        <td>
                                            @foreach ($product->categories as $category)
                                                <span class="badge bg-secondary">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">Brand</th>
                                        <td>{{ $product->brand ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">Unit</th>
                                        <td>{{ $product->unit }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">SKU</th>
                                        <td><code>{{ $product->sku }}</code></td>
                                    </tr>
                                    <tr>
                                        <th class="">Stock Alert</th>
                                        <td>{{ $variant->quantity_alert }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">Quantity</th>
                                        <td>
                                            <span
                                                class="{{ $variant->quantity < $variant->quantity_alert ? 'text-danger fw-bold' : 'text-success' }}">
                                                {{ $variant->quantity }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">Tax</th>
                                        <td>0.00%</td>
                                    </tr>
                                    <tr>
                                        <th class="">Discount</th>
                                        <td>
                                            @if ($product->discount_value)
                                                {{ $product->discount_type }}: {{ $product->discount_value }}
                                            @else
                                                No Discount
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">Tax Type</th>
                                        <td>{{ ucfirst($product->tax_type) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">Selling Price</th>
                                        <td class="fw-bold">{{ number_format($variant->prices?->first()->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">Purchase Price</th>
                                        <td>{{ number_format($variant->prices?->first()->purchase_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="">Status</th>
                                        <td>
                                            <span class="badge {{ $product->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->status == 1 ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="">Description</th>
                                        <td>{{ $product->description ?? 'No description available' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Images -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Product Images</h5>
                    </div>
                    <div class="card-body">
                        @if ($product->productImage->count() > 0)
                            <div class="row">
                                @foreach ($product->productImage as $image)
                                    <div class="col-6 mb-3">
                                        <div class="border p-2 text-center">
                                            <img style="max-height: 120px; width: auto;" class="img-fluid"
                                                src="{{ Storage::url($image->image) }}" alt="Product Image">
                                            <p class="small text-muted mt-2 mb-0">
                                                {{ \Illuminate\Support\Str::limit(basename($image->image), 15) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">No images available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .barcode-container {
            max-width: 250px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 4px;
            /* background: white; */
        }

        .card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            /* background-color: #f8f9fa; */
            border-radius: 8px 8px 0 0 !important;
        }

        th {
            white-space: nowrap;
        }
    </style>
@endsection
