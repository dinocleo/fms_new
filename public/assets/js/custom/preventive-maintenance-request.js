$(document).on('click', '#add', function () {
    var selector = $('#addModal');
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('form').trigger("reset");
    $('#preventive').modal('hide');

});


$(document).on('click', '#preventive', function () {
    var selector = $('#PreventiveModal');
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('form').trigger("reset");
    $('#addModal').modal('hide');

});


$(document).on('click', '.edit', function () {
    commonAjax('GET', $('#getInfoRoute').val(), getDataEditRes, getDataEditRes, { 'id': $(this).data('id') });
});

$(document).on('change', '.property_id', function () {
    var thisStateSelector = $(this);
    var getPropertyUnitsRoute = $('#getPropertyUnitsRoute').val();
    commonAjax('GET', getPropertyUnitsRoute, getUnitsRes, getUnitsRes, { 'property_id': $(thisStateSelector).val() });
});


function getDataEditRes(response) {
    var selector = $('#editModal');
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.find('#id').val(response.data.id);
    selector.find('.property_id').val(response.data.property_id);

    var html = '<option value="">--Select Option--</option>';
    Object.entries(response.data.units).forEach((unit) => {
        if (unit[1].id == response.data.unit_id) {
            html += '<option value="' + unit[1].id + '" selected>' + unit[1].unit_name + '</option>';
        } else {
            html += '<option value="' + unit[1].id + '">' + unit[1].unit_name + '</option>';
        }
    });
    selector.find('.unit_id').html(html);
    selector.find('.issue_id').val(response.data.issue_id);
    selector.find('.status').val(response.data.status);
    selector.find('.details').text(response.data.details);
    selector.find('.created_date').val(response.data.created_date);
    selector.modal('show');
}

$(document).on('click', '.view', function () {
    commonAjax('GET', $('#getInfoRoute').val(), getDataRes, getDataRes, { 'id': $(this).data('id') });
});

function getDataRes(response) {
    $('#viewId').val(response.data.id)
    $('.amount').val(response.data.amount)
    $('.status').val(response.data.status)

    if (response.data.file_attach_file) {
        $('.attach').attr('href', response.data.attach);
        $('.attach').text(response.data.file_attach_file.file_name);
    } else {
        $('.attach').attr('href', '');
        $('.attach').text('');
    }
    if (response.data.file_attach_invoice) {
        $('.invoice').attr('href', response.data.invoice);
        $('.invoice').text(response.data.file_attach_invoice.file_name);
    } else {
        $('.invoice').attr('href', '');
        $('.invoice').text('');
    }

    $('.property_name').text(response.data.property_name);
    $('.unit_name').text(response.data.unit_name);
    $('.issue_name').text(response.data.issue_name);
    $('.view_details').text(response.data.details);
    $('.resolved_date').val(response.data.resolved_date);
    $(document).find('#statusSelect').trigger('change');
}


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

function getUnitsRes(response) {
    if (response.data) {
        var unitOptionsHtml = response.data.map(function (opt) {
            return '<option value="' + opt.id + '">' + opt.unit_name + '</option>';
        }).join('');
        var unitsHtml = '<option value="0">--Select Unit--</option>' + unitOptionsHtml
        $('.unit_id').html(unitsHtml);
    } else {
        $('.unit_id').html('<option value="0">--No Unit--</option>');
    }
}


function getSubUnitsRes(response) {

    if (Array.isArray(response.data) && response.data.length > 0) {
        var unitOptionsHtml = response.data.map(function (opt) {
            return '<option value="' + opt.id + '">' + opt.sub_unit_name + '</option>';
        }).join('');
        var unitsHtml = '<option value="0">--Select Sub Unit--</option>' + unitOptionsHtml
        $('.sub_unit_id').html(unitsHtml);
    } else {
        $('.sub_unit_id').html('<option value="0">--No Sub Unit--</option>');
    }
}




// function date_convert(date)
// {
//     const isoDate = date;
// const date = new Date(isoDate);

// const readableTime = date.toLocaleString("en-US", {
//   year: "numeric",
//   month: "long",
//   day: "numeric",
//   hour: "2-digit",
//   minute: "2-digit",
//   second: "2-digit",
//   hour12: true,
//   timeZone: "UTC" // Adjust time zone if needed
// });


// return readableTime

// }
