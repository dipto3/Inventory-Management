<div class="modal fade" id="editPaymentType" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="page-wrapper-new p-0">
                <div class="content">
                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4>Edit Payment Type</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form action="{{ route('payment_type.update', $paymentType->id ?? '') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <input type="text" name="type" id="edit-paymenttype-type" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-control" id="edit-paymenttype-status" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Has Transaction</label>
                                <div class="form-check">
                                    <input type="hidden" name="has_transaction" value="0">
                                    <input type="checkbox" class="form-check-input" id="edit-paymenttype-has_transaction" name="has_transaction" value="1">
                                    <label class="form-check-label" for="has_transaction">Yes</label>
                                </div>
                            </div>
                            <div class="modal-footer-btn">
                                <button type="button" class="btn btn-cancel me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
