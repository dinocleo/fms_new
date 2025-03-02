

$(document).on("click", ".fetch_location", function () {
//  alert("amhere")
    var tag = $('#tag').val();
    if(tag){
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
            title: 'No tag specified!',
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





$(document).on("click", ".submit_button_id", function () {
 

    var tag = $('#tag').val();
    if(tag){

    let property_name;
    let unit_name;
    let sub_unit_name;
 
    property_name =  $('#current_property').val();
    unit_name = $('#current_unit').val();
    sub_unit_name = $('#current_sub_unit').val();

 

        var formElement = document.getElementById('updateLocationForm'); // Get form element
        var formData = new FormData(formElement);
        var getReplacementRoute = $('#newLocationInfo').val();

        // Start NProgress before making the AJAX request
        NProgress.start();

        $.ajax({
            type: 'POST',
            url: getReplacementRoute,
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
            //    $('#submit_button_id').hide();
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
                if (data.message="success") {
                                        toastr.success('Location information updated');

                    // $('#submit_button_id').show();
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
            title: 'Fetch Current Location First!',
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
