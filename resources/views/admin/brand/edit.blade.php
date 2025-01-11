<div class="modal fade" id="editBrandModal{{ $brand->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('brand.update', $brand->id ?? '') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="brand_id" id="brand_id" value="{{ $brand->id }}" class="form-control">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Brand Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $brand->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Brand Description</label>
                        <textarea class="form-control" name="description" required>{{ old('description', $brand->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="1" {{ old('status', $brand->status) == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $brand->status) == '0' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        @isset($brand)
                            <img src="{{ $brand->getFirstMediaUrl() ?? '' }}" style="height: 100px;width:100px;"
                                class="" alt="" />
                        @endisset
                        <input type="file" id="logo" name="logo" class="form-control">
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
