<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModal">
                    Edit Supplier - {{ $supplier->id }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateSupplierForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="supplier_id" id="supplier_id" value="{{ $supplier->id }}"
                        class="form-control">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="SupplierName" class="form-label">Supplier Name ({{ $supplier->id }})</label>
                            <input type="text"class="form-control" placeholder="Enter Supplier Name" name="name"
                                id="name" value="{{ old('name', $supplier->name) }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="SupplierName" class="form-label">Supplier email</label>
                            <input type="email"class="form-control" placeholder="Enter Supplier Email" name="email"
                                id="email" value="{{ old('email', $supplier->email) }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="SupplierPhone" class="form-label">Supplier phone</label>
                            <input type="number"class="form-control" placeholder="Enter Supplier phone" name="phone"
                                id="phone" value="{{ old('phone', $supplier->phone) }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="SupplierCity" class="form-label">Supplier city</label>
                            <input type="text"class="form-control" placeholder="Enter Supplier city" name="city"
                                id="city" value="{{ old('city', $supplier->city) }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="SupplierCategory" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ old('status', $supplier->status) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('status', $supplier->status) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Address" class="form-label">Address</label>
                        <textarea type="text" class="form-control" placeholder="Enter Address"name="address" value="{{ old('address') }}"
                            id="address" required>{{ old('address', $supplier->address) }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Image</label>
                        <input type="file"class="form-control" name="image" />
                        @isset($supplier)
                            <img src="{{ asset('storage/' . $supplier->image) }}" style="height: 100px;width:100px;"
                                class="" alt="" />
                        @endisset
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
@push('scripts')
    <script>
        //  $(document).ready(function() {
        //      $(document).on('click', '.update-supplier-btn', function(e) {
        //          e.preventDefault();
        //          let id = $(this).data('id');
        //          let name = $('#name').val();
        //          let email = $('#email').val();
        //          let phone = $('#phone').val();
        //          let city = $('#city').val();
        //          let status = $('#status').val();
        //          let address = $('#address').val();
        //          let image = $('#image').val();

        //          $('#supplier_id').val(id);
        //          $('#name').val(name);
        //          $('#email').val(email);
        //          $('#phone').val(phone);
        //          $('#city').val(city);
        //          $('#status').val(status);
        //          $('#address').val(address);
        //      });
        //  });
        $(document).ready(function() {
            // Edit supplier button click
            $(document).on('click', '.edit-supplier', function() {
                let supplierId = $(this).data('id');

                // Clear previous form data and errors
                $('#editSupplierForm')[0].reset();
                $('.error-message').remove();

                // Fetch supplier data
                $.ajax({
                    url: `supplier/${supplierId}/edit`,
                    type: 'GET',
                    success: function(response) {
                        // Populate the form with the specific supplier data
                        $('#editSupplierForm input[name="name"]').val(response.supplier.name);
                        $('#editSupplierForm input[name="email"]').val(response.supplier.email);
                        $('#editSupplierForm input[name="phone"]').val(response.supplier.phone);
                        $('#editSupplierForm input[name="city"]').val(response.supplier.city);
                        $('#editSupplierForm select[name="status"]').val(response.supplier
                            .status);
                        $('#editSupplierForm textarea[name="address"]').val(response.supplier
                            .address);

                        // Add supplier ID to form for update
                        $('#editSupplierForm').append(
                            `<input type="hidden" name="supplier_id" value="${supplierId}">`
                            );

                        // Show the edit modal
                        $('#editSupplierModal').modal('show');
                    },
                    error: function(xhr) {
                        toastr.error("Error fetching supplier data");
                    }
                });
            });

            // Update supplier form submission
            $(document).on('click', '.update_supplier', function(e) {
                e.preventDefault();
                let formData = new FormData($('#editSupplierForm')[0]);
                let supplierId = formData.get('supplier_id');

                $.ajax({
                    url: `supplier/${supplierId}`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#editSupplierModal').modal('hide');
                        if (response.success) {
                            $("#supplierTable").load(location.href + " #supplierTable");
                            toastr.success("Supplier updated successfully");
                        }
                    },
                    error: function(xhr) {
                        // Handle errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $(
                                    `#editSupplierForm [name="${field}"]`);
                                if (inputField.next(".error-message").length === 0) {
                                    inputField.after(
                                        `<small class="text-danger error-message">${messages[0]}</small>`
                                    );
                                }
                            });
                        } else {
                            toastr.error("An error occurred while updating the supplier");
                        }
                    }
                });
            });
        });
    </script>



    {{-- <script>
         $(document).ready(function() {
             $(document).on('click', '.update-supplier-btn', function(e) {
                 e.preventDefault();

                 // Get the current modal and form
                 let modal = $(this).closest('.modal');
                 let form = modal.find('form');

                 // Get the supplier ID from the hidden input in THIS specific modal
                //  let supplier_id = modal.find('input[name="supplier_id"]').val();
                let supplier_id = $(this).data("id");

                 // Create FormData from the specific form
                 var formData = new FormData(form[0]);

                 // Add the CSRF token and method
                 formData.append('_token', '{{ csrf_token() }}');
                 formData.append('_method', 'PUT');

                 console.log("Supplier ID:", supplier_id); // Debug to verify correct ID

                 $.ajax({
                     type: "POST",
                     url: "{{ url('supplier') }}/" + supplier_id,
                     data: formData,
                     contentType: false,
                     processData: false,
                     success: function(response) {
                         if (response.success) {
                             modal.modal('hide');
                             $("#supplierTable").load(location.href + " #supplierTable");
                             $(".error-message").remove();
                         }
                     },
                     error: function(xhr, status, error) {
                         console.error("Error details:", xhr.responseText);
                         var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                         if (errors) {
                             $.each(errors, function(key, value) {
                                 toastr.error(value[0]);
                             });
                         } else {
                             toastr.error("An error occurred while updating the supplier.");
                         }
                     }
                 });
             });
         });
     </script> --}}
@endpush
