@extends('admin.layouts.master')
@section('admin.content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">New Product</h4>
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Back to Products
            </a>
        </div>
        <div class="container-fluid py-4">

            <form id="productForm" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Product Information -->
                <div class="form-section">
                    <div class="form-section-title">

                        <h5 class="mb-0"> <i class="bi bi-info-circle text-primary"></i> Product Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <div class="input-group">
                                <select class="form-select selectpicker" name="supplier" data-live-search="true">
                                    <option value="Choose">Choose</option>
                                    @foreach ($productVariants as $variant)
                                        <option value="{{ $variant->id }}">
                                            @if ($variant->variant_value_name)
                                                {{ $variant->product->name }} >> {{ $variant->variant_value_name }}
                                            @else
                                                {{ $variant->product->name }}
                                            @endif

                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Supplier</label>
                            <div class="input-group">
                                <select class="form-select selectpicker" name="supplier" data-live-search="true">
                                    <option value="Choose">Choose</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Purchase Date</label>
                            <i data-feather="calendar" class="info-img"></i>
                            <input type="date" class="form-control" name="purchase_date">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Purchase Code</label>
                            <input type="text" class="form-control" name="purchase_code"
                                value="{{ old('purchase_code') }}" placeholder="Enter Purchase Code" />
                            @error('purchase_code')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
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
@endsection
