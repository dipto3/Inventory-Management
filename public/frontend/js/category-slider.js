
        document.addEventListener('DOMContentLoaded', function () {
            console.log("DOM fully loaded - initializing category slider");

            // Direct references to slider elements
            const categoryPrev = document.getElementById('categoryPrev');
            const categoryNext = document.getElementById('categoryNext');
            const categoryTrack = document.getElementById('categoryTrack');

            // Log to check if elements are found
            console.log("Slider elements:", { categoryPrev, categoryNext, categoryTrack });

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
            categoryNext.onclick = function () {
                console.log("Next button clicked");
                const maxPosition = -(sliderItems.length - visibleItems) * itemWidth;
                if (currentPosition > maxPosition) {
                    currentPosition -= itemWidth;
                    updateSliderPosition();
                }
            };

            categoryPrev.onclick = function () {
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
            window.addEventListener('resize', function () {
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


        