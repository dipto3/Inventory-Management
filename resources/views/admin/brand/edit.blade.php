<div class="modal fade" id="editBrand">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Brand</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body new-employee-field">
                        <form action="{{ route('brand.update', $brand->id ??'') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="brand_id" id="brand_id" class="form-control">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" id="description" name="description" class="form-control">
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
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <img src="{{$brand->getFirstMediaUrl()}}"
                                class="" alt="" />
                                <input type="file" id="logo" name="logo" class="form-control">
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