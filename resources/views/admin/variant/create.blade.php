<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Add Variant</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="post" action="{{ route('variant.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="id-field" class="form-label">ID</label>
                        <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Variant Name</label>
                        <input type="text"class="form-control" placeholder="Enter Variant Name" name="name"
                            value="{{ old('name') }}" required />
                        <div class="invalid-feedback">Please enter a Variant name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" id="tags" name="values" data-role="tagsinput" class="form-control" placeholder="Enter tags">
                    </div>

                    <div>
                        <label for="status-field" class="form-label">Status</label>
                        <select class="form-control" data-trigger name="status" id="status-field" required>
                            <option value="">Status</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .bootstrap-tagsinput .tag [data-role="remove"] {
        margin-left: 8px;
        cursor: pointer;
        color: white;
        background-color: transparent;
        border: none;
        font-size: 1rem;
        font-weight: bold;
    }
    .bootstrap-tagsinput .tag {
        margin: 0.2rem;
        padding: 0.3rem 0.5rem;
        background-color: #007bff;
        color: #fff;
        border-radius: 0.25rem;
        display: inline-flex;
        align-items: center;
    }
</style>