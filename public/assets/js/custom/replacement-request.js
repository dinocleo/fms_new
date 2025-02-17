

$(document).on("click", ".fetch_location", function () {
 
    var tag = $('#tag').val();
    if(tag){
        // console.log("Suceeess:");

        var formData = new FormData($('#fetchLocationFormID'));
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
                console.log("asdsad");
              $('#submit_button_id').hide();
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

                // handle the success response
                if (data.response == true) {
                  // $('#submit_button_id').show();
                  toastr.success('Uploading was done successful');
                  window.location.href = "{{ url('panel_manifest') }}";

                    // alert('Uploading was successful');
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