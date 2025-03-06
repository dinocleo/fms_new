 

(function ($) {
    "use strict";
    var oTable;
    
    oTable = $('#allAssetsDataTable1').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        responsive: true,
        ajax: $('#Assetroute').val(),
        order: [1, 'desc'],
        ordering: false,
        autoWidth: false,
        drawCallback: function () {
            $(".dataTables_length select").addClass("form-select form-select-sm");
        },
        language: {
            'paginate': {
                'previous': '<span class="iconify" data-icon="icons8:angle-left"></span>',
                'next': '<span class="iconify" data-icon="icons8:angle-right"></span>'
            }
        },
        columns: [
            // { "data": "image", "image": 'DT_RowIndex' },
            { "data": "tag", "tag": "users.tag" },
            { "data": "name" },
            { "data": "property" },
            { "data": "unit" },
            { "data": "sub_unit" },
            { "data": "action", "class": "text-end" },
        ]
    });
})(jQuery);


    $(document).on('click', '#add2', function () {
        var selector = $('#addModal2');
        selector.find('.is-invalid').removeClass('is-invalid');
        selector.find('.error-message').remove();
        selector.modal('show');
        selector.find('form').trigger("reset");
    });
 

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

    if (Array.isArray(response.data) && response.data.length > 0) {
        var unitOptionsHtml = response.data.map(function (opt) {
            return '<option value="' + opt.id + '">' + opt.sub_unit_name + '</option>';
        }).join('');
        var unitsHtml = '<option value="0">--Select Sub Unit--</option>' + unitOptionsHtml
        $('.sub_unit_id').html(unitsHtml);
    } else {
        $('.sub_unit_id').html('<option value="0">--Select Sub Unit--</option>');
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