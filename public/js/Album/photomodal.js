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
    //$('body').on('click', '#photoInsertModal', function () {
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/profile/getalbum',
            data: {},
            success: function (res) {
                $('#listing').html(res);
            }
        });
   // });
    $('body').on('change', '#imageFriend', function () {
        $('#imageTitleError').hide();
    
    });
    $('body').on('click', '#saveDetails', function () {
        var flag = 0;
        var imageTitle = $('#imageTitle').val();
        var imagePath = $('#aviaryPath').val();
        var editor = CKEDITOR.instances['imagetextDescription'];
        var imageDescription = CKEDITOR.instances['imagetextDescription'].getData();
        var friendsId = [];
        var pageId = $('#currentPageId').val();
        //alert(pageId);
//var users = $('input:text.frndId').serialize();
/*var values = [];
$("input[name='frndId[]']").each(function() {
    values.push($(this).val());
});*/
//var values = $("input[name='frndId[]']").map(function(){return $(this).val();}).get();
        if($('#photoInsertModal').find('input.frndId').length !== 0)
        {
            var values = $("input[name='frndId[]']").map(function(){return $(this).val();}).get();
            for (var i=0;i<(values.length)/2;i++)
            {
                friendsId.push(values[i]);
            }
        }
        else
        {
            friendsId = '';
        }
        //alert(friendsId);
        if (imageTitle == '') {
            flag = 1;
            $('#imageTitle').addClass('error-class');
            $('#imageTitleError').show();
            $('.error-style').css('margin-top','28px');
        } else {
            $('#imageTitleError').hide();
            $('#imageTitle').removeClass('error-class');
           
        }
        if (imageDescription == '') {
            flag = 1;
            $('#cke_textDescription').addClass('error-class');
            $('#imagetextDescriptionError').show();
            $('.error-style').css('margin-top','28px');
        } else {
            $('#imagetextDescriptionError').hide();
            $('#imagetextDescriptionError').removeClass('error-class');
        }
        if (friendsId == '')
        {
            flag = 1; 
            $('#imageFriend').addClass('error-class');
            $('#imageFriendError').show();
        }
        else {
            flag = 0;
            $('#imageFriendError').hide();
            $('#imageFriend').removeClass('error-class');
        }
        if (imageDescription == '' && imageTitle == '') {
            $('.error-style').css('margin-top','-12px');
            flag = 1;    
        }
        if (imageDescription != '' && imageTitle != '') {
            $('.error-style').css('margin-top','46px');
            flag = 1;  
        }
        if (imagePath  == '')
        {
            flag = 1;
            $('#imagePathError').show();
        }
        else
        {
            flag = 0;
        }
        if (flag == 0) {
            $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/image/saveImageDetails',
                data: {
                    imageTitle : imageTitle,
                    imagePath : imagePath,
                    imageDescription : imageDescription,
                    imagefriendsId : friendsId,
                    pageId : pageId
                },
                success: function (res) {
                    alert(res);
                }
        });
        }
    })

    $('#imageArea1').on('change', function () { 
        $('#imagePathError').hide();
        $("#imageuploadform").ajaxSubmit({   //saving the image temporarily so that editing can be done in Aviary
			data: {
				filename: 'file'
	        },
			success: function (result) {
				$('.canvas-placeholder').html('<img id= "profile_pic_thumb" src="'+result+'" style="height:360px;width:100%"/>')
				$("#imagePath").val(result);
				$("#aviaryPath").val(result);
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
                url: base_url_dynamic + '/image/removeimage',
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