// Simple cart functionality - focused on making quantity buttons work
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle quantity changes
    function handleQuantityButtons() {
        // Get all quantity buttons
        const quantityButtons = document.querySelectorAll('.cart-item-quantity-btn');
        
        // Add click event listener to each button
        quantityButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the action (increase or decrease)
                const action = this.getAttribute('data-action');
                
                // Get the input element
                const inputElement = this.parentElement.querySelector('.cart-item-quantity-input');
                
                // Get current quantity
                let quantity = parseInt(inputElement.value);
                
                // Update quantity based on action
                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }
                
                // Update input value
                inputElement.value = quantity;
                
                // Get the cart item element
                const cartItem = this.closest('.cart-item');
                
                // Get the price element
                const priceElement = cartItem.querySelector('.cart-item-price');
                const price = parseFloat(priceElement.textContent.replace('$', ''));
                
                // Update the total for this item
                const totalElement = cartItem.querySelector('.cart-item-total');
                totalElement.textContent = '$' + (price * quantity).toFixed(2);
                
                // Update cart totals
                updateCartTotals();
            });
        });
    }
    
    // Function to handle remove buttons
    function handleRemoveButtons() {
        const removeButtons = document.querySelectorAll('.cart-item-remove');
        
        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the cart item
                const cartItem = this.closest('.cart-item');
                
                // Remove the item from DOM
                cartItem.remove();
                
                // Update cart totals
                updateCartTotals();
                
                // Update cart count
                updateCartCount();
            });
        });
    }
    
    // Function to update cart totals
    function updateCartTotals() {
        let subtotal = 0;
        
        // Calculate subtotal from all cart items
        document.querySelectorAll('.cart-item').forEach(item => {
            const itemTotal = parseFloat(item.querySelector('.cart-item-total').textContent.replace('$', ''));
            subtotal += itemTotal;
        });
        
        // Update subtotal and total in the cart summary
        const subtotalElement = document.querySelector('.cart-subtotal');
        const totalElement = document.querySelector('.cart-total');
        
        if (subtotalElement) subtotalElement.textContent = '$' + subtotal.toFixed(2);
        if (totalElement) totalElement.textContent = '$' + subtotal.toFixed(2);
    }
    
    // Function to update cart count
    function updateCartCount() {
        const cartItems = document.querySelectorAll('.cart-item');
        const cartCount = cartItems.length;
        
        // Update cart count in header
        const cartCountBadge = document.querySelector('.cart-count-badge');
        if (cartCountBadge) cartCountBadge.textContent = cartCount;
        
        // Update cart count in offcanvas header
        const cartCountSpan = document.querySelector('.cart-count');
        if (cartCountSpan) cartCountSpan.textContent = '(' + cartCount + ')';
    }
    
    // Initialize cart functionality
    function initCart() {
        handleQuantityButtons();
        handleRemoveButtons();
        updateCartTotals();
        updateCartCount();
    }
    
    // Call initialization
    initCart();
});