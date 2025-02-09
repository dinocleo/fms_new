$(document).on('click', '#add', function () {
    var selector = $('#addModal');
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('form').trigger("reset");
});

// handle property
$(document).on('change', '.property_id', function () {
    var thisStateSelector = $(this);
    var getPropertyUnitsRoute = $('#getPropertyUnitsRoute').val();
    commonAjax('GET', getPropertyUnitsRoute, getUnitsRes, getUnitsRes, { 'property_id': $(thisStateSelector).val() });
});


$(document).on('change', '.unit_id', function () {
    var thisStateSelector = $(this);
    var getUnitsRoute = $('#getUnitsRoute').val();
    commonAjax('GET', getUnitsRoute, getSubUnitsRes, getSubUnitsRes, { 'unit_id': $(thisStateSelector).val() });
});


function getSubUnitsRes(response) {
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

// handle propoerty end here


// handle property
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
// handle propoerty end here