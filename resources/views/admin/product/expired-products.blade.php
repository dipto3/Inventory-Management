@extends('admin.layouts.master')
@section('admin.content')
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
                                    <div class="variant-container">
                                        @foreach ($product->variants as $variant)
                                            <div class="variant-card {{ $variant->quantity === 0 ? 'out-of-stock' : ($variant->quantity < $variant->quantity_alert ? 'low-stock' : '') }}">
                                                <a href="{{ route('view.details', [$product->id, $variant->id]) }}" class="variant-link">
                                                    <div class="variant-info">
                                                        <span class="variant-name">{{ $variant->variant_value_name }}</span>
                                                        <div class="variant-details">
                                                            <span class="variant-qty">
                                                                <i class="bi bi-box-seam"></i> {{ $variant->quantity }}
                                                            </span>
                                                            <span class="variant-price">
                                                                <i class="bi bi-tag"></i> ৳{{ $variant->prices->first()->price ?? 'N/A' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @if($variant->quantity === 0)
                                                        <span class="stock-badge">Out of Stock</span>
                                                    @elseif($variant->quantity < $variant->quantity_alert)
                                                        <span class="stock-badge">Low Stock</span>
                                                    @endif
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
        .variant-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .variant-card {
            width: 120px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .variant-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .variant-link {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: inherit;
        }
        
        .variant-info {
            display: flex;
            flex-direction: column;
        }
        
        .variant-name {
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .variant-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #666;
        }
        
        .variant-qty, .variant-price {
            display: flex;
            align-items: center;
            gap: 3px;
        }
        
        .stock-badge {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 0.7rem;
            padding: 2px 5px;
            border-bottom-left-radius: 5px;
            color: white;
        }
        
        .out-of-stock {
            background-color: #ffebee;
            border-color: #ef9a9a;
        }
        
        .out-of-stock .stock-badge {
            background-color: #c62828;
        }
        
        .low-stock {
            background-color: #fff8e1;
            border-color: #ffe082;
        }
        
        .low-stock .stock-badge {
            background-color: #f9a825;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .variant-card {
                width: 100px;
            }
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
