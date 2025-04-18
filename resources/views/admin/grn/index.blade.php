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
                        <li class="breadcrumb-item active">Purchase List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- End Breadcrumb --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchases</h5>
            {{-- <a class="btn btn-primary add-btn" href="{{ route('purchase-order.create') }}"><i
                class="ri-add-line align-bottom me-1"></i> Create</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="purchaseTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Purchase Code</th>
                            <th>Payment Status</th>
                            <th>Received Quantity</th>
                            <th>Purchase Order Code</th>
                            <th>Purchase Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr id="purchase-row-{{ $purchase->id }}">
                                <td style="display:none;">{{ $purchase->id }}</td>
                                <td>
                                    <strong>
                                        <a>
                                            {{ $purchase->purchase_code }}
                                        </a>
                                    </strong>
                                </td>
                                <td class="status">
                                    @if ($purchase->payment_status == 'pending')
                                        <span class="badge bg-info">Unpaid</span>
                                    @elseif ($purchase->payment_status == 'partial')
                                        <span class="badge bg-warning">Partial</span>
                                    @elseif ($purchase->payment_status == 'completed')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-danger">Something Wrong!</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $purchase->total_receive_quantity }}
                                </td>
                                <td>
                                    {{ $purchase->purchaseOrder?->purchase_order_code }}
                                </td>
                                <td>

                                    {{ \Carbon\Carbon::parse($purchase->purchaseOrder?->purchase_date)->format('d F, Y') }}
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{ route('purchase.payment.view', $purchase->id) }}"
                                                class="btn btn-primary btn-sm" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>

                                        @if ($purchase->payment_status != 'completed')
                                            <div class="col-sm-2">
                                                <button class="btn btn-sm btn-success" title="Make Payment"
                                                    data-bs-toggle="modal" value="{{ $purchase->id }}"
                                                    data-bs-target="#makePaymentModal{{ $purchase->id }}"><i
                                                        class="bi bi-wallet2"></i>
                                                </button>
                                            </div>
                                        @endif

                                        <div class="col-sm-2">
                                            <button class="btn btn-sm btn-info" title="Payment History" title="Make Payment"
                                                data-bs-toggle="modal" value="{{ $purchase->id }}"
                                                data-bs-target="#paymentHistoryModal{{ $purchase->id }}">

                                                <i class="bi bi-cash-coin"></i>
                                            </button>

                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @include('admin.grn.make-payment')
                            @include('admin.grn.payment-history')
                        @endforeach
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
            $("#purchaseTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search purchases...",
                    lengthMenu: "Show _MENU_ brand per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ purchases",
                    infoEmpty: "No purchase order found",
                    infoFiltered: "(filtered from _MAX_ total purchases)",
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
