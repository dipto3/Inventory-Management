<div class="modal fade" id="editbannerModal" tabindex="-1" aria-labelledby="editbannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editbannerModalLabel">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updatebannerForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="banner_id" id="edit_banner_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Banner Title</label>
                            <input type="text" class="form-control" placeholder="Enter banner Title" name="title"
                                id="edit_title" required />
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
                        <label for="description" class="form-label">Link</label>
                        <input class="form-control" placeholder="Enter Link" name="link" id="edit_link" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" />
                        <div id="current_image_container" class="mt-2"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary update_banner">
                            Save brand
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
