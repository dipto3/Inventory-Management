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
                                        id="create-btn" data-bs-target="#showBrandModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Create</button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Logo</th>
                                                    <th>Created at</th>

                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($brands as $brand)
                                                    <tr>
                                                        <td class="customer_name">{{ $brand->name }}</td>
                                                        <td class="email">{{ $brand->description }}</td>
                                                        <td class="logo"><img style="height: 50px;width:50px;"
                                                                src="{{ $brand->getFirstMediaUrl() }}" alt></td>
                                                        <td class="phone">
                                                            {{ \Carbon\Carbon::parse($brand->created_at)->format('Y-m-d') }}
                                                        </td>

                                                        <td class="status">
                                                            @if ($brand->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif ($brand->status == 0)
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success"
                                                                        data-bs-toggle="modal" value="{{ $brand->id }}"
                                                                        data-bs-target="#editBrandModal{{ $brand->id }}"><i
                                                                            class="las la-edit"></i></button>
                                                                </div>

                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal{{ $brand->id }}"><i
                                                                            class="ri-delete-bin-2-line"></i></button>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('admin.brand.edit')
                                                    @include('admin.brand.delete-modal')
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

        @include('admin.brand.create')
    @endsection
