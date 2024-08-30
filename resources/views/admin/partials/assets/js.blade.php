<script src="{{ asset('admin/assets/js/jquery-3.7.1.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>

<script src="{{ asset('admin/assets/js/feather.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>

<script src="{{ asset('admin/assets/js/jquery.slimscroll.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>

<script src="{{ asset('admin/assets/js/dataTables.bootstrap5.min.js') }}"
        type="2bbd58bb513c72193d549e5f-text/javascript"></script>
<script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}"
        type="2bbd58bb513c72193d549e5f-text/javascript"></script>

<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>
<script src="{{ asset('admin/assets/js/moment.min.js') }}"
        type="2bbd58bb513c72193d549e5f-text/javascript"></script>

<script src="{{ asset('admin/assets/js/bootstrap-datetimepicker.min.js') }}"
        type="2bbd58bb513c72193d549e5f-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/apexchart/apexcharts.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/apexchart/chart-data.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>
{{-- 
<script
        src="{{ asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>
<script src="{{ asset('admin/assets/plugins/sweetalert/sweetalerts.min.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script> --}}

<script src="{{ asset('admin/assets/js/theme-script.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>
<script src="{{ ('admin/assets/js/script.js') }}"
        type="2c8d1b9e5f6705bf4267f265-text/javascript"></script>

<script src="{{ asset('admin/assets/plugins/select2/js/select2.min.js') }}"
        type="2bbd58bb513c72193d549e5f-text/javascript"></script>
<!-- <script src="https://dreamspos.dreamstechnologies.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
    data-cf-settings="2c8d1b9e5f6705bf4267f265-|49" defer></script> -->
<script src="{{ asset('admin/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
    data-cf-settings="2c8d1b9e5f6705bf4267f265-|49" defer></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
                $(document).on('click', '.editbtn', function(){
                        var category_id = $(this).val();
                        // alert(category_id);
                        $('#editCategory').modal('show');
                        $.ajax({
                                type:"GET",
                                url: "category/" + category_id + "/edit",
                                success: function(response) {
                                    console.log(response);
                                    $('#name').val(response.category.name);
                                    $('#description').val(response.category.description);
                                    $('#category_id').val(response.category.id);
                                //     $('#status').val(response.category.status);
                                  // Set the selected option for status
                    $('#status option[value="' + response.category.status + '"]').prop('selected', true);
                                 // Set the status dropdown value
                //     $('#editCategory').find('#status').val(response.category.status);
                
                                        
                                }
                        })
    
                });
        });
    </script>
    <script>
        $(document).ready(function () {
                $(document).on('click', '.editsubcatbtn', function(){
                        var subcategory_id = $(this).val();
                        // alert(subcategory_id);
                        $('#editSubcategory').modal('show');
                        $.ajax({
                                type:"GET",
                                url: "subcategory/" + subcategory_id + "/edit",
                                success: function(response) {
                                    console.log(response);
                                    $('#name').val(response.subcategory.name);
                                    $('#description').val(response.subcategory.description);
                                    $('#subcategory_id').val(response.subcategory.id);
                                    $('#status').val(response.subcategory.status);
                                    $('#category_id').val(response.subcategory.category_id);
                                  // Set the selected option for status
                //     $('#status option[value="' + response.category.status + '"]').prop('selected', true);
                                 // Set the status dropdown value
                //     $('#editCategory').find('#status').val(response.category.status);
                
                                        
                                }
                        })
    
                });
        });
    </script>

<script>
        $(document).ready(function () {
                $(document).on('click', '.editbrandbtn', function(){
                        var brand_id = $(this).val();
                        // alert(category_id);
                        $('#editBrand').modal('show');
                        $.ajax({
                                type:"GET",
                                url: "brand/" + brand_id + "/edit",
                                success: function(response) {
                                    console.log(response);
                                    $('#name').val(response.brand.name);
                                    $('#description').val(response.brand.description);
                                    $('#brand_id').val(response.brand.id);
                                    $('#status').val(response.brand.status);
                                  // Set the selected option for status
                //     $('#status option[value="' + response.category.status + '"]').prop('selected', true);
                                 // Set the status dropdown value
                //     $('#editCategory').find('#status').val(response.category.status);
                
                                        
                                }
                        })
    
                });
        });
    </script>

    

</script>
@yield('scripts')