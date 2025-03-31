@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Supplier</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                <i class="bi bi-plus-lg me-2"></i>Add Supplier
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="supplierTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr id="supplier-row-{{ $supplier->id }}">
                                <td style="display:none;">{{ $supplier->id }}</td>
                                <td>{{ $supplier->name }} ({{ $supplier->id }}) </td>
                                <td class="image"><img style="height: 50px;width:50px;"
                                        src="{{ asset('storage/' . $supplier->image) }}" alt></td>
                                <td> {{ $supplier->email }} </td>
                                <td> {{ $supplier->phone }} </td>
                                <td> {{ $supplier->address }} </td>
                                <td> {{ $supplier->city }} </td>
                                <td>
                                    @if ($supplier->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($supplier->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-supplier" data-id="{{ $supplier->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $supplier->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit Supplier Modal -->
    @include('admin.supplier.edit')

    @include('admin.supplier.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#supplierTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search supplier...",
                    lengthMenu: "Show _MENU_ supplier per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ orders",
                    infoEmpty: "No orders found",
                    infoFiltered: "(filtered from _MAX_ total orders)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit supplier button click
            $(document).on('click', '.edit-supplier', function() {
                let supplierId = $(this).data('id');

                // Clear previous form data and errors
                $('#updateSupplierForm')[0].reset();
                $('.error-message').remove();

                // Fetch supplier data
                $.ajax({
                    url: `supplier/${supplierId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific supplier data
                        $('#edit_supplier_id').val(supplierId);
                        $('#edit_name').val(response.supplier.name);
                        $('#edit_email').val(response.supplier.email);
                        $('#edit_phone').val(response.supplier.phone);
                        $('#edit_city').val(response.supplier.city);
                        $('#edit_status').val(response.supplier.status);
                        $('#edit_address').val(response.supplier.address);

                        // Show current image if exists
                        if (response.supplier.image) {
                            $('#current_image_container').html(
                                `<img src="${response.image_url}" style="height: 100px;width:100px;" alt="Current Image" />`
                            );
                        } else {
                            $('#current_image_container').empty();
                        }

                        // Show the edit modal
                        $('#editSupplierModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching supplier data");
                    }
                });
            });

            // Update supplier form submission
            $(document).on('submit', '#updateSupplierForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let supplierId = $('#edit_supplier_id').val();

                $.ajax({
                    url: `supplier/${supplierId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editSupplierModal').modal('hide');
                        if (response.success) {
                            $("#supplierTable").load(location.href + " #supplierTable",
                                function() {
                                    // $("#supplierTable").DataTable({
                                    //     responsive: true,
                                    //     language: {
                                    //         search: "_INPUT_",
                                    //         searchPlaceholder: "Search supplier...",
                                    //         lengthMenu: "Show _MENU_ supplier per page",
                                    //         info: "",
                                    //         infoEmpty: "",
                                    //         infoFiltered: "",
                                    //         paginate: {
                                    //             first: "First",
                                    //             last: "Last",
                                    //             next: "Next",
                                    //             previous: "Previous",
                                    //         },
                                    //     },
                                    // });
                                });
                            toastr.success("Supplier updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updateSupplierForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the supplier");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        // $(document).on("click", ".show_confirm", function(event) {
        //     var supplierId = $(this).data('id');
        //     var $row = $(this).closest('tr'); // Store reference to the row
        //     event.preventDefault();

        //     swal({
        //         title: `Are you sure you want to delete this record?`,
        //         text: "If you delete this, it will be gone forever.",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     }).then((willDelete) => {
        //         if (willDelete) {
        //             $.ajax({
        //                 url: "{{ url('supplier') }}/" + supplierId,
        //                 type: 'DELETE',
        //                 data: {
        //                     _token: '{{ csrf_token() }}',
        //                 },
        //                 success: function(response) {
        //                     $("#supplierTable").load(location.href + " #supplierTable");
        //                     // Remove from DataTable properly
        //                     var table = $('#supplierTable').DataTable();
        //                     table.row($row).remove().draw(
        //                         false); // false keeps current pagination
        //                 },
        //                 error: function(xhr, status, error) {
        //                     swal("Error!", "Something went wrong, please try again.", "error");
        //                 }
        //             });
        //         }
        //     });
        // });
        $(document).on("click", ".show_confirm", function(event) {
            var supplierId = $(this).data('id');
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
                        url: "{{ url('supplier') }}/" + supplierId,
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
                                        '#supplierTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#supplierTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#supplierTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#supplierTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search supplier...",
                                            lengthMenu: "Show _MENU_ supplier per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ orders",
                                            infoEmpty: "No orders found",
                                            infoFiltered: "(filtered from _MAX_ total orders)",
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
                                    toastr.success("Supplier deleted successfully");
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
