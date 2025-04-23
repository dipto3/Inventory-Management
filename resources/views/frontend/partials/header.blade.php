@include('frontend.partials.topbar')

<!-- Header -->
<header class="bg-white py-3 shadow-sm">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <a href="index.html" class="text-decoration-none">
                    <h1 class="m-0" style="color: #4d629d;">ShopEasy</h1>
                </a>
            </div>
            <div class="col-md-6">
                <div class="input-group flex-nowrap">
                    <input type="text" class="form-control" placeholder="Search for products...">
                    <button class="btn btn-primary" style="background-color: #4d629d; white-space: nowrap;"
                        type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="#" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-heart"></i>
                    </a>
                    <!-- Cart Button with Counter - This will toggle the offcanvas -->
                    <button type="button" class="btn btn-outline-secondary position-relative"
                        data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                        <i class="fas fa-shopping-cart"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count-badge">
                            0
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Cart Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="cartOffcanvasLabel">Your Cart <span class="cart-count">(3)</span></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div id="cartContent">
            <!-- Static cart items for design -->
            <div class="cart-item p-3 border-bottom" data-product-id="1">
                <div class="d-flex">
                    <div class="cart-item-image me-3">
                        <img src="http://localhost:63342/e-commerce/images/product.jpeg" alt="Wireless Headphones"
                            class="img-fluid"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                    </div>
                    <div class="cart-item-details flex-grow-1">
                        <h6 class="cart-item-title mb-1">Wireless Bluetooth Headphones</h6>
                        <div class="cart-item-variant small text-muted mb-1">Color: Black | Size: Medium</div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="cart-item-price text-primary fw-bold">$99.99</div>
                            <div class="cart-item-total fw-bold">$99.99</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm align-items-center" style="width: 100px;">
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="decrease">-</button>
                                <input type="text" style="height: 28px; margin: 0;"
                                    class="form-control text-center cart-item-quantity-input" value="1"
                                    readonly>
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="increase">+</button>
                            </div>
                            <button class="btn btn-sm text-danger ms-auto cart-item-remove" data-product-id="1">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-item p-3 border-bottom" data-product-id="1">
                <div class="d-flex">
                    <div class="cart-item-image me-3">
                        <img src="http://localhost:63342/e-commerce/images/product.jpeg" alt="Wireless Headphones"
                            class="img-fluid"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                    </div>
                    <div class="cart-item-details flex-grow-1">
                        <h6 class="cart-item-title mb-1">Wireless Bluetooth Headphones</h6>
                        <div class="cart-item-variant small text-muted mb-1">Color: Black | Size: Medium</div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="cart-item-price text-primary fw-bold">$99.99</div>
                            <div class="cart-item-total fw-bold">$99.99</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm align-items-center" style="width: 100px;">
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="decrease">-</button>
                                <input type="text" style="height: 28px; margin: 0;"
                                    class="form-control text-center cart-item-quantity-input" value="1"
                                    readonly>
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="increase">+</button>
                            </div>
                            <button class="btn btn-sm text-danger ms-auto cart-item-remove" data-product-id="1">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-item p-3 border-bottom" data-product-id="1">
                <div class="d-flex">
                    <div class="cart-item-image me-3">
                        <img src="http://localhost:63342/e-commerce/images/product.jpeg" alt="Wireless Headphones"
                            class="img-fluid"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                    </div>
                    <div class="cart-item-details flex-grow-1">
                        <h6 class="cart-item-title mb-1">Wireless Bluetooth Headphones</h6>
                        <div class="cart-item-variant small text-muted mb-1">Color: Black | Size: Medium</div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="cart-item-price text-primary fw-bold">$99.99</div>
                            <div class="cart-item-total fw-bold">$99.99</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="input-group input-group-sm align-items-center" style="width: 100px;">
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="decrease">-</button>
                                <input type="text" style="height: 28px; margin: 0;"
                                    class="form-control text-center cart-item-quantity-input" value="1"
                                    readonly>
                                <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button"
                                    data-action="increase">+</button>
                            </div>
                            <button class="btn btn-sm text-danger ms-auto cart-item-remove" data-product-id="1">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer p-3 border-top bg-light">
        <div class="cart-summary mb-3">
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal:</span>
                <span class="cart-subtotal">$249.96</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span>Shipping:</span>
                <span class="cart-shipping">Free</span>
            </div>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total:</span>
                <span class="cart-total">$249.96</span>
            </div>
        </div>
        <div class="cart-actions">
            <a href="cart.html" class="btn btn-outline-primary w-100 mb-2">View Cart</a>
            <a href="checkout.html" class="btn btn-primary w-100" id="checkoutBtn">Checkout</a>
        </div>
    </div>
</div>

@include('frontend.partials.nav')