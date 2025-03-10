@extends('admin.layouts.master')
@section('admin.content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div
                            class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                            <h4 class="mb-sm-0">Purchase</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                    <li class="breadcrumb-item active">purchase</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Add, Edit & Remove</h4>
                                <div class="d-flex justify-content-sm-end">
                                    <a class="btn btn-success add-btn" href="{{ route('purchase-order.create') }}"><i
                                            class="ri-add-line align-bottom me-1"></i> Create</a>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th >Purchase Code</th>
                                                    <th>Payment Status</th>
                                                    <th >Received Quantity</th>
                                                    <th >Purchase Order Code</th>
                                                    <th >Purchase Date</th>

                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchases as $purchase)
                                                    <tr>

                                                        <td>
                                                            <strong>
                                                                <a href="" style="color: rgb(32, 104, 212)">
                                                                    {{ $purchase->purchase_code }}
                                                                </a>
                                                            </strong>

                                                        </td>
                                                        <td class="status">
                                                            @if ($purchase->payment_status == 'pending')
                                                                <span class="badge bg-info">Pending</span>
                                                            @elseif ($purchase->payment_status == 'partial')
                                                                <span class="badge bg-warning">Partial</span>
                                                            @elseif ($purchase->payment_status == 'completed')
                                                                <span class="badge bg-success">Completed</span>
                                                            @else
                                                                <span class="badge bg-danger">Something Wrong!</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $purchase->total_receive_quantity }}
                                                        </td>
                                                        <td>
                                                            {{ $purchase->purchaseOrder?->purchase_order_code }}
                                                        </td>
                                                        <td>

                                                            {{ \Carbon\Carbon::parse($purchase->purchaseOrder?->purchase_date)->format('d F, Y') }}
                                                        </td>

                                                        <td>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <a href="" class="btn btn-primary btn-sm">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-3">

                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div><!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- container-fluid -->
        </div>
    @endsection
