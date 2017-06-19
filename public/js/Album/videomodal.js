 $(document).ready(function () {

 	$('#file').on('change', function () {
	     $("#videoupload").ajaxSubmit({

                    data: {
                        file: 'file'
                    },
                    success: function (result) {
						var response = JSON.parse(result);
                        if (response.error == 0 || response.error == 1) {
                        	alert("wrong");return false;
                           
                        } else {
                        	$("#videoId").show();
                        	$(".canvas-placeholder").html('<video controls="controls" name="Video Name" id="videoId" src="/video/'+response.filePath+'" style="width:100%;height:100%;"></video>');
                        	$(".uploadedvideo").val(response.filePath);
                          }
                     
                    }
                });
	 });
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
});