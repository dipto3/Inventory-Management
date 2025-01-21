<div class="modal fade" id="editSupplierModal{{ $supplier->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Edit supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('supplier.update', $supplier->id ?? '') }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="supplier_id" id="supplier_id" value="{{ $supplier->id }}"
                    class="form-control">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>supplier Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $supplier->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>supplier Email</label>
                        <input type="email" class="form-control" name="email"
                            value="{{ old('email', $supplier->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>supplier Phone</label>
                        <input type="text" class="form-control" name="phone"
                            value="{{ old('phone', $supplier->phone) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>supplier address</label>
                        <textarea class="form-control" name="address" required>{{ old('address', $supplier->address) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label>supplier City</label>
                        <input type="text" class="form-control" name="city"
                            value="{{ old('city', $supplier->city) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="1" {{ old('status', $supplier->status) == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $supplier->status) == '0' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        @isset($supplier)
                            <img src="{{ $supplier->getFirstMediaUrl() ?? '' }}" style="height: 100px;width:100px;"
                                class="" alt="" />
                        @endisset
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
