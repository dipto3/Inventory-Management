@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Brand</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                <i class="bi bi-plus-lg me-2"></i>Add Brand
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="brandTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit brand Modal -->
    @include('admin.brand.edit')

    @include('admin.brand.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#brandTable").DataTable({
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

            // Edit brand button click
            $(document).on('click', '.edit-brand', function() {
                let brandId = $(this).data('id');
                // Clear previous form data and errors
                $('#updatebrandForm')[0].reset();
                $('.error-message').remove();

                // Fetch brand data
                $.ajax({
                    url: `brand/${brandId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific brand data
                        $('#edit_brand_id').val(brandId);
                        $('#edit_name').val(response.brand.name);
                        $('#edit_status').val(response.brand.status);
                        $('#edit_description').val(response.brand.description);

                        // Show current image if exists
                        if (response.brand.image) {
                            $('#current_image_container').html(
                                `<img src="${response.image_url}" style="height: 100px;width:100px;" alt="Current Image" />`
                            );
                        } else {
                            $('#current_image_container').empty();
                        }

                        // Show the edit modal
                        $('#editbrandModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching brand data");
                    }
                });
            });

            // Update brand form submission
            $(document).on('submit', '#updatebrandForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let brandId = $('#edit_brand_id').val();

                $.ajax({
                    url: `brand/${brandId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editbrandModal').modal('hide');
                        if (response.success) {
                            $("#brandTable").load(location.href + " #brandTable");
                            toastr.success("Brand updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updatebrandForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the brand");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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
                                        '#brandTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#brandTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#brandTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#brandTable').DataTable({
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
    </script>
@endpush
