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
                            {{-- <th style="display:none;">ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($brands as $brand)
                            <tr id="brand-row-{{ $brand->id }}">
                                <td style="display:none;">{{ $brand->id }}</td>
                                <td>{{ $brand->name }} ({{ $brand->id }}) </td>
                                <td class="image"><img style="height: 50px;width:50px;"
                                        src="{{ asset('storage/' . $brand->logo) }}" alt></td>
                                <td> {{ $brand->description }} </td>

                                <td>
                                    @if ($brand->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($brand->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-brand" data-id="{{ $brand->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $brand->id }}" data-toggle="tooltip" title='Delete'>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
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
                    lengthMenu: "Show _MENU_ brand per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
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
