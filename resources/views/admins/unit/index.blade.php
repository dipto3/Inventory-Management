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
                            <h4 class="mb-sm-0">Unit</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                    <li class="breadcrumb-item active">unit</li>
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
                                        id="create-btn" data-bs-target="#showUnitModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Create</button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>Short name</th>
                                                    <th>Created at</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($units as $unit)
                                                    <tr>
                                                        <td class="customer_name">{{ $unit->name }}</td>
                                                        <td class="email">{{ $unit->short_name }}</td>
                                                        <td class="phone">
                                                            {{ \Carbon\Carbon::parse($unit->created_at)->format('Y-m-d') }}
                                                        </td>

                                                        <td class="status">
                                                            @if ($unit->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif ($unit->status == 0)
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success"
                                                                        data-bs-toggle="modal" value="{{ $unit->id }}"
                                                                        data-bs-target="#editUnitModal{{ $unit->id }}"><i
                                                                            class="las la-edit"></i></button>
                                                                </div>

                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal{{ $unit->id }}"><i
                                                                            class="ri-delete-bin-2-line"></i></button>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @include('admin.unit.edit')
                                                    @include('admin.unit.delete-modal')
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

        @include('admin.unit.create')
    @endsection
