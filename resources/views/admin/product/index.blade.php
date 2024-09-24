@extends('admin.layouts.master')
@section('admin.content')

<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                            src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/pdf.svg"
                            alt="img"></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                            src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/excel.svg"
                            alt="img"></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                            class="feather-rotate-ccw"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                            data-feather="rotate-ccw" class="feather-rotate-ccw"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                            data-feather="chevron-up" class="feather-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn">
                <a href="{{ route('product.create') }}"
                    class="btn btn-added"><i data-feather="plus-circle" class="me-2"></i>Add New Product</a>
            </div>
            <div class="page-btn import">
                <a href="#" class="btn btn-added color" data-bs-toggle="modal" data-bs-target="#view-notes"><i
                        data-feather="download" class="me-2"></i>Import Product</a>
            </div>
        </div>

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a href="javascript:void(0);" class="btn btn-searchset"><i data-feather="search"
                                    class="feather-search"></i></a>
                        </div>
                    </div>
                    <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                            <i data-feather="filter" class="filter-icon"></i>
                            <span><img
                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/closes.svg"
                                    alt="img"></span>
                        </a>
                    </div>
                    <div class="form-sort">
                        <i data-feather="sliders" class="info-img"></i>
                        <select class="select">
                            <option>Sort by Date</option>
                            <option>14 09 23</option>
                            <option>11 09 23</option>
                        </select>
                    </div>
                </div>

                <div class="card mb-0" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <i data-feather="box" class="info-img"></i>
                                            <select class="select">
                                                <option>Choose Product</option>
                                                <option>
                                                    Lenovo 3rd Generation</option>
                                                <option>Nike Jordan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <i data-feather="stop-circle" class="info-img"></i>
                                            <select class="select">
                                                <option>Choose Categroy</option>
                                                <option>Laptop</option>
                                                <option>Shoe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <i data-feather="git-merge" class="info-img"></i>
                                            <select class="select">
                                                <option>Choose Sub Category</option>
                                                <option>Computers</option>
                                                <option>Fruits</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <i data-feather="stop-circle" class="info-img"></i>
                                            <select class="select">
                                                <option>All Brand</option>
                                                <option>Lenovo</option>
                                                <option>Nike</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <i class="fas fa-money-bill info-img"></i>
                                            <select class="select">
                                                <option>Price</option>
                                                <option>$12500.00</option>
                                                <option>$12500.00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6 col-12">
                                        <div class="input-blocks">
                                            <a class="btn btn-filters ms-auto"> <i data-feather="search"
                                                    class="feather-search"></i> Search </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive product-list">
                    <table class="table datanew">
                        <thead>
                            <tr>
                
                                <th>Product</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                {{-- <th>Price</th> --}}
                                <th>Unit</th>
                              
                                <th>Variant</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                
                                <td>
                                    <div class="productimgname">
                                        <a href="javascript:void(0);" class="product-img stock-img">
                                            <img src="{{ $product->getFirstMediaUrl() }}"
                                                alt="product">
                                        </a>
                                        <a href="javascript:void(0);">{{ $product->name }} </a>
                                    </div>
                                </td>
                                <td>{{ $product->sku }} </td>
                                <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                                <td>{{ $product->brand}}</td>
                                {{-- <td></td> --}}
                                <td>{{ $product->unit}}</td>
                              
                                <td>
                                    <div class="row">
                                        @foreach ($product->variants as $variant)
                                        <div class="col-md-4 mb-2">
                                            <div class="card" style="padding: 0.5rem; margin: 0.5rem;">
                                                <div class="card-body p-1">
                                                    <h6 class="card-title mb-1" style="font-size: 0.9rem;">{{ $variant->variant_value_name }}</h6>
                                                    <p class="card-text mb-0" style="font-size: 0.8rem;">
                                                        Qty: {{ $variant->quantity }} | Price: &#2547; {{ $variant->variant_value_price }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="">
                                    <div class="edit-delete-action">
                                        <button type="button" class="btn btn-primary me-2 p-2 editbrandbtn"
                                            value="{{ $product->id }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </button>
                                        
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-xs btn-danger btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'><i data-feather="trash-2"
                                                    class="feather-trash-2"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection