
<div class="modal fade" id="add-units">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Create Attributes</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="{{ route('variant.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="input-blocks">
                                <label class="form-label">Variant</label>
                                <input class type="text" data-role="tagsinput" name="values" value="">
                                <span class="tag-text">Enter value separated by comma</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="select" name="status" required>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                    </option>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Create Attributes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

