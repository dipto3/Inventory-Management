<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Add Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="post" action="{{ route('supplier.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3" id="modal-id" style="display: none;">
                        <label for="id-field" class="form-label">ID</label>
                        <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                    </div>

                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Supplier Name</label>
                        <input type="text"class="form-control" placeholder="Enter Supplier  Name" name="name"
                            value="{{ old('name') }}" required />
                        <div class="invalid-feedback">Please enter a Supplier name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Supplier Email</label>
                        <input type="email"class="form-control" placeholder="Enter Supplier Email" name="email"
                            value="{{ old('email') }}" required />
                        <div class="invalid-feedback">Please enter a Supplier email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Supplier phone</label>
                        <input type="number"class="form-control" placeholder="Enter Supplier phone" name="phone"
                            value="{{ old('phone') }}" required />
                        <div class="invalid-feedback">Please enter a Supplier phone.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Supplier city</label>
                        <input type="text"class="form-control" placeholder="Enter Supplier city" name="city"
                            value="{{ old('city') }}" required />
                        <div class="invalid-feedback">Please enter a Supplier city.</div>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Address</label>
                        <textarea type="text" class="form-control" placeholder="Enter Address"name="address" value="{{ old('address') }}"
                            required></textarea>
                        <div class="invalid-feedback">Please enter a customer name.</div>
                    </div>
                    <div>
                        <label for="status-field" class="form-label">Status</label>
                        <select class="form-control" data-trigger name="status" id="status-field" required>
                            <option value="">Status</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Image</label>
                        <input type="file"class="form-control" name="image" required />
                        <div class="invalid-feedback">Please enter a Brand Image.</div>
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
