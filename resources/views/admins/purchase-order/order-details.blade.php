@extends('admin.layouts.master')

@section('admin.content')
    {{-- <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Space Fix -->
            <div class="col-lg-2 d-none d-lg-block"></div>
            <div class="col-lg-10 col-md-12">
                <div class="card mt-4 p-4 border">
                    
                    <!-- Invoice Header -->
                    <div class="d-flex flex-column flex-md-row justify-content-between border-bottom pb-3">
                        <div>
                            <h2 class="text-primary">Purchase Invoice</h2>
                            <p class="text-muted">Invoice #: INV-2025001</p>
                            <p class="text-muted">Date: 2025-01-09</p>
                        </div>
                        <div class="text-md-end">
                            <h4 class="text-dark">Company Name</h4>
                            <p class="text-muted">123 Business Street, Dhaka</p>
                            <p class="text-muted">Email: info@company.com</p>
                        </div>
                    </div>

                    <!-- Buyer & Supplier Details -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <h5 class="text-secondary">Billed To:</h5>
                            <p><strong>Name:</strong> Admin</p>
                            <p class="text-muted"><strong>Email:</strong> admin@gmail.com</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-secondary">Supplier Details:</h5>
                            <p><strong>Name:</strong> test2</p>
                            <p class="text-muted"><strong>Email:</strong> test2@gmail.com</p>
                            <p><strong>Phone:</strong> 0172594777</p>
                            <p><strong>Address:</strong> Dholao</p>
                        </div>
                    </div>

                    <!-- Purchase Items Table -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Barcode</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Solerly Belt</td>
                                    <td>A06800</td>
                                    <td>10</td>
                                    <td>690.00</td>
                                    <td>9,900.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary & Total -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <h5 class="text-secondary">Payment Status:</h5>
                            <p class="badge bg-warning text-dark">Pending</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h5 class="text-secondary">Total Amount:</h5>
                            <h3 class="text-success"><strong>৳ 17,840.00</strong></h3>
                        </div>
                    </div>

                    <!-- Print Button -->
                    <div class="text-center mt-4">
                        <button onclick="window.print()" class="btn btn-primary">
                            <i class="fas fa-print"></i> Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 768px) {
            .table {
                font-size: 14px; /* ছোট স্ক্রিনের জন্য ফন্ট ছোট */
            }
            .container-fluid {
                padding: 0 10px;
            }
        }
        .container-fluid {
            margin-top: 60px;
            padding-top: 20px;
        }
    </style> --}}

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h4 class="mb-sm-0">Invoice Details</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                                    <li class="breadcrumb-item active">Invoice Details</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row justify-content-center">
                    <div class="col-xxl-9">
                        <div class="card" id="demo">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-header border-bottom-dashed p-4">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark"
                                                    alt="logo dark" height="17">
                                                <img src="assets/images/logo-light.png" class="card-logo card-logo-light"
                                                    alt="logo light" height="17">
                                                <div class="mt-sm-5 mt-4">
                                                    <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                                    <p class="text-muted mb-1" id="address-details">California, United
                                                        States</p>
                                                    <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 90201
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                <h6><span class="text-muted fw-normal">Legal Registration No:</span><span
                                                        id="legal-register-no">987654</span></h6>
                                                <h6><span class="text-muted fw-normal">Email:</span><span
                                                        id="email">velzon@themesbrand.com</span></h6>
                                                <h6><span class="text-muted fw-normal">Website:</span> <a
                                                        href="https://themesbrand.com/" class="link-primary" target="_blank"
                                                        id="website">www.themesbrand.com</a></h6>
                                                <h6 class="mb-0"><span class="text-muted fw-normal">Contact No:
                                                    </span><span id="contact-no"> +(01) 234 6789</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card-header-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="row g-3">
                                            {{-- <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Invoice No</p>
                                                <h5 class="fs-14 mb-0">#VL<span id="invoice-no">25000355</span></h5>
                                            </div> --}}
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Date</p>
                                                <h5 class="fs-14 mb-0"><span
                                                        id="invoice-date">{{ \Carbon\Carbon::parse($purchaseOrder->purchase_date)->format('d F, Y') }}</span>
                                                    {{-- <small class="text-muted" id="invoice-time">02:36PM</small> --}}
                                                </h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                                <span class="badge bg-success-subtle text-success fs-11"
                                                    id="payment-status">{{ $purchaseOrder->purchase_status }}</span>
                                            </div>
                                            <!--end col-->

                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Quantity</p>
                                                <h5 class="fs-14 mb-0"><span id="total-amount">
                                                        {{ $purchaseOrder->total_quantity }}</span></h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-3 col-6">
                                                <p class="text-muted mb-2 text-uppercase fw-semibold">Total Amount</p>
                                                <h5 class="fs-14 mb-0">&#2547;<span id="total-amount">
                                                        {{ $purchaseOrder->total_price }}</span></h5>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4 border-top border-top-dashed">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Created By</h6>
                                                <p class="fw-medium mb-2" id="billing-name">
                                                    {{ $purchaseOrder->user?->name }}</p>
                                                <p class="text-muted mb-1" id="billing-address-line-1">
                                                    {{ $purchaseOrder->user?->address }}</p>
                                                <p class="text-muted mb-1"><span>Phone: +</span><span
                                                        id="billing-phone-no">{{ $purchaseOrder->user?->phone }}</span></p>
                                                {{-- <p class="text-muted mb-0"><span>Tax: </span><span
                                                        id="billing-tax-no">12-3456789</span> </p> --}}
                                            </div>
                                            <!--end col-->
                                            <div class="col-6">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Supplier Information
                                                </h6>
                                                <p class="fw-medium mb-2" id="shipping-name">
                                                    {{ $purchaseOrder->supplier?->name }}</p>
                                                <p class="text-muted mb-1" id="shipping-address-line-1">
                                                    {{ $purchaseOrder->supplier?->address }}</p>
                                                <p class="text-muted mb-1"><span>Phone: </span><span
                                                        id="shipping-phone-no">{{ $purchaseOrder->supplier?->phone }}</span>
                                                </p>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="card-body p-4">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                <thead>
                                                    <tr class="table-active">
                                                        <th scope="col" style="width: 50px;">#</th>
                                                        <th scope="col">Product Details</th>
                                                        <th scope="col">Barcode</th>
                                                        <th scope="col">Purchase Rate</th>

                                                        <th scope="col">Quantity</th>
                                                        <th scope="col" class="text-end">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="products-list">
                                                    @foreach ($purchaseOrder->purchaseOrderItems as $key => $purchaseOrderItem)
                                                        <tr>
                                                            <th scope="row">{{ $key + 1 }}</th>
                                                            <td class="text-start">
                                                                <span class="fw-medium">
                                                                    {{ $purchaseOrderItem->product?->name }}</span>
                                                                <p class="text-muted mb-0">
                                                                    {{ $purchaseOrderItem->productVariant?->variant_value_name }}
                                                                </p>
                                                            </td>
                                                            <td>{{ $purchaseOrderItem->productVariant?->barcode }}</td>
                                                            <td>&#2547; {{ $purchaseOrderItem->purchase_price }}</td>
                                                            <td>{{ $purchaseOrderItem->purchase_quantity }}</td>
                                                            <td class="text-end">{{ $purchaseOrderItem->subtotal }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table><!--end table-->
                                        </div>
                                        <div class="border-top border-top-dashed mt-2">
                                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                                style="width:250px">
                                                <tbody>
                                                    {{-- <tr>
                                                        <td>Sub Total</td>
                                                        <td class="text-end">$699.96</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax (12.5%)</td>
                                                        <td class="text-end">$44.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount <small class="text-muted">(VELZON15)</small></td>
                                                        <td class="text-end">- $53.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge</td>
                                                        <td class="text-end">$65.00</td>
                                                    </tr> --}}
                                                    <tr class="fs-15">
                                                        <th scope="row">Total Amount</th>
                                                        <th class="text-end">&#2547; {{ $purchaseOrder->total_price }}
                                                        </th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end table-->
                                        </div>
                                        {{-- <div class="mt-3">
                                            <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                                            <p class="text-muted mb-1">Payment Method: <span class="fw-medium"
                                                    id="payment-method">Mastercard</span></p>
                                            <p class="text-muted mb-1">Card Holder: <span class="fw-medium"
                                                    id="card-holder-name">David Nichols</span></p>
                                            <p class="text-muted mb-1">Card Number: <span class="fw-medium"
                                                    id="card-number">xxx xxxx xxxx 1234</span></p>
                                            <p class="text-muted">Total Amount: <span class="fw-medium" id="">$
                                                </span><span id="card-total-amount">755.96</span></p>
                                        </div> --}}
                                        {{-- <div class="mt-4">
                                            <div class="alert alert-info">
                                                <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                                    <span id="note">All accounts are to be paid within 7 days from
                                                        receipt of invoice. To be paid by cheque or
                                                        credit card or direct payment online. If account is not paid within
                                                        7
                                                        days the credits details supplied as confirmation of work undertaken
                                                        will be charged the agreed quoted fee noted above.
                                                    </span>
                                                </p>
                                            </div>
                                        </div> --}}
                                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                            <a href="javascript:window.print()" class="btn btn-success"><i
                                                    class="ri-printer-line align-bottom me-1"></i> Print</a>
                                            <a href="javascript:void(0);" class="btn btn-primary"><i
                                                    class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    @endsection
