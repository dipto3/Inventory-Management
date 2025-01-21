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
                            <h4 class="mb-sm-0">Supplier</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                    <li class="breadcrumb-item active">supplier</li>
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
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Create</button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="example">
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
                                                    <tr>
                                                        <td>{{ $supplier->name }} </td>

                                                        <td class="image"><img style="height: 50px;width:50px;"
                                                                src="{{ $supplier->getFirstMediaUrl() }}" alt></td>
                                                        <td> {{ $supplier->email }} </td>
                                                        <td> {{ $supplier->phone }} </td>
                                                        <td> {{ $supplier->address }} </td>
                                                        <td> {{ $supplier->city }} </td>
                                                        <td class="status">
                                                            @if ($supplier->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif ($supplier->status == 0)
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success"
                                                                        data-bs-toggle="modal" value="{{ $supplier->id }}"
                                                                        data-bs-target="#editSupplierModal{{ $supplier->id }}"><i
                                                                            class="las la-edit"></i></button>
                                                                </div>

                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal{{ $supplier->id }}"><i
                                                                            class="ri-delete-bin-2-line"></i></button>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('admin.supplier.edit')
                                                    @include('admin.supplier.delete-modal')
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

        @include('admin.supplier.create')
    @endsection
