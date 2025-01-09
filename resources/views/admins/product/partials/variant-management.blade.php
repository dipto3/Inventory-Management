<div class="row select-attributes-add">
    <div class="col-lg-6 col-sm-6 col-12">
        <div class="input-blocks add-product">
            <label>Variant Attributes</label>
            <div class="row">
                <div class="col-lg-10 col-sm-10 col-10">
                    <select class="form-control variant-select select-option" id="attributeSelect">
                        <option value="">Choose Attribute</option>
                        @foreach ($variants as $attribute)
                            <option value="{{ $attribute->id }}">{{ ucfirst($attribute->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-sm-2 col-2 ps-0">
                    <div class="add-icon tab">
                        <a class="btn btn-filter" href="javascript:void(0);" id="addAttribute"><i class="feather feather-plus-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="selected-attributes mt-3" id="selected-attributes">
</div>

<div class="modal-body-table variant-table mt-4" id="variant-table-section">
    <div class="table-responsive">
        <table class="table table-bordered" id="variants-table">
            <thead>
                <tr>
                    <th>Variation</th>
                    <th>Variation Values</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th class="no-sort">Image</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){

    // Initialize Select2 on dynamically added select elements
    function initializeSelect2() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select options',
            allowClear: true
        });
    }

    // Handle adding of variant attributes
    $('#addAttribute').on('click', function(){
        let attributeId = $('#attributeSelect').val();
        let attributeName = $('#attributeSelect option:selected').text();

        if(attributeId === ""){
            alert('Please select an attribute.');
            return;
        }

        // Check if attribute is already selected
        if($('#selected-attributes').find(`input[value="${attributeId}"]`).length > 0){
            alert('Attribute already selected.');
            return;
        }

        // Fetch attribute values via AJAX
        $.ajax({
            url: `/attributes/${attributeId}/values`,
            type: 'GET',
            success: function(response){
                if(response.success){
                    let values = response.data;
                    let options = '';
                    values.forEach(function(value){
                        options += `<option value="${value.id}">${value.value}</option>`;
                    });

                    let attributeHtml = `
                        <div class="row align-items-center mb-2" data-attribute-id="${attributeId}">
                            <div class="col-sm-4">
                                <input type="hidden" name="attributes[]" value="${attributeId}">
                                <input type="text" class="form-control" value="${attributeName}" readonly>
                            </div>
                            <div class="col-sm-6">
                                <select name="variant_values[${attributeId}][]" class="form-control select2" multiple>
                                    ${options}
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger remove-attribute">Remove</button>
                            </div>
                        </div>
                    `;

                    $('#selected-attributes').append(attributeHtml);
                    initializeSelect2();
                    generateVariantsTable();
                } else {
                    alert('Failed to fetch attribute values.');
                }
            },
            error: function(){
                alert('Error fetching attribute values.');
            }
        });
    });

    // Handle removal of variant attributes
    $('#selected-attributes').on('click', '.remove-attribute', function(){
        $(this).closest('.row').remove();
        generateVariantsTable();
    });

    // Handle changes in variant values to regenerate the variants table
    $('#selected-attributes').on('change', 'select', function(){
        generateVariantsTable();
    });

    // Function to generate all possible combinations and render the variants table
    function generateVariantsTable(){
        let attributes = [];
        $('#selected-attributes .row').each(function(){
            let attributeId = $(this).data('attribute-id');
            let attributeName = $(this).find('input[type="text"]').val();
            let selectedValues = $(this).find('select').val();
            if(selectedValues && selectedValues.length > 0){
                attributes.push({
                    id: attributeId,
                    name: attributeName,
                    values: selectedValues
                });
            }
        });

        if(attributes.length === 0){
            $('#variants-table tbody').empty();
            return;
        }

        // Prepare data for AJAX
        let data = {
            attributes: attributes
        };

        // Make AJAX request to generate combinations
        $.ajax({
            url: '/products/generate-combinations',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                attributes: attributes
            },
            beforeSend: function(){
                // Optionally, show a loading spinner
            },
            success: function(response){
                if(response.success){
                    renderVariantsTable(response.combinations);
                } else {
                    alert('Failed to generate combinations.');
                }
            },
            error: function(){
                alert('Error generating combinations.');
            },
            complete: function(){
                // Optionally, hide the loading spinner
            }
        });
    }

    // Function to render the variants table based on combinations
    function renderVariantsTable(combinations){
        let tbody = $('#variants-table tbody');
        tbody.empty();

        combinations.forEach(function(combination, index){
            let variation = combination.map(item => item.value).join(' - ');
            let attributeValues = combination.map(item => item.id).join(',');

            let rowHtml = `
                <tr>
                    <td>${variation}</td>
                    <td>
                        ${combination.map(item => item.value).join(', ')}
                        <input type="hidden" name="variants[${index}][attribute_values][]" value="${attributeValues}">
                    </td>
                    <td>
                        <input type="text" name="variants[${index}][sku]" class="form-control" placeholder="SKU">
                    </td>
                    <td>
                        <input type="number" name="variants[${index}][quantity]" class="form-control" min="0" value="0">
                    </td>
                    <td>
                        <input type="number" name="variants[${index}][price]" class="form-control" min="0" step="0.01" value="0.00">
                    </td>
                    <td>
                        <input type="file" name="variants[${index}][image]" class="form-control">
                    </td>
                </tr>
            `;
            tbody.append(rowHtml);
        });
    }

    initializeSelect2();
});
</script>
@endsection
