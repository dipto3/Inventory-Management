@extends('admin.layouts.master')

@section('admin.content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Purchase Order #{{ $purchaseOrder->id }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Purchases</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">
                <div class="col-xxl-10">
                    <div class="card border-0 shadow-sm" id="printableArea">
                        <!-- Invoice Header -->
                        <div class="card-header bg-light py-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark me-3" height="40" alt="Company Logo">
                                        <div>
                                            <h4 class="mb-0 fw-bold text-primary">INVOICE</h4>
                                            <p class="mb-0 text-muted">PO-{{ $purchaseOrder->id }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                    <p class="mb-1"><span class="text-muted">Date:</span> <strong>{{ \Carbon\Carbon::parse($purchaseOrder->purchase_date)->format('M d, Y') }}</strong></p>
                                    <p class="mb-1"><span class="text-muted">Status:</span> 
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'paid' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$purchaseOrder->purchase_status] ?? 'secondary' }}-subtle text-{{ $statusColors[$purchaseOrder->purchase_status] ?? 'secondary' }}">
                                            {{ ucfirst($purchaseOrder->purchase_status) }}
                                        </span>
                                    </p>
                                    <p class="mb-0"><span class="text-muted">Amount:</span> <strong>${{ number_format($purchaseOrder->total_price, 2) }}</strong></p>
                                </div>
                            </div>
                        </div>

                        <!-- Company and Supplier Info -->
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h6 class="text-uppercase text-muted mb-3">From</h6>
                                    <div class="p-3 bg-light rounded">
                                        <h5 class="mb-1 fw-bold">{{ config('app.name') }}</h5>
                                        <p class="mb-1">California, United States</p>
                                        <p class="mb-1">Zip-code: 90201</p>
                                        <p class="mb-1">Reg No: 987654</p>
                                        <p class="mb-0">contact@themesbrand.com</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-uppercase text-muted mb-3">Supplier</h6>
                                    <div class="p-3 bg-light rounded">
                                        <h5 class="mb-1 fw-bold">{{ $purchaseOrder->supplier?->name ?? 'N/A' }}</h5>
                                        <p class="mb-1">{{ $purchaseOrder->supplier?->address ?? 'N/A' }}</p>
                                        <p class="mb-0">Phone: {{ $purchaseOrder->supplier?->phone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Products Table -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center" width="5%">#</th>
                                            <th width="40%">Product</th>
                                            <th class="text-center" width="15%">Barcode</th>
                                            <th class="text-center" width="15%">Unit Price</th>
                                            <th class="text-center" width="10%">Qty</th>
                                            <th class="text-end" width="15%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseOrder->purchaseOrderItems as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>
                                                <div class="fw-medium">{{ $item->product?->name ?? 'N/A' }}</div>
                                                @if($item->productVariant?->variant_value_name)
                                                <div class="text-muted small">{{ $item->productVariant?->variant_value_name }}</div>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->productVariant?->barcode ?? 'N/A' }}</td>
                                            <td class="text-center">${{ number_format($item->purchase_price, 2) }}</td>
                                            <td class="text-center">{{ $item->purchase_quantity }}</td>
                                            <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="card-body p-4">
                            <div class="row justify-content-end">
                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td class="text-muted">Subtotal:</td>
                                                    <td class="text-end">${{ number_format($purchaseOrder->total_price, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Tax (0%):</td>
                                                    <td class="text-end">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-muted">Shipping:</td>
                                                    <td class="text-end">$0.00</td>
                                                </tr>
                                                <tr class="border-top">
                                                    <th>Total:</th>
                                                    <th class="text-end">${{ number_format($purchaseOrder->total_price, 2) }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer bg-light border-top py-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="mb-md-0 text-muted"><i class="ri-information-line align-middle me-1"></i> Thank you for your business</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="hstack gap-2 justify-content-md-end">
                                       <a href="javascript:window.print()" class="btn btn-outline-secondary">
                                            <i class="ri-printer-line align-bottom me-1"></i> Print
                                       </a>
                                        <button class="btn btn-primary">
                                            <i class="ri-download-2-line align-bottom me-1"></i> Download PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /* Enhanced styling */
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .card-header {
        border-bottom-width: 2px;
    }
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .table-bordered {
        border-color: #eff2f7;
    }
    .table-bordered th, 
    .table-bordered td {
        border-color: #eff2f7;
    }
    .bg-light {
        background-color: #f9fafb !important;
    }
    
    /* Print styles */
    @media print {
        body {
            background: #fff !important;
            color: #000 !important;
            font-size: 12pt;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        .table thead th {
            background-color: #f1f1f1 !important;
            -webkit-print-color-adjust: exact;
        }
        .no-print {
            display: none !important;
        }
        .card-header, .card-footer {
            background-color: #f9f9f9 !important;
            -webkit-print-color-adjust: exact;
        }
        .text-primary {
            color: #000 !important;
        }
    }
</style>



@endsection