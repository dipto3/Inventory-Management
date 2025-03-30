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
                                <td>{{ $supplier->name }} </td>

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
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            value="{{ $supplier->id }}"
                                            data-bs-target="#editSupplierModal{{ $supplier->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        {{-- <form method="POST" action="{{ route('supplier.destroy', $supplier->id) }}"
                                            style="margin-left: 5px;">

                                            @csrf

                                            <input name="_method" type="hidden" value="DELETE">

                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'><i class="bi bi-trash"></i></button>

                                        </form> --}}
                                        <button type="button" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-id="{{ $supplier->id }}" data-toggle="tooltip" title='Delete'>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('admin.supplier.edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.supplier.create')
@endsection
@push('scripts')
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $("#supplierTable").DataTable({
                responsive: true,

                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search supplier...",
                    lengthMenu: "Show _MENU_ supplier per page",
                    info: "",
                    infoEmpty: "",
                    infoFiltered: "",
                    // info: "Showing _START_ to _END_ of _TOTAL_ supplier",
                    // infoEmpty: "No supplier found",
                    // infoFiltered: "(filtered from _MAX_ total supplier)",
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>



    <script type="text/javascript">
        $(document).on("click", ".show_confirm", function(event) {
            var supplierId = $(this).data('id');
            var $row = $(this).closest('tr'); // Store reference to the row
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
                            // Remove from DataTable properly
                            var table = $('#supplierTable').DataTable();

                            table.row($row).remove().draw(
                                false); // false keeps current pagination

                            // Update counter
                            // updateSupplierCount();
                        },
                        error: function(xhr, status, error) {
                            swal("Error!", "Something went wrong, please try again.", "error");
                        }
                    });
                }
            });
        });

        // function updateSupplierCount() {
        //     var table = $('#supplierTable').DataTable();
        //     var info = table.page.info();
        //     $('.dataTables_info').html(
        //         'Showing ' + (info.start + 1) + ' to ' + info.end + ' of ' +
        //         info.recordsDisplay + ' suppliers' +
        //         (info.recordsDisplay !== info.recordsTotal ?
        //             ' (filtered from ' + info.recordsTotal + ' total)' : '')
        //     );
        // }
    </script>
@endpush
