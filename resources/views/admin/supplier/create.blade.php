 <!-- Add this modal at the bottom of your body (before the scripts) -->
 <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addSupplierModalLabel">
                     Add New Supplier
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post" enctype="multipart/form-data" id="supplierForm">
                     @csrf
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="SupplierName" class="form-label">Supplier Name</label>
                             <input type="text"class="form-control" placeholder="Enter Supplier Name" name="name"
                                 value="{{ old('name') }}" />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierName" class="form-label">Supplier email</label>
                             <input type="email"class="form-control" placeholder="Enter Supplier Email" name="email"
                                 value="{{ old('email') }}" />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierPhone" class="form-label">Supplier phone</label>
                             <input type="number"class="form-control" placeholder="Enter Supplier phone" name="phone"
                                 value="{{ old('phone') }}" />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierCity" class="form-label">Supplier city</label>
                             <input type="text"class="form-control" placeholder="Enter Supplier city" name="city"
                                 value="{{ old('city') }}" />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierCategory" class="form-label">Status</label>
                             <select class="form-select" id="" name="status">
                                 <option value="">Status</option>
                                 <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                 <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                             </select>
                         </div>
                     </div>
                     <div class="mb-3">
                         <label for="Address" class="form-label">Address</label>
                         <textarea type="text" class="form-control" placeholder="Enter Address"name="address" value="{{ old('address') }}"></textarea>
                     </div>
                     <div class="col-md-6 mb-3">
                         <label for="" class="form-label">Image</label>
                         <input type="file"class="form-control" name="image" />
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Close
                         </button>
                         <button type="button" class="btn btn-primary add_supplier">
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
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     </script>
     <script>
         $(document).ready(function() {
             //  $("#supplierForm").on("submit", function(e) {
             $(document).on('click', '.add_supplier', function(e) {
                 e.preventDefault();
                 let formData = new FormData($('#supplierForm')[0]);
                 $.ajax({
                     url: "{{ route('supplier.store') }}",
                     type: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     //  headers: {
                     //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     //  },
                     success: function(response) {
                         // Hide the modal and reset form if successful
                         $("#addSupplierModal").modal('hide');
                         if (response.success) {
                             $("#supplierForm")[0].reset();
                             //  $("#supplierTable").load(location.href + " #supplierTable");
                             $(".error-message").remove();
                             // Completely refresh the data by making an AJAX call
                             $.ajax({
                                 url: window.location.href,
                                 type: 'GET',
                                 success: function(data) {
                                     // Extract the table HTML from the response
                                     let newTableHTML = $(data).find(
                                         '#supplierTable').html();

                                     // First destroy the existing DataTable
                                     let table = $('#supplierTable').DataTable();
                                     table.destroy();

                                     // Replace the table HTML
                                     $('#supplierTable').html(newTableHTML);

                                     // Reinitialize DataTable
                                     $('#supplierTable').DataTable({
                                         responsive: true,
                                         language: {
                                             search: "_INPUT_",
                                             searchPlaceholder: "Search supplier...",
                                             lengthMenu: "Show _MENU_ supplier per page",
                                             info: "Showing _START_ to _END_ of _TOTAL_ orders",
                                             infoEmpty: "No orders found",
                                             infoFiltered: "(filtered from _MAX_ total orders)",
                                             paginate: {
                                                 first: "First",
                                                 last: "Last",
                                                 next: "Next",
                                                 previous: "Previous",
                                             },
                                         },
                                     });

                                     toastr.success("Supplier added successfully");
                                 },
                                 error: function() {
                                     toastr.error("Error refreshing table data");
                                 }
                             });
                         }
                     },
                     error: function(error) {
                         console.log("Error Response:", error);
                         if (error.status === 422) {
                             let errors = error.responseJSON.errors;
                             // Display errors next to the fields
                             $.each(errors, function(field, messages) {
                                 let inputField = $(`[name="${field}"]`);
                                 // Check if error message already exists
                                 if (inputField.next(".error-message").length === 0) {
                                     inputField.after(
                                         `<small class="text-danger error-message">${messages[0]}</small>`
                                     );
                                 }
                             });
                         } else {
                             alert("Something went wrong! Please check the form.");
                         }
                     }
                 });
             });
         });
     </script>
 @endpush
