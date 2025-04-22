 <!-- Add this modal at the bottom of your body (before the scripts) -->
 <div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addCouponModalLabel">
                     Add New Coupon
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post" enctype="multipart/form-data" id="couponForm">
                     @csrf
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="code" class="form-label">Coupon Code</label>
                             <input type="text" class="form-control" placeholder="Enter coupon Title" name="code"
                                 id="edit_code" required value="{{ old('code') }}" />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="discount_type" class="form-label">Discount type</label>
                             <select class="form-select" id="edit_discount_type" name="discount_type">
                                 <option value="">Choose Discount type</option>
                                 <option value="percentage"
                                     {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                 <option value="amount" {{ old('discount_type') == 'amount' ? 'selected' : '' }}>Amount
                                 </option>
                             </select>
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="discount_value" class="form-label">Discount value</label>
                             <input type="text" class="form-control" placeholder="Enter coupon Title"
                                 name="discount_value" id="edit_code" value="{{ old('discount_value') }}" required />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="minimum_order_amount" class="form-label">Minimum order amount</label>
                             <input type="number" class="form-control" placeholder="Enter coupon minimum_order_amount"
                                 name="minimum_order_amount" id="edit_minimum_order_amount"
                                 value="{{ old('minimum_order_amount') }}" required />
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="discount_value" class="form-label">Maximum discount amount</label>
                             <input type="text" class="form-control" placeholder="Enter maximum_discount_amount"
                                 name="maximum_discount_amount" id="edit_maximum_discount_amount" required
                                 value="{{ old('maximum_discount_amount') }}" />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="start_date" class="form-label">Start date</label>
                             <input type="date" class="form-control" placeholder="Enter start_date" name="start_date"
                                 id="edit_start_date" required value="{{ old('start_date') }}" />
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="end_date" class="form-label">End date</label>
                             <input type="date" class="form-control" placeholder="Enter end_date" name="end_date"
                                 id="edit_end_date" value="{{ old('end_date') }}" required />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="start_time" class="form-label">Start Time</label>
                             <input type="time" class="form-control" placeholder="Enter start_time" name="start_time"
                                 id="edit_start_time" value="{{ old('start_time') }}" required />
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="end_time" class="form-label">End Time</label>
                             <input type="time" class="form-control" placeholder="Enter end_time" name="end_time"
                                 id="edit_end_time" value="{{ old('end_time') }}" required />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="start_time" class="form-label">Usage Limit</label>
                             <input type="number" class="form-control" placeholder="Enter usage_limit"
                                 name="usage_limit" id="edit_usage_limit" value="{{ old('usage_limit') }}" />
                         </div>
                     </div>

                     <div class="mb-3">
                         <label for="status" class="form-label">Status</label>
                         <select class="form-select" id="edit_status" name="status">
                             <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                             <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                         </select>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Close
                         </button>
                         <button type="button" class="btn btn-primary add_coupon">
                             Save Coupon
                         </button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
 @push('scripts')
     <script>
         toastr.options = {
             "closeButton": true,
             "progressBar": true,
             "positionClass": "toast-top-right",
             "showDuration": "300",
             "hideDuration": "1000",
             "timeOut": "5000"
         };
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     </script>
     <script>
         $(document).ready(function() {
             //  $("#couponForm").on("submit", function(e) {
             $(document).on('click', '.add_coupon', function(e) {
                 e.preventDefault();
                 let formData = new FormData($('#couponForm')[0]);
                 $.ajax({
                     url: "{{ route('coupon.store') }}",
                     type: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     //  headers: {
                     //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     //  },
                     success: function(response) {
                         // Hide the modal and reset form if successful
                         $("#addCouponModal").modal('hide');
                         if (response.success) {
                             $("#couponForm")[0].reset();
                             //  $("#couponTable").load(location.href + " #couponTable");
                             $(".error-message").remove();
                             // Completely refresh the data by making an AJAX call
                             $.ajax({
                                 url: window.location.href,
                                 type: 'GET',
                                 success: function(data) {
                                     // Extract the table HTML from the response
                                     let newTableHTML = $(data).find(
                                         '#couponTable').html();

                                     // First destroy the existing DataTable
                                     let table = $('#couponTable').DataTable();
                                     table.destroy();

                                     // Replace the table HTML
                                     $('#couponTable').html(newTableHTML);

                                     // Reinitialize DataTable
                                     $('#couponTable').DataTable({
                                         responsive: true,
                                         order: [
                                             [0, 'desc']
                                         ],
                                         language: {
                                             search: "_INPUT_",
                                             searchPlaceholder: "Search Banner...",
                                             lengthMenu: "Show _MENU_ Banner per page",
                                             info: "Showing _START_ to _END_ of _TOTAL_ coupons",
                                             infoEmpty: "No coupons found",
                                             infoFiltered: "(filtered from _MAX_ total coupons)",
                                             paginate: {
                                                 first: "First",
                                                 last: "Last",
                                                 next: "Next",
                                                 previous: "Previous",
                                             },
                                         },
                                     });
                                     toastr.options = {
                                         positionClass: "toast-bottom-center"
                                     };
                                     toastr.success("Coupon added successfully");
                                 },
                                 error: function() {
                                     toastr.options = {
                                         positionClass: "toast-bottom-center"
                                     };
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
