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

                    <!-- Regular Image Section -->
                    <div id="regularImageSection">
                        <div class="image-upload-container">
                            <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                                @foreach ($product->productImage as $image)
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

                    <!-- Variant Image Section -->
                    <div id="variantImageOptions" style="display: none;">
                        <!-- Variant image upload section -->
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
            valuesSection.empty();

            selectedVariantIds.forEach(variantId => {
                const variant = variantData.find(v => v.id == variantId);

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
            });

            $('.variant-values').selectpicker();

            $('.variant-values').on('changed.bs.select', function() {
                console.log("Variant value changed");
                const variantSelections = {};

                $('.variant-values').each(function() {
                    const variantName = $(this).data('variant');
                    const selectedValues = $(this).val();
                    console.log("Selected values for", variantName, ":", selectedValues);

                    if (selectedValues?.length) {
                        variantSelections[variantName] = selectedValues.map(value => ({
                            id: value,
                            value: $(this).find(`option[value='${value}']`).text()
                                .trim()
                        }));
                    }
                });

                console.log("Variant selections:", variantSelections);

                if (Object.keys(variantSelections).length > 0) {
                    const combinations = generateAllCombinations(variantSelections);
                    console.log("Generated combinations:", combinations);
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

        function renderCombinationsTable(combinations) {
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
                const combinationName = typeof combo === 'string' ? combo :
                    Object.entries(combo).map(([variant, value]) =>
                        `${variant}: ${value.value}`).join(', ');

                html += `
                <tr>
                    <td>
                        ${combo.combination || combinationName}
                        <input type="hidden" name="child_products[${index}][combination]" value="${combo.combination || combinationName}">
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
