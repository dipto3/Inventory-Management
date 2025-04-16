<div class="modal fade" id="editReturnReasonModal" tabindex="-1" aria-labelledby="editReturnReasonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReturnReasonModalLabel">Edit Return Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateReturnReasonForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="return_reason_id" id="edit_return_reason_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Reason</label>
                            <input type="text" class="form-control" placeholder="Enter return_reason Name"
                                name="reason" id="edit_reason" required />
                        </div>
                        <div class="col-md-6 mb-3">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary update_return_reason">
                            Save return reason
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
