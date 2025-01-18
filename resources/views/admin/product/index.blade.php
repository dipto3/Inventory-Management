@extends('admin.layouts.master')
@section('admin.content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h4 class="mb-sm-0">Products</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                    <li class="breadcrumb-item active">products</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Add, Edit & Remove</h4>
                                <div class="d-flex justify-content-sm-end">
                                    <a class="btn btn-success add-btn" href="{{ route('product.create') }}"><i
                                            class="ri-add-line align-bottom me-1"></i> Create</a>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <table class="table table-nowrap" id="example">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Image</th>
                                                <th>SKU</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Unit</th>

                                                <th>Variant</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>
                                                        {{ $product->name }}
                                                    </td>
                                                    <td >
                                                        @foreach ($product->getMedia() as $media)
                                                            <img style="height: 100px; width: 100px;" src="{{ $media->getUrl() }}" alt="product">
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $product->sku }} </td>
                                                    <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                                                    <td>{{ $product->brand }}</td>
                                                    <td>{{ $product->unit }}</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($product->variants as $variant)
                                                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                                                    <a href="{{ route('view.details', [$product->id, $variant->id]) }}"
                                                                        class="card-link" title="view">
                                                                        <div class="card"
                                                                            style="padding: 0.5rem; margin: 0.5rem; 
                                                                {{ $variant->quantity === 0 ? 'background-color: #933636;color: white' : ($variant->quantity < $variant->quantity_alert ? 'background-color: #a7a944;' : '') }}">
                                                                            <div class="card-body p-1">
                                                                                <h6 class="card-title mb-1"
                                                                                    style="font-size: 0.9rem;{{ $variant->quantity === 0 ? 'color: white;' : '' }}">
                                                                                    {{ $variant->variant_value_name }}</h6>
                                                                                <p class="card-text mb-0"
                                                                                    style="font-size: 0.9rem; line-height: 1.2;">
                                                                                    <span>Qty:
                                                                                        {{ $variant->quantity }}</span><br>
                                                                                    <!-- Added <br> for new line -->
                                                                                    <span>Price: &#2547;
                                                                                        {{ $variant->prices?->first()->price }}</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="edit-delete-action">
                                                            <a class="btn btn-primary me-2 p-2"
                                                                href="{{ route('product.edit', $product->id) }}">
                                                                <i data-feather="edit" class="feather-edit"></i>
                                                            </a>

                                                            <form action="{{ route('product.destroy', $product->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-xs btn-danger btn-flat show_confirm"
                                                                    data-toggle="tooltip" title='Delete'><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
    @endsection
