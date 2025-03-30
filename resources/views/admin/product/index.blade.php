@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Products</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg me-2"></i>Add Product Modal
            </button>
            <a href="{{ route('product.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg me-2"></i> Product Form</a>
        </div>

        <!-- Add this modal at the bottom of your body (before the scripts) -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">
                            Add New Product
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="productName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" id="productName"
                                        placeholder="Enter product name" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select class="form-select" id="productCategory">
                                        <option selected disabled>Select category</option>
                                        <option>Electronics</option>
                                        <option>Fashion</option>
                                        <option>Home & Garden</option>
                                        <option>Sports</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control" id="productPrice"
                                            placeholder="Enter price" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productStock" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" id="productStock"
                                        placeholder="Enter quantity" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="productsTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#EC-1254</td>
                            <td>John Smith</td>
                            <td>2023-05-15</td>
                            <td>$245.00</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                                <button class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1253</td>
                            <td>Sarah Johnson</td>
                            <td>2023-05-14</td>
                            <td>$189.50</td>
                            <td><span class="badge bg-warning">Processing</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1252</td>
                            <td>Michael Brown</td>
                            <td>2023-05-14</td>
                            <td>$420.75</td>
                            <td><span class="badge bg-primary">Shipped</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1251</td>
                            <td>Emily Davis</td>
                            <td>2023-05-13</td>
                            <td>$156.00</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1250</td>
                            <td>Robert Wilson</td>
                            <td>2023-05-12</td>
                            <td>$325.25</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1249</td>
                            <td>Jennifer Lee</td>
                            <td>2023-05-11</td>
                            <td>$275.80</td>
                            <td><span class="badge bg-primary">Shipped</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1248</td>
                            <td>David Miller</td>
                            <td>2023-05-10</td>
                            <td>$189.99</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1247</td>
                            <td>Lisa Taylor</td>
                            <td>2023-05-09</td>
                            <td>$420.00</td>
                            <td><span class="badge bg-warning">Processing</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1246</td>
                            <td>James Anderson</td>
                            <td>2023-05-08</td>
                            <td>$156.75</td>
                            <td><span class="badge bg-primary">Shipped</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1245</td>
                            <td>Patricia White</td>
                            <td>2023-05-07</td>
                            <td>$299.50</td>
                            <td><span class="badge bg-success">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1244</td>
                            <td>Thomas Martin</td>
                            <td>2023-05-06</td>
                            <td>$175.25</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#EC-1243</td>
                            <td>Nancy Clark</td>
                            <td>2023-05-05</td>
                            <td>$225.00</td>
                            <td><span class="badge bg-primary">Shipped</span></td>
                            <td>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-light">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#productsTable").DataTable({
                responsive: true,
                order: [
                    [2, "desc"]
                ], // Default sort by date descending
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    }, // Order ID
                    {
                        responsivePriority: 2,
                        targets: 5
                    }, // Actions
                    {
                        responsivePriority: 3,
                        targets: 1
                    }, // Customer
                    {
                        targets: 2, // Date column
                        render: function(data, type, row) {
                            if (type === "display") {
                                return new Date(data).toLocaleDateString("en-US", {
                                    year: "numeric",
                                    month: "short",
                                    day: "numeric",
                                });
                            }
                            return data;
                        },
                    },
                    {
                        targets: 3, // Amount column
                        render: function(data, type, row) {
                            if (type === "display") {
                                return parseFloat(data.replace("$", "")).toLocaleString(
                                    "en-US", {
                                        style: "currency",
                                        currency: "USD",
                                    }
                                );
                            }
                            return data;
                        },
                    },
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search products...",
                    lengthMenu: "Show _MENU_ products per page",
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
@endpush
