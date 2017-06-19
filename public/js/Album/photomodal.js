var base_url_dynamic = window.location.origin;
$(document).ready(function () {
    //alert();
    $('#div-editphoto').hide();
    CKEDITOR.replace('imagetextDescription', {
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
    $('body').on('click', '#photoInsert', function () {
        $('.close').trigger('click');
        $('#imagetextTitleError').hide();
        $('#imagetextTitle').removeClass('error-class');
        $('#imagetextDescriptionError').hide();
        $('#imagetextDescription').removeClass('error-class');
        $.ajax({
            type: "POST",
            
            data: {},
            success: function (res) {
                //$('#AID').html(res);
            }
        });
    });
    
    

    $('#imageArea1').on('change', function () { 
        $("#imageuploadform").ajaxSubmit({   //saving the image temporarily so that editing can be done in Aviary
			data: {
				filename: 'file'
	        },
			success: function (result) {
				$('.canvas-placeholder').html('<img id= "profile_pic_thumb" src="'+result+'" style="height:360px;width:100%"/>')
				$("#imagePath").val(result);
                $('#div-editphoto').show();
			}
		});
	});
});
var featherEditor = new Aviary.Feather({
    apiKey: 'yourkey',
    apiVersion: 2,
    openType: 'lightbox',
    tools: 'all',
    onSave: function (imageID, newURL) {
        $("#aviaryPath").val(newURL);
        $("#profile_pic_thumb").attr('src', newURL);
        var originalFile = $('#imagePath').val();
        $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/payment/removeimage',
                data: {
                    removeimage : originalFile
                },
                success: function (res) {
                    alert('removed image');
                }
        });
    }
});

function launchEditor(id, src) {
    featherEditor.launch({
        image: id,
        url: src
    });
    return false;
}