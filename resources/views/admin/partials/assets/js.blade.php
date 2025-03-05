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
