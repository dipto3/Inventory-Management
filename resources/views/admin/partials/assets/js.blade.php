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
  <script>
      // Initialize DataTable
      new DataTable('#example');
  </script>


<<<<<<< HEAD
  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
=======
                }
            })

        });
    });
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '.editpaymenttypebtn', function() {
        var payment_type_id = $(this).val(); 
        $('#editPaymentType').modal('show');

        $.ajax({
            type: "GET",
            url: "payment_type/" + payment_type_id + "/edit",
            success: function(response) {
                console.log(response); 

                $('#edit-paymenttype-type').val(response.paymentType.type);
                $('#edit-paymenttype-status').val(response.paymentType.status);
                console.log(response.paymentType.has_transaction);
                if(response.paymentType.has_transaction == 1) {
                    $('#edit-paymenttype-has_transaction').prop('checked', true); 
                } else {
                    $('#edit-paymenttype-has_transaction').prop('checked', false);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", error);
            }
        });
    });
});


</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.editbrandbtn', function() {
            var brand_id = $(this).val();
            $('#editBrand').modal('show');
            $.ajax({
                type: "GET",
                url: "brand/" + brand_id + "/edit",
                success: function(response) {
                    console.log(response);
                    $('#name').val(response.brand.name);
                    $('#description').val(response.brand.description);
                    $('#brand_id').val(response.brand.id);
                    $('#status').val(response.brand.status);
                }
            })

        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.editunitbtn', function() {
            var unit_id = $(this).val();
            $('#editUnit').modal('show');
            $.ajax({
                type: "GET",
                url: "unit/" + unit_id + "/edit",
                success: function(response) {
                    console.log(response);
                    $('#name').val(response.unit.name);
                    $('#short_name').val(response.unit.short_name);
                    $('#unit_id').val(response.unit.id);
                    $('#status').val(response.unit.status);
                }
            })

        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.editvariantbtn', function() {
            var variant_id = $(this).val();
            $('#editVariant').modal('show');
            $.ajax({
                type: "GET",
                url: "variant/" + variant_id + "/edit",
                success: function(response) {
                    // console.log(response);
                    $('#variant_id').val(response.variant.id); 
                $('#name').val(response.variant.name);
                    $('#status').val(response.variant.status);
                    var values = response.variant.variant_values.map(function(value) {
                    return value.value;
                }).join(', ');
                // console.log(values);
                // $('#variant_values').val(values); 
                var $variantValues = $('#variant_values');
                $variantValues.tagsinput('removeAll'); // Clear current values if any
                $variantValues.tagsinput('add', values); 
                }
            })

        });
    });
</script>



</script>
@yield('scripts')
>>>>>>> c9969c0ab27468f4d98085fed9387604c2dfcd81
