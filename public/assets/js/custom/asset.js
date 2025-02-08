
$(document).on('change', '.property_id', function () {
    var thisStateSelector = $(this);
    var getPropertyUnitsRoute = $('#getPropertyUnitsRoute').val();
    commonAjax('GET', getPropertyUnitsRoute, getUnitsRes, getUnitsRes, { 'property_id': $(thisStateSelector).val() });
});


function getUnitsRes(response) {
    if (response.data) {
        var unitOptionsHtml = response.data.map(function (opt) {
            return '<option value="' + opt.id + '">' + opt.unit_name + '</option>';
        }).join('');
        var unitsHtml = '<option value="0">--Select Unit--</option>' + unitOptionsHtml
        $('.unit_id').html(unitsHtml);
    } else {
        $('.unit_id').html('<option value="0">--Select Unit--</option>');
    }
}

function getUnitsRes(response) {
    if (response.data) {
        var unitOptionsHtml = response.data.map(function (opt) {
            return '<option value="' + opt.id + '">' + opt.unit_name + '</option>';
        }).join('');
        var unitsHtml = '<option value="0">--Select Unit--</option>' + unitOptionsHtml
        $('.unit_id').html(unitsHtml);
    } else {
        $('.unit_id').html('<option value="0">--Select Unit--</option>');
    }
}
