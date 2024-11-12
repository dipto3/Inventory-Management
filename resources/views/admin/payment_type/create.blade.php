<div class="modal fade" id="add-category">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
        <div class="modal-content">
            <div class="modal-header border-0 custom-modal-header">
                <h4 class="modal-title" id="addPaymentTypeLabel">Create Payment Type</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom-modal-body">
                <form action="{{ route('payment_type.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="form_name" value="create">
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
                        @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Has Transaction</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="has_transaction" name="has_transaction" value="1" {{ old('has_transaction') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_transaction">Yes</label>
                        </div>
                        @error('has_transaction')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Payment Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
