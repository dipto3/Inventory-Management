 <!-- Add this modal at the bottom of your body (before the scripts) -->
 <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addCategoryModalLabel">
                     Add New category
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="post" enctype="multipart/form-data" id="categoryForm">
                     @csrf
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="categoryName" class="form-label">Parent Category Name</label>
                             <select class="form-control selectpicker" name="parent_id" id="status-field" required
                                 data-live-search="true">
                                 <option value="0">No Parent</option>
                                 @foreach ($categories as $category)
                                     @php
                                         $category1[] = $category->name;
                                     @endphp
                                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                                     @foreach ($category->childrenCategories as $childCategory)
                                         @include('admin.category.child_category', [
                                             'child_category' => $childCategory,
                                             'category' => $category1,
                                         ])
                                     @endforeach
                                     @php
                                         array_pop($category1);
                                     @endphp
                                 @endforeach
                             </select>
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="categoryName" class="form-label">Category Name</label>
                             <input type="text" class="form-control" placeholder="Enter Category Name" name="name"
                                 value="{{ old('name') }}" />
                         </div>

                     </div>
                     <div class="col-md-6 mb-3">
                         <label for="" class="form-label">Status</label>
                         <select class="form-select" id="" name="status">
                             <option value="">Status</option>
                             <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                             <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                         </select>
                     </div>
                     <div class="mb-3">
                         <label for="description" class="form-label">Description</label>
                         <textarea class="form-control" placeholder="Enter description" name="description">{{ old('description') }}</textarea>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Close
                         </button>
                         <button type="button" class="btn btn-primary add_category">
                             Save Category
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
             //  $("#categoryForm").on("submit", function(e) {
             $(document).on('click', '.add_category', function(e) {
                 e.preventDefault();
                 let formData = new FormData($('#categoryForm')[0]);
                 $.ajax({
                     url: "{{ route('category.store') }}",
                     type: "POST",
                     data: formData,
                     processData: false,
                     contentType: false,
                     //  headers: {
                     //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     //  },
                     success: function(response) {
                         // Hide the modal and reset form if successful
                         $("#addCategoryModal").modal('hide');
                         if (response.success) {
                             $("#categoryForm")[0].reset();
                             //  $("#categoryTable").load(location.href + " #categoryTable");
                             $(".error-message").remove();
                             // Completely refresh the data by making an AJAX call
                             $.ajax({
                                 url: window.location.href,
                                 type: 'GET',
                                 success: function(data) {
                                     // Extract the table HTML from the response
                                     let newTableHTML = $(data).find(
                                         '#categoryTable').html();

                                     // First destroy the existing DataTable
                                     let table = $('#categoryTable').DataTable();
                                     table.destroy();

                                     // Replace the table HTML
                                     $('#categoryTable').html(newTableHTML);

                                     // Reinitialize DataTable
                                     $('#categoryTable').DataTable({
                                         responsive: true,
                                         order: [
                                             [0, 'desc']
                                         ],
                                         language: {
                                             search: "_INPUT_",
                                             searchPlaceholder: "Search category...",
                                             lengthMenu: "Show _MENU_ category per page",
                                             info: "Showing _START_ to _END_ of _TOTAL_ categorys",
                                             infoEmpty: "No categorys found",
                                             infoFiltered: "(filtered from _MAX_ total categorys)",
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
                                     toastr.success("Category added successfully");
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
