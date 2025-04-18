@extends('admin.layouts.master')
@section('admin.content')
{{-- Breadcrumb --}}
<div class="container-p-y">
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">  <!-- mb-0 removes bottom margin -->
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Inventory</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Products</a>
                    </li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
{{-- End Breadcrumb --}}
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Products</h5>

            <a href="{{ route('product.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg me-2"></i>Add Product
            </a>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table id="productsTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
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
                                <td style="display:none;">{{ $product->id }}</td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    @foreach ($product->productImage->take(1) as $image)
                                        <img style="height: 100px; width: 100px;"
                                            src="{{ str_contains($image->image, 'demo-products') ? asset($image->image) : Storage::url($image->image) }}"
                                            alt="product">
                                    @endforeach
                                </td>
                                <td>{{ $product->sku }} </td>
                                <td>{{ $product->categories->pluck('name')->implode(', ') }}</td>
                                <td>{{ $product->product }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    <div class="row">
                                        @foreach ($product->variants as $variant)
                                           
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                                <a href="{{ route('view.details', [$product->id, $variant->id]) }}"
                                                    class="card-link" title="view">
                                                    <div
                                                        class="card variant-card
                                                        @if ($variant->quantity == 0) bg-out-of-stock
                                                        @elseif($variant->quantity_alert > $variant->quantity)
                                                            bg-low-stock
                                                        @else
                                                            bg-normal-stock @endif
                                                    ">
                                                        <div class="card-body p-2">
                                                            <div
                                                                class="d-flex justify-content-between align-items-start mb-1">
                                                                <h6 class="card-title mb-0 variant-name">
                                                                    {{ $variant->variant_value_name }}
                                                                </h6>
                                                                @if ($variant->quantity == 0)
                                                                    <span class="badge bg-danger">Out</span>
                                                                @elseif($variant->quantity < $variant->quantity_alert)
                                                                    <span class="badge bg-warning text-dark">Low</span>
                                                                @endif
                                                            </div>
                                                            <div class="variant-details">
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-muted small">Qty:</span>
                                                                    <span class="fw-bold">{{ $variant->quantity }}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-muted small">Price:</span>
                                                                    <span
                                                                        class="fw-bold">৳{{ $variant->prices->first()->price ?? 'N/A' }}</span>
                                                                </div>
                                                            </div>
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
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        {{-- <button class="btn btn-sm btn-info edit-product" data-id="{{ $product->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button> --}}

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $product->id }}" data-toggle="tooltip" title='Delete'>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        .variant-card {
            transition: all 0.2s ease;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .variant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .variant-name {
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }

        .variant-details {
            font-size: 0.8rem;
        }

        .bg-out-of-stock {
            background-color: #ffebee !important;
            border-color: #ef9a9a !important;
        }

        .bg-low-stock {
            background-color: #fff3e0 !important;
            border-color: #ffcc80 !important;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-link:hover {
            text-decoration: none;
        }
    </style>
@endsection
@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#productsTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search product...",
                    lengthMenu: "Show _MENU_ product per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ products",
                    infoEmpty: "No products found",
                    infoFiltered: "(filtered from _MAX_ total products)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var productId = $(this).data('id');
            event.preventDefault();

            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('product') }}/" + productId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            // Completely refresh the data by making an AJAX call
                            $.ajax({
                                url: window.location.href,
                                type: 'GET',
                                success: function(data) {
                                    // Extract the table HTML from the response
                                    let newTableHTML = $(data).find(
                                        '#productsTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#productsTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#productsTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#productsTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search product...",
                                            lengthMenu: "Show _MENU_ product per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ products",
                                            infoEmpty: "No products found",
                                            infoFiltered: "(filtered from _MAX_ total products)",
                                            paginate: {
                                                first: "First",
                                                last: "Last",
                                                next: "Next",
                                                previous: "Previous",
                                            },
                                        },
                                    });
                                    toastr.options = {
                                        positionClass: "toast-bottom-center"
                                    };
                                    toastr.success("Product deleted successfully");
                                },
                                error: function() {
                                    toastr.options = {
                                        positionClass: "toast-bottom-center"
                                    };
                                    toastr.error("Error refreshing table data");
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            swal("Error!", "Something went wrong, please try again.", "error");
                        }
                    });
                }
            });
        });
    </script>
@endpush
