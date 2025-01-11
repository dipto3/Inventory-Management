<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Add Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="post" action="{{ route('unit.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="id-field" class="form-label">ID</label>
                        <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Unit Name</label>
                        <input type="text"class="form-control" placeholder="Enter Unit Name" name="name"
                            value="{{ old('name') }}" required />
                        <div class="invalid-feedback">Please enter a unit name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Unit Short Name</label>
                        <textarea type="text" class="form-control" placeholder="Enter Unit short name"name="short_name"
                            value="{{ old('short_name') }}" required></textarea>
                        <div class="invalid-feedback">Please enter a unit short name name.</div>
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
