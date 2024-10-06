@extends('admin.layouts.master')
@section('admin.content')
    <div class="container mt-5">
        <h1 class="mb-4">Product Details</h1>
        <p class="text-muted">Full details of a product</p>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                         <div class="row">
                            <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode" />
                            <div class="barcode">{{ $variant->barcode }}</div>
                         </div>
                            
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-printer"></i>
                            </button>
                        </div>
                        <table class="table">
                            <tbody >
                                <tr>
                                    <th>Product</th>
                                    <td>{{ $product->name }}  | Variant : {{ $variant->variant_value_name ?? 'N/A' }}  </td>
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
                                    <td>{{ $product->brand}}</td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td>{{ $product->unit}}</td>
                                </tr>
                                <tr>
                                    <th>SKU</th>
                                    <td>{{ $product->sku}}</td>
                                </tr>
                                <tr>
                                    <th>Minimum Qty</th>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>50</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>0.00 %</td>
                                </tr>
                                <tr>
                                    <th>Discount Type</th>
                                    <td>{{ $product->discount_type}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{$product->prices?->first()->price }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $product->status == 1 ? 'Active': 'Inactive'}}</td> 
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->description}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ $product->getFirstMediaUrl() }}" alt="Macbook Pro" class="product-image img-fluid">
                        <p class="text-center mt-2">macbookpro.jpg<br>581kb</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @endsection
  <script src="{{ asset('admin/assets/js/theme-script.js') }}"
  type="a50b14d9f276acf5108d3056-text/javascript"></script>
<script src="{{ asset('admin/assets/js/script.js') }}"
  type="a50b14d9f276acf5108d3056-text/javascript"></script>
<script
  src="{{ asset('admin/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
  data-cf-settings="a50b14d9f276acf5108d3056-|49" defer></script>