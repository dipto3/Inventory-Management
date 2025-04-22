<div class="sidebar" id="sidebar">
    <div class="sidebar-brand p-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="bi bi-shop fs-4"></i>
            <span class="sidebar-brand-text ms-2 fs-5">E-Commerce</span>
        </div>
        <button class="btn btn-link text-white d-lg-none" id="mobileCloseBtn">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <div class="sidebar-content px-2">
        <!-- Inventory Group -->
        <div class="menu-group" data-bs-toggle="collapse" data-bs-target="#inventoryGroup">
            <span>Inventory</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div class="menu-items collapse show" id="inventoryGroup">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('supplier.index') }}">
                        <i class="bi bi-person-gear"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('brand.index') }}">
                        <i class="bi bi-border-width"></i>
                        <span>Brand</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('unit.index') }}">
                        <i class="bi bi-boxes"></i>
                        <span>Unit</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('variant.index') }}">
                        <i class="bi bi-command"></i>
                        <span>Variant Attributes</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.index') }}">
                        <i class="bi bi-ui-checks-grid"></i>
                        <span>Category</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">
                        <i class="bi bi-box-fill"></i>
                        <span>Products</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expired.products') }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Expired Products</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchase-order.index') }}">
                        <i class="bi bi-cart-check-fill"></i>
                        <span>Purchase Order</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchase.index') }}">
                        <i class="bi bi-cart-plus-fill"></i>
                        <span>Purchase</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('return-reason.index') }}">
                        <i class="bi bi-bootstrap-reboot"></i>
                        <span>Return Reasons</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('purchase-return.index') }}">
                        <i class="bi bi-r-circle-fill"></i>
                        <span>Return Purchase</span>
                    </a>
                </li>



                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-receipt"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="#">All Orders</a></li>
                        <li><a class="dropdown-item" href="#">Pending Orders</a></li>
                        <li>
                            <a class="dropdown-item" href="#">Completed Orders</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Cancelled Orders</a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <div class="menu-group" data-bs-toggle="collapse" data-bs-target="#ecommerceGroup">
            <span>E-commerce</span>
            <i class="bi bi-chevron-down"></i>
        </div>
        <div class="menu-items collapse show" id="ecommerceGroup">
            <ul class="nav flex-column">


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('banner.index') }}">
                        <i class="bi bi-card-image"></i>
                        <span>Banner</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('coupon.index') }}">
                        <i class="bi bi-ticket-perforated-fill"></i>
                        <span>Coupon</span>
                    </a>
                </li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="ordersDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-receipt"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ordersDropdown">
                        <li><a class="dropdown-item" href="#">All Orders</a></li>
                        <li><a class="dropdown-item" href="#">Pending Orders</a></li>
                        <li>
                            <a class="dropdown-item" href="#">Completed Orders</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Cancelled Orders</a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </div>
    </div>
</div>
