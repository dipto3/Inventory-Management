<div class="modal fade" id="showVariantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" id="tags" name="values" class="form-control bootstrap-tagsinput"
                            data-role="tagsinput" placeholder="Enter tags">
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
    .bootstrap-tagsinput {
        display: block;
        /* Ensure it behaves like a block element */
        width: 100%;
        /* Full width */
        padding: 0.375rem 0.75rem;
        /* Match form-control padding */
        font-size: 1rem;
        /* Match form-control font size */
        line-height: 1;
        /* Match form-control line height */
        color: #495057;
        /* Match form-control text color */
        background-color: #fff;
        /* Match form-control background */
        background-clip: padding-box;
        /* Match form-control clipping */
        border: 1px solid #ced4da;
        /* Match form-control border */
        border-radius: 0.25rem;
        /* Match form-control border radius */
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .bootstrap-tagsinput:focus {
        border-color: #80bdff;
        /* Match form-control focus border */
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        /* Match form-control focus shadow */
    }

    .bootstrap-tagsinput .tag {
        margin: 0.2rem;
        padding: 0.3rem 0.5rem;
        background-color: #0ab39c;
        color: #fff;
        border-radius: 0.25rem;
        display: inline-flex;
        align-items: center;
    }

    .bootstrap-tagsinput .tag [data-role="remove"] {
        margin-left: 8px;
        cursor: pointer;
        color: rgb(209, 14, 14);
        background-color: transparent;
        border: none;
        font-size: 1rem;
        font-weight: bold;
    }

    .bootstrap-tagsinput .tag [data-role="remove"]:before {
        content: "\f00d";
        /* Font Awesome cross icon */
        font-family: "Font Awesome 5 Free";
        /* Ensure this matches your icon library */
        font-weight: 900;
        /* Adjust based on your icon library */
        margin-right: 5px;
        /* Space between icon and tag text */
    }
</style>
