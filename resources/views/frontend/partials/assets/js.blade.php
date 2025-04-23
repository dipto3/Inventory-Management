<script src="{{ asset('frontend/js/countdown.js') }}"></script>
<script> 
        
    function startCountdown() {
        // Set the countdown date (24 hours from now)
        const countdownDate = new Date();
        countdownDate.setHours(countdownDate.getHours() + 24);
    
        // Update the countdown every second
        const countdownTimer = setInterval(function() {
            const now = new Date().getTime();
            const distance = countdownDate - now;
    
            // Calculate hours, minutes and seconds
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
            // Update the countdown display
            document.querySelectorAll('.countdown-item .hours').forEach(el => {
                el.textContent = hours.toString().padStart(2, '0');
            });
            document.querySelectorAll('.countdown-item .minutes').forEach(el => {
                el.textContent = minutes.toString().padStart(2, '0');
            });
            document.querySelectorAll('.countdown-item .seconds').forEach(el => {
                el.textContent = seconds.toString().padStart(2, '0');
            });
    
            // If the countdown is finished, clear the interval
            if (distance < 0) {
                clearInterval(countdownTimer);
                document.querySelectorAll('.countdown-timer').forEach(timer => {
                    timer.innerHTML = '<p class="text-danger fw-bold">This offer has expired!</p>';
                });
            }
        }, 1000);
    }
        </script>
<script src="{{ asset('frontend/js/category-slider.js') }}"></script>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->

<script src="{{ asset('frontend/js/mobile-navigation.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
