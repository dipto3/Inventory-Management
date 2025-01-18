@extends('admin.layouts.master')
@section('admin.content')
    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <h4 class="mb-0">New Product</h4>
            <button class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Back to Products
            </button>
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
                            <select class="form-select"name="store">
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
                                <select class="form-select" name="category_id">
                                    <option>Choose</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sub Category</label>
                            <div class="input-group">
                                <select class="form-select"name="subcategory_id">
                                    <option>Choose</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <label class="form-label">Sub Sub Category</label>
                            <select class="form-select">
                                <option>Choose</option>
                            </select>
                        </div> --}}
                        <div class="col-md-4">
                            <label class="form-label">Discount Type</label>
                            <div class="input-group">
                                <select class="form-select"name="discount_type">

                                    <option>Choose</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Cash">Cash</option>
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
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
                                <button class="add-new-btn" type="button">Add New</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit</label>
                            <div class="input-group">
                                <select class="form-select"name="unit">
                                    <option>Choose</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->short_name }}">{{ $unit->short_name }}</option>
                                    @endforeach
                                </select>
                                <button class="add-new-btn" type="button">Add New</button>
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
                                <button class="generate-btn" type="button">
                                    Generate Code
                                </button>
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
                                <label class="form-label">Quantity Alert</label>
                                <input type="number" class="form-control" name="quantity_alert" />
                            </div>

                        </div>
                    </div>

                    <!-- Variable Product Section -->

                    {{-- <div class="variable-product-section" style="display: none">
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" id="addVariation">
                                <i class="bi bi-plus"></i> Add Variation
                            </button>
                        </div>
                        <div id="variationsContainer">
                            <!-- Variation Template -->
                            <div class="variation-item border rounded p-3 mb-3">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Color</label>
                                        <select class="form-select variant-color">
                                            <option value="">Choose Color</option>
                                            <option value="Red">Red</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Green">Green</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Size</label>
                                        <select class="form-select variant-size">
                                            <option value="">Choose Size</option>
                                            <option value="Small">Small</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Large">Large</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Variant Value Name</label>
                                        <input type="text" class="form-control variant-value-name" readonly />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" class="form-control" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Tax Type</label>
                                        <select class="form-select">
                                            <option value="">Choose</option>
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-danger d-block w-100 remove-variation">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="mb-3" id="variantSection" style="display: none;">
                        <label class="form-label">Select Variants</label>
                        <select class="form-select" id="variantDropdown" multiple>

                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="combinationContainer">
                        <!-- Dynamically generated rows will appear here -->
                    </div>

                </div>


                <div class="mb-3">
                    <label for="productImages" class="form-label">Images</label>
                    <div class="d-flex flex-wrap gap-3" id="imagePreviewContainer">
                        <div class="border rounded p-2" style="width: 100px; height: 100px">
                            <label for="productImages"
                                class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer">
                                <i class="bi bi-cloud-upload fs-3"></i>
                                <span class="small text-muted">Upload</span>
                            </label>
                            <input type="file" id="productImages" multiple class="d-none" name="image[]" multiple />
                        </div>
                    </div>
                </div>
                <!-- Submit Buttons -->
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </div>
            </form>
        </div>
    </div>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productTypeSelect = document.getElementById("productType");
        const singleProductSection = document.querySelector(".single-product-section");
        const variantSection = document.getElementById("variantSection");
        const combinationContainer = document.getElementById("combinationContainer");
        const variantDropdown = document.getElementById("variantDropdown");

        const variantData = @json($variants); // Pass variants data from the controller.

        // Toggle visibility of sections based on product type selection
        productTypeSelect.addEventListener("change", function() {
            if (this.value === "single") {
                singleProductSection.style.display = "block"; // Show the single product section
                if (variantSection) {
                    variantSection.style.display = "none"; // Hide the variant section
                    combinationContainer.innerHTML = ""; // Clear combinations if hidden
                }
            } else if (this.value === "variable") {
                singleProductSection.style.display = "none"; // Hide the single product section
                if (variantSection) {
                    variantSection.style.display = "block"; // Show the variant section
                }
            }
        });

        // Initialize visibility based on the current value of product type
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



        function generateCombinations(selectedVariants) {
            if (selectedVariants.length === 0) {
                combinationContainer.innerHTML = "";
                return;
            }

            // Retrieve variant values for the selected variants
            // const variantValues = selectedVariants.map((id) => {
            //     const variant = variantData.find((v) => v.id == id);
            //     return variant ? variant.variant_values : [];
            // });
            const variantValues = selectedVariants.map((id) => {
                const variant = variantData.find((v) => v.id == id);
                return variant ?
                    variant.variant_values.map((value) => ({
                        id: variant.id, // Variant model's id
                        name: variant.name,
                        value: value,
                    })) : [];
            });

            // Generate Cartesian product of the selected variant values
            // const combinations = variantValues.reduce((acc, values) => {
            //     const result = [];
            //     acc.forEach((a) => {
            //         values.forEach((v) => {
            //             result.push([...a, v]);
            //         });
            //     });
            //     return result;
            // }, [
            //     []
            // ]);
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

            // Render rows for combinations
            // combinationContainer.innerHTML = combinations
            //     .map((combo, index) => {
            //         const combinationName = combo.map((v, idx) => {
            //             // const variantName = variantData[idx] ? variantData[idx].name : '';
            //             // return `${variantName}: ${v.value}`;
            //             const variant = variantData[idx];
            //             return `${variant.name}: ${v.value}`;
            //         }).join(", ");
            //         const variantIds = combo.map((v) => v.id).join(",");
            combinationContainer.innerHTML = combinations
                .map((combo, index) => {
                    const combinationName = combo
                        .map((v) => `${v.name}: ${v.value.value}`)
                        .join(", ");

                    // Collect variant IDs for the current combination
                    const variantIds = combo.map((v) => v.id).join(",");
                    return `
                    <div class="row g-3 mb-2 combination-row" data-index="${index}">
                        
                        <div class="col-md-2">
                            <input type="text" class="form-control" value="${combinationName}" readonly name="child_products[${index}][combination]"/>
                            <input type="hidden" name="child_products[${index}][variant_ids]" value="${variantIds}">
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" name="child_products[${index}][quantity]" placeholder="Quantity"  />
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" placeholder="Price" name="child_products[${index}][price]" />
                        </div>
                        
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="Quantity alert" name="child_products[${index}][quantity_alert]"/>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger remove-row">Remove</button>
                        </div>
                    </div>`;
                })
                .join("");

            // Attach event listeners for remove buttons
            document.querySelectorAll(".remove-row").forEach((button) => {
                button.addEventListener("click", function() {
                    const row = this.closest(".combination-row");
                    row.remove();
                });
            });
        }

        variantDropdown.addEventListener("change", function() {
            const selectedVariantIds = Array.from(this.selectedOptions).map((opt) => opt.value);
            generateCombinations(selectedVariantIds);
        });
    });
</script>
