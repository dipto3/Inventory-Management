@extends('admin.layouts.master')
@section('admin.content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Payment Types</h4>
                        <h6>Manage your Payment Types</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/pdf.svg"
                                alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/excel.svg"
                                alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i data-feather="rotate-ccw"
                                class="feather-rotate-ccw"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="#" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add-category"><i
                            data-feather="plus-circle" class="me-2"></i> Add Payment Type</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body ">
                            <div class="table-responsive">

                                <table class="table  datanew">
                                    <thead>
                                        <tr>
                                            <th>Payment Type</th>
                                            <th>Has Transaction</th>
                                            <th>Status</th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymentTypes as $types)
                                            <tr>
                                                <td>{{ $types->type }}</td>
                                                <td> 

                                                @if ($types->has_transaction == 1)
                                                <span class="badge badge-linesuccess">Yes</span>
                                                @else
                                                <span class="badge badge-linedanger">No</span>
                                                @endif
                                                </td>
                                                
                                                <td>
                                                    @if ($types->status == 1)
                                                        <span class="badge badge-linesuccess">Active</span>
                                                    @else
                                                        <span class="badge badge-linedanger">Inactive</span>
                                                    @endif

                                                </td>
                                                <td class="action-table-data">
                                                    <div class="edit-delete-action">
                                                        <button type="button" class="btn btn-primary me-2 p-2 editpaymenttypebtn"
                                                value="{{ $types->id }}">
                                                <i data-feather="edit" class="feather-edit"></i>
                                            </button>
                                                    
                                                    
                                                        <form action="{{ route('payment_type.destroy', $types->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-xs btn-danger btn-flat show_confirm"
                                                                data-toggle="tooltip" title='Delete'><i
                                                                    data-feather="trash-2"
                                                                    class="feather-trash-2"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.payment_type.create')
    @include('admin.payment_type.edit')
@endsection



@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
