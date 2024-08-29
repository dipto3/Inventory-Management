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
                        <form action="https://dreamspos.dreamstechnologies.com/html/template/brand-list.html">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control">
                            </div>
                            <label class="form-label">Logo</label>
                            <div class="profile-pic-upload mb-3">
                                <div class="profile-pic brand-pic">
                                    <span><i data-feather="plus-circle" class="plus-down-add"></i> Add Image</span>
                                </div>
                                <div class="image-upload mb-0">
                                    <input type="file">
                                    <div class="image-uploads">
                                        <h4>Change Image</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 input-blocks">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                            <div class="mb-0">
                                <div
                                    class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <span class="status-label">Status</span>
                                    <input type="checkbox" id="user2" class="check" checked>
                                    <label for="user2" class="checktoggle"></label>
                                </div>
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