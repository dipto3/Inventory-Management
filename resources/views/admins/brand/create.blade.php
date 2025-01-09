<div class="modal fade" id="add-brand">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Create Brand</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body new-employee-field">
                        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <label class="form-label">Logo</label>
                           
                            <div class="profile-pic-upload mb-3">
                       
                                <input type="file" class="form-control" name="logo">
                               
                            </div>
                            <div class="mb-3 input-blocks">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="select" name="status" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>