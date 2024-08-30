<div class="modal fade" id="editUnit">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Unit</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="{{ route('unit.update', $unit->id ??'') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="unit_id" id="unit_id" class="form-control">
                            <div class="mb-3">
                                <label class="form-label">Unit</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Short Name</label>
                                <input type="text" id="short_name" name="short_name" class="form-control">
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