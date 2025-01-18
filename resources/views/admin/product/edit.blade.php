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
                            <div class="input-group">
                                <input type="text" class="form-control" name="sku" value="{{ $product->sku }}">
                                @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Categories</label>
                            <div class="input-group">
                                <select class="form-select" name="category_ids[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sub Categories</label>
                            <div class="input-group">
                                <select class="form-select" name="subcategory_ids[]" multiple>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}"
                                            {{ in_array($subcategory->id, $product->subcategories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Discount Type</label>
                            <div class="input-group">
                                <select class="form-select" name="discount_type">
                                    <option>Choose</option>
                                    <option value="Percentage"
                                        {{ $product->discount_type == 'Percentage' ? 'selected' : '' }}>Percentage</option>
                                    <option value="Cash" {{ $product->discount_type == 'Cash' ? 'selected' : '' }}>Cash
                                    </option>
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Discount Value</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="discount_value"
                                    value="{{ $product->discount_value }}">
                            </div>
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
                                <button class="add-new-btn" type="button">Add New</button>
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
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Selling Type</label>
                            <select class="form-select" name="selling_type">
                                <option>Choose</option>
                                <option value="Transactional selling"
                                    {{ $product->selling_type == 'Transactional selling' ? 'selected' : '' }}>
                                    Transactional selling
                                </option>
                                <option value="Solution selling"
                                    {{ $product->selling_type == 'Solution selling' ? 'selected' : '' }}>
                                    Solution selling
                                </option>
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
                            <div class="input-group">
                                <input type="text" class="form-control" name="item_code"
                                    value="{{ $product->item_code }}" />
                                <button class="generate-btn" type="button">Generate Code</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                            <small class="text-muted">Maximum 60 Characters</small>
                        </div>
                    </div>
                </div>

                <!-- Pricing & Stocks Section -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="bi bi-currency-dollar text-primary"></i>
                        <h5 class="mb-0">Pricing & Stocks</h5>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Product Type</label>
                        <div>
                            <select class="form-select" name="productType" id="productType">
                                <option value="single" {{ $product->product_type === 'single' ? 'selected' : '' }}>Single
                                    Product
                                </option>
                                <option value="variable" {{ $product->product_type === 'variable' ? 'selected' : '' }}>
                                    Variable
                                    Product</option>
                            </select>
                        </div>
                    </div>

                    <!-- Single Product Section -->
                    <div class="single-product-section"
                        style="display: {{ $product->product_type === 'single' ? 'block' : 'none' }};">
                        <div class="row g-3">
                            @foreach ($product->variants as $index => $variant)
                                <div class="col-md-4">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" class="form-control" name="quantity"
                                        value="{{ $variant->quantity }}" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Price</label>
                                    @foreach ($variant->prices as $price)
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $price->price }}" />
                                    @endforeach
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantity Alert</label>
                                    <input type="number" class="form-control" name="quantity_alert"
                                        value="{{ $variant->quantity_alert }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Variable Product Section -->
                    <div class="mb-3" id="variantSection"
                        style="display: {{ $product->product_type === 'variable' ? 'block' : 'none' }};">
                        <label class="form-label">Select Variants</label>
                        <select class="form-select" id="variantDropdown" multiple>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}"
                                    {{ $product->variants->pluck('variant_id')->contains($variant->id) ? 'selected' : '' }}>
                                    {{ $variant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="combinationContainer">
                        @if ($product->product_type === 'variable')
                            @foreach ($product->variants as $index => $variant)
                                <div class="row g-3 mb-2 combination-row" data-index="{{ $index }}">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            value="{{ $variant->variant_value_name }}" readonly
                                            name="child_products[{{ $index }}][combination]" />
                                        <input type="hidden" name="child_products[{{ $index }}][variant_ids]"
                                            value="{{ $variant->variantValues->pluck('variant_id')->join(',') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control"
                                            name="child_products[{{ $index }}][quantity]"
                                            value="{{ $variant->quantity }}" placeholder="Quantity" />
                                    </div>
                                    <div class="col-md-2">
                                        @foreach ($variant->prices as $price)
                                            <input type="number" class="form-control mb-2"
                                                name="child_products[{{ $index }}][prices][]"
                                                value="{{ $price->price }}" placeholder="Price" />
                                        @endforeach
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control"
                                            name="child_products[{{ $index }}][quantity_alert]"
                                            value="{{ $variant->quantity_alert }}" placeholder="Quantity alert" />
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Images Section -->
                <div class="mb-3">
                    <label class="form-label">Images</label>
                    <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                        @foreach ($product->getMedia('images') as $media)
                            <div class="d-flex flex-column align-items-center m-2" data-media-id="{{ $media->id }}">
                                <img src="{{ $media->getUrl() }}" class="img-thumbnail"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger mt-2"
                                    onclick="removeMedia({{ $media->id }})">Remove</button>
                            </div>
                        @endforeach
                        <div class="border rounded p-2" style="width: 100px; height: 100px">
                            <label for="productImages"
                                class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer">
                                <i class="bi bi-cloud-upload fs-3"></i>
                                <span class="small text-muted">Upload</span>
                            </label>
                            <input type="file" id="productImages" multiple class="d-none" name="images[]" />
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("productForm");
            const imageInput = document.getElementById("productImages");
            const imagePreviewContainer = document.getElementById(
                "imagePreviewContainer"
            );

            imageInput.addEventListener("change", function(event) {
                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Create image element
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.classList.add("img-thumbnail");
                        img.style.width = "100px";
                        img.style.height = "100px";
                        img.style.objectFit = "cover";

                        // Create remove button
                        const removeButton = document.createElement("button");
                        removeButton.textContent = "Remove";
                        removeButton.classList.add("btn", "btn-sm", "btn-danger", "mt-2");
                        removeButton.style.display = "block";

                        // Remove button functionality
                        removeButton.addEventListener("click", function() {
                            imgContainer.remove();
                        });

                        // Create container for image and remove button
                        const imgContainer = document.createElement("div");
                        imgContainer.classList.add(
                            "d-flex",
                            "flex-column",
                            "align-items-center",
                            "m-2"
                        );
                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeButton);

                        // Append container to preview container
                        imagePreviewContainer.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    {{-- <script>
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
            const existingVariants = @json($product->variants);
            const productData = @json($product);

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
                        removeButton.textContent = "Remove";
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

            // Initialize product type sections
            function initializeProductType() {
                const hasVariants = existingVariants && existingVariants.length > 0;

                if (!hasVariants) {
                    productTypeSelect.value = 'single';
                    singleProductSection.style.display = "block";
                    variantSection.style.display = "none";
                    combinationContainer.innerHTML = "";

                    const quantityInput = document.querySelector('input[name="quantity"]');
                    const priceInput = document.querySelector('input[name="price"]');
                    const quantityAlertInput = document.querySelector('input[name="quantity_alert"]');

                    if (quantityInput) quantityInput.value = productData.quantity || '';
                    if (priceInput) priceInput.value = productData.price || '';
                    if (quantityAlertInput) quantityAlertInput.value = productData.quantity_alert || '';
                } else {
                    productTypeSelect.value = 'variable';
                    singleProductSection.style.display = "none";
                    variantSection.style.display = "block";
                }
            }

            initializeProductType();

            // Product Type Handler
            productTypeSelect.addEventListener("change", function() {
                if (this.value === "single") {
                    singleProductSection.style.display = "block";
                    variantSection.style.display = "none";
                    combinationContainer.innerHTML = "";

                    const quantityInput = document.querySelector('input[name="quantity"]');
                    const priceInput = document.querySelector('input[name="price"]');
                    const quantityAlertInput = document.querySelector('input[name="quantity_alert"]');

                    if (quantityInput) quantityInput.value = productData.quantity || '';
                    if (priceInput) priceInput.value = productData.price || '';
                    if (quantityAlertInput) quantityAlertInput.value = productData.quantity_alert || '';
                } else {
                    singleProductSection.style.display = "none";
                    variantSection.style.display = "block";
                    if (existingVariants && existingVariants.length) {
                        generateExistingCombinations();
                    }
                }
            });

            function generateExistingCombinations() {
                const selectedVariantIds = Array.from(variantDropdown.selectedOptions).map(opt => opt.value);
                generateCombinations(selectedVariantIds);
            }

            function generateCombinations(selectedVariants) {
                if (selectedVariants.length === 0) {
                    combinationContainer.innerHTML = "";
                    return;
                }

                const variantValues = selectedVariants.map((id) => {
                    const variant = variantData.find((v) => v.id == id);
                    return variant ? variant.variant_values.map((value) => ({
                        id: variant.id,
                        name: variant.name,
                        value: value,
                    })) : [];
                });

                const combinations = variantValues.reduce((acc, values) => {
                    const result = [];
                    acc.forEach((a) => {
                        values.forEach((v) => {
                            result.push([...a, v]);
                        });
                    });
                    return result;
                }, [
                    []
                ]);

                renderCombinations(combinations);
            }

            function renderCombinations(combinations) {
                combinationContainer.innerHTML = combinations.map((combo, index) => {
                    const existingVariant = existingVariants.find(v =>
                        v.variant_value_name === combo.map(v => `${v.name}: ${v.value.value}`).join(
                            ", ")
                    );

                    const combinationName = combo.map(v => `${v.name}: ${v.value.value}`).join(", ");
                    const variantIds = combo.map(v => v.id).join(",");

                    return `
                    <div class="row g-3 mb-2 combination-row" data-index="${index}">
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="${combinationName}" readonly 
                                name="child_products[${index}][combination]"/>
                            <input type="hidden" name="child_products[${index}][variant_ids]" value="${variantIds}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="child_products[${index}][quantity]" 
                                value="${existingVariant ? existingVariant.quantity : ''}" placeholder="Quantity" />
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="child_products[${index}][price]" 
                                value="${existingVariant && existingVariant.prices[0] ? existingVariant.prices[0].price : ''}" placeholder="Price" />
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="child_products[${index}][quantity_alert]" 
                                value="${existingVariant ? existingVariant.quantity_alert : ''}" placeholder="Quantity alert"/>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                        </div>
                    </div>`;
                }).join("");

                document.querySelectorAll(".remove-row").forEach(button => {
                    button.addEventListener("click", function() {
                        this.closest(".combination-row").remove();
                    });
                });
            }

            variantDropdown.addEventListener("change", function() {
                const selectedVariantIds = Array.from(this.selectedOptions).map(opt => opt.value);
                generateCombinations(selectedVariantIds);
            });

            window.removeMedia = function(mediaId) {
                if (confirm('Are you sure you want to remove this image?')) {
                    const element = document.querySelector(`[data-media-id="${mediaId}"]`);
                    if (element) {
                        element.remove();
                    }
                }
            };
        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("productForm");
            const imageInput = document.getElementById("productImages");
            const imagePreviewContainer = document.getElementById("imagePreviewContainer");
            const productTypeSelect = document.getElementById("productType");
            const singleProductSection = document.querySelector(".single-product-section");
            const variantSection = document.getElementById("variantSection");
            const combinationContainer = document.getElementById("combinationContainer");
            const variantDropdown = document.getElementById("variantDropdown");
    
            const variantData = @json($variants);
    
            // Image handling
            imageInput.addEventListener("change", function(event) {
                const files = event.target.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
    
                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.classList.add("img-thumbnail");
                        img.style.width = "100px";
                        img.style.height = "100px";
                        img.style.objectFit = "cover";
    
                        const removeButton = document.createElement("button");
                        removeButton.textContent = "Remove";
                        removeButton.classList.add("btn", "btn-sm", "btn-danger", "mt-2");
                        removeButton.style.display = "block";
    
                        removeButton.addEventListener("click", function() {
                            imgContainer.remove();
                        });
    
                        const imgContainer = document.createElement("div");
                        imgContainer.classList.add(
                            "d-flex",
                            "flex-column",
                            "align-items-center",
                            "m-2"
                        );
                        imgContainer.appendChild(img);
                        imgContainer.appendChild(removeButton);
    
                        imagePreviewContainer.appendChild(imgContainer);
                    };
    
                    reader.readAsDataURL(file);
                }
            });
    
            // Product type handling
            productTypeSelect.addEventListener("change", function() {
                if (this.value === "single") {
                    singleProductSection.style.display = "block";
                    if (variantSection) {
                        variantSection.style.display = "none";
                        combinationContainer.innerHTML = "";
                    }
                } else if (this.value === "variable") {
                    singleProductSection.style.display = "none";
                    if (variantSection) {
                        variantSection.style.display = "block";
                    }
                }
            });
    
            // Initialize product type sections
            if (productTypeSelect.value === "single") {
                singleProductSection.style.display = "block";
                if (variantSection) {
                    variantSection.style.display = "none";
                }
            } else if (productTypeSelect.value === "variable") {
                singleProductSection.style.display = "none";
                if (variantSection) {
                    variantSection.style.display = "block";
                }
            }
    
            // Variant combinations generator
            function generateCombinations(selectedVariants) {
                if (selectedVariants.length === 0) {
                    combinationContainer.innerHTML = "";
                    return;
                }
    
                const variantValues = selectedVariants.map((id) => {
                    const variant = variantData.find((v) => v.id == id);
                    return variant ?
                        variant.variant_values.map((value) => ({
                            id: variant.id,
                            name: variant.name,
                            value: value,
                        })) : [];
                });
    
                const combinations = variantValues.reduce((acc, values) => {
                    const result = [];
                    acc.forEach((a) => {
                        values.forEach((v) => {
                            result.push([...a, v]);
                        });
                    });
                    return result;
                }, [[]]);
    
                combinationContainer.innerHTML = combinations
                    .map((combo, index) => {
                        const combinationName = combo
                            .map((v) => `${v.name}: ${v.value.value}`)
                            .join(", ");
    
                        const variantIds = combo.map((v) => v.id).join(",");
                        return `
                        <div class="row g-3 mb-2 combination-row" data-index="${index}">
                            <div class="col-md-2">
                                <input type="text" class="form-control" value="${combinationName}" readonly name="child_products[${index}][combination]"/>
                                <input type="hidden" name="child_products[${index}][variant_ids]" value="${variantIds}">
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" name="child_products[${index}][quantity]" placeholder="Quantity" />
                            </div>
                            <div class="col-md-2">
                                <input type="number" class="form-control" placeholder="Price" name="child_products[${index}][price]" />
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" placeholder="Quantity alert" name="child_products[${index}][quantity_alert]"/>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                            </div>
                        </div>`;
                    })
                    .join("");
    
                document.querySelectorAll(".remove-row").forEach((button) => {
                    button.addEventListener("click", function() {
                        this.closest(".combination-row").remove();
                    });
                });
            }
    
            // Handle variant selection changes
            variantDropdown.addEventListener("change", function() {
                const selectedVariantIds = Array.from(this.selectedOptions).map((opt) => opt.value);
                generateCombinations(selectedVariantIds);
            });
        });
    </script>
    
@endpush
