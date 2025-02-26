@extends('admin.layouts.master')
@section('admin.content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">New Product</h4>
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Back to Products
            </a>
        </div>
        <div class="container-fluid py-4">

            <form id="productForm" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Product Information -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-info-circle text-primary"></i>
                        <h5 class="mb-0">Product Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Store</label>
                            <select class="form-select" name="store">
                                <option>Choose</option>
                                <option value="Thomas" {{ old('store') == 'Thomas' ? 'selected' : '' }}>Thomas</option>
                                <option value="Rasmussen" {{ old('store') == 'Rasmussen' ? 'selected' : '' }}>Rasmussen
                                </option>
                                <option value="Fred john" {{ old('store') == 'Fred john' ? 'selected' : '' }}>Fred john
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Warehouse</label>
                            <select class="form-select" name="warehouse">
                                <option>Choose</option>
                                <option value="Legendary" {{ old('warehouse') == 'Legendary' ? 'selected' : '' }}>Legendary
                                </option>
                                <option value="Determined" {{ old('warehouse') == 'Determined' ? 'selected' : '' }}>
                                    Determined</option>
                                <option value="Sincere" {{ old('warehouse') == 'Sincere' ? 'selected' : '' }}>Sincere
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter SKU" name="sku"
                                    value="{{ old('sku') }}">
                                @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <div class="input-group">
                                <select class="form-select selectpicker" name="category_id[]" data-live-search="true"
                                    multiple>
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
                                <button class="add-new-btn" type="button" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target="#showCategoryModal">Add New</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Discount Type</label>
                            <div class="input-group">
                                <select class="form-select" name="discount_type">

                                    <option>Choose</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Cash">Cash</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Discount Value</label>
                            <div class="input-group">
                                <input type="text" placeholder="Choose" class="form-control" name="discount_value">


                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <div class="input-group">
                                <select class="form-select"name="brand">
                                    <option>Choose</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#showBrandModal">Add New</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit</label>
                            <div class="input-group">
                                <select class="form-select" name="unit">
                                    <option>Choose</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->short_name }}">{{ $unit->short_name }}</option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#showUnitModal">Add New</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Selling Type</label>
                            <select class="form-select"name="selling_type">
                                <option>Choose</option>
                                <option>Transactional selling</option>
                                <option>Solution selling</option>
                            </select>
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">Tax Type</label>
                            <select class="form-select" name="tax_type">
                                <option value="">Choose</option>
                                <option value="exclusive">Exclusive</option>
                                <option value="inclusive">Inclusive</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Item Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="Please Enter Item Code"name="item_code" />

                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" name="description"></textarea>
                            <small class="text-muted">Maximum 60 Characters</small>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Stocks -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-currency-dollar text-primary"></i>
                        <h5 class="mb-0">Pricing & Stocks</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Product Type</label>
                        <div>
                            <select class="form-select" name="productType" id="productType">
                                <option value="single" selected>Single Product</option>
                                <option value="variable">Variable Product</option>
                            </select>
                        </div>
                    </div>

                    <!-- Single Product Section -->
                    <div class="single-product-section" style="display: none;">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity Alert</label>
                                <input type="number" class="form-control" name="quantity_alert" />
                            </div>

                        </div>
                    </div>

                    <!-- Variable Product Section -->


                    <div class="mb-3" id="variantSection" style="display: none;">
                        <label class="form-label">Select Variants</label>
                        <select class="form-select selectpicker" id="variantDropdown" multiple>

                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="variantValuesSection"></div>
                    <div id="combinationContainer"></div>

                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Manufactured Date</label>
                        <i data-feather="calendar" class="info-img"></i>
                        <input type="date" class="form-control" name="manufactured_date" placeholder="Choose Date">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Expiry On</label>
                        <i data-feather="calendar" class="info-img"></i>
                        <input type="date" class="form-control" name="expired_date" placeholder="Choose Date">
                    </div>
                </div>

                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-images text-primary"></i>
                        <h5 class="mb-0">Product Images</h5>
                    </div>

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
                        <div class="image-upload-container">
                            <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                                <div class="border rounded p-2" style="width: 100px; height: 100px">
                                    <label for="productImages"
                                        class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer">
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
                        <div id="variantValueTable" class="mt-4">
                            <!-- Variant values and image upload interface will be dynamically inserted here -->
                        </div>
                    </div>
                </div>

                <!-- Add these styles to your CSS -->
                <style>
                    .cursor-pointer {
                        cursor: pointer;
                    }

                    .image-upload-container {
                        min-height: 120px;
                    }

                    .upload-box:hover {
                        background-color: #f8f9fa;
                    }

                    .variant-image-input {
                        visibility: hidden;
                        position: absolute;
                    }
                </style>



                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.category.create')
    @include('admin.unit.create')
    @include('admin.brand.create')
    @include('admin.variant.create')
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
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
        // const imageInput = document.getElementById("productImages");
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

        // Image Preview Handler
        imageInput.addEventListener("change", function(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("d-flex", "flex-column", "align-items-center",
                        "m-2");

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList.add("img-thumbnail");
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";

                    const removeButton = document.createElement("button");
                    removeButton.textContent = "Removeeeee";
                    removeButton.classList.add("btn", "btn-sm", "btn-danger", "mt-2");
                    removeButton.onclick = () => imgContainer.remove();

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeButton);
                    imagePreviewContainer.insertBefore(imgContainer, imagePreviewContainer
                        .lastElementChild);
                };

                reader.readAsDataURL(file);
            }
        });

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

        $('.selectpicker').selectpicker({
            width: '80%',
            liveSearch: true,
            container: 'body' // This ensures dropdown renders at body level
        });
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
                <select class="form-select selectpicker variant-values"
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
            <div class="card-header bg-light">
                <h5 class="mb-0">Global Price & Stock Settings</h5>
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
