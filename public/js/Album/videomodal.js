 $(document).ready(function () {
    var baseURL = window.location.origin;

    CKEDITOR.replace('videoDescription', {
        toolbar: [

            {
                name: 'others',
                items: ['-']
            },
            '/',
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },

            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            }


        ]
    });
    CKEDITOR.disableAutoInline = true;

    $("#videoInsert").click(function(){
            $.ajax({
            type: "POST",
            url: baseURL + '/profile/getalbum',
            data: {},
            success: function (res) {
                $('.AID').html(res);
            }
        });

    });

 	$('#file').on('change', function () {
	     $("#videoupload").ajaxSubmit({

                    data: {
                        file: 'file'
                    },
                    success: function (result) {
						var response = JSON.parse(result);
                        if (response.error == 0 || response.error == 1) {
                        	 $(".errormsgvideo").html('<p style="color:red;">Please select video</p>');
                             $(".errormsgvideo").show();return false;
                           
                        } else {
                            $(".errormsgvideo").hide();
                        	$("#videoId").show();
                        	$(".canvas-placeholder").html('<video controls="controls" name="Video Name" id="videoId" src="/video/'+response.filePath+'" style="width:100%;height:100%;"></video>');
                        	$(".uploadedvideo").val(response.filePath);
                          }
                     
                    }
                });
	 });

    $('#publishid').on('click', function () {
          var flag = 0;
            var title = $("#title").val();
            var editor = CKEDITOR.instances['videoDescription'];
            var videoDescription = CKEDITOR.instances['videoDescription'].getData();
            var uploadedvideo = $("#uploadedvideo").val();
            if(title == "" || videoDescription == "" || uploadedvideo ==""){
                $(".errormsg").html('<p style="color:red;">Please fill all details</p>');
                $(".errormsg").show();
                return false;
            } else {
                 $(".errormsg").hide();
            
            $('#videodetailsupload').submit();
      
         }
    });


});