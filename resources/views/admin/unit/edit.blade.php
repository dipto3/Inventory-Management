<div class="modal fade" id="editUnitModal" tabindex="-1" aria-labelledby="editUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUnitModalLabel">Edit unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateUnitForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="unit_id" id="edit_unit_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Unit Name</label>
                            <input type="text" class="form-control" placeholder="Enter unit Name" name="name"
                                id="edit_name" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Short Name</label>
                            <input type="text" class="form-control" placeholder="Enter short Name" name="short_name"
                                id="edit_short_name" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary update_unit">
                            Save unit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
