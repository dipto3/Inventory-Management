<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateSupplierForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="supplier_id" id="edit_supplier_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" placeholder="Enter Supplier Name" name="name" id="edit_name" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Supplier email</label>
                            <input type="email" class="form-control" placeholder="Enter Supplier Email" name="email" id="edit_email" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Supplier phone</label>
                            <input type="number" class="form-control" placeholder="Enter Supplier phone" name="phone" id="edit_phone" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Supplier city</label>
                            <input type="text" class="form-control" placeholder="Enter Supplier city" name="city" id="edit_city" required />
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
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" placeholder="Enter Address" name="address" id="edit_address"></textarea>
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
                        <button type="submit" class="btn btn-primary update_supplier">
                            Save Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>