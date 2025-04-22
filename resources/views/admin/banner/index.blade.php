@extends('admin.layouts.master')
@section('admin.content')
    <div class="card mb-4">
        <!-- Add this button to your card header (just below the <h5> tag) -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Banner</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                <i class="bi bi-plus-lg me-2"></i>Add Banner
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="bannerTable" class="table table-hover w-100">
                    <thead>
                        <tr>
                            <th style="display:none;">ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr id="banner-row-{{ $banner->id }}">
                                <td style="display:none;">{{ $banner->id }}</td>
                                <td>{{ $banner->title }}</td>
                                <td class="image"><img style="height: 50px;width:50px;"
                                        src="{{ asset('storage/' . $banner->image) }}" alt></td>
                                <td> {{ $banner->link }} </td>

                                <td>
                                    @if ($banner->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @elseif ($banner->status == 0)
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-info edit-banner" data-id="{{ $banner->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $banner->id }}" data-toggle="tooltip" title='Delete'>
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

    <!-- Edit banner Modal -->
    @include('admin.banner.edit')

    @include('admin.banner.create')
@endsection

@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#bannerTable").DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search banner...",
                    lengthMenu: "Show _MENU_ banner per page",
                    // info: "",
                    // infoEmpty: "",
                    // infoFiltered: "",
                    info: "Showing _START_ to _END_ of _TOTAL_ banners",
                    infoEmpty: "No banners found",
                    infoFiltered: "(filtered from _MAX_ total banners)",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous",
                    },
                },
            });

            // Edit banner button click
            $(document).on('click', '.edit-banner', function() {
                let bannerId = $(this).data('id');
                // Clear previous form data and errors
                $('#updatebannerForm')[0].reset();
                $('.error-message').remove();

                // Fetch banner data
                $.ajax({
                    url: `banner/${bannerId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific banner data
                        $('#edit_banner_id').val(bannerId);
                        $('#edit_title').val(response.banner.title);
                        $('#edit_status').val(response.banner.status);
                        $('#edit_link').val(response.banner.link);

                        // Show current image if exists
                        if (response.banner.image) {
                            $('#current_image_container').html(
                                `<img src="${response.image_url}" style="height: 100px;width:100px;" alt="Current Image" />`
                            );
                        } else {
                            $('#current_image_container').empty();
                        }

                        // Show the edit modal
                        $('#editbannerModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching banner data");
                    }
                });
            });

            // Update banner form submission
            $(document).on('submit', '#updatebannerForm', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let bannerId = $('#edit_banner_id').val();

                $.ajax({
                    url: `banner/${bannerId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editbannerModal').modal('hide');
                        if (response.success) {
                            $("#bannerTable").load(location.href + " #bannerTable");
                            toastr.success("Banner updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#updatebannerForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the banner");
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var bannerId = $(this).data('id');
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
                        url: "{{ url('banner') }}/" + bannerId,
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
                                        '#bannerTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#bannerTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#bannerTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#bannerTable').DataTable({
                                        responsive: true,
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search banner...",
                                            lengthMenu: "Show _MENU_ banner per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ banners",
                                            infoEmpty: "No banners found",
                                            infoFiltered: "(filtered from _MAX_ total banners)",
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
                                    toastr.success("Banner deleted successfully");
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
