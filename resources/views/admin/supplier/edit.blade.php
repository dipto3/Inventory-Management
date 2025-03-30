 <!-- Add this modal at the bottom of your body (before the scripts) -->
 <div class="modal fade" id="editSupplierModal{{ $supplier->id }}" tabindex="-1" aria-labelledby="addSupplierModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editSupplierModal{{ $supplier->id }}">
                     Edit Supplier
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="{{ route('supplier.update', $supplier->id ?? '') }}"
                     enctype="multipart/form-data">
                     @csrf
                     @method('PUT')
                     <input type="hidden" name="supplier_id" id="supplier_id" value="{{ $supplier->id }}"
                         class="form-control">
                     <div class="row">
                         <div class="col-md-6 mb-3">
                             <label for="SupplierName" class="form-label">Supplier Name</label>
                             <input type="text"class="form-control" placeholder="Enter Supplier Name" name="name"
                                 value="{{ old('name', $supplier->name) }}" required />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierName" class="form-label">Supplier email</label>
                             <input type="email"class="form-control" placeholder="Enter Supplier Email" name="email"
                                 value="{{ old('email', $supplier->email) }}" required />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierPhone" class="form-label">Supplier phone</label>
                             <input type="number"class="form-control" placeholder="Enter Supplier phone" name="phone"
                                 value="{{ old('phone', $supplier->phone) }}" required />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierCity" class="form-label">Supplier city</label>
                             <input type="text"class="form-control" placeholder="Enter Supplier city" name="city"
                                 value="{{ old('city', $supplier->city) }}" required />
                         </div>
                         <div class="col-md-6 mb-3">
                             <label for="SupplierCategory" class="form-label">Status</label>
                             <select class="form-select" id="" name="status">
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
                             required>{{ old('address', $supplier->address) }}</textarea>
                     </div>
                     <div class="col-md-6 mb-3">
                         <label for="" class="form-label">Image</label>
                         <input type="file"class="form-control" name="image"/>
                         @isset($supplier)
                             <img src="{{ asset('storage/'. $supplier->image) }}" style="height: 100px;width:100px;"
                                 class="" alt="" />
                         @endisset
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Close
                         </button>
                         <button type="submit" class="btn btn-primary">
                             Save Supplier
                         </button>
                     </div>
                 </form>
             </div>

         </div>
     </div>
 </div>
