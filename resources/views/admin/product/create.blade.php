@extends('admin.layouts.master')
@section('admin.content')
{{-- Breadcrumb --}}
<div class="container-p-y">
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">  <!-- mb-0 removes bottom margin -->
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Inventory</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
{{-- End Breadcrumb --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Product</h5>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" id="productForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Store</label>
                        <select class="form-select" name="store">
                            <option>Choose</option>
                            <option value="Thomas" {{ old('store') == 'Thomas' ? 'selected' : '' }}>Thomas</option>
                            <option value="Rasmussen" {{ old('store') == 'Rasmussen' ? 'selected' : '' }}>Rasmussen</option>
                            <option value="Fred john" {{ old('store') == 'Fred john' ? 'selected' : '' }}>Fred john</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warehouse</label>
                        <select class="form-select" name="warehouse">
                            <option>Choose</option>
                            <option value="Legendary" {{ old('warehouse') == 'Legendary' ? 'selected' : '' }}>Legendary
                            </option>
                            <option value="Determined" {{ old('warehouse') == 'Determined' ? 'selected' : '' }}>Determined
                            </option>
                            <option value="Sincere" {{ old('warehouse') == 'Sincere' ? 'selected' : '' }}>Sincere</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            placeholder="Enter Product Name" />
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" placeholder="Enter SKU" name="sku"
                            value="{{ old('sku') }}">
                        @error('sku')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select select2-categories" name="category_id[]" id="productCategory"
                            multiple="multiple" data-placeholder="Select categories...">
                            <option value="">Choose</option>
                            @foreach ($categories as $category)
                                <option class="parent-category" value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @foreach ($category->childrenCategories as $child)
                                    <option value="{{ $child->id }}"
                                        {{ in_array($child->id, old('category_id', [])) ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;{{ $category->name }} >> {{ $child->name }}
                                    </option>
                                    @foreach ($child->categories as $grandchild)
                                        <option value="{{ $grandchild->id }}"
                                            {{ in_array($grandchild->id, old('category_id', [])) ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $category->name }} >>
                                            {{ $child->name }} >> {{ $grandchild->name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @error('category_id.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Type</label>
                        <select class="form-select" name="discount_type">
                            <option>Choose</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Cash">Cash</option>
                        </select>
                        @error('discount_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Discount Value</label>
                        <input type="number" placeholder="Choose" class="form-control" name="discount_value">
                        @error('discount_value')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Brand</label>
                        <select class="form-select" name="brand">
                            <option value="">Choose</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->name }}" {{ old('brand') == $brand->name ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>

                        </select>
                        @error('brand')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit</label>
                        <select class="form-select" name="unit">
                            <option value="">Choose</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->short_name }}"
                                    {{ old('unit') == $unit->short_name ? 'selected' : '' }}>
                                    {{ $unit->short_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Selling Type</label>
                        <select class="form-select" name="selling_type">
                            <option value="{{ old('selling_type') }}">Choose</option>
                            <option>Transactional selling</option>
                            <option>Solution selling</option>
                        </select>
                        @error('selling_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tax Type</label>
                        <select class="form-select" name="tax_type">
                            <option value="">Choose</option>
                            <option value="exclusive">Exclusive</option>
                            <option value="inclusive">Inclusive</option>
                        </select>
                        @error('tax_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Item Code</label>
                        <input type="text" class="form-control" placeholder="Please Enter Item Code"
                            name="item_code">
                        @error('item_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="4" name="description"></textarea>
                        <small class="text-muted">Maximum 60 Characters</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Product Type</label>
                        <select class="form-select" name="productType" id="productType">
                            <option value="single" selected>Single Product</option>
                            <option value="variable">Variable Product</option>
                        </select>
                        @error('productType')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Single Product Section -->
                    <div class="single-product-section" style="display: none;">
                        <div class="row g-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price">
                                @error('purchase_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantity Alert</label>
                                <input type="number" class="form-control" name="quantity_alert" value="{{ old('quantity_alert') }}">
                                @error('quantity_alert')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variable Product Section -->
                <div class="row" id="variantSection" style="display: none;">
                    <div class="col-12 mb-3">
                        <label class="form-label">Select Variants</label>

                        <select class="selectpicker form-control" id="variantDropdown" multiple>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>


                    </div>
                </div>

                <div class="row" id="variantValuesSection"></div>
                <div class="row" id="combinationContainer"></div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Manufactured Date</label>
                        <input type="date" class="form-control" name="manufactured_date" placeholder="Choose Date">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Expiry On</label>
                        <input type="date" class="form-control" name="expired_date" placeholder="Choose Date">
                    </div>
                </div>

                <div class="form-section mb-4">
                    <h5 class="mb-3"><i class="bi bi-images"></i> Product Images</h5>

                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="image_type" id="regularImage"
                                value="regular" checked>
                            <label class="form-check-label" for="regularImage">Regular Image</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="image_type" id="variantImage"
                                value="variant">
                            <label class="form-check-label" for="variantImage">Variant Image</label>
                        </div>
                    </div>

                    <!-- Regular Image Section -->
                    <div id="regularImageSection">
                        <div class="image-upload-container border rounded p-3">
                            <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                                <div class="border rounded p-2 upload-box" style="width: 100px; height: 100px">
                                    <label for="productImages"
                                        class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer mb-0">
                                        <i class="bi bi-cloud-upload fs-3"></i>
                                        <span class="small text-muted">Upload</span>
                                    </label>
                                </div>
                            </div>
                            <input type="file" id="productImages" multiple class="d-none" name="image[]"
                                accept="image/*">
                        </div>
                    </div>

                    <!-- Variant Image Section -->
                    <div id="variantImageOptions" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Variant</label>
                                <select class="form-select" id="variantSelect" name="imageVariant_id">
                                    <option value="">Choose Variant</option>
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="variantValueTable" class="mt-4"></div>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" name="is_featured" type="checkbox" id="featuredProduct">
                    <label class="form-check-label" for="featuredProduct">Featured Product</label>
                </div>

                <div class="form-footer text-end">
                    <button type="reset" class="btn btn-outline-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary add_product">Create</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .select2-container--bootstrap-5 .select2-results__option[aria-disabled=true] {
            color: #6c757d;
            font-weight: 600;
            padding-left: 8px;
            background-color: #f8f9fa;
        }

        .select2-container--bootstrap-5 .select2-results__option[aria-selected=true] {
            background-color: #e9ecef;
            color: #495057;
        }

        .upload-box {
            transition: all 0.2s ease;
        }

        .upload-box:hover {
            background-color: #f8f9fa;
            border-color: #86b7fe;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .image-preview {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 20px;
            height: 20px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .variant-image-input {
            visibility: hidden;
            position: absolute;
        }

        #combinationContainer table {
            width: 100%;
        }

        #combinationContainer th,
        #combinationContainer td {
            vertical-align: middle;
        }

        #combinationContainer .form-control {
            min-width: 100px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet" />
    <style>
        /* Style for parent categories in dropdown */
        .select2-container--bootstrap-5 .select2-results__option[aria-disabled=true] {
            color: #6c757d;
            font-weight: 600;
            padding-left: 8px;
            background-color: #f8f9fa;
        }

        /* Style for selected items */
        .select2-container--bootstrap-5 .select2-results__option[aria-selected=true] {
            background-color: #e9ecef;
            color: #495057;
        }
    </style>
    @push('scripts')
        <!-- JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.select2-categories').select2({
                        theme: 'bootstrap-5',
                        width: '100%',
                        closeOnSelect: false,
                        templateResult: function(data) {
                            // Style parent categories differently
                            if (data.element && data.element.classList.contains('parent-category')) {
                                return $('<span style="">' + data.text +
                                    '</span>');
                            }
                            return data.text;
                        },
                        escapeMarkup: function(markup) {
                            return markup;
                        }
                    });
                });
            </script>
        @endpush
    @endpush
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Core elements
            const form = document.getElementById("productForm");
            const regularImageInput = document.getElementById("productImages");
            const regularPreviewContainer = document.getElementById("imagePreviewContainer");
            const regularImageSection = document.getElementById('regularImageSection');
            const variantImageOptions = document.getElementById('variantImageOptions');

            // Toggle image type sections
            document.querySelectorAll('input[name="image_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    variantImageOptions.style.display = (this.value === 'variant') ? 'block' :
                        'none';
                    regularImageSection.style.display = (this.value === 'regular') ? 'block' :
                        'none';
                });
            });

            // Handle regular image uploads
            regularImageInput.addEventListener("change", function(event) {
                const files = event.target.files;
                for (let file of files) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgContainer = createImagePreviewElement(e.target.result);
                        regularPreviewContainer.insertBefore(imgContainer, regularPreviewContainer
                            .lastElementChild);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle variant selection and image upload
            document.getElementById('variantSelect').addEventListener('change', function() {
                if (!this.value) return;

                fetch(`/admin/variants/${this.value}/values`)
                    .then(response => response.json())
                    .then(data => {
                        const tableHTML = generateVariantValueTable(data);
                        document.getElementById('variantValueTable').innerHTML = tableHTML;

                        // Add upload handlers to new inputs
                        document.querySelectorAll('.variant-image-input').forEach(input => {
                            input.addEventListener('change', handleVariantImageUpload);
                        });
                    });
            });

            function createImagePreviewElement(imageSrc) {
                const container = document.createElement("div");
                container.classList.add("border", "rounded", "p-2", "position-relative");
                container.style.width = "100px";
                container.style.height = "100px";

                const img = document.createElement("img");
                img.src = imageSrc;
                img.classList.add("img-fluid", "h-100", "w-100");
                img.style.objectFit = "cover";

                const removeBtn = document.createElement("button");
                removeBtn.innerHTML = '<i class="bi bi-x"></i>';
                removeBtn.classList.add("btn", "btn-sm", "btn-danger", "position-absolute", "top-0", "end-0", "p-0",
                    "m-1");
                removeBtn.style.width = "20px";
                removeBtn.style.height = "20px";
                removeBtn.onclick = (e) => {
                    e.preventDefault();
                    container.remove();
                };

                container.appendChild(img);
                container.appendChild(removeBtn);
                return container;
            }

            function generateVariantValueTable(data) {
                return `
       <table class="table table-bordered">
           <tbody>
               ${data.map(value => `
                                                                                                                                                         <tr>
                                                                                                                                                             <td class="align-middle">
                                                                                                                                                                 ${value.value}
                                                                                                                                                                 <input type="hidden" name="variant_value_ids[${value.id}]" value="${value.value}">
                                                                                                                                                             </td>
                                                                                                                                                             <td>
                                                                                                                                                                 <div class="d-flex flex-wrap gap-2 image-container" id="imagePreview_${value.id}">
                                                                                                                                                                     <div class="upload-box border rounded p-2" style="width: 100px; height: 100px">
                                                                                                                                                                         <label for="variantImage_${value.id}" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer mb-0">
                                                                                                                                                                             <i class="bi bi-plus-circle fs-3"></i>
                                                                                                                                                                             <span class="small text-muted">Add Images</span>
                                                                                                                                                                         </label>
                                                                                                                                                                     </div>
                                                                                                                                                                 </div>
                                                                                                                                                                 <input type="file"
                                                                                                                                                                     id="variantImage_${value.id}"
                                                                                                                                                                     class="variant-image-input d-none"
                                                                                                                                                                     name="variant_images[${value.id}][]"
                                                                                                                                                                     multiple
                                                                                                                                                                     accept="image/*"
                                                                                                                                                                     data-value-id="${value.id}">
                                                                                                                                                             </td>
                                                                                                                                                         </tr>
                                                                                                                                                     `).join('')}
           </tbody>
       </table>
   `;
            }

            function handleVariantImageUpload(event) {
                const valueId = event.target.dataset.valueId;
                const previewContainer = document.getElementById(`imagePreview_${valueId}`);
                const uploadBox = previewContainer.querySelector('.upload-box');

                // Create fresh file input
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = `variant_images[${valueId}][]`;
                newInput.multiple = true;
                newInput.style.display = 'none';

                // Transfer only the newly selected files
                const transfer = new DataTransfer();
                Array.from(event.target.files).forEach(file => {
                    transfer.items.add(file);
                });
                newInput.files = transfer.files;

                // Remove any existing input and add new one
                const form = event.target.closest('form');
                form.querySelectorAll(`input[name="variant_images[${valueId}][]"]`).forEach(el => el.remove());
                form.appendChild(newInput);

                // Clear and update previews
                previewContainer.querySelectorAll('.preview-container').forEach(el => el.remove());

                Array.from(event.target.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewContainer.insertBefore(
                            createImagePreviewElement(e.target.result),
                            uploadBox
                        );
                    };
                    reader.readAsDataURL(file);
                });
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // DOM Elements
            const form = document.getElementById("productForm");
            const imageInput = document.getElementById("productImages");
            const imagePreviewContainer = document.getElementById("imagePreviewContainer");
            const productTypeSelect = document.getElementById("productType");
            const singleProductSection = document.querySelector(".single-product-section");
            const variantSection = document.getElementById("variantSection");
            const combinationContainer = document.getElementById("combinationContainer");
            const variantDropdown = document.getElementById("variantDropdown");

            // Data
            const variantData = @json($variants);

            // Initialize product type sections
            function initializeProductType() {
                if (productTypeSelect.value === 'single') {
                    singleProductSection.style.display = "block";
                    variantSection.style.display = "none";
                    combinationContainer.innerHTML = "";
                } else {
                    singleProductSection.style.display = "none";
                    variantSection.style.display = "block";
                }
            }

            // Call initialization on page load
            initializeProductType();

            // Product Type Handler
            productTypeSelect.addEventListener("change", function() {
                if (this.value === "single") {
                    singleProductSection.style.display = "block";
                    variantSection.style.display = "none";
                    variantValuesSection.innerHTML = "";
                    combinationContainer.innerHTML = "";
                } else {
                    singleProductSection.style.display = "none";
                    variantSection.style.display = "block";


                }
            });

        });

        document.addEventListener("DOMContentLoaded", function() {
            const variantData = @json($variants);

            // $('.selectpicker').selectpicker({
            //     width: '100%',
            //     liveSearch: true,
            //     container: 'body' // This is important for proper positioning
            // });
            $('#variantDropdown').on('changed.bs.select', function() {
                const selectedVariantIds = $(this).val() || [];
                showVariantValueSelections(selectedVariantIds);
                // Clear combinations when variants change
                $('#combinationContainer').empty();
            });

            function showVariantValueSelections(selectedVariantIds) {
                const valuesSection = $('#variantValuesSection');

                // Clear existing dropdowns if no variants selected
                if (!selectedVariantIds.length) {
                    valuesSection.empty();
                    return;
                }

                let html = '';

                // Get selected variants
                const selectedVariants = selectedVariantIds.map(id =>
                    variantData.find(v => v.id == id)
                );

                // Create dropdowns for all selected variants
                selectedVariants.forEach(variant => {
                    html += `
           <div class="mb-3">
               <label class="form-label">Select ${variant.name}</label>
               <select class="selectpicker variant-values"
                       id="${variant.name.toLowerCase()}Select"
                       data-variant="${variant.name}"
                       multiple
                       data-live-search="true">
                   ${variant.variant_values.map(value =>
                       `<option value="${value.id}">${value.value}</option>`
                   ).join('')}
               </select>
           </div>`;
                });

                valuesSection.html(html);
                $('.variant-values').selectpicker();

                // Add change listener to variant value selections
                $('.variant-values').on('changed.bs.select', function() {
                    const variantSelections = {};

                    // Collect all selected values
                    $('.variant-values').each(function() {
                        const variantName = $(this).data('variant');
                        const selectedValues = $(this).val();
                        if (selectedValues?.length) {
                            variantSelections[variantName] = selectedValues.map(value => ({
                                id: value,
                                value: $(this).find(`option[value='${value}']`).text()
                            }));
                        }
                    });

                    // Generate combinations if all variants have selections
                    if (Object.keys(variantSelections).length === selectedVariants.length) {
                        const combinations = generateAllCombinations(variantSelections);
                        renderCombinationsTable(combinations, selectedVariants);
                    } else {
                        $('#combinationContainer').empty();
                    }
                });
            }

            function generateAllCombinations(variantSelections) {
                const variants = Object.keys(variantSelections);
                const combinations = [{}];

                variants.forEach(variant => {
                    const temp = [];
                    combinations.forEach(combo => {
                        variantSelections[variant].forEach(value => {
                            temp.push({
                                ...combo,
                                [variant]: value
                            });
                        });
                    });
                    combinations.length = 0;
                    combinations.push(...temp);
                });

                return combinations;
            }

            function renderCombinationsTable(combinations, selectedVariants) {
                let html = `
   <div class="mt-4">
       <div class="card mb-3">
           <div class="card-header">
               <h5 class="mb-0"><i class="bi bi-cash-stack"></i> Global Price & Stock Settings</h5>
           </div>
           <div class="card-body">
               <div class="row">
                   <div class="col-md-3">
                       <div class="input-group">
                           <input type="number" class="form-control" id="globalPrice" placeholder="Set price for all">
                           <span class="input-group-text">Price</span>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="input-group">
                           <input type="number" class="form-control" id="globalPurchasePrice" placeholder="Set purchase price">
                           <span class="input-group-text">Purchase Price</span>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="input-group">
                           <input type="number" class="form-control" id="globalQuantity" placeholder="Set quantity">
                           <span class="input-group-text">Quantity</span>
                       </div>
                   </div>
                   <div class="col-md-3">
                       <div class="input-group">
                           <input type="number" class="form-control" id="globalQuantityAlert" placeholder="Set alert">
                           <span class="input-group-text">Alert</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <table class="table">
           <thead>
               <tr>
                   <th>Combination</th>
                   <th>Price</th>
                   <th>Quantity</th>
                   <th>Purchase Price</th>
                   <th>Quantity Alert</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>`;

                combinations.forEach((combo, index) => {
                    const combinationName = Object.entries(combo)
                        .map(([variant, value]) => `${variant}: ${value.value}`)
                        .join(', ');
                    const variantIds = selectedVariants.map(v => v.id).join(',');

                    html += `
       <tr>
           <td>
               ${combinationName}
               <input type="hidden" name="child_products[${index}][combination]" value="${combinationName}">
               <input type="hidden" name="child_products[${index}][variant_ids]" value="${variantIds}">
           </td>
           <td><input type="number" class="form-control price-input" name="child_products[${index}][price]"></td>
           <td><input type="number" class="form-control quantity" name="child_products[${index}][quantity]"></td>
           <td><input type="number" class="form-control purchase-price-input" name="child_products[${index}][purchase_price]"></td>
           <td><input type="number" class="form-control quantity_alert" name="child_products[${index}][quantity_alert]"></td>
           <td><button type="button" class="btn btn-danger btn-sm remove-combination">Remove</button></td>
       </tr>`;
                });

                html += '</tbody></table></div>';
                $('#combinationContainer').html(html);

                // Global input handlers
                $('#globalPrice').on('input', function() {
                    $('.price-input').val($(this).val());
                });

                $('#globalPurchasePrice').on('input', function() {
                    $('.purchase-price-input').val($(this).val());
                });

                $('#globalQuantity').on('input', function() {
                    $('.quantity').val($(this).val());
                });

                $('#globalQuantityAlert').on('input', function() {
                    $('.quantity_alert').val($(this).val());
                });

                $('.remove-combination').click(function() {
                    $(this).closest('tr').remove();
                });
            }
        });
    </script>
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
            //  $("#productForm").on("submit", function(e) {
            $(document).on('click', '.add_product', function(e) {
                e.preventDefault();
                let formData = new FormData($('#productForm')[0]);
                $.ajax({
                    url: "{{ route('product.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    //  headers: {
                    //      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //  },
                    success: function(response) {
                        // Hide the modal and reset form if successful
                        // $("#addBrandModal").modal('hide');
                        if (response.success) {
                            $("#productForm")[0].reset();
                            window.location.href = "{{ route('product.index') }}";
                            //  $("#productTable").load(location.href + " #productTable");
                            $(".error-message").remove();
                            // Completely refresh the data by making an AJAX call
                            $.ajax({
                                url: window.location.href,
                                type: 'GET',
                                success: function(data) {
                                    // Extract the table HTML from the response
                                    let newTableHTML = $(data).find(
                                        '#productTable').html();

                                    // First destroy the existing DataTable
                                    let table = $('#productTable').DataTable();
                                    table.destroy();

                                    // Replace the table HTML
                                    $('#productTable').html(newTableHTML);

                                    // Reinitialize DataTable
                                    $('#productTable').DataTable({
                                        responsive: true,
                                        order: [
                                            [0, 'desc']
                                        ],
                                        language: {
                                            search: "_INPUT_",
                                            searchPlaceholder: "Search Brand...",
                                            lengthMenu: "Show _MENU_ Brand per page",
                                            info: "Showing _START_ to _END_ of _TOTAL_ products",
                                            infoEmpty: "No products found",
                                            infoFiltered: "(filtered from _MAX_ total products)",
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
                                    toastr.success("Brand added successfully");
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
                            // Clear existing errors
                            $('.error-message').remove();

                            // Display errors next to the fields
                            $.each(errors, function(field, messages) {
                                // Handle array fields differently
                                if (field.includes('.')) {
                                    // This is an array field error (like category_id.0)
                                    let baseField = field.split('.')[0];
                                    let element = $(`[name="${baseField}[]"]`);
                                    if (element.length) {
                                        element.closest('.mb-3').append(
                                            `<small class="text-danger error-message">${messages[0]}</small>`
                                        );
                                    }
                                } else {
                                    // Regular field error
                                    let element = $(
                                        `[name="${field}"], [name="${field}[]"]`);
                                    if (element.length) {
                                        element.closest('.mb-3').append(
                                            `<small class="text-danger error-message">${messages[0]}</small>`
                                        );
                                    }
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
