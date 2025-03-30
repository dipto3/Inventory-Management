<div class="modal fade" id="editUnitModal{{ $unit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="">Edit Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('unit.update', $unit->id ?? '') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="unit_id" id="unit_id" value="{{ $unit->id }}" class="form-control">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Unit Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $unit->name) }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Unit Short Name</label>
                        <input class="form-control" name="short_name" value="{{ old('short_name', $unit->short_name) }}"
                            required />
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="1" {{ old('status', $unit->status) == '1' ? 'selected' : '' }}>
                                Active</option>
                            <option value="0" {{ old('status', $unit->status) == '0' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
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
