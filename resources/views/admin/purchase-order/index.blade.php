@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchase Order</h5>
            <a class="btn btn-primary add-btn" href="{{ route('purchase-order.create') }}"><i
                    class="ri-add-line align-bottom me-1"></i> Create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="poTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Purchase Order Code</th>
                            <th>Purchase Status</th>
                            <th>Purchase Date</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr id="purchase-row-{{ $purchase->id }}">
                                <td style="display:none;">{{ $purchase->id }}</td>
                                <td> <strong>
                                        <a href="{{ route('create.grn', $purchase->id) }}" style="color: rgb(32, 104, 212)">
                                            {{ $purchase->purchase_order_code }}
                                        </a>
                                    </strong> </td>
                                <td class="status">
                                    @if ($purchase->purchase_status == 'pending')
                                        <span class="badge bg-info">Pending</span>
                                    @elseif ($purchase->purchase_status == 'partial')
                                        <span class="badge bg-warning">Partial</span>
                                    @elseif ($purchase->purchase_status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Something Wrong!</span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d F, Y') }}
                                </td>
                                <td>
                                    {{ $purchase->total_quantity }}
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="{{ route('purchase-order.show', $purchase->id) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>

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

    </style>
@endsection
@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#poTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search purchase order...",
                    lengthMenu: "Show _MENU_ brand per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ purchase orders",
                    infoEmpty: "No purchase order found",
                    infoFiltered: "(filtered from _MAX_ total purchase orders)",
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
