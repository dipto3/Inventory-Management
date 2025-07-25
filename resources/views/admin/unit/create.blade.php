 <!-- Add this modal at the bottom of your body (before the scripts) -->
 <div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addUnitModalLabel">
                     Add New Unit
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post" enctype="multipart/form-data" id="unitForm">
                     @csrf
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="unitName" class="form-label">Unit Name</label>
                             <input type="text"class="form-control" placeholder="Enter unit Name" name="name"
                                 value="{{ old('name') }}" />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="unit shortName" class="form-label">Short Name</label>
                             <input type="text"class="form-control" placeholder="Enter short Name" name="short_name"
                                 value="{{ old('short_name') }}" />
                         </div>

                         <div class="col-md-6 mb-3">
                             <label for="" class="form-label">Status</label>
                             <select class="form-select" id="" name="status">
                                 <option value="">Status</option>
                                 <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                 <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                             </select>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Close
                         </button>
                         <button type="button" class="btn btn-primary add_unit">
                             Save unit
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
             //  $("#unitForm").on("submit", function(e) {
             $(document).on('click', '.add_unit', function(e) {
                 e.preventDefault();
                 let formData = new FormData($('#unitForm')[0]);
                 $.ajax({
                     url: "{{ route('unit.store') }}",
                     type: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     //  headers: {
                     //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     //  },
                     success: function(response) {
                         // Hide the modal and reset form if successful
                         $("#addUnitModal").modal('hide');
                         if (response.success) {
                             $("#unitForm")[0].reset();
                             //  $("#unitTable").load(location.href + " #unitTable");
                             $(".error-message").remove();
                             // Completely refresh the data by making an AJAX call
                             $.ajax({
                                 url: window.location.href,
                                 type: 'GET',
                                 success: function(data) {
                                     // Extract the table HTML from the response
                                     let newTableHTML = $(data).find(
                                         '#unitTable').html();

                                     // First destroy the existing DataTable
                                     let table = $('#unitTable').DataTable();
                                     table.destroy();

                                     // Replace the table HTML
                                     $('#unitTable').html(newTableHTML);

                                     // Reinitialize DataTable
                                     $('#unitTable').DataTable({
                                         responsive: true,
                                         order: [
                                             [0, 'desc']
                                         ],
                                         language: {
                                             search: "_INPUT_",
                                             searchPlaceholder: "Search unit...",
                                             lengthMenu: "Show _MENU_ unit per page",
                                             info: "Showing _START_ to _END_ of _TOTAL_ units",
                                             infoEmpty: "No units found",
                                             infoFiltered: "(filtered from _MAX_ total units)",
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
                                     toastr.success("Unit added successfully");
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
