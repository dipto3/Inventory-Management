<div class="modal fade" id="editbrandModal" tabindex="-1" aria-labelledby="editbrandModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editbrandModalLabel">Edit brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updatebrandForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="brand_id" id="edit_brand_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">brand Name</label>
                            <input type="text" class="form-control" placeholder="Enter brand Name" name="name" id="edit_name" required />
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="Enter description" name="description" id="edit_description"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Logo</label>
                        <input type="file" class="form-control" name="logo" />
                        <div id="current_image_container" class="mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary update_brand">
                            Save brand
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>