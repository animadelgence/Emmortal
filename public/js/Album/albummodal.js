/*
 * @Author: Maitrayee
 * @Date:   2017-06-30 17:46:35
 * @Last Modified by:   Maitrayee
 * @Last Modified time: 2017-06-30 16:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
var base_url_dynamic = window.location.origin;
$(document).ready(function () {
    if($('#albumtextDescription').length) {
    CKEDITOR.replace('albumtextDescription', {
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
    }
    $('body').on('click','#colordropdown',function(){
        //$(this).toggle(function(){
            if($(this).hasClass('open'))
            {
                $(this).removeClass('open');
            }
            else{
               $(this).addClass('open'); 
            }
    });
    $('body').on('change', '#albumArea1', function () {
    //$('#imageArea1').on('change', function () {
        $('#imagePathError').hide();
        $("#albumuploadform").ajaxSubmit({   //saving the image temporarily so that editing can be done in Aviary
            data: {
                filename: 'albumImagefile'
            },
            success: function (result) {
                //alert(result);return false;
                var jsObject = JSON.parse(result);
                $('#canvasPlaceholdeIdalbum').html('<img id= "album_pic_thumb" src="'+jsObject.imgFullName+'" style="height:360px;width:100%"/>')
                $("#albumPath").val(base_url_dynamic + jsObject.imgFullName);
                $("#aviaryPathalbum").val(base_url_dynamic + jsObject.imgFullName);
                $("#albumName").val(jsObject.imgFilename);
                $("#albumFolder").val(base_url_dynamic + jsObject.imgFolder);
                $('#div-editalbumphoto').show();
            }
        });
    });
    $('body').on('click', '#frndlist-click-album', function () {
        var id = $(this).data("id");
        frndDetails.push(id);
        var name = $(this).text();
        $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel-album frnd-cross-class" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div-image input[type="text"]');
        $('#frndlistAlbum').hide();
        $('#frndlistAlbum').val('');
    });
    $('body').on('click', '.frnd-cancel-album', function () {
        var removeItem = $(this).next().val();
        frndDetails = jQuery.grep(frndDetails, function (value) {
            return value != removeItem;
        });
        $(this).parent().remove();
    });
     $('body').on('keyup', '#frndlistAlbum', function () {
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
                                html += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-album" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    $('#frndlistAlbum').html(html);
                    $('#frndlistAlbum').show();
                }
            });
        } else {
            $('#frndlistAlbum').hide();
        }
    });
    $('body').on('click', '#savealbumDetails', function () {
        var flag = 0;
        var imageTitle = $('#albumTitle').val();
        var imagePath = $('#aviaryPathalbum').val();
        var imageName = $('#albumName').val();
        var imageFolder = $('#albumFolder').val();
        var editor = CKEDITOR.instances['albumtextDescription'];
        var imageDescription = CKEDITOR.instances['albumtextDescription'].getData();
        var friendsId = [];
        //var pageId = $('#currentPageId').val();
       // var pageURL = window.location.origin;
        if (base_url_dynamic.indexOf('profile/showprofile') > -1) {
          var currentPageId = $("#currentPageId").val();
        } else {
            var currentPageId = '';
        }
        if($('#albumInsertModal').find('input.frndId').length !== 0)
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
            //$('#imageTitle').addClass('error-class');
            $('#imageTitleError').css('display','block');
            $('.error-style').css('margin-top','28px');
            /*$("#uploadModal").hide();
            $("#photoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please fill title field</span>");*/
        } else {
            $('#imageTitleError').css('display','none');
            //$('#imageTitle').removeClass('error-class');
            flag= 0;
        }
        if (imageDescription == '') {
            flag = 1;
            //$('#cke_textDescription').addClass('error-class');
            $('#imagetextDescriptionError').css('display','block');
            $('.error-style').css('margin-top','28px');
            /*$("#uploadModal").hide();
            $("#photoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please fill description field</span>");*/
        } else {
            $('#imagetextDescriptionError').css('display','none');
            //$('#imagetextDescriptionError').removeClass('error-class');
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
            /*$("#uploadModal").hide();
            $("#photoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please select one image</span>");*/
        }
        if (flag == 0) {
            $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/image/saveImageDetails',
                data: {
                    imageTitle : imageTitle,
                    imagePath : imagePath,
                    /*imageName : imageName,
                    imageFolder : imageFolder,*/
                    imageDescription : imageDescription,
                    imagefriendsId : friendsId,
                    pageId : currentPageId
                },
                success: function (res) {
                    //alert(res);
                    if(res == 1){


                         if (base_url_dynamic.indexOf('profile/showprofile') > -1) {
                                $('.modal').modal('hide');
                                $(".profile-paginator__click").trigger("click");
                            } else{
                                window.location.href = base_url_dynamic + "/profile/showprofile";
                            }

                    }
                }
        });
        }
    })

});
var featheralbumEditor = new Aviary.Feather({
    apiKey: 'yourkey',
    apiVersion: 2,
    openType: 'lightbox',
    tools: 'all',
    onSave: function (imageID, newURL) {
        alert(newURL);
        $("#aviaryPathalbum").val(newURL);
        $("#album_pic_thumb").attr('src', newURL);
        var originalFile = $('#albumPath').val();
        $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/createalbum/removealbum',
                data: {
                    removeimage : originalFile
                },
                success: function (res) {
                    console.log('removed image');
                }
        });
    }
});
function launchalbumaviaryEditor(id, src){
    alert(53678);
    featheralbumEditor.launch({
        image: id,
        url: src
    });
    return false;
}
function albumClick()
{
    $('#uploadModal').modal('show');
    $('#albumInsertModal').modal('hide');
}
