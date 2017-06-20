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
    /*$('body').on('change', '#imageFriend', function () {
        alert();
        $('#imageFriendError').css('display','none');
   
    });*/
    $('body').on('click', '#frndlist-click-image', function () {
        var id = $(this).data("id");
        frndDetails.push(id);
        var name = $(this).text();
        $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div-image input[type="text"]');
        $('#frndlistImage').hide();
        $('#frndlistImage').val('');
    });
    $('body').on('click', '.frnd-cancel', function () {
        var removeItem = $(this).next().val();
        frndDetails = jQuery.grep(frndDetails, function (value) {
            return value != removeItem;
        });
        $(this).parent().remove();
    });
    $('body').on('keyup', '#imageFriend', function () {
        var friendsid = $(this).val().trim();
        if (friendsid != '') {
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/profile/getfriends',
                data: {},
                success: function (res) {
                    jsObject = JSON.parse(res);
                    var html = "",
                        profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (i = 0; i < jsObject.friendDetails.length; i++) {
                        var id = jsObject.friendDetails[i].friendsid;
                        var friendsname = jsObject.friendDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id), frndDetails) == '-1') {
                                if (jsObject.friendDetails[i].profileimage != null) {
                                    profileimage = jsObject.friendDetails[i].profileimage;
                                }
                                html += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-image" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    $('#frndlistImage').html(html);
                    $('#frndlistImage').show();
                }
            });
        } else {
            $('#frndlistImage').hide();
        }
    });
    $('body').on('click', '#saveDetails', function () {
        var flag = 0;
        var imageTitle = $('#imageTitle').val();
        var imagePath = $('#aviaryPath').val();
        var editor = CKEDITOR.instances['imagetextDescription'];
        var imageDescription = CKEDITOR.instances['imagetextDescription'].getData();
        var friendsId = [];
        //var pageId = $('#currentPageId').val();
        var pageURL = $(location).attr("href");
        if (pageURL.indexOf('profile/showprofile') > -1) {
          var currentPageId = $("#currentPageId").val();
        } else {
          //return false;
            var currentPageId = '';
        }
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
            $('#imageTitleError').css('display','block');
            $('.error-style').css('margin-top','28px');
        } else {
            $('#imageTitleError').css('display','none');
            $('#imageTitle').removeClass('error-class');
            flag= 0;
        }
        if (imageDescription == '') {
            flag = 1;
            $('#cke_textDescription').addClass('error-class');
            $('#imagetextDescriptionError').css('display','block');
            $('.error-style').css('margin-top','28px');
        } else {
            $('#imagetextDescriptionError').css('display','none');
            $('#imagetextDescriptionError').removeClass('error-class');
            flag = 0;
        }
        /*if (friendsId == '')
        {
            flag = 1; 
            $('#imageFriend').addClass('error-class');
            $('#imageFriendError').css('display','block');
        }
        else {
            flag = 0;
            $('#imageFriendError').css('display','none');
            $('#imageFriend').removeClass('error-class');
        }*/
        if (imageDescription == '' && imageTitle == '') {
            $('.error-style').css('margin-top','-12px');
            flag = 1;    
        }
        if (imageDescription != '' && imageTitle != '') {
            $('.error-style').css('margin-top','46px');
            flag = 0;  
        }
        if (imagePath  == '')
        {
            flag = 1;
            $('#imagePathError').css('display','block');
        }
        if (flag == 0) {
            //alert('ready for saving the details');
            //alert(imageDescription);
            $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/image/saveImageDetails',
                data: {
                    imageTitle : imageTitle,
                    imagePath : imagePath,
                    imageDescription : imageDescription,
                    imagefriendsId : friendsId,
                    pageId : currentPageId
                },
                success: function (res) {
                    alert(res);
                }
        });
        }
        else{
            alert("no data");
        }
    })

    $('#imageArea1').on('change', function () { 
        $('#imagePathError').hide();
        $("#imageuploadform").ajaxSubmit({   //saving the image temporarily so that editing can be done in Aviary
			data: {
				filename: 'file'
	        },
			success: function (result) {
                //alert(result);return false;
				$('#canvasPlaceholdeId').html('<img id= "profile_pic_thumb" src="'+result+'" style="height:360px;width:100%"/>')
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