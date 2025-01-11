<div class="modal fade" id="editCategoryModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Edit Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('subcategory.update', $subcategory->id ?? '') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="subcategory_id" id="subcategory_id" value="{{ $subcategory->id }}"
                    class="form-control">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Parent Category</label>
                        <select class="form-control" name="category_id" required>
                            <option>Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ ($subcategory->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $subcategory->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Category Description</label>
                        <textarea class="form-control" name="description" required>{{ old('description', $subcategory->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="1" {{ old('status', $subcategory->status) == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $subcategory->status) == '0' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
