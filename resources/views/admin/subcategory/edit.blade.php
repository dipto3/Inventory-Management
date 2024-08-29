<div class="modal fade" id="editSubcategory">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Sub Category</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="{{ route('subcategory.update', ':id') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="subcategory_id" id="subcategory_id" class="form-control">
                            <div class="mb-3">
                                <label class="form-label">Parent Category</label>
                                <select class="select" name="category_id" id="category_id">
                                    <option>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                    @error('category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Code</label>
                                <input type="text" class="form-control" value="CT001">
                            </div>
                            <div class="mb-3 input-blocks">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select selected class="select" id="status" name="status" required>

                                    <option value="1" @if (old('status') == '1') selected @endif>Active
                                    </option>
                                    <option value="0" @if (old('status') == '0') selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
