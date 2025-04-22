@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">variant</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVariantModal">
                <i class="bi bi-plus-lg me-2"></i>Add variant
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="variantTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Title</th>
                            <th>Values</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($variants as $variant)
                            <tr id="variant-row-{{ $variant->id }}">
                                <td style="display:none;">{{ $variant->id }}</td>
                                <td>{{ $variant->name }} </td>
                                <td>{{ $variant->variantValues->pluck('value')->implode(', ') }}</td>
                                <td> {{ \Carbon\Carbon::parse($variant->created_at)->format('Y-m-d') }} </td>

                                <td>
                                    <label class="custom-switch">
                                        <input data-id="{{ $variant->id }}" class="status-toggle" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="InActive" {{ $variant->status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-variant" data-id="{{ $variant->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $variant->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit variant Modal -->
    @include('admin.variant.edit')

    @include('admin.variant.create')
    <style>
        .bootstrap-tagsinput {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            /* background-color: #fff; */
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            min-height: 45px;
        }

        .bootstrap-tagsinput:focus-within {
            color: #212529;
            background-color: #fff;
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .bootstrap-tagsinput input {
            border: none;
            box-shadow: none;
            outline: none;
            background-color: transparent;
            padding: 0;
            margin: 0;
            width: auto;
            max-width: inherit;
        }

        .bootstrap-tagsinput .tag {
            margin: 0.2rem;
            padding: 0.35rem 0.65rem;
            background-color: #28405e;
            color: #fff;
            border-radius: 0.25rem;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.875rem;
            line-height: 1;
            white-space: nowrap;
            text-align: center;
            vertical-align: baseline;
        }

        .bootstrap-tagsinput .tag [data-role="remove"] {
            margin-left: 8px;
            cursor: pointer;
            color: #fff;
            opacity: 0.7;
            background-color: transparent;
            border: none;
            font-size: 0.875rem;
            font-weight: bold;
            padding: 0 2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.15s ease;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]:hover {
            opacity: 1;
        }

        .bootstrap-tagsinput .tag [data-role="remove"]::after {
            content: "×";
            font-size: 1.25rem;
            line-height: 1;
        }

        /* Placeholder styling */
        .bootstrap-tagsinput input::placeholder {
            color: #6c757d;
            opacity: 0.65;
        }

        /* Hover effect for tags */
        .bootstrap-tagsinput .tag:hover {
            background-color: #2b62a5;
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#variantTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search variant...",
                    lengthMenu: "Show _MENU_ variant per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ variants",
                    infoEmpty: "No variants found",
                    infoFiltered: "(filtered from _MAX_ total variants)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit variant button click
            $(document).on('click', '.edit-variant', function() {
                let variantId = $(this).data('id');
                // Clear previous form data and errors
                $('#updateVariantForm')[0].reset();
                $('.error-message').remove();

                // Fetch variant data
                $.ajax({
                    url: `variant/${variantId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific variant data
                        $('#edit_variant_id').val(variantId);
                        $('#edit_name').val(response.variant.name);
                        $('#edit_status').val(response.variant.status);
                        // Use the formatted values string for the tagsinput
                        $('#edit_values').tagsinput('removeAll');

                        // Add each tag individually
                        if (response.values) {
                            var tags = response.values.split(',');
                            tags.forEach(function(tag) {
                                $('#edit_values').tagsinput('add', tag.trim());
                            });
                        }


                        // Show the edit modal
                        $('#editVariantModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching variant data");
                    }
                });
            });

            // Update variant form submission
            $(document).on('submit', '#updateVariantForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let variantId = $('#edit_variant_id').val();

                $.ajax({
                    url: `variant/${variantId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editVariantModal').modal('hide');
                        if (response.success) {
                            $("#variantTable").load(location.href + " #variantTable");
                            toastr.success("Variant updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updateVariantForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the variant");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var variantId = $(this).data('id');
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
                        url: "{{ url('variant') }}/" + variantId,
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
                                        '#variantTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#variantTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#variantTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#variantTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search variant...",
                                            lengthMenu: "Show _MENU_ variant per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ variants",
                                            infoEmpty: "No variants found",
                                            infoFiltered: "(filtered from _MAX_ total variants)",
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
                                    toastr.success("Variant deleted successfully");
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

    <script>
        $(document).ready(function() {
            $('.status-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('variant.status.change') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Status updated to:', response.status);
                            toastr.options = {
                                "positionClass": "toast-bottom-center",
                                // "closeButton": true,
                                // "progressBar": true,
                                "timeOut": "3000"
                            };
                            toastr.success("Status updated successfully!");
                        } else {
                            alert('Status update failed!');
                        }
                    },
                    error: function() {
                        alert('Server error!');
                    }
                });
            });
        });
    </script>
@endpush
