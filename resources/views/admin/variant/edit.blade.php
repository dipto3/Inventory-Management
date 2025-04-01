<div class="modal fade" id="editVariantModal" tabindex="-1" aria-labelledby="editVariantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVariantModalLabel">Edit variant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateVariantForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="variant_id" id="edit_variant_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">variant Name</label>
                            <input type="text" class="form-control" placeholder="Enter variant Name" name="name"
                                id="edit_name" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tags</label>
                            <input type="text" class="form-control bootstrap-tagsinput" data-role="tagsinput"
                                placeholder="Enter variant values" name="values" id="edit_values" required />
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
                        <button type="submit" class="btn btn-primary update_variant">
                            Save variant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
