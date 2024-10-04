@extends('admin.layouts.master')
@section('admin.content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>New Product</h4>
                        <h6>Create new product</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li>
                        <div class="page-btn">
                            <a href="{{ route('product.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                                    class="me-2"></i>Back to
                                Product</a>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                data-feather="chevron-up" class="feather-chevron-up"></i></a>
                    </li>
                </ul>
            </div>

            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body add-product pb-0">
                        <div class="accordion-card-one accordion" id="accordionExample">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingOne">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                        aria-controls="collapseOne">
                                        <div class="addproduct-icon">
                                            <h5><i data-feather="info" class="add-info"></i><span>Product
                                                    Information</span></h5>
                                            <a href="javascript:void(0);"><i data-feather="chevron-down"
                                                    class="chevron-down-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Store</label>
                                                    <select class="select" name="store">
                                                        <option>Choose</option>
                                                        <option>Thomas</option>
                                                        <option>Rasmussen</option>
                                                        <option>Fred john</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Warehouse</label>
                                                    <select class="select" name="warehouse">
                                                        <option>Choose</option>
                                                        <option>Legendary</option>
                                                        <option>Determined</option>
                                                        <option>Sincere</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Slug</label>
                                                    <input type="text" name="slug" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-12">
                                                <div class="input-blocks add-product list">
                                                    <label>SKU</label>
                                                    <input type="text" name="sku" class="form-control list" placeholder="Enter SKU">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="addservice-info">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <div class="add-newplus">
                                                            <label class="form-label">Category</label>
                                                            {{-- <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#add-units-category"><i
                                                                    data-feather="plus-circle"
                                                                    class="plus-down-add"></i><span>Add
                                                                    New</span></a> --}}
                                                        </div>
                                                        <select class="select" name="category_id">
                                                            <option>Choose</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <label class="form-label">Sub Category</label>
                                                        <select class="select" name="subcategory_id">
                                                            <option>Choose</option>
                                                            @foreach ($subcategories as $subcategory)
                                                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                                            @endforeach
                                                            <option>Lenovo</option>
                                                            <option>Electronics</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <label class="form-label">Sub Sub Category</label>
                                                        <select class="select">
                                                            <option>Choose</option>
                                                            <option>Fruits</option>
                                                            <option>Computers</option>
                                                            <option>Shoes</option>
                                                        </select>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="add-product-new">
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <div class="add-newplus">
                                                            <label class="form-label">Brand</label>
                                                            {{-- <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#add-units-brand"><i
                                                                    data-feather="plus-circle"
                                                                    class="plus-down-add"></i><span>Add
                                                                    New</span></a> --}}
                                                        </div>
                                                        <select class="select" name="brand">
                                                            <option>Choose</option>
                                                            <option>Nike</option>
                                                            <option>Bolt</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <div class="add-newplus">
                                                            <label class="form-label">Unit</label>
                                                            {{-- <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                data-bs-target="#add-unit"><i data-feather="plus-circle"
                                                                    class="plus-down-add"></i><span>Add
                                                                    New</span></a> --}}
                                                        </div>
                                                        <select class="select" name="unit">
                                                            <option>Choose</option>
                                                            <option>Kg</option>
                                                            <option>Pc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="mb-3 add-product">
                                                        <label class="form-label">Selling Type</label>
                                                        <select class="select" name="selling_type">
                                                            <option>Choose</option>
                                                            <option>Transactional selling</option>
                                                            <option>Solution selling</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="mb-3 add-product">
                                                    <label class="form-label">Barcode Symbology</label>
                                                    <select class="select">
                                                        <option>Choose</option>
                                                        <option>Code34</option>
                                                        <option>Code35</option>
                                                        <option>Code36</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-sm-6 col-12">
                                                <div class="input-blocks add-product list">
                                                    <label>Item Code</label>
                                                    <input type="text" class="form-control list" name="item_code"
                                                        placeholder="Please Enter Item Code">
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="input-blocks summer-description-box transfer mb-3">
                                                <label>Description</label>
                                                <textarea class="form-control h-100" rows="5" name="description"></textarea>
                                                <p class="mt-1">Maximum 60 Characters</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-card-one accordion" id="accordionExample2">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingTwo">
                                    <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                        aria-controls="collapseTwo">
                                        <div class="text-editor add-list">
                                            <div class="addproduct-icon list icon">
                                                <h5><i data-feather="life-buoy" class="add-info"></i><span>Pricing &
                                                        Stocks</span></h5>
                                                <a href="javascript:void(0);"><i data-feather="chevron-down"
                                                        class="chevron-down-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        <div class="input-blocks add-products">
                                            <label class="d-block">Product Type</label>
                                            <div class="mb-3">
                                                <select class="form-control" name="product_type" id="productType">
                                                    <option value="single">Single Product</option>
                                                    <option value="variable">Variable Product</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="tab-content" id="productTypeContent">
                                            <div class="tab-pane fade show active" id="singleProduct" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Quantity</label>
                                                            <input type="text" class="form-control" name="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Price</label>
                                                            <input type="text" class="form-control" name="price">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Tax Type</label>
                                                            <select class="select" name="tax_type">
                                                                <option>Exclusive</option>
                                                                <option>Sales Tax</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Discount Type</label>
                                                            <select class="select" name="discount_type">
                                                                <option>Choose</option>
                                                                <option>Percentage</option>
                                                                <option>Cash</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Discount Value</label>
                                                            <input type="text" placeholder="Choose" name="discount_value">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12">
                                                        <div class="input-blocks add-product">
                                                            <label>Quantity Alert</label>
                                                            <input type="text" class="form-control" name="quantity_alert">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="variableProduct" role="tabpanel">
                                                <div class="row select-color-add">
                                                    <div class="col-lg-6 col-sm-6 col-12">
                                                        <div id="variant-attributes">
                                                            <label>Variant Attributes</label>
                                                            <div class="row">
                                                                <div class="col-lg-10 col-sm-10 col-10">
                                                                    <select class="form-control select2" id="variantSelect" multiple name="variant_ids[]">
                                                                        <option value="">Choose</option>
                                                                        @foreach ($variants as $variant)
                                                                            <option value="{{ $variant->id }}"
                                                                                    data-name="{{ $variant->name }}"
                                                                                    data-values="{{ $variant->variantValues->pluck('value') }}">
                                                                                {{ $variant->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-2 col-sm-2 col-2">
                                                                    <button id="generateVariants" class="btn btn-primary" type="button">
                                                                        <i class="feather-plus-circle"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="variant-values-container" class="mt-3">
                                                            <!-- Variant values will be dynamically added here -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body-table variant-table" id="variant-table" style="display: none;">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Variant Combination</th>
                                                                    <th>Barcode</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity Alert</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="variant-table-body">
                                                                <!-- Dynamically add rows here -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-card-one accordion" id="accordionExample4">
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingFour">
                                    <div class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-controls="collapseFour">
                                        <div class="text-editor add-list">
                                            <div class="addproduct-icon list">
                                                <h5><i data-feather="list" class="add-info"></i><span>Custom
                                                        Fields</span></h5>
                                                <a href="javascript:void(0);"><i data-feather="chevron-down"
                                                        class="chevron-down-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseFour" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample4">
                                    <div class="accordion-body">
                                        <div class="text-editor add-list add">
                                            <div class="custom-filed">
                                                <div class="input-block add-lists">
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>Warranties
                                                    </label>
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>Manufacturer
                                                    </label>
                                                    <label class="checkboxs">
                                                        <input type="checkbox">
                                                        <span class="checkmarks"></span>Expiry
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Discount Type</label>
                                                        <select class="select">
                                                            <option>Choose</option>
                                                            <option>Percentage</option>
                                                            <option>Cash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks add-product">
                                                        <label>Quantity Alert</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks">
                                                        <label>Manufactured Date</label>
                                                        <div class="input-groupicon calender-input">
                                                            <i data-feather="calendar" class="info-img"></i>
                                                            <input type="text" class="datetimepicker" name="manufactured_date"
                                                                placeholder="Choose Date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-sm-6 col-12">
                                                    <div class="input-blocks">
                                                        <label>Expiry On</label>
                                                        <div class="input-groupicon calender-input">
                                                            <i data-feather="calendar" class="info-img"></i>
                                                            <input type="text" class="datetimepicker" name="expired_date"
                                                                placeholder="Choose Date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-card-one accordion" id="accordionExample3">
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="headingThree">
                                                            <div class="accordion-button" data-bs-toggle="collapse"
                                                                data-bs-target="#collapseThree"
                                                                aria-controls="collapseThree">
                                                                <div class="addproduct-icon list">
                                                                    <h5><i data-feather="image"
                                                                            class="add-info"></i><span>Images</span>
                                                                    </h5>
                                                                    <a href="javascript:void(0);"><i
                                                                            data-feather="chevron-down"
                                                                            class="chevron-down-add"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseThree" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample3">
                                                            <div class="accordion-body">
                                                                <div class="text-editor add-list add">
                                                                    <div class="col-lg-12">
                                                                        <div class="add-choosen">
                                                                            <div class="input-blocks">
                                                                                <div class="image-upload">
                                                                                    <input type="file" name="image[]" multiple>
                                                                                    <div class="image-uploads">
                                                                                        <i data-feather="plus-circle"
                                                                                            class="plus-down-add me-0"></i>
                                                                                        <h4>Add Images</h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="phone-img">
                                                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/products/phone-add-2.png"
                                                                                    alt="image">
                                                                                <a href="javascript:void(0);"><i
                                                                                        data-feather="x"
                                                                                        class="x-square-add remove-product"></i></a>
                                                                            </div>
                                                                            <div class="phone-img">
                                                                                <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/products/phone-add-1.png"
                                                                                    alt="image">
                                                                                <a href="javascript:void(0);"><i
                                                                                        data-feather="x"
                                                                                        class="x-square-add remove-product"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-addproduct mb-4">
                        <button type="button" class="btn btn-cancel me-2">Cancel</button>
                        <button type="submit" class="btn btn-submit">Save Product</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection


<script src="{{ asset('admin/assets/js/feather.min.js') }}"
type="3e7d17d336227172fbef6778-text/javascript"></script>

<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"
type="3e7d17d336227172fbef6778-text/javascript"></script>


<script src="{{ asset('admin/assets/js/moment.min.js') }}"
type="3e7d17d336227172fbef6778-text/javascript"></script>


<script src="{{ asset('admin/assets/js/theme-script.js') }}"
type="3e7d17d336227172fbef6778-text/javascript"></script>
<script src="{{ asset('admin/assets/js/script.js') }}"
type="3e7d17d336227172fbef6778-text/javascript"></script>
<script src="{{ asset('admin/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
    data-cf-settings="3e7d17d336227172fbef6778-|49" defer></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    border: 1px solid #007bff;
    color: #fff;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productTypeSelect = document.getElementById('productType');
    const singleProductPane = document.getElementById('singleProduct');
    const variableProductPane = document.getElementById('variableProduct');
    const variantSelect = $('#variantSelect');
    const generateVariantsBtn = document.getElementById('generateVariants');
    const variantValuesContainer = document.getElementById('variant-values-container');
    const variantTable = document.getElementById('variant-table');
    const variantTableBody = document.getElementById('variant-table-body');

    let selectedVariants = {};

    // Initialize Select2
    variantSelect.select2({
        placeholder: "Select variants",
        allowClear: true,
        width: '100%'
    });

    variantSelect.on('change', function() {
        updateSelectedVariants();
        updateVariantValuesContainer();
    });

    generateVariantsBtn.addEventListener('click', function(event) {
        event.preventDefault();
        generateVariantCombinations();
    });

    productTypeSelect.addEventListener('change', function() {
        if (this.value === 'single') {
            singleProductPane.classList.add('show', 'active');
            variableProductPane.classList.remove('show', 'active');
        } else {
            singleProductPane.classList.remove('show', 'active');
            variableProductPane.classList.add('show', 'active');
        }
    });

    function updateSelectedVariants() {
        selectedVariants = {};
        variantSelect.find(':selected').each(function() {
            const option = $(this);
            selectedVariants[option.val()] = {
                name: option.data('name'),
                values: option.data('values')
            };
        });
    }

    function updateVariantValuesContainer() {
        variantValuesContainer.innerHTML = '';
        Object.entries(selectedVariants).forEach(([variantId, variant]) => {
            const variantDiv = document.createElement('div');
            variantDiv.innerHTML = `
                <h5>${variant.name}</h5>
                <div class="variant-values-list" data-variant-id="${variantId}">
                    ${variant.values.map(value => `
                        <span class="badge bg-primary me-2 mb-2">
                            ${value}
                            <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="removeVariantValue('${variantId}', '${value}')"></button>
                        </span>
                    `).join('')}
                </div>
            `;
            variantValuesContainer.appendChild(variantDiv);
        });
    }

    window.removeVariantValue = function(variantId, value) {
        selectedVariants[variantId].values = selectedVariants[variantId].values.filter(v => v !== value);
        updateVariantValuesList(variantId);
    }

    function updateVariantValuesList(variantId) {
        const valuesList = document.querySelector(`.variant-values-list[data-variant-id="${variantId}"]`);
        valuesList.innerHTML = selectedVariants[variantId].values.map(value => `
            <span class="badge bg-primary me-2 mb-2">
                ${value}
                <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="removeVariantValue('${variantId}', '${value}')"></button>
            </span>
        `).join('');
    }

    function generateVariantCombinations() {
        const variants = Object.values(selectedVariants);
        const combinations = getCombinations(variants);
        updateVariantTable(combinations);
    }

    function getCombinations(variants) {
        if (variants.length === 0) return [[]];
        const [first, ...rest] = variants;
        const combsWithoutFirst = getCombinations(rest);
        const combsWithFirst = first.values.flatMap(value =>
            combsWithoutFirst.map(comb => [{ name: first.name, value }].concat(comb))
        );
        return combsWithFirst;
    }

    function updateVariantTable(combinations) {
        variantTableBody.innerHTML = '';
        combinations.forEach((combination, index) => {
            const row = document.createElement('tr');
            const combinationText = combination.map(v => `${v.name}: ${v.value}`).join(', ');
            const variantIds = Object.keys(selectedVariants).join(',');
            row.innerHTML = `
                <td>
                    <input type="hidden" name="child_products[${index}][combination]" value="${combinationText}">
                    <input type="hidden" name="child_products[${index}][variant_ids]" value="${variantIds}">
                    ${combinationText}
                </td>
                <td><input type="text" class="form-control" name="child_products[${index}][barcode]" placeholder="Barcode"></td>
                <td><input type="number" class="form-control" name="child_products[${index}][quantity]" placeholder="Quantity"></td>
                <td><input type="number" class="form-control" name="child_products[${index}][price]" placeholder="Price"></td>
               
                <td><input type="number" class="form-control" name="child_products[${index}][quantity_alert]" placeholder="Quantity Alert"></td>            `;
            variantTableBody.appendChild(row);
        });
        variantTable.style.display = 'block';
    }
});
</script>
