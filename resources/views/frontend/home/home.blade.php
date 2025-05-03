@extends('frontend.layouts.master')
@section('frontend.content')
    <!-- Hero Section -->
    <!-- Hero Section -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($banners as $index => $banner)
                    <button 
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="{{ $loop->first ? 'true' : 'false' }}"
                        aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
            <div class="carousel-inner">

                @foreach ($banners as $banner)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="Home Essentials">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="hero-content">
                                            <h2>{{ $banner->title }}</h2>
                                            <p>Transform your living space with our home collection.</p>
                                            <a href="#" class="btn btn-primary btn-lg">Discover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>


    <!-- Features Section -->
    <section class="features py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="feature-box text-center p-4 bg-white rounded shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-truck text-primary mb-3" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        <h5>Free Shipping</h5>
                        <p class="mb-0">On orders over $50</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box text-center p-4 bg-white rounded shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-truck text-primary mb-3" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        <h5>Easy Returns</h5>
                        <p class="mb-0">30 days return policy</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box text-center p-4 bg-white rounded shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-truck text-primary mb-3" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        <h5>Secure Payment</h5>
                        <p class="mb-0">100% secure checkout</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="feature-box text-center p-4 bg-white rounded shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-truck text-primary mb-3" viewBox="0 0 16 16">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 1a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                        </svg>
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Dedicated support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section with Slider -->
    <section class="categories py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Shop by Category</h2>
                <p>Browse our wide range of products by category</p>
            </div>

            <div class="category-slider position-relative">
                <!-- Slider Controls -->
                <button class="slider-control prev" id="categoryPrev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-control next" id="categoryNext">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Slider Container -->
                <div class="slider-container">
                    <div class="slider-track" id="categoryTrack">
                        <!-- Category 1: Electronics -->
                        @foreach ($categories as $category)
                            
                       
                        <div class="slider-item">
                            <div class="category-circle text-center">
                                <a href="#" class="category-circle-link">
                                    <div class="circle-img">
                                        <img src=""
                                            alt={{ $category->name }} class="img-fluid">
                                        <div class="circle-overlay">
                                            <span>Shop Now</span>
                                        </div>
                                    </div>
                                    <h5 class="mt-3">{{ $category->name }}</h5>
                                </a>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Featured Products -->
    <section class="featured-products py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Featured Products</h2>
                <p>Handpicked products for you</p>
            </div>
            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-6 col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-danger text-white">Sale</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Headphones" alt="Wireless Headphones"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Electronics</a>
                            <h3 class="product-title">
                                <a href="#">Wireless Bluetooth Headphones</a>
                            </h3>
                            <div class="product-price">
                                <span class="old-price">$129.99</span>
                                <span class="current-price">$99.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(45)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3 add-to-cart-btn" data-product-id="1">Add to
                                Cart</button>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-danger text-white">Sale</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Headphones" alt="Wireless Headphones"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Electronics</a>
                            <h3 class="product-title">
                                <a href="#">Wireless Bluetooth Headphones</a>
                            </h3>
                            <div class="product-price">
                                <span class="old-price">$129.99</span>
                                <span class="current-price">$99.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(45)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-danger text-white">Sale</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Headphones" alt="Wireless Headphones"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Electronics</a>
                            <h3 class="product-title">
                                <a href="#">Wireless Bluetooth Headphones</a>
                            </h3>
                            <div class="product-price">
                                <span class="old-price">$129.99</span>
                                <span class="current-price">$99.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(45)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-danger text-white">Sale</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Headphones" alt="Wireless Headphones"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Electronics</a>
                            <h3 class="product-title">
                                <a href="#">Wireless Bluetooth Headphones</a>
                            </h3>
                            <div class="product-price">
                                <span class="old-price">$129.99</span>
                                <span class="current-price">$99.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(45)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary">View All Products</a>
            </div>
        </div>
    </section>



    <!-- New Arrivals -->
    <section class="new-arrivals py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>New Arrivals</h2>
                <p>The latest additions to our collection</p>
            </div>
            <div class="row g-4">
                <!-- Product 1 -->
                <div class="col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-success text-white">New</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Product" alt="Product"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Electronics</a>
                            <h3 class="product-title">
                                <a href="#">Smart Watch Series 5</a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">$199.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>(12)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-success text-white">New</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Product" alt="Product"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Fashion</a>
                            <h3 class="product-title">
                                <a href="#">Women's Summer Dress</a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">$59.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(8)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-success text-white">New</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Product" alt="Product"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Home & Kitchen</a>
                            <h3 class="product-title">
                                <a href="#">Air Fryer Pro</a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">$129.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>(15)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="col-md-3">
                    <div class="product-card bg-white rounded shadow-sm">
                        <div class="product-badge bg-success text-white">New</div>
                        <div class="product-wishlist">
                            <button class="btn wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <a href="#" class="product-thumb">
                            <img src="https://placehold.co/300x300/red/white?text=Product" alt="Product"
                                class="img-fluid">
                        </a>
                        <div class="product-info p-3">
                            <a href="#" class="product-category">Sports</a>
                            <h3 class="product-title">
                                <a href="#">Fitness Tracker</a>
                            </h3>
                            <div class="product-price">
                                <span class="current-price">$89.99</span>
                            </div>
                            <div class="product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <span>(10)</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Deal of the Day -->
    <section class="deal-of-the-day py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 order-2 order-md-1 mt-4 mt-md-0">
                    <img src="https://placehold.co/600x400/red/white?text=Premium+Earbuds" alt="Deal of the Day"
                        class="img-fluid rounded">
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2">
                    <div class="deal-content p-4">
                        <span class="badge bg-danger mb-2">Deal of the Day</span>
                        <h2>Premium Wireless Earbuds</h2>
                        <div class="product-rating mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>(87)</span>
                        </div>
                        <p class="mb-4">Experience crystal-clear sound with our premium wireless earbuds. Featuring
                            noise cancellation, water resistance, and 24-hour battery life.</p>
                        <div class="deal-price mb-4">
                            <span class="old-price fs-5 text-decoration-line-through text-muted">$149.99</span>
                            <span class="current-price fs-2 fw-bold text-danger ms-2">$89.99</span>
                            <span class="discount-badge ms-2">40% OFF</span>
                        </div>
                        <div class="deal-countdown mb-4">
                            <p class="mb-2">Hurry up! Offer ends in:</p>
                            <div class="countdown-timer d-flex flex-wrap">
                                <div class="countdown-item">
                                    <span class="hours">24</span>
                                    <span class="countdown-label">Hours</span>
                                </div>
                                <div class="countdown-item">
                                    <span class="minutes">00</span>
                                    <span class="countdown-label">Mins</span>
                                </div>
                                <div class="countdown-item">
                                    <span class="seconds">00</span>
                                    <span class="countdown-label">Secs</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger btn-lg">Shop Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>What Our Customers Say</h2>
                <p>Trusted by thousands of customers worldwide</p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                    <div class="testimonial-card p-4 bg-white rounded shadow-sm">
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="testimonial-text mb-4">"I'm extremely satisfied with my purchase. The quality of the
                            products is outstanding and the delivery was faster than expected!"</p>
                        <div class="testimonial-author d-flex align-items-center">
                            <img src="https://placehold.co/50x50/gray/white?text=User" alt="Customer"
                                class="rounded-circle me-3">
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <small class="text-muted">Loyal Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                    <div class="testimonial-card p-4 bg-white rounded shadow-sm">
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="testimonial-text mb-4">"The customer service is exceptional. They helped me resolve
                            an
                            issue with my order promptly and professionally. Highly recommended!"</p>
                        <div class="testimonial-author d-flex align-items-center">
                            <img src="https://placehold.co/50x50/gray/white?text=User" alt="Customer"
                                class="rounded-circle me-3">
                            <div>
                                <h5 class="mb-0">Michael Brown</h5>
                                <small class="text-muted">New Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                    <div class="testimonial-card p-4 bg-white rounded shadow-sm">
                        <div class="testimonial-rating mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="testimonial-text mb-4">"I've been shopping here for years and have never been
                            disappointed. The product selection is amazing and prices are competitive."</p>
                        <div class="testimonial-author d-flex align-items-center">
                            <img src="https://placehold.co/50x50/gray/white?text=User" alt="Customer"
                                class="rounded-circle me-3">
                            <div>
                                <h5 class="mb-0">Emily Davis</h5>
                                <small class="text-muted">Regular Customer</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter py-5 text-white" style="background-color: #475e9f;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h3>Subscribe to Our Newsletter</h3>
                    <p class="mb-4">Get the latest updates, deals and exclusive offers directly to your inbox.</p>
                    <div class="input-group newsletter-form flex-column flex-md-row">
                        <input type="email" class="form-control mb-2 mb-md-0" placeholder="Your email address">
                        <button class="btn btn-light" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="brands py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brands-slider d-flex justify-content-between align-items-center">
                        <div class="brand-item">
                            <img src="https://placehold.co/150x60/lightgray/white?text=Brand" alt="Brand"
                                class="img-fluid">
                        </div>
                        <div class="brand-item">
                            <img src="https://placehold.co/150x60/lightgray/white?text=Brand" alt="Brand"
                                class="img-fluid">
                        </div>
                        <div class="brand-item">
                            <img src="https://placehold.co/150x60/lightgray/white?text=Brand" alt="Brand"
                                class="img-fluid">
                        </div>
                        <div class="brand-item">
                            <img src="https://placehold.co/150x60/lightgray/white?text=Brand" alt="Brand"
                                class="img-fluid">
                        </div>
                        <div class="brand-item">
                            <img src="https://placehold.co/150x60/lightgray/white?text=Brand" alt="Brand"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
