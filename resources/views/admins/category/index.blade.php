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
                            <h4 class="mb-sm-0">Categories</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                    <li class="breadcrumb-item active">Category</li>
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
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="listjs-table" id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm-auto">
                                            <div>
                                                <button type="button" class="btn btn-success add-btn"
                                                    data-bs-toggle="modal" id="create-btn"
                                                    data-bs-target="#showCategoryModal"><i
                                                        class="ri-add-line align-bottom me-1"></i> Add</button>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="example">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th class="sort" data-sort="name">Category</th>
                                                    <th class="sort" data-sort="parent">Parent Category</th>
                                                    <th class="sort" data-sort="description">Description</th>
                                                    <th class="sort" data-sort="status">Status</th>
                                                    <th class="sort" data-sort="ordering">Ordering</th>
                                                    <th class="sort" data-sort="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list form-check-all">
                                                @foreach ($allCategories as $key =>$category)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <!-- Category Name -->
                                                        <td class="customer_name">{{ $category->name }}</td>

                                                        <!-- Parent Category -->
                                                        <td class="customer_name">
                                                            {{ $category->parentCategory->name ?? 'Parent Category' }}
                                                        </td>

                                                        <!-- Description -->
                                                        <td class="description">{{ $category->description }}</td>

                                                        <!-- Status -->
                                                        <td class="status">
                                                            @if ($category->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>

                                                        <!-- Ordering -->
                                                        <td>
                                                            <input type="number" class="form-control"
                                                                value="{{ $category->ordering }}" name="ordering"
                                                                id="ordering" style="width: 50px;"
                                                                data-category-id="{{ $category->id }}">
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <!-- Edit Button -->
                                                                <div class="edit">
                                                                    <button class="btn btn-sm btn-success"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editCategoryModal{{ $category->id }}">
                                                                        <i class="las la-edit"></i>
                                                                    </button>
                                                                </div>

                                                                <!-- Delete Button -->
                                                                <div class="remove">
                                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteRecordModal{{ $category->id }}">
                                                                        <i class="ri-delete-bin-2-line"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modals -->
                                                    @include('admin.category.edit', [
                                                        'category' => $category,
                                                    ])
                                                    @include('admin.category.delete-modal', [
                                                        'category' => $category,
                                                    ])
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="noresult" style="display: none">
                                            <div class="text-center">
                                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                    colors="primary:#121331,secondary:#08a88a"
                                                    style="width:75px;height:75px"></lord-icon>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                {{-- <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p> --}}
                                            </div>
                                        </div>
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

        @include('admin.category.create')
        <style>
            .dt-type-numeric {
                text-align: left !important;
            }
        </style>
    @endsection
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
        <script>
            $(document).ready(function() {
                console.log('Document ready');

                $('input[name="ordering"]').each(function() {
                    console.log('Found ordering input:', $(this).data('category-id'));
                });

                $('input[name="ordering"]').on('change', function() {
                    console.log('Input changed');
                    let ordering = $(this).val();
                    let categoryId = $(this).data('category-id');

                    console.log('Ordering:', ordering);
                    console.log('Category ID:', categoryId);

                    $.ajax({
                        url: "{{ route('category.updateOrdering') }}",
                        type: "POST",
                        data: {
                            ordering: ordering,
                            category_id: categoryId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log('Success:', response);
                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', error);
                        }
                    });
                });
            });
        </script>
    @endpush


