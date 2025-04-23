// Back to top button functionality
window.addEventListener('scroll', function() {
    var backToTopBtn = document.querySelector('.back-to-top');
    if (window.pageYOffset > 300) {
        backToTopBtn.classList.add('show');
    } else {
        backToTopBtn.classList.remove('show');
    }
});

// Initialize Bootstrap tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

// Mobile menu enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const navbarCollapse = document.getElementById('navbarNav');
        const navbarToggler = document.querySelector('.navbar-toggler');
        
        if (navbarCollapse.classList.contains('show') && 
            !navbarCollapse.contains(event.target) && 
            !navbarToggler.contains(event.target)) {
            navbarToggler.click();
        }
    });
    
    // Wishlist button functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
                showToast('Product added to wishlist!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');
                showToast('Product removed from wishlist!');
            }
        });
    });
    
    // Add to cart functionality
    const addToCartButtons = document.querySelectorAll('.product-card .btn-primary');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-title a').textContent;
            const cartCount = document.querySelector('.fa-shopping-cart + .badge');
            
            // Update cart count
            let count = parseInt(cartCount.textContent);
            cartCount.textContent = count + 1;
            
            // Show animation
            this.innerHTML = '<i class="fas fa-check"></i> Added';
            this.classList.add('btn-success');
            
            // Reset button after 2 seconds
            setTimeout(() => {
                this.innerHTML = 'Add to Cart';
                this.classList.remove('btn-success');
            }, 2000);
            
            showToast(`${productName} added to cart!`);
        });
    });
    
    // Countdown timer functionality
    const countdownElements = document.querySelectorAll('.countdown-timer');
    if (countdownElements.length > 0) {
        startCountdown();
    }
    
    // Product image hover effect
    const productThumbs = document.querySelectorAll('.product-thumb');
    productThumbs.forEach(thumb => {
        thumb.addEventListener('mouseenter', function() {
            this.classList.add('zoomed');
        });
        thumb.addEventListener('mouseleave', function() {
            this.classList.remove('zoomed');
        });
    });
    
    // Newsletter form validation
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        const emailInput = newsletterForm.querySelector('input[type="email"]');
        const submitButton = newsletterForm.querySelector('button');
        
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            const email = emailInput.value.trim();
            
            if (email === '') {
                showToast('Please enter your email address', 'error');
                emailInput.focus();
                return;
            }
            
            if (!isValidEmail(email)) {
                showToast('Please enter a valid email address', 'error');
                emailInput.focus();
                return;
            }
            
            // Simulate form submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Subscribing...';
            
            setTimeout(() => {
                emailInput.value = '';
                submitButton.disabled = false;
                submitButton.textContent = 'Subscribe';
                showToast('Thank you for subscribing to our newsletter!', 'success');
            }, 1500);
        });
    }
    
    // Create toast container if it doesn't exist
    if (!document.querySelector('.toast-container')) {
        const toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        document.body.appendChild(toastContainer);
    }
});

// Helper functions
function showToast(message, type = 'info') {
    const toastContainer = document.querySelector('.toast-container');
    
    const toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-white bg-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'primary'} border-0`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    
    toastContainer.appendChild(toastEl);
    
    const toast = new bootstrap.Toast(toastEl, {
        autohide: true,
        delay: 3000
    });
    
    toast.show();
    
    // Remove toast from DOM after it's hidden
    toastEl.addEventListener('hidden.bs.toast', function() {
        toastEl.remove();
    });
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}


// Add smooth scrolling for all links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        if (this.getAttribute('href') !== '#') {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        }
    });
});

// Lazy loading for images
if ('loading' in HTMLImageElement.prototype) {
    // Browser supports native lazy loading
    document.querySelectorAll('img').forEach(img => {
        img.setAttribute('loading', 'lazy');
    });
} else {
    // Fallback for browsers that don't support lazy loading
    const lazyLoadScript = document.createElement('script');
    lazyLoadScript.src = 'https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js';
    document.head.appendChild(lazyLoadScript);
    
    lazyLoadScript.onload = function() {
        const observer = lozad();
        observer.observe();
    };
}

// Add animation on scroll
window.addEventListener('scroll', function() {
    const animatedElements = document.querySelectorAll('.feature-box, .product-card, .category-card, .testimonial-card');
    
    animatedElements.forEach(element => {
        const elementPosition = element.getBoundingClientRect().top;
        const screenPosition = window.innerHeight / 1.2;
        
        if (elementPosition < screenPosition) {
            element.classList.add('animate__animated', 'animate__fadeInUp');
        }
    });
});
// Category Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('categoryTrack');
    const prevBtn = document.getElementById('categoryPrev');
    const nextBtn = document.getElementById('categoryNext');
    
    if (!track || !prevBtn || !nextBtn) return;
    
    const items = track.querySelectorAll('.slider-item');
    const itemWidth = items[0].offsetWidth;
    const visibleItems = getVisibleItems();
    let position = 0;
    
    // Update slider position
    function updateSliderPosition() {
        track.style.transform = `translateX(${position}px)`;
    }
    
    // Get number of visible items based on screen width
    function getVisibleItems() {
        if (window.innerWidth >= 1200) return 5;
        if (window.innerWidth >= 992) return 4;
        if (window.innerWidth >= 768) return 3;
        if (window.innerWidth >= 576) return 2;
        return 1;
    }
    
    // Next button click
    nextBtn.addEventListener('click', function() {
        const maxPosition = -(items.length - visibleItems) * itemWidth;
        if (position > maxPosition) {
            position -= itemWidth;
            updateSliderPosition();
        }
    });
    
    // Previous button click
    prevBtn.addEventListener('click', function() {
        if (position < 0) {
            position += itemWidth;
            updateSliderPosition();
        }
    });
    
    // Update on window resize
    window.addEventListener('resize', function() {
        // Recalculate visible items
        const newVisibleItems = getVisibleItems();
        if (newVisibleItems !== visibleItems) {
            // Reset position if needed
            position = 0;
            updateSliderPosition();
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Initialize price range slider
    if (document.getElementById('priceRange')) {
        const priceSlider = document.getElementById('priceRange');
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        
        noUiSlider.create(priceSlider, {
            start: [0, 1000],
            connect: true,
            step: 10,
            range: {
                'min': 0,
                'max': 2000
            }
        });
        
        priceSlider.noUiSlider.on('update', function(values, handle) {
            const value = Math.round(values[handle]);
            
            if (handle === 0) {
                minPriceInput.value = value;
            } else {
                maxPriceInput.value = value;
            }
        });
        
        minPriceInput.addEventListener('change', function() {
            priceSlider.noUiSlider.set([this.value, null]);
        });
        
        maxPriceInput.addEventListener('change', function() {
            priceSlider.noUiSlider.set([null, this.value]);
        });
    }
    
    // Grid/List view toggle
    const gridViewBtn = document.getElementById('gridView');
    const listViewBtn = document.getElementById('listView');
    const productsGrid = document.getElementById('productsGrid');
    const productsList = document.getElementById('productsList');
    
    if (gridViewBtn && listViewBtn) {
        gridViewBtn.addEventListener('click', function() {
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            productsGrid.classList.remove('d-none');
            productsList.classList.add('d-none');
        });
        
        listViewBtn.addEventListener('click', function() {
            listViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            productsList.classList.remove('d-none');
            productsGrid.classList.add('d-none');
        });
    }
    
    // Initialize tooltips for color options
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Size options selection
    const sizeOptions = document.querySelectorAll('.size-option');
    if (sizeOptions) {
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    
    // Color options selection
    const colorOptions = document.querySelectorAll('.color-option');
    if (colorOptions) {
        colorOptions.forEach(option => {
            option.addEventListener('click', function() {
                colorOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }
    
    // Wishlist button functionality
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    if (wishlistBtns) {
        wishlistBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = '#e74a3b';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    icon.style.color = '';
                }
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Make filter cards collapsible
    const filterTitles = document.querySelectorAll('.filter-title');
    filterTitles.forEach(title => {
        title.style.cursor = 'pointer';
        title.innerHTML += '<i class="fas fa-chevron-down float-end" style="font-size: 0.8rem; margin-top: 5px;"></i>';
        
        title.addEventListener('click', function() {
            const body = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            if (body.style.display === 'none') {
                body.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                body.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    });
    
    // Animate color and size selection
    const colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            colorOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    const sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            sizeOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
const productThumbs = new Swiper('.product-thumbs-slider', {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});

const productMain = new Swiper('.product-main-slider', {
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    thumbs: {
        swiper: productThumbs,
    },
});

// Quantity selector functionality
document.getElementById('decreaseQuantity').addEventListener('click', function() {
    const quantityInput = document.getElementById('productQuantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});

document.getElementById('increaseQuantity').addEventListener('click', function() {
    const quantityInput = document.getElementById('productQuantity');
    const currentValue = parseInt(quantityInput.value);
    const maxValue = parseInt(quantityInput.getAttribute('max'));
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
});

// Color selection
const colorOptions = document.querySelectorAll('.color-option');
colorOptions.forEach(option => {
    option.addEventListener('click', function() {
        colorOptions.forEach(opt => opt.classList.remove('active'));
        this.classList.add('active');
    });
});

// Review star rating
const starRatings = document.querySelectorAll('.star-rating');
starRatings.forEach(star => {
    star.addEventListener('click', function() {
        const rating = parseInt(this.getAttribute('data-rating'));
        document.getElementById('selectedRating').value = rating;
        
        // Update stars visual
        starRatings.forEach(s => {
            const sRating = parseInt(s.getAttribute('data-rating'));
            if (sRating <= rating) {
                s.classList.remove('far');
                s.classList.add('fas');
            } else {
                s.classList.remove('fas');
                s.classList.add('far');
            }
        });
    });
    
    // Hover effects
    star.addEventListener('mouseenter', function() {
        const rating = parseInt(this.getAttribute('data-rating'));
        
        starRatings.forEach(s => {
            const sRating = parseInt(s.getAttribute('data-rating'));
            if (sRating <= rating) {
                s.classList.add('hover');
            }
        });
    });
    
    star.addEventListener('mouseleave', function() {
        starRatings.forEach(s => {
            s.classList.remove('hover');
        });
    });
});

// Submit review button
document.getElementById('submitReview').addEventListener('click', function() {
    const rating = document.getElementById('selectedRating').value;
    const title = document.getElementById('reviewTitle').value;
    const text = document.getElementById('reviewText').value;
    const name = document.getElementById('reviewerName').value;
    
    if (rating === '0') {
        alert('Please select a rating');
        return;
    }
    
    if (!title || !text || !name) {
        alert('Please fill in all required fields');
        return;
    }
    
    // Here you would normally send the review data to your server
    alert('Thank you for your review! It will be published after moderation.');
    
    // Close modal and reset form
    const modal = bootstrap.Modal.getInstance(document.getElementById('reviewModal'));
    modal.hide();
    document.getElementById('reviewForm').reset();
    starRatings.forEach(s => {
        s.classList.remove('fas');
        s.classList.add('far');
    });
    document.getElementById('selectedRating').value = '0';
});

// Add to cart button
document.getElementById('addToCartBtn').addEventListener('click', function() {
    const quantity = document.getElementById('productQuantity').value;
    // Here you would add the product to cart with the selected quantity
    alert(`Added ${quantity} item(s) to your cart!`);
});

// Buy now button
document.getElementById('buyNowBtn').addEventListener('click', function() {
    const quantity = document.getElementById('productQuantity').value;
    // Here you would add the product to cart and redirect to checkout
    alert(`Proceeding to checkout with ${quantity} item(s)!`);
    // window.location.href = 'checkout.html';
});

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

// Initialize product image sliders
const productThumbs = new Swiper('.product-thumbs-slider', {
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
        // when window width is >= 768px
        768: {
            slidesPerView: 5,
        }
    }
});

const productMain = new Swiper('.product-main-slider', {
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    thumbs: {
        swiper: productThumbs,
    }
    zoom: {
        maxRatio: 2,
        toggle: true,
    }
});

// Initialize product image sliders
document.addEventListener('DOMContentLoaded', function() {
    // Initialize thumbnail slider first
    const productThumbs = new Swiper('.product-thumbs-slider', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    
    // Initialize main slider and connect it to the thumbnails
    const productMain = new Swiper('.product-main-slider', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: productThumbs,
        },
    });
});

// Cart Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Update cart display on page load
    updateCartDisplay();
    
    // Add to Cart Button Click
    document.addEventListener('click', function(e) {
        if (e.target.matches('.add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
            const button = e.target.matches('.add-to-cart-btn') ? e.target : e.target.closest('.add-to-cart-btn');
            const productCard = button.closest('.product-card') || button.closest('.product-details');
            
            if (productCard) {
                // Get product data
                const productName = productCard.querySelector('.product-title a').textContent.trim();
                const productPrice = productCard.querySelector('.current-price').textContent.trim();
                const productImage = productCard.querySelector('.product-thumb img, .product-main-slider .swiper-slide:first-child img').src;
                const productId = button.getAttribute('data-product-id') || Date.now().toString();
                
                const productData = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                };
                
                // Check if product is already in cart
                const existingProductIndex = cart.findIndex(item => item.id === productData.id);
                
                if (existingProductIndex > -1) {
                    // Increment quantity if product already exists
                    cart[existingProductIndex].quantity += 1;
                } else {
                    // Add new product to cart
                    cart.push(productData);
                }
                
                // Save cart to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
                
                // Update cart display
                updateCartDisplay();
                
                // Show cart offcanvas
                const cartOffcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
                cartOffcanvas.show();
            }
        }
    });
    
    // Remove Item from Cart
    document.addEventListener('click', function(e) {
        if (e.target.matches('.cart-item-remove') || e.target.closest('.cart-item-remove')) {
            const button = e.target.matches('.cart-item-remove') ? e.target : e.target.closest('.cart-item-remove');
            const productId = button.getAttribute('data-product-id');
            
            // Remove item from cart array
            cart = cart.filter(item => item.id !== productId);
            
            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Update cart display
            updateCartDisplay();
        }
    });
    
    // Update Item Quantity
    document.addEventListener('click', function(e) {
        if (e.target.matches('.cart-item-quantity-btn')) {
            const button = e.target;
            const action = button.getAttribute('data-action');
            const productId = button.closest('.cart-item').getAttribute('data-product-id');
            
            // Find product in cart
            const productIndex = cart.findIndex(item => item.id === productId);
            
            if (productIndex > -1) {
                if (action === 'decrease') {
                    if (cart[productIndex].quantity > 1) {
                        cart[productIndex].quantity -= 1;
                    } else {
                        // Remove item if quantity becomes 0
                        cart.splice(productIndex, 1);
                    }
                } else if (action === 'increase') {
                    cart[productIndex].quantity += 1;
                }
                
                // Save updated cart to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
                
                // Update cart display
                updateCartDisplay();
            }
        }
    });
    
    // Helper Functions
    function updateCartDisplay() {
        // Update cart count in header
        const cartCountElements = document.querySelectorAll('.cart-count, .cart-count-badge');
        const itemCount = cart.reduce((total, item) => total + item.quantity, 0);
        
        cartCountElements.forEach(element => {
            element.textContent = itemCount;
        });
        
        // Update cart content
        const cartContent = document.getElementById('cartContent');
        
        if (!cartContent) return; // Exit if element doesn't exist
        
        if (cart.length === 0) {
            // Show empty cart message
            cartContent.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <p class="mb-3">No products found in your cart</p>
                    <a href="index.html" class="btn btn-primary btn-sm">Continue Shopping</a>
                </div>
            `;
            
            // Update summary
            document.querySelector('.cart-subtotal').textContent = '$0.00';
            document.querySelector('.cart-shipping').textContent = '$0.00';
            document.querySelector('.cart-total').textContent = '$0.00';
            
            // Disable checkout button
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (checkoutBtn) {
                checkoutBtn.classList.add('disabled');
            }
        } else {
            // Generate cart items HTML
            let cartItemsHTML = '';
            let subtotal = 0;
            
            cart.forEach(item => {
                const itemPrice = parseFloat(item.price.replace(/[^0-9.-]+/g, ''));
                const itemTotal = itemPrice * item.quantity;
                subtotal += itemTotal;
                
                cartItemsHTML += `
                    <div class="cart-item mb-3 pb-3 border-bottom" data-product-id="${item.id}">
                        <div class="d-flex">
                            <div class="cart-item-image me-3">
                                <img src="${item.image}" alt="${item.name}" class="img-fluid" style="width: 70px; height: 70px; object-fit: cover; border-radius: 4px;">
                            </div>
                            <div class="cart-item-details flex-grow-1">
                                <h6 class="cart-item-title mb-1">${item.name}</h6>
                                <div class="cart-item-price text-primary fw-bold mb-2">${item.price}</div>
                                <div class="d-flex align-items-center">
                                    <div class="input-group input-group-sm" style="width: 100px;">
                                        <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button" data-action="decrease">-</button>
                                        <input type="text" class="form-control text-center cart-item-quantity-input" value="${item.quantity}" readonly>
                                        <button class="btn btn-outline-secondary cart-item-quantity-btn" type="button" data-action="increase">+</button>
                                    </div>
                                    <button class="btn btn-sm text-danger ms-auto cart-item-remove" data-product-id="${item.id}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            cartContent.innerHTML = cartItemsHTML;
            
            // Update cart summary
            const shipping = subtotal >= 50 ? 0 : 5.99;
            const total = subtotal + shipping;
            
            document.querySelector('.cart-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.querySelector('.cart-shipping').textContent = shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`;
            document.querySelector('.cart-total').textContent = `$${total.toFixed(2)}`;
            
            // Enable checkout button
            const checkoutBtn = document.getElementById('checkoutBtn');
            if (checkoutBtn) {
                checkoutBtn.classList.remove('disabled');
            }
        }
    }
});



// Sticky Header
// Mobile toggle and current selection for side-by-side navigation
document.addEventListener('DOMContentLoaded', function() {
    // Mobile: Toggle subcategories
    if (window.innerWidth < 992) {
        const subcategoryTitles = document.querySelectorAll('.subcategory-title');
        subcategoryTitles.forEach(title => {
            title.addEventListener('click', function() {
                this.classList.toggle('active');
            });
        });
    }
    
    // Mark current selection
    const currentUrl = window.location.href;
    const subSubLinks = document.querySelectorAll('.sub-subcategory-list a');
    
    subSubLinks.forEach(link => {
        if (link.href === currentUrl) {
            // Mark the link as current
            link.classList.add('current');
            
            // Mark parent subcategory as active
            const parentTitle = link.closest('.subcategory-column').querySelector('.subcategory-title');
            if (parentTitle) {
                parentTitle.classList.add('active');
            }
            
            // Mark main dropdown parent
            const dropdownParent = link.closest('.nav-item.dropdown');
            if (dropdownParent) {
                const navLink = dropdownParent.querySelector('.nav-link');
                if (navLink) {
                    navLink.classList.add('active');
                }
            }
        }
    });
});

// Order view functionality
// Order view functionality
const viewOrderBtns = document.querySelectorAll('.view-order-btn');
const orderDetailsModal = document.getElementById('orderDetailsModal');
const closeModal = document.querySelector('.close-modal');
const modalOrderId = document.getElementById('modalOrderId');
const modalOrderDate = document.getElementById('modalOrderDate');
const modalOrderStatus = document.getElementById('modalOrderStatus');
const modalOrderItems = document.getElementById('modalOrderItems');
const modalSubtotal = document.getElementById('modalSubtotal');
const modalShipping = document.getElementById('modalShipping');
const modalTax = document.getElementById('modalTax');
const modalTotal = document.getElementById('modalTotal');

// Sample order data (in a real app, this would come from a database)
const orderData = {
    'ORD-12345': {
        id: 'ORD-12345',
        date: 'November 15, 2023',
        status: 'delivered',
        items: [
            { name: 'Wireless Headphones', price: 129.99, quantity: 1, image: 'https://via.placeholder.com/50' },
            { name: 'Phone Case', price: 19.99, quantity: 2, image: 'https://via.placeholder.com/50' }
        ],
        subtotal: 169.97,
        shipping: 5.99,
        tax: 14.00,
        total: 189.96
    },
    'ORD-12346': {
        id: 'ORD-12346',
        date: 'October 28, 2023',
        status: 'shipped',
        items: [
            { name: 'Smart Watch', price: 249.99, quantity: 1, image: 'https://via.placeholder.com/50' }
        ],
        subtotal: 249.99,
        shipping: 0.00,
        tax: 20.00,
        total: 269.99
    },
    'ORD-12347': {
        id: 'ORD-12347',
        date: 'September 10, 2023',
        status: 'delivered',
        items: [
            { name: 'Laptop Backpack', price: 79.99, quantity: 1, image: 'https://via.placeholder.com/50' },
            { name: 'USB-C Cable', price: 9.99, quantity: 3, image: 'https://via.placeholder.com/50' }
        ],
        subtotal: 109.96,
        shipping: 4.99,
        tax: 9.20,
        total: 124.15
    }
};

// Function to open modal and populate with order data
function openOrderModal(orderId) {
    const order = orderData[orderId];
    if (!order) return;
    
    // Set order details in modal
    modalOrderId.textContent = order.id;
    modalOrderDate.textContent = order.date;
    
    // Set status with appropriate class
    modalOrderStatus.textContent = order.status.charAt(0).toUpperCase() + order.status.slice(1);
    modalOrderStatus.className = 'status-text ' + order.status;
    
    // Clear previous items
    modalOrderItems.innerHTML = '';
    
    // Add order items to table
    order.items.forEach(item => {
        const row = document.createElement('tr');
        
        const productCell = document.createElement('td');
        productCell.className = 'product-cell';
        
        const img = document.createElement('img');
        img.src = item.image;
        img.alt = item.name;
        
        const productName = document.createElement('span');
        productName.className = 'product-name';
        productName.textContent = item.name;
        
        productCell.appendChild(img);
        productCell.appendChild(productName);
        
        const priceCell = document.createElement('td');
        priceCell.textContent = '$' + item.price.toFixed(2);
        
        const quantityCell = document.createElement('td');
        quantityCell.textContent = item.quantity;
        
        const totalCell = document.createElement('td');
        totalCell.textContent = '$' + (item.price * item.quantity).toFixed(2);
        
        row.appendChild(productCell);
        row.appendChild(priceCell);
        row.appendChild(quantityCell);
        row.appendChild(totalCell);
        
        modalOrderItems.appendChild(row);
    });
    
    // Set order summary values
    modalSubtotal.textContent = '$' + order.subtotal.toFixed(2);
    modalShipping.textContent = '$' + order.shipping.toFixed(2);
    modalTax.textContent = '$' + order.tax.toFixed(2);
    modalTotal.textContent = '$' + order.total.toFixed(2);
    
    // Show modal
    orderDetailsModal.style.display = 'block';
    
    // Prevent scrolling on the body
    document.body.style.overflow = 'hidden';
}

// Add click event to view order buttons
viewOrderBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order-id');
        openOrderModal(orderId);
    });
});

// Close modal when clicking the X
if (closeModal) {
    closeModal.addEventListener('click', function() {
        orderDetailsModal.style.display = 'none';
        document.body.style.overflow = '';
    });
}

// Close modal when clicking outside the modal content
window.addEventListener('click', function(event) {
    if (event.target === orderDetailsModal) {
        orderDetailsModal.style.display = 'none';
        document.body.style.overflow = '';
    }
});

// Track Order button functionality
const trackOrderBtn = document.getElementById('trackOrderBtn');
if (trackOrderBtn) {
    trackOrderBtn.addEventListener('click', function() {
        // In a real app, this would redirect to a tracking page
        alert('Redirecting to order tracking...');
    });
}

// Buy Again button functionality
const reorderBtn = document.getElementById('reorderBtn');
if (reorderBtn) {
    reorderBtn.addEventListener('click', function() {
        // In a real app, this would add all items to cart
        alert('Adding items to cart...');
    });
}




// Add this code at the end of your script.js file
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded - initializing category slider");
    
    // Direct references to slider elements
    const categoryPrev = document.getElementById('categoryPrev');
    const categoryNext = document.getElementById('categoryNext');
    const categoryTrack = document.getElementById('categoryTrack');
    
    // Log to check if elements are found
    console.log("Slider elements:", {categoryPrev, categoryNext, categoryTrack});
    
    if (!categoryTrack || !categoryPrev || !categoryNext) {
        console.error("Category slider elements not found!");
        return;
    }
    
    // Get all slider items
    const sliderItems = categoryTrack.querySelectorAll('.slider-item');
    console.log("Found slider items:", sliderItems.length);
    
    if (sliderItems.length === 0) return;
    
    // Set initial state
    let currentPosition = 0;
    const itemWidth = sliderItems[0].offsetWidth;
    const visibleItems = getVisibleItems();
    
    // Function to determine visible items based on screen width
    function getVisibleItems() {
        if (window.innerWidth >= 1200) return 5;
        if (window.innerWidth >= 992) return 4;
        if (window.innerWidth >= 768) return 3;
        if (window.innerWidth >= 576) return 2;
        return 1;
    }
    
    // Function to update slider position
    function updateSliderPosition() {
        categoryTrack.style.transform = `translateX(${currentPosition}px)`;
        
        // Update button states
        categoryPrev.disabled = currentPosition >= 0;
        categoryNext.disabled = currentPosition <= -(sliderItems.length - visibleItems) * itemWidth;
    }
    
    // Add direct click event listeners
    categoryNext.onclick = function() {
        console.log("Next button clicked");
        const maxPosition = -(sliderItems.length - visibleItems) * itemWidth;
        if (currentPosition > maxPosition) {
            currentPosition -= itemWidth;
            updateSliderPosition();
        }
    };
    
    categoryPrev.onclick = function() {
        console.log("Prev button clicked");
        if (currentPosition < 0) {
            currentPosition += itemWidth;
            updateSliderPosition();
        }
    };
    
    // Initialize
    console.log("Category slider initialized");
    updateSliderPosition();
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // Recalculate item width and visible items
        const newVisibleItems = getVisibleItems();
        const newItemWidth = sliderItems[0].offsetWidth;
        
        // Reset position if needed
        if (newVisibleItems !== visibleItems || newItemWidth !== itemWidth) {
            currentPosition = 0;
            updateSliderPosition();
        }
    });
});






