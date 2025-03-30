@extends('admin.layouts.master')
@section('admin.content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="productName"
                            placeholder="Enter product name" />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productSKU" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="productSKU" placeholder="Enter SKU" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory">
                            <option selected disabled>Select category</option>
                            <option>Electronics</option>
                            <option>Fashion</option>
                            <option>Home & Garden</option>
                            <option>Sports</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="productPrice" placeholder="Enter price" />
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="productImages" class="form-label">Product Images</label>
                    <input class="form-control" type="file" id="productImages" multiple />
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="productStock" class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" id="productStock" placeholder="Enter quantity" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="productWeight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" id="productWeight" placeholder="Enter weight" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="productStatus" class="form-label">Status</label>
                        <select class="form-select" id="productStatus">
                            <option selected>Active</option>
                            <option>Inactive</option>
                            <option>Out of Stock</option>
                        </select>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="featuredProduct" />
                    <label class="form-check-label" for="featuredProduct">
                        Featured Product
                    </label>
                </div>
                <div class="form-footer" style="margin-top: 10px; float: right;">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="reset" class="btn btn-outline-secondary ms-2">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
