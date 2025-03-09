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
                                                    {{-- <th width="">ID</th> --}}
                                                    <th width="10%">Purchase Order Code</th>
                                                    <th width="20%">Purchase Status</th>
                                                    <th width="5%">Purchase Date</th>
                                                    <th width="5%">Quantity</th>
                                                    <th width="20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchases as $purchase)
                                                    <tr>
                                                        {{-- <td>{{ $purchase->id }}</td> --}}
                                                        <td>
                                                            <strong>
                                                                <a href="{{ route('create.grn', $purchase->id) }}"
                                                                    style="color: rgb(32, 104, 212)">
                                                                    {{ $purchase->purchase_order_code }}
                                                                </a>
                                                            </strong>

                                                        </td>
                                                        <td class="status">
                                                            {{ $purchase->purchase_status }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }}
                                                        </td>
                                                        <td>
                                                            {{ $purchase->total_quantity }}
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <a href="{{ route('purchase-order.show', $purchase->id) }}"
                                                                        class="btn btn-primary btn-sm">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    Duplicate
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
