@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Coupon</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                <i class="bi bi-plus-lg me-2"></i>Add Coupon
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="couponTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>code</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr id="coupon-row-{{ $coupon->id }}">
                                <td style="display:none;">{{ $coupon->id }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ \Carbon\Carbon::parse($coupon->start_date)->format('M d, Y') }}</td>
                                <td> {{ \Carbon\Carbon::parse($coupon->end_date)->format('M d, Y') }} </td>

                                <td>
                                    @if ($coupon->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($coupon->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('coupon.show', $coupon->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-info edit-coupon" data-id="{{ $coupon->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $coupon->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit coupon Modal -->
    @include('admin.coupon.edit')

    @include('admin.coupon.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#couponTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search coupon...",
                    lengthMenu: "Show _MENU_ coupon per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ coupons",
                    infoEmpty: "No coupons found",
                    infoFiltered: "(filtered from _MAX_ total coupons)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit coupon button click
            $(document).on('click', '.edit-coupon', function() {
                let couponId = $(this).data('id');
                // Clear previous form data and errors
                $('#updatecouponForm')[0].reset();
                $('.error-message').remove();

                // Fetch coupon data
                $.ajax({
                    url: `coupon/${couponId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific coupon data
                        $('#edit_coupon_id').val(couponId);
                        $('#edit_code').val(response.coupon.code);
                        $('#edit_status').val(response.coupon.status);
                        $('#edit_discount_type').val(response.coupon.discount_type);
                        $('#edit_discount_value').val(response.coupon.discount_value);
                        $('#edit_start_date').val(response.coupon.start_date);
                        $('#edit_start_time').val(response.coupon.start_time);
                        $('#edit_end_date').val(response.coupon.end_date);
                        $('#edit_end_time').val(response.coupon.end_time);
                        $('#edit_minimum_order_amount').val(response.coupon
                            .minimum_order_amount);
                        $('#edit_maximum_discount_amount').val(response.coupon
                            .maximum_discount_amount);
                        $('#edit_usage_limit').val(response.coupon
                            .usage_limit);
                        // Show the edit modal
                        $('#editcouponModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching coupon data");
                    }
                });
            });

            // Update coupon form submission
            $(document).on('submit', '#updatecouponForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let couponId = $('#edit_coupon_id').val();

                $.ajax({
                    url: `coupon/${couponId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editcouponModal').modal('hide');
                        if (response.success) {
                            $("#couponTable").load(location.href + " #couponTable");
                            toastr.success("Coupon updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updatecouponForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the coupon");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var couponId = $(this).data('id');
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
                        url: "{{ url('coupon') }}/" + couponId,
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
                                        '#couponTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#couponTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#couponTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#couponTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search coupon...",
                                            lengthMenu: "Show _MENU_ coupon per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ coupons",
                                            infoEmpty: "No coupons found",
                                            infoFiltered: "(filtered from _MAX_ total coupons)",
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
                                    toastr.success("Coupon deleted successfully");
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
