  <!-- JAVASCRIPT -->
  @stack('js')

  <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>
  {{-- <script src="{{ asset('admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins.js') }}"></script> --}}
  <script src="{{ asset('admin/assets/js/app.js') }}" defer></script>

  <script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
  <script src="{{ asset('admin/assets/js/bootstrap-select.min.js') }}"></script>
  <script>
      $(document).ready(function() {
          $('.selectpicker').selectpicker({
              liveSearch: true,
              actionsBox: true,
              size: 5

          });
      });

      $(document).ready(function() {
          $('#tags').tagsinput();
      });
  </script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          new DataTable('#example', {
              ordering: true,
          });
      });
  </script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          const toggleButton = document.getElementById("darkModeToggle");
          const icon = document.getElementById("darkModeIcon");
          const html = document.documentElement;

          // Page reload হলে dark mode check করে সেট করা
          if (localStorage.getItem("darkMode") === "enabled") {
              html.setAttribute("data-bs-theme", "dark");
              document.body.classList.add("dark-mode"); // Dark mode class add
              icon.classList.remove("bx-sun"); //  Remove sun icon
              icon.classList.add("bx-moon"); //  Add moon icon
          }

          // Button click করলে dark mode toggle করা
          toggleButton.addEventListener("click", function() {
              if (document.body.classList.contains("dark-mode")) {
                  document.body.classList.remove("dark-mode"); // Dark mode off
                  html.setAttribute("data-bs-theme", "light");
                  localStorage.removeItem("darkMode");
                  icon.classList.remove("bx-moon"); //  Remove moon icon
                  icon.classList.add("bx-sun"); //  Add sun icon
              } else {
                  document.body.classList.add("dark-mode"); // Dark mode on
                  html.setAttribute("data-bs-theme", "dark");
                  localStorage.setItem("darkMode", "enabled");
                  icon.classList.remove("bx-sun"); // Remove sun icon
                  icon.classList.add("bx-moon"); // Add moon icon
              }
          });
      });
  </script>
