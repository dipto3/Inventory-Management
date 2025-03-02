@extends('admin.layouts.master')
@section('admin.content')
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">Edit Product</h4>
            <a href="{{ route('product.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Back to Products
            </a>
        </div>
        <div class="container-fluid py-4">
            <form id="productForm" action="{{ route('product.update', $product->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Information -->
                <div class="form-section">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-info-circle text-primary"></i> Product Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Store</label>
                            <select class="form-select" name="store">
                                <option>Choose</option>
                                <option value="Thomas" {{ $product->store == 'Thomas' ? 'selected' : '' }}>Thomas</option>
                                <option value="Rasmussen" {{ $product->store == 'Rasmussen' ? 'selected' : '' }}>Rasmussen
                                </option>
                                <option value="Fred john" {{ $product->store == 'Fred john' ? 'selected' : '' }}>Fred john
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Warehouse</label>
                            <select class="form-select" name="warehouse">
                                <option>Choose</option>
                                <option value="Legendary" {{ $product->warehouse == 'Legendary' ? 'selected' : '' }}>
                                    Legendary</option>
                                <option value="Determined" {{ $product->warehouse == 'Determined' ? 'selected' : '' }}>
                                    Determined</option>
                                <option value="Sincere" {{ $product->warehouse == 'Sincere' ? 'selected' : '' }}>Sincere
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}" />
                            @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" name="sku" value="{{ $product->sku }}" />
                            @error('sku')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('admin.category.child_category', [
                                                'child_category' => $childCategory,
                                                'category' => $category1,
                                                'selected_categories' => $product->categories->pluck('id')->toArray(),
                                            ])
                                        @endforeach
                                        @php
                                            array_pop($category1);
                                        @endphp
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#showCategoryModal">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Discount Type</label>
                            <select class="form-select" name="discount_type">
                                <option>Choose</option>
                                <option value="Percentage" {{ $product->discount_type == 'Percentage' ? 'selected' : '' }}>
                                    Percentage</option>
                                <option value="Cash" {{ $product->discount_type == 'Cash' ? 'selected' : '' }}>Cash
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Discount Value</label>
                            <input type="text" class="form-control" name="discount_value"
                                value="{{ $product->discount_value }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <div class="input-group">
                                <select class="form-select" name="brand">
                                    <option>Choose</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}"
                                            {{ $product->brand == $brand->name ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
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
                                        <option value="{{ $unit->short_name }}"
                                            {{ $product->unit == $unit->short_name ? 'selected' : '' }}>
                                            {{ $unit->short_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#showUnitModal">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Selling Type</label>
                            <select class="form-select" name="selling_type">
                                <option>Choose</option>
                                <option {{ $product->selling_type == 'Transactional selling' ? 'selected' : '' }}>
                                    Transactional selling</option>
                                <option {{ $product->selling_type == 'Solution selling' ? 'selected' : '' }}>Solution
                                    selling</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tax Type</label>
                            <select class="form-select" name="tax_type">
                                <option value="">Choose</option>
                                <option value="exclusive" {{ $product->tax_type == 'exclusive' ? 'selected' : '' }}>
                                    Exclusive</option>
                                <option value="inclusive" {{ $product->tax_type == 'inclusive' ? 'selected' : '' }}>
                                    Inclusive</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Item Code</label>
                            <input type="text" class="form-control" name="item_code"
                                value="{{ $product->item_code }}" />
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                            <small class="text-muted">Maximum 60 Characters</small>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Stocks -->
                <div class="form-section">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-currency-dollar text-primary"></i> Pricing & Stocks</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Product Type</label>
                        <select class="form-select" name="productType" id="productType">
                            <option value="single" {{ $product->product_type == 'single' ? 'selected' : '' }}>Single
                                Product</option>
                            <option value="variable" {{ $product->product_type == 'variable' ? 'selected' : '' }}>Variable
                                Product</option>
                        </select>
                    </div>

                    <!-- Single Product Section -->
                    <div class="single-product-section" style="{{ !$product->is_variable ? '' : 'display: none;' }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity"
                                    value="{{ $product->quantity }}" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="price"
                                    value="{{ $product->price }}" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price"
                                    value="{{ $product->purchase_price }}" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity Alert</label>
                                <input type="number" class="form-control" name="quantity_alert"
                                    value="{{ $product->quantity_alert }}" />
                            </div>
                        </div>
                    </div>

                    <!-- Variable Product Section -->
                    <div class="mb-3" id="variantSection"
                        style="{{ $product->product_type == 'variable' ? '' : 'display: none;' }}">
                        <label class="form-label">Select Variants</label>
                        <select class="form-select selectpicker" id="variantDropdown" multiple>
                            @foreach ($variants as $variant)
                                @php
                                    $isSelected = $product
                                        ->variants()
                                        ->whereHas('variantValues', function ($query) use ($variant) {
                                            $query->where('variant_id', $variant->id);
                                        })
                                        ->exists();
                                @endphp
                                <option value="{{ $variant->id }}" {{ $isSelected ? 'selected' : '' }}>
                                    {{ $variant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="variantValuesSection"></div>
                    <div id="combinationContainer"></div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Manufactured Date</label>
                        <input type="date" class="form-control" name="manufactured_date"
                            value="{{ $product->manufactured_date }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" name="expired_date"
                            value="{{ $product->expired_date }}">
                    </div>
                </div>

                <!-- Product Images -->
                <div class="form-section">
                    <div class="form-section-title">
                        <h5 class="mb-0"><i class="bi bi-images text-primary"></i> Product Images</h5>
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

                    <div id="regularImageSection">
                        <div class="image-upload-container">
                            <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                                @foreach ($product->productImage->where('is_variant', false) as $image)
                                    <div class="border rounded p-2 position-relative" style="width: 100px; height: 100px">
                                        <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid h-100 w-100"
                                            style="object-fit: cover">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0 m-1"
                                            style="width: 20px; height: 20px"
                                            onclick="deleteImage({{ $image->id }}, this)">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                @endforeach
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

                    <div id="variantImageOptions" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Select Variant</label>
                                <select class="form-select" id="imageVariantSelect">
                                    <option value="">Choose Variant</option>
                                    @foreach ($variants as $variant)
                                        @php
                                            $hasImages =
                                                $product->productImage
                                                    ->where('is_variant', true)
                                                    ->where('variant_id', $variant->id)
                                                    ->count() > 0;
                                        @endphp
                                        <option value="{{ $variant->id }}" {{ $hasImages ? 'selected' : '' }}>
                                            {{ $variant->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Add hidden input here -->
                                <input type="hidden" name="imageVariant_id" id="imageVariant_id">
                            </div>
                        </div>
                        <div id="variantValueImageTable" class="mt-4">
                        </div>
                    </div>

                </div>




                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.category.create')
    @include('admin.unit.create')
    @include('admin.brand.create')
    @include('admin.variant.create')
@endsection

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productData = @json($product);
        const variantData = @json($variants);

        // Image type toggle handlers
        const regularImage = document.getElementById('regularImage');
        const variantImage = document.getElementById('variantImage');
        const regularImageSection = document.getElementById('regularImageSection');
        const variantImageOptions = document.getElementById('variantImageOptions');
        const regularImageInput = document.getElementById("productImages");
        const regularPreviewContainer = document.getElementById("imagePreviewContainer");

        function toggleImageSections() {
            regularImageSection.style.display = regularImage.checked ? 'block' : 'none';
            variantImageOptions.style.display = variantImage.checked ? 'block' : 'none';
        }

        regularImage.addEventListener('change', toggleImageSections);
        variantImage.addEventListener('change', toggleImageSections);

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

        // Initialize image sections based on existing data
        if (productData.product_image.some(img => img.is_variant)) {
            variantImage.checked = true;
            toggleImageSections();
        }

        $('#imageVariantSelect').on('change', function() {
            const variantId = $(this).val();
            if (variantId) {
                showVariantValuesTable(variantId);
            }
        });

        function showVariantValuesTable(variantId) {
            const variant = variantData.find(v => v.id == variantId);
            const variantValues = variant.variant_values;

            let html = `
        <table class="table">
            <thead>
                <tr>
                    <th>Value</th>
                    <th>Images</th>
                </tr>
            </thead>
            <tbody>`;

            variantValues.forEach(value => {
                const existingImages = productData.product_image.filter(img =>
                    img.is_variant &&
                    img.variant_id === parseInt(variantId) &&
                    img.variant_value_id === value.id
                );

                html += `
            <tr>
                <td>${value.value}</td>
                <td>
                    <div class="d-flex flex-wrap gap-2" id="variant_images_${value.id}">
                        ${existingImages.map(img => `
                            <div class="border rounded p-2 position-relative" style="width: 100px; height: 100px">
                                <img src="/storage/${img.image}" class="img-fluid h-100 w-100" style="object-fit: cover">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0 m-1"
                                    style="width: 20px; height: 20px" 
                                    onclick="deleteVariantImage(${img.id}, this)">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        `).join('')}
                        <div class="border rounded p-2" style="width: 100px; height: 100px">
                            <label for="variant_image_${value.id}" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer">
                                <i class="bi bi-cloud-upload fs-3"></i>
                                <span class="small text-muted">Upload</span>
                            </label>
                        </div>
                    </div>
                    <input type="file" 
                        id="variant_image_${value.id}" 
                        class="variant-image-input d-none" 
                        name="variant_images[${variantId}][${value.id}][]" 
                        multiple 
                        accept="image/*"
                        data-variant="${variantId}"
                        data-value="${value.id}">
                </td>
            </tr>`;
            });

            html += '</tbody></table>';
            $('#variantValueImageTable').html(html);

            document.querySelectorAll('.variant-image-input').forEach(input => {
                input.addEventListener('change', handleVariantImageUpload);
            });
        }

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

        function handleVariantImageUpload(event) {
            const input = event.target;
            const valueId = input.dataset.value;
            const files = input.files;
            const container = document.getElementById(`variant_images_${valueId}`);

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = createImagePreviewElement(e.target.result);
                    container.insertBefore(imageDiv, container.lastElementChild);
                };
                reader.readAsDataURL(file);
            });
        }

        // Initialize variant images if they exist
        const initialVariantId = productData.product_image.find(img => img.is_variant)?.variant_id;
        if (initialVariantId) {
            $('#imageVariantSelect').val(initialVariantId).trigger('change');
        }

        function deleteVariantImage(imageId, element) {
            if (confirm('Are you sure you want to delete this variant image?')) {
                fetch(`/product/image/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            element.closest('.border.rounded').remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function deleteImage(imageId, element) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/product/image/${imageId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            element.closest('.border.rounded').remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productData = @json($product);
        const variantData = @json($variants);

        // Image type toggle handlers
        const regularImage = document.getElementById('regularImage');
        const variantImage = document.getElementById('variantImage');
        const regularImageSection = document.getElementById('regularImageSection');
        const variantImageOptions = document.getElementById('variantImageOptions');
        const regularImageInput = document.getElementById("productImages");
        const regularPreviewContainer = document.getElementById("imagePreviewContainer");

        function toggleImageSections() {
            regularImageSection.style.display = regularImage.checked ? 'block' : 'none';
            variantImageOptions.style.display = variantImage.checked ? 'block' : 'none';
        }

        regularImage.addEventListener('change', toggleImageSections);
        variantImage.addEventListener('change', toggleImageSections);

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

        // Initialize image sections based on existing data
        if (productData.product_image.some(img => img.is_variant)) {
            variantImage.checked = true;
            toggleImageSections();
        }

        $('#imageVariantSelect').on('change', function() {
            const variantId = $(this).val();
            if (variantId) {
                $('#imageVariant_id').val(variantId);
                showVariantValuesTable(variantId);
            }
        });

        function showVariantValuesTable(variantId) {
            const variant = variantData.find(v => v.id == variantId);
            const variantValues = variant.variant_values;

            let html = `
                <table class="table">
                    <thead>
                        <tr>
                            <th>Value</th>
                            <th>Images</th>
                        </tr>
                    </thead>
                    <tbody>`;

            variantValues.forEach(value => {
                const existingImages = productData.product_image.filter(img =>
                    img.is_variant &&
                    img.variant_id === parseInt(variantId) &&
                    img.variant_value_id === value.id
                );

                html += `
                    <tr>
                        <td>${value.value}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-2" id="variant_images_${value.id}">
                                ${existingImages.map(img => `
                                    <div class="border rounded p-2 position-relative" style="width: 100px; height: 100px">
                                        <img src="/storage/${img.image}" class="img-fluid h-100 w-100" style="object-fit: cover">
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 p-0 m-1"
                                            style="width: 20px; height: 20px" 
                                            onclick="deleteVariantImage(${img.id}, this)">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                `).join('')}
                                <div class="border rounded p-2" style="width: 100px; height: 100px">
                                    <label for="variant_image_${value.id}" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer">
                                        <i class="bi bi-cloud-upload fs-3"></i>
                                        <span class="small text-muted">Upload</span>
                                    </label>
                                </div>
                            </div>
                            <input type="file" 
                                id="variant_image_${value.id}" 
                                class="variant-image-input d-none" 
                                name="variant_images[${value.id}][]" 
                                multiple 
                                accept="image/*"
                                data-variant="${variantId}"
                                data-value="${value.id}">
                        </td>
                    </tr>`;
            });

            html += '</tbody></table>';
            $('#variantValueImageTable').html(html);

            document.querySelectorAll('.variant-image-input').forEach(input => {
                input.addEventListener('change', handleVariantImageUpload);
            });
        }

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
            removeBtn.onclick = function(e) {
                e.preventDefault();
                container.remove();
            };

            container.appendChild(img);
            container.appendChild(removeBtn);
            return container;
        }

        function handleVariantImageUpload(event) {
            const input = event.target;
            const valueId = input.dataset.value;
            const files = input.files;
            const container = document.getElementById(`variant_images_${valueId}`);

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageDiv = createImagePreviewElement(e.target.result);
                    container.insertBefore(imageDiv, container.lastElementChild);
                };
                reader.readAsDataURL(file);
            });
        }

        // Initialize variant images if they exist
        const initialVariantId = productData.product_image.find(img => img.is_variant)?.variant_id;
        if (initialVariantId) {
            $('#imageVariantSelect').val(initialVariantId).trigger('change');
            $('#imageVariant_id').val(initialVariantId);
        }
    });

    function deleteImage(imageId, element) {
        $.ajax({
            url: `/product/image/${imageId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $(element).closest('.border.rounded').remove();
                    toastr.success('Image deleted successfully');
                }
            },
            error: function() {
                toastr.error('Error deleting image');
            }
        });
    }

    function deleteVariantImage(imageId, element) {
        $.ajax({
            url: `/product/image/${imageId}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $(element).closest('.border.rounded').remove();
                    toastr.success('Variant image deleted successfully');
                }
            },
            error: function() {
                toastr.error('Error deleting variant image');
            }
        });
    }
</script>




<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productData = @json($product);
        const variantData = @json($variants);

        // Initialize selectpicker
        $('.selectpicker').selectpicker({
            width: '80%',
            liveSearch: true,
            container: 'body'
        });

        // Product type handling
        const productTypeSelect = document.getElementById("productType");
        const singleProductSection = document.querySelector(".single-product-section");
        const variantSection = document.getElementById("variantSection");

        // Initialize product type display
        function initializeProductType() {
            const isVariable = productData.product_type === 'variable';
            singleProductSection.style.display = isVariable ? "none" : "block";
            variantSection.style.display = isVariable ? "block" : "none";

            if (isVariable) {
                const existingVariants = productData.variants;
                if (existingVariants?.length) {
                    loadExistingVariantCombinations(existingVariants);
                }
            }
        }

        function loadExistingVariantCombinations(variants) {
            const combinations = variants.map(variant => ({
                combination: variant.variant_value_name,
                quantity: variant.quantity,
                quantity_alert: variant.quantity_alert,
                price: variant.prices[0]?.price,
                purchase_price: variant.prices[0]?.purchase_price
            }));
            renderCombinationsTable(combinations);
        }

        $('#variantDropdown').on('changed.bs.select', function() {
            const selectedVariantIds = $(this).val() || [];
            showVariantValueSelections(selectedVariantIds);
        });

        function showVariantValueSelections(selectedVariantIds) {
            const valuesSection = $('#variantValuesSection');
            // Don't empty the section if there are existing values
            if (!valuesSection.children().length) {
                valuesSection.empty();
            }

            selectedVariantIds.forEach(variantId => {
                const variant = variantData.find(v => v.id == variantId);
                const existingSelect = $(`#${variant.name.toLowerCase()}Select`);

                // Skip if this variant's select already exists
                if (existingSelect.length) {
                    return;
                }

                // Get existing selected values from product data
                const existingValues = productData.variants
                    .filter(v => v.variant_values.some(vv => vv.variant_id === variant.id))
                    .flatMap(v => v.variant_values)
                    .filter(vv => vv.variant_id === variant.id)
                    .map(vv => vv.variant_value_id);

                const html = `
            <div class="mb-3">
                <label class="form-label">Select ${variant.name}</label>
                <select class="form-select selectpicker variant-values"
                        id="${variant.name.toLowerCase()}Select"
                        data-variant="${variant.name}"
                        multiple
                        data-live-search="true">
                    ${variant.variant_values.map(value =>
                        `<option value="${value.id}" ${existingValues.includes(value.id) ? 'selected' : ''}>
                            ${value.value}
                        </option>`
                    ).join('')}
                </select>
            </div>`;
                valuesSection.append(html);

                // Initialize selectpicker for the new select
                $(`#${variant.name.toLowerCase()}Select`).selectpicker();
            });

            // Reattach change event handler
            $('.variant-values').off('changed.bs.select').on('changed.bs.select', function() {
                const variantSelections = {};
                $('.variant-values').each(function() {
                    const variantName = $(this).data('variant');
                    const selectedValues = $(this).val();
                    if (selectedValues?.length) {
                        variantSelections[variantName] = selectedValues.map(value => ({
                            id: value,
                            value: $(this).find(`option[value='${value}']`).text()
                                .trim()
                        }));
                    }
                });

                if (Object.keys(variantSelections).length > 0) {
                    const combinations = generateAllCombinations(variantSelections);
                    renderCombinationsTable(combinations);
                }
            });
        }
        // Trigger initial load of variant values
        $(document).ready(function() {
            const initialSelectedVariants = $('#variantDropdown').val();
            if (initialSelectedVariants?.length) {
                showVariantValueSelections(initialSelectedVariants);
            }
        });

        function generateCombinations() {
            const selections = {};
            let allSelected = true;

            $('.variant-values').each(function() {
                const variantName = $(this).data('variant');
                const selectedValues = $(this).val();

                if (!selectedValues?.length) {
                    allSelected = false;
                    return false;
                }

                selections[variantName] = selectedValues.map(value => ({
                    id: value,
                    value: $(this).find(`option[value='${value}']`).text()
                }));
            });

            if (allSelected) {
                const combinations = generateAllCombinations(selections);
                renderCombinationsTable(combinations);
            }
        }

        function generateAllCombinations(selections) {
            const variants = Object.keys(selections);
            const combinations = [{}];

            variants.forEach(variant => {
                const temp = [];
                combinations.forEach(combo => {
                    selections[variant].forEach(value => {
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

        function loadExistingVariantCombinations(variants) {
            const existingCombinations = variants.map(variant => ({
                combination: variant.variant_value_name,
                quantity: variant.quantity,
                quantity_alert: variant.quantity_alert,
                price: variant.prices[0]?.price,
                purchase_price: variant.prices[0]?.purchase_price,
                isFromDb: true // Flag to identify combinations from database
            }));
            window.existingCombinations = existingCombinations; // Store globally
            renderCombinationsTable(existingCombinations);
        }

        function renderCombinationsTable(newCombinations) {
            const existingCombinations = window.existingCombinations || [];

            // Normalize combination names for comparison
            const normalizeCombination = (combo) => {
                if (combo.combination) return combo.combination;
                return Object.entries(combo)
                    .filter(([key]) => key !== 'isFromDb')
                    .map(([variant, value]) => `${variant}: ${value.value}`)
                    .sort()
                    .join(', ');
            };

            // Create unique combinations array
            const uniqueCombinations = [...existingCombinations];

            newCombinations.forEach(newCombo => {
                const newComboName = normalizeCombination(newCombo);
                const exists = uniqueCombinations.some(existing =>
                    normalizeCombination(existing) === newComboName
                );

                if (!exists) {
                    uniqueCombinations.push(newCombo);
                }
            });

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

            uniqueCombinations.forEach((combo, index) => {
                const combinationName = combo.combination || normalizeCombination(combo);

                html += `
                <tr>
                    <td>
                        ${combinationName}
                        <input type="hidden" name="child_products[${index}][combination]" value="${combinationName}">
                        <input type="hidden" name="child_products[${index}][variant_ids]" value="${$('#variantDropdown').val().join(',')}">
                    </td>
                    <td><input type="number" class="form-control price-input" name="child_products[${index}][price]" value="${combo.price || ''}"></td>
                    <td><input type="number" class="form-control quantity" name="child_products[${index}][quantity]" value="${combo.quantity || ''}"></td>
                    <td><input type="number" class="form-control purchase-price-input" name="child_products[${index}][purchase_price]" value="${combo.purchase_price || ''}"></td>
                    <td><input type="number" class="form-control quantity_alert" name="child_products[${index}][quantity_alert]" value="${combo.quantity_alert || ''}"></td>
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
        // Initialize the page
        initializeProductType();
    });
</script>
