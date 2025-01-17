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
                            <select class="form-select">
                                <option>Choose</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Warehouse</label>
                            <select class="form-select">
                                <option>Choose</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" />
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sku" placeholder="Enter SKU"
                                    value="{{ old('sku') }}" />
                                @error('sku')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <button class="generate-btn" type="button">
                                    Generate Code
                                </button>
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
                                <select class="form-select" name="subcategory_id">
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
                            <label class="form-label">Brand</label>
                            <div class="input-group">
                                <select class="form-select" name="brand">
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
                                <select class="form-select" name="unit">
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
                            <select class="form-select" name="selling_type">
                                <option>Choose</option>
                                <option>Transactional selling</option>
                                <option>Solution selling</option>
                            </select>
                        </div>

                        {{-- <div class="col-md-8">
                            <label class="form-label">Barcode Symbology</label>
                            <select class="form-select">
                                <option>Choose</option>
                            </select>
                        </div> --}}
                        <div class="col-md-4">
                            <label class="form-label">Item Code</label>
                            <div class="input-group">
                                <input type="text" class="form-control"name="item_code"
                                    placeholder="Please Enter Item Code" />
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
                    <div class="single-product-section">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control"name="quantity"
                                    value="{{ old('quantity') }}" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price</label>
                                <input type="number" class="form-control" name="single_price" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tax Type</label>
                                <select class="form-select" name="single_tax_type">
                                    <option value="">Choose</option>
                                    <option value="exclusive">Exclusive</option>
                                    <option value="inclusive">Inclusive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Variable Product Section -->

                    <div class="variable-product-section" style="display: none">
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
                                        <input type="number" class="form-control" name="quantity"
                                            value="{{ old('quantity') }}" />
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
                            <input type="file" id="productImages" accept="image/*" multiple class="d-none" />
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
        // Product type interaction
        const productTypeSelect = document.getElementById("productType");
        const singleProductSection = document.querySelector(
            ".single-product-section"
        );
        const variableProductSection = document.querySelector(
            ".variable-product-section"
        );

        function toggleProductSections(isSingleProduct) {
            singleProductSection.style.display = isSingleProduct ?
                "block" :
                "none";
            variableProductSection.style.display = isSingleProduct ?
                "none" :
                "block";
        }

        toggleProductSections(productTypeSelect.value === "single");

        productTypeSelect.addEventListener("change", function() {
            toggleProductSections(this.value === "single");
        });

        // Variable product variations
        const addVariationBtn = document.getElementById("addVariation");
        const variationsContainer = document.getElementById(
            "variationsContainer"
        );
        const variationTemplate =
            variationsContainer.querySelector(".variation-item");

        if (variationTemplate) {
            variationTemplate.style.display = "none";
        }

        addVariationBtn.addEventListener("click", function() {
            const newVariation = variationTemplate.cloneNode(true);
            newVariation.style.display = "block";

            // Add event listeners to Color and Size dropdowns
            const colorSelect = newVariation.querySelector(".variant-color");
            const sizeSelect = newVariation.querySelector(".variant-size");
            const variantValueName = newVariation.querySelector(
                ".variant-value-name"
            );

            function updateVariantValueName() {
                const color = colorSelect.value || "N/A";
                const size = sizeSelect.value || "N/A";
                variantValueName.value = `Color: ${color}, Size: ${size}`;
            }

            colorSelect.addEventListener("change", updateVariantValueName);
            sizeSelect.addEventListener("change", updateVariantValueName);
            const removeBtn = newVariation.querySelector(".remove-variation");
            removeBtn.addEventListener("click", function() {
                newVariation.remove();
            });

            newVariation.querySelectorAll("input, select").forEach((input) => {
                input.value = "";
            });

            variationsContainer.appendChild(newVariation);
        });

        document.querySelectorAll(".remove-variation").forEach((btn) => {
            btn.addEventListener("click", function() {
                this.closest(".variation-item").remove();
            });
        });

        // Form submission
        const form = document.getElementById("productForm");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            console.log("Form submitted");
        });
    });
</script>

