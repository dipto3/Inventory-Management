@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Return Reason</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReturnReasonModal">
                <i class="bi bi-plus-lg me-2"></i>Add Return Reason
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="reasonTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Reason</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reasons as $reason)
                            <tr id="return_reason-row-{{ $reason->id }}">
                                <td style="display:none;">{{ $reason->id }}</td>
                                <td>{{ $reason->reason }} </td>
                                <td>{{ $reason->description ?? 'N/A' }} </td>
                                <td>
                                    @if ($reason->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($reason->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-return-reason"
                                            data-id="{{ $reason->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $reason->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit return-reason Modal -->
    @include('admin.return-reason.edit')

    @include('admin.return-reason.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#reasonTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search return reason...",
                    lengthMenu: "Show _MENU_ return reason per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ return reasons",
                    infoEmpty: "No return reasons found",
                    infoFiltered: "(filtered from _MAX_ total return reasons)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit return_reason button click
            $(document).on('click', '.edit-return-reason', function() {
                let return_reasonId = $(this).data('id');
                // Clear previous form data and errors
                $('#updateReturnReasonForm')[0].reset();
                $('.error-message').remove();

                // Fetch return_reason data
                $.ajax({
                    url: `return-reason/${return_reasonId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific return_reason data
                        $('#edit_return_reason_id').val(return_reasonId);
                        $('#edit_reason').val(response.return_reason.reason);
                        $('#edit_status').val(response.return_reason.status);
                        $('#edit_description').val(response.return_reason.description);

                        // Show current image if exists
                        if (response.return_reason.image) {
                            $('#current_image_container').html(
                                `<img src="${response.image_url}" style="height: 100px;width:100px;" alt="Current Image" />`
                            );
                        } else {
                            $('#current_image_container').empty();
                        }

                        // Show the edit modal
                        $('#editReturnReasonModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching return_reason data");
                    }
                });
            });

            // Update return_reason form submission
            $(document).on('submit', '#updateReturnReasonForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let return_reasonId = $('#edit_return_reason_id').val();

                $.ajax({
                    url: `return-reason/${return_reasonId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editReturnReasonModal').modal('hide');
                        if (response.success) {
                            $("#reasonTable").load(location.href + " #reasonTable");
                            toastr.success("ReturnReason updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updateReturnReasonForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the return_reason");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var return_reasonId = $(this).data('id');
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
                        url: "{{ url('return-reason') }}/" + return_reasonId,
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
                                        '#reasonTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#reasonTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#reasonTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#reasonTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search return reason...",
                                            lengthMenu: "Show _MENU_ return reason per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ return reasons",
                                            infoEmpty: "No return reasons found",
                                            infoFiltered: "(filtered from _MAX_ total return reasons)",
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
                                    toastr.success(
                                        "Return Reason deleted successfully");
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
