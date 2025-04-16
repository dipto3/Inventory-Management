@extends('admin.layouts.master')

@section('admin.content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Admin dashboard elements (will be hidden when printing) -->
                <div class="row no-print">
                    <div class="col-12 position-relative">
                        <div class="page-title-box d-flex align-items-center">
                            <!-- Centered title -->
                            <div class="position-absolute start-50 translate-middle-x text-center w-100">
                                <h4 class="mb-10">Purchase Order #{{ $purchaseOrder->id }}</h4>
                            </div>

                            <!-- Breadcrumb in the right corner -->
                            <div class="ms-auto"> <!-- ms-auto pushes content to the right -->
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Purchase Order</a>
                                    </li>
                                    <li class="breadcrumb-item active">Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Printable Invoice Content -->
                <div class="row justify-content-center">
                    <div class="col-xxl-10">
                        <div class="card" id="printableArea" style="border: 1px solid #e0e0e0;">
                            <!-- Invoice Header with Watermark -->
                            <div class="card-header position-relative"
                                style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                                {{-- <div class="watermark"
                                    style="position: absolute; opacity: 0.1; font-size: 6rem; font-weight: bold; color: #0d6efd; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; pointer-events: none;">
                                    {{ strtoupper($purchaseOrder->purchase_status) }}
                                </div> --}}
                                <div class="row align-items-center position-relative" style="z-index: 2;">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}"
                                                class="card-logo card-logo-dark me-3" height="50" alt="Company Logo">
                                            <div>
                                                <h3 class="mb-0 fw-bold" style="color: #2a3042; font-size: 0.9rem;">PURCHASE
                                                    ORDER</h3>
                                                <p class="mb-0" style="color: #6c757d; font-size: 0.9rem;">
                                                    PO-{{ $purchaseOrder->id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                        <div
                                            style="background: #ffffff; padding: 15px; border-radius: 8px; display: inline-block; text-align: right; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <p class="mb-1"><span style="color: #6c757d;">Date:</span> <strong
                                                    style="color: #2a3042;">{{ \Carbon\Carbon::parse($purchaseOrder->purchase_date)->format('M d, Y') }}</strong>
                                            </p>
                                            <p class="mb-1"><span style="color: #6c757d;">Status:</span>
                                                <span class="badge"
                                                    style="background-color: {{ $purchaseOrder->purchase_status == 'pending' ? '#fff3cd' : ($purchaseOrder->purchase_status == 'paid' ? '#d1e7dd' : '#f8d7da') }}; color: {{ $purchaseOrder->purchase_status == 'pending' ? '#664d03' : ($purchaseOrder->purchase_status == 'paid' ? '#0f5132' : '#842029') }}; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">
                                                    {{ ucfirst($purchaseOrder->purchase_status) }}
                                                </span>
                                            </p>
                                            <p class="mb-0"><span style="color: #6c757d;">Total Amount:</span> <strong
                                                    style="color: #2a3042; font-size: 1.1rem;">${{ number_format($purchaseOrder->total_price, 2) }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Company and Supplier Info -->
                            <div class="card-body p-4" style="background: #fdfdfd;">
                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <h6
                                            style="color: #6c757d; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; margin-bottom: 1rem;">
                                            From</h6>
                                        <div
                                            style="background: #ffffff; padding: 20px; border-radius: 8px; border-left: 4px solid #0d6efd; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <h5 style="color: #2a3042; margin-bottom: 0.5rem;">{{ config('app.name') }}
                                            </h5>
                                            <p style="color: #6c757d; margin-bottom: 0.3rem; font-size: 0.9rem;">
                                                <i class="ri-map-pin-line" style="margin-right: 5px;"></i> California,
                                                United States
                                            </p>
                                            <p style="color: #6c757d; margin-bottom: 0.3rem; font-size: 0.9rem;">
                                                <i class="ri-mail-line" style="margin-right: 5px;"></i>
                                                contact@themesbrand.com
                                            </p>
                                            <p style="color: #6c757d; margin-bottom: 0; font-size: 0.9rem;">
                                                <i class="ri-phone-line" style="margin-right: 5px;"></i> +1 (555) 123-4567
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6
                                            style="color: #6c757d; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; margin-bottom: 1rem;">
                                            Supplier</h6>
                                        <div
                                            style="background: #ffffff; padding: 20px; border-radius: 8px; border-left: 4px solid #6c757d; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <h5 style="color: #2a3042; margin-bottom: 0.5rem;">
                                                {{ $purchaseOrder->supplier?->name ?? 'N/A' }}</h5>
                                            <p style="color: #6c757d; margin-bottom: 0.3rem; font-size: 0.9rem;">
                                                <i class="ri-map-pin-line" style="margin-right: 5px;"></i>
                                                {{ $purchaseOrder->supplier?->address ?? 'N/A' }}
                                            </p>
                                            <p style="color: #6c757d; margin-bottom: 0; font-size: 0.9rem;">
                                                <i class="ri-phone-line" style="margin-right: 5px;"></i>
                                                {{ $purchaseOrder->supplier?->phone ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Products Table -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0" style="border-collapse: separate; border-spacing: 0;">
                                        <thead style="background: #f8f9fa;">
                                            <tr>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; text-align: center;">
                                                    #</th>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem;">
                                                    Product</th>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; text-align: center;">
                                                    Barcode</th>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; text-align: center;">
                                                    Unit Price</th>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; text-align: center;">
                                                    Qty</th>
                                                <th
                                                    style="padding: 12px 15px; border: none; border-bottom: 2px solid #e0e0e0; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; text-align: right;">
                                                    Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchaseOrder->purchaseOrderItems as $key => $item)
                                                <tr style="background: #ffffff; border-bottom: 1px solid #f0f0f0;">
                                                    <td
                                                        style="padding: 15px; text-align: center; color: #6c757d; border: none;">
                                                        {{ $key + 1 }}</td>
                                                    <td style="padding: 15px; border: none;">
                                                        <div style="font-weight: 600; color: #2a3042; margin-bottom: 3px;">
                                                            {{ $item->product?->name ?? 'N/A' }}</div>
                                                        @if ($item->productVariant?->variant_value_name)
                                                            <div
                                                                style="color: #6c757d; font-size: 0.8rem; background: #f8f9fa; padding: 3px 8px; border-radius: 4px; display: inline-block;">
                                                                {{ $item->productVariant?->variant_value_name }}</div>
                                                        @endif
                                                    </td>
                                                    <td
                                                        style="padding: 15px; text-align: center; color: #6c757d; border: none;">
                                                        <span>{{ $item->productVariant?->barcode ?? 'N/A' }}</span>
                                                    </td>
                                                    <td
                                                        style="padding: 15px; text-align: center; color: #2a3042; border: none;">
                                                        ${{ number_format($item->purchase_price, 2) }}</td>
                                                    <td
                                                        style="padding: 15px; text-align: center; color: #2a3042; border: none;">
                                                        {{ $item->purchase_quantity }}</td>
                                                    <td
                                                        style="padding: 15px; text-align: right; color: #2a3042; border: none;">
                                                        ${{ number_format($item->subtotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Summary Section -->
                            <div class="card-body p-4" style="background: #fdfdfd;">
                                <div class="row justify-content-end">
                                    <div class="col-md-5">
                                        <div
                                            style="background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <table class="table mb-0" style="width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 8px 0; color: #6c757d; border: none;">Subtotal:
                                                        </td>
                                                        <td
                                                            style="padding: 8px 0; text-align: right; color: #2a3042; border: none;">
                                                            ${{ number_format($purchaseOrder->total_price, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 8px 0; color: #6c757d; border: none;">Tax (0%):
                                                        </td>
                                                        <td
                                                            style="padding: 8px 0; text-align: right; color: #2a3042; border: none;">
                                                            $0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 8px 0; color: #6c757d; border: none;">Shipping:
                                                        </td>
                                                        <td
                                                            style="padding: 8px 0; text-align: right; color: #2a3042; border: none;">
                                                            $0.00</td>
                                                    </tr>
                                                    <tr style="border-top: 1px solid #e0e0e0;">
                                                        <td
                                                            style="padding: 12px 0; font-weight: 600; color: #2a3042; border: none;">
                                                            Total:</td>
                                                        <td
                                                            style="padding: 12px 0; text-align: right; font-weight: 600; color: #2a3042; border: none;">
                                                            ${{ number_format($purchaseOrder->total_price, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="padding: 8px 0; color: #6c757d; font-size: 0.8rem; border: none;">
                                                            <i class="ri-alert-line" style="margin-right: 5px;"></i>
                                                            Payment due within 30 days
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes and Footer -->
                            <div class="card-footer p-4" style="background: #f8f9fa; border-top: 2px solid #e0e0e0;">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <h6
                                            style="color: #6c757d; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; margin-bottom: 1rem;">
                                            Notes</h6>
                                        <div
                                            style="background: #ffffff; padding: 15px; border-radius: 8px; min-height: 100px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 0.5rem;">Thank you
                                                for your business.</p>
                                            <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 0;">This is a
                                                computer generated document. No signature required.
                                                {{ config('app.name') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6
                                            style="color: #6c757d; text-transform: uppercase; letter-spacing: 1px; font-size: 0.8rem; margin-bottom: 1rem;">
                                            Terms & Conditions</h6>
                                        <div
                                            style="background: #ffffff; padding: 15px; border-radius: 8px; min-height: 100px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 0.5rem;">1. Goods
                                                must be delivered within 7 days.</p>
                                            <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 0.5rem;">2.
                                                Defective items will be returned at supplier's cost.</p>
                                            <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 0;">3. Invoice must
                                                accompany delivery.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="card-footer bg-light border-top py-3 no-print">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <p class="mb-md-0 text-muted" style="font-size: 0.85rem;">
                                            <i class="ri-information-line align-middle me-1"></i> This is a computer
                                            generated document. No signature required.
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <div class="hstack gap-2 justify-content-md-end">
                                            <button onclick="printInvoice()" class="btn btn-outline-secondary"
                                                style="border-radius: 6px;">
                                                <i class="ri-printer-line align-bottom me-1"></i> Print
                                            </button>
                                            <button class="btn btn-primary" style="border-radius: 6px;">
                                                <i class="ri-download-2-line align-bottom me-1"></i> Download PDF
                                            </button>
                                            <button class="btn btn-success" style="border-radius: 6px;">
                                                <i class="ri-send-plane-line align-bottom me-1"></i> Email to Supplier
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
        body {
            /* background-color: #f5f7fb; */
        }

        .card {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .no-print {
            background-color: transparent !important;
        }

        /* Print styles */
        @media print {
            body * {
                visibility: hidden;
            }

            .card-body .row {
                display: flex !important;
                flex-wrap: nowrap !important;
            }

            .col-md-6 {
                width: 50% !important;
                float: left !important;
                page-break-inside: avoid !important;
            }

            #printableArea,
            #printableArea * {
                visibility: visible;

            }

            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;

            }

            .no-print,
            .no-print * {
                display: none !important;
            }

            .watermark {
                opacity: 0.05 !important;
            }

            @page {
                size: auto;
                margin: 10mm;
            }
        }

        /* Barcode font */
        @font-face {
            font-family: 'Libre Barcode 39';
            src: url('https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap');
        }
    </style>

    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endsection
