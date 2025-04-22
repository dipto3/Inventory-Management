@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">category</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-lg me-2"></i>Add category
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="categoryTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Category</th>
                            <th>Parent Category</th>
                            <th>Description</th>
                            <th>Ordering</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allCategories as $key => $category)
                            <tr id="category-row-{{ $category->id }}">
                                <td style="display:none;">{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->parentCategory->name ?? 'Parent Category' }}</td>
                                <td> {{ $category->description }} </td>
                                <!-- Ordering -->
                                <td>
                                    <input type="number" class="form-control" value="{{ $category->ordering }}"
                                        name="ordering" id="ordering" style="width: 50px;"
                                        data-category-id="{{ $category->id }}">
                                </td>
                                <td>
                                    <label class="custom-switch">
                                        <input data-id="{{ $category->id }}" class="status-toggle" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="InActive" {{ $category->status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-category" data-id="{{ $category->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $category->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit category Modal -->
    @include('admin.category.edit')

    @include('admin.category.create')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready');

            $('input[name="ordering"]').each(function() {
                console.log('Found ordering input:', $(this).data('category-id'));
            });

            $('input[name="ordering"]').on('change', function() {
                console.log('Input changed');
                let ordering = $(this).val();
                let categoryId = $(this).data('category-id');

                console.log('Ordering:', ordering);
                console.log('Category ID:', categoryId);

                $.ajax({
                    url: "{{ route('category.updateOrdering') }}",
                    type: "POST",
                    data: {
                        ordering: ordering,
                        category_id: categoryId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#categoryTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search category...",
                    lengthMenu: "Show _MENU_ category per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ categorys",
                    infoEmpty: "No categorys found",
                    infoFiltered: "(filtered from _MAX_ total categorys)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit category button click
            $(document).on('click', '.edit-category', function() {
                let categoryId = $(this).data('id');

                // Clear previous form data and errors
                $('#updateCategoryForm')[0].reset();
                $('.error-message').remove();

                // Fetch category data
                $.ajax({
                    url: `category/${categoryId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific category data
                        $('#edit_category_id').val(categoryId);
                        $('#edit_name').val(response.category.name);
                        $('#edit_status').val(response.category.status);
                        $('#edit_description').val(response.category.description);

                        // Set the parent_id value using standard DOM methods
                        document.getElementById('parent_id').value = response.category
                            .parent_id;

                        // Show the edit modal
                        $('#editCategoryModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching category data");
                    }
                });
            });

            // Update category form submission
            $(document).on('submit', '#updateCategoryForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let categoryId = $('#edit_category_id').val();

                $.ajax({
                    url: `category/${categoryId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editCategoryModal').modal('hide');
                        if (response.success) {
                            $("#categoryTable").load(location.href + " #categoryTable");
                            toastr.success("category updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updateCategoryForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the category");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var categoryId = $(this).data('id');
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
                        url: "{{ url('category') }}/" + categoryId,
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
                                        '#categoryTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#categoryTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#categoryTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#categoryTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search category...",
                                            lengthMenu: "Show _MENU_ category per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ categorys",
                                            infoEmpty: "No categorys found",
                                            infoFiltered: "(filtered from _MAX_ total categorys)",
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
                                    toastr.success("category deleted successfully");
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
                    url: '{{ route('category.status.change') }}',
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
