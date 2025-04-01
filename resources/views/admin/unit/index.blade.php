@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">unit</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUnitModal">
                <i class="bi bi-plus-lg me-2"></i>Add unit
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="unitTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($units as $unit)
                            <tr id="unit-row-{{ $unit->id }}">
                                <td style="display:none;">{{ $unit->id }}</td>
                                <td>{{ $unit->name }} </td>
                                <td>{{ $unit->short_name }} </td>
                                <td>
                                    @if ($unit->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($unit->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-unit" data-id="{{ $unit->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $unit->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit unit Modal -->
    @include('admin.unit.edit')

    @include('admin.unit.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#unitTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search unit...",
                    lengthMenu: "Show _MENU_ unit per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ units",
                    infoEmpty: "No units found",
                    infoFiltered: "(filtered from _MAX_ total units)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit unit button click
            $(document).on('click', '.edit-unit', function() {
                let unitId = $(this).data('id');
                // Clear previous form data and errors
                $('#updateUnitForm')[0].reset();
                $('.error-message').remove();

                // Fetch unit data
                $.ajax({
                    url: `unit/${unitId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific unit data
                        $('#edit_unit_id').val(unitId);
                        $('#edit_name').val(response.unit.name);
                        $('#edit_status').val(response.unit.status);
                        $('#edit_short_name').val(response.unit.short_name);

                        // Show current image if exists
                        if (response.unit.image) {
                            $('#current_image_container').html(
                                `<img src="${response.image_url}" style="height: 100px;width:100px;" alt="Current Image" />`
                            );
                        } else {
                            $('#current_image_container').empty();
                        }

                        // Show the edit modal
                        $('#editUnitModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching unit data");
                    }
                });
            });

            // Update unit form submission
            $(document).on('submit', '#updateUnitForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let unitId = $('#edit_unit_id').val();

                $.ajax({
                    url: `unit/${unitId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editUnitModal').modal('hide');
                        if (response.success) {
                            $("#unitTable").load(location.href + " #unitTable");
                            toastr.success("Unit updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updateUnitForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the unit");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var unitId = $(this).data('id');
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
                        url: "{{ url('unit') }}/" + unitId,
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
                                        '#unitTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#unitTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#unitTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#unitTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search unit...",
                                            lengthMenu: "Show _MENU_ unit per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ units",
                                            infoEmpty: "No units found",
                                            infoFiltered: "(filtered from _MAX_ total units)",
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
                                    toastr.success("Unit deleted successfully");
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
