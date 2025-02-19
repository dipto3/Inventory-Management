  <!-- JAVASCRIPT -->
  @stack('js')

  <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins.js') }}"></script>

  <!-- Vector map-->
  {{-- <script src="{{ asset('admin/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script> --}}

  <!--Swiper slider js-->
  {{-- <script src="{{ asset('admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script> --}}

  <!-- Dashboard init -->
  {{-- <script src="{{ asset('admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script> --}}

  <!-- App js -->
  <script src="{{ asset('admin/assets/js/app.js') }}"></script>
  <!-- prismjs plugin -->
  {{-- <script src="{{ asset('admin/assets/libs/prismjs/prism.js') }}"></script> --}}
  {{-- <script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}

  <!-- listjs init -->
  {{-- <script src="{{ asset('admin/assets/js/pages/listjs.init.js') }}"></script> --}}

  <!-- Sweet Alerts js -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
  {{-- <script>
      // Initialize DataTable
      new DataTable('#example') $.extend($.fn.dataTable.defaults, {

          ordering: true,
          searching: true,
          select: true,
          "order": [
              [0, 'desc'],
              [1, 'desc'],
              [2, 'desc'],
              [3, 'desc']
          ]
      });
  </script> --}}
  <script>
      $(document).ready(function() {
          $('#example').DataTable({
              order: [
                  [0, 'desc']
              ], // Sort by the first column (index 0) in descending order
              ordering: true, // Enable ordering
              searching: true, // Enable searching
              select: true // Enable row selection
          });
      });
  </script>





  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
