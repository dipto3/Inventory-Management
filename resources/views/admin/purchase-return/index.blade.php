@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchase Returrn</h5>
            <a class="btn btn-primary" href="{{ route('purchase-return.create') }}">
                <i class="bi bi-plus-lg me-2"></i>Add Return
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="purchaseReturnTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Purchase Code</th>
                            <th>Purchase Order Code</th>
                            <th>Supplier</th>
                            <th>Return Date</th>
                            <th>Approval</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseReturns as $purchaseReturn)
                            <tr id="purchaseReturn-row-{{ $purchaseReturn->id }}">
                                <td style="display:none;">{{ $purchaseReturn->id }}</td>
                                <td>{{ $purchaseReturn->purchase?->purchase_code }} </td>
                                <td>{{ $purchaseReturn->purchaseOrder?->purchase_order_code }} </td>
                                <td> {{ $purchaseReturn->supplier?->name }} </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($purchaseReturn->return_date)->format('d F, Y') }}
                                </td>
                                <td>
                                    @if ($purchaseReturn->is_approved == 0)
                                        <span class="badge bg-info">Pending</span>
                                    @elseif ($purchaseReturn->is_approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                    @elseif ($purchaseReturn->is_approved == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                    @else
                                    <span class="badge bg-warning">Something wrong!!</span>
                                        
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-primary edit-brand"
                                            href="{{ route('purchase-return.show', $purchaseReturn->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="" data-toggle="tooltip" title='Delete'>
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
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#purchaseReturnTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search brand...",
                    lengthMenu: "Show _MENU_ purchase return per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ purchase return",
                    infoEmpty: "No purchase return found",
                    infoFiltered: "(filtered from _MAX_ total purchase return)",
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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var brandId = $(this).data('id');
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
                        url: "{{ url('brand') }}/" + brandId,
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
                                        '#purchaseReturnTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#purchaseReturnTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#purchaseReturnTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#purchaseReturnTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search brand...",
                                            lengthMenu: "Show _MENU_ brand per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ brands",
                                            infoEmpty: "No brands found",
                                            infoFiltered: "(filtered from _MAX_ total brands)",
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
                                    toastr.success("Brand deleted successfully");
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
    </script> --}}
@endpush
