<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateCategoryForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="category_id" id="edit_category_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Parent Category Name</label>
                            <select id="parent_id" class="form-control" name="parent_id">
                                <option value="0">No Parent</option>
                                @foreach ($categories as $acategory)
                                    @php
                                        $category1[] = $acategory->name;
                                    @endphp
                                    <option value="{{ $acategory->id }}">
                                        {{ $acategory->name }}
                                    </option>
                                    @foreach ($acategory->childrenCategories as $childCategory)
                                        @include('admin.category.child_category', [
                                            'child_category' => $childCategory,
                                            'category' => $category1,
                                        ])
                                    @endforeach
                                    @php
                                        array_pop($category1);
                                    @endphp
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">category Name</label>
                            <input type="text" class="form-control" placeholder="Enter category Name" name="name"
                                id="edit_name" required />
                        </div>



                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="Enter description" name="description" id="edit_description"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary update_category">
                                Save category
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
