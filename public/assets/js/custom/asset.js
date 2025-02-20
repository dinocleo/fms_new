
(function ($) {
    "use strict";
    var oTable;
    $('#search_property').on('change', function () {
        oTable.search($(this).val()).draw();
    })

    oTable = $('#allMaintainerDataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        responsive: true,
        ajax: $('#route').val(),
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
            { "data":"image", "image": 'DT_RowIndex' },
            // { "data": "name" },
            // { "data": "name", "name": "users.first_name" },
            // { "data": "name", "visible": false, "name": "users.last_name" },
            // { "data": "email", "name": "users.email" },
            { "data": "tag", "tag": "users.tag" },
            { "data": "name"  },
            // { "data": "property", "property": "users.contact_number" },
            // { "data": "property", "property": "users.contact_number" },
            // { "data": "category", },
            // { "data": "manufacturer",  },
            // { "data": "property", "property": "users.contact_number" },
            { "data": "property",   },
            { "data": "unit",  },
            // { "data": "property", "name": "properties.name" },
            { "data": "sub_unit" },
            { "data": "action", "class": "text-end" },
        ]
    });
})(jQuery)


$(document).on("click", ".save_bulk", function () {
    //  alert("amhere")
        var asset_file = $('#asset_file').val();
        if(asset_file){
            // console.log("Suceeess:");
    
            var formElement = document.getElementById('fetchLocationFormID'); // Get form element
            var formData = new FormData(formElement);
                    var getReplacementRoute = $('#getReplacementRoute').val();
    
            // Start NProgress before making the AJAX request
            NProgress.start();
    
            $.ajax({
                type: 'POST',
                url: getReplacementRoute,
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                     var xhr = new window.XMLHttpRequest();
    
                    // Variables to track the previous progress and the current progress
                    var prevProgress = 0;
                    var currentProgress = 0;
    
                    // Listen to the upload progress
                    xhr.upload.addEventListener('progress', function (e) {
                      // return e;
                    setTimeout(function () {
    
                        if (e.lengthComputable) {
                            currentProgress = (e.loaded / e.total) * 100;
    
                            // Only update NProgress if there is significant progress
                            if (currentProgress - prevProgress >= 5) {
                                NProgress.set(currentProgress / 100);
                                prevProgress = currentProgress;
                            }
                        }
                      }, 9000000); // Add a delay (in milliseconds) before finishing NProgress
    
                    }, false);
    
                    return xhr;
                },
                success: function (data) {
                    // Finish NProgress on success
                    setTimeout(function () {
                        NProgress.done();
                    }, 1000); // Add a delay (in milliseconds) before finishing NProgress
                    // console.log(data);
                    // handle the success response
                    if (data) {
                        let property_name;
                        let unit_name;
                        let sub_unit_name;
                        if(data.property){
                            property_name = data.property.name;
                            $('#current_property').val(property_name);
    
                        }
                      
                        if(data.property_unit){
                            unit_name = data.property_unit.unit_name;
                      $('#current_unit').val(unit_name);
                    }
                        if(data.sub_unit){
                            sub_unit_name = data.sub_unit.sub_unit_name;
                             $('#current_sub_unit').val(sub_unit_name);
                    }
    
    
                    // alert(data.id)
                    $('#asset_id').val(data.id);
    
                        // console.log(data.property.name)
                      //   toastr.success('Uploading was done successful');
                         //   window.location.href = "{{ url('panel_manifest') }}";
                    } else {
                        alert('Uploading went wrong');
                    }
                },
                error: function (error) {
                    // Finish NProgress on error
                    setTimeout(function () {
                        NProgress.done();
                    }, 500); // Add a delay (in milliseconds) before finishing NProgress
    
                    // handle the error response
                    console.log(error);
                    alert("An error occurred while uploading");
                }
            });
          
        
        }else{
            Swal.fire({
                title: 'Select file first!',
                // text: tag,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                // confirmButtonText: 'No tag specified!'
            }).then((result) => {
                // if (result.value) {
                //     $("#" + form_id).submit();
                // }
            })
        }
    
     
    });




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