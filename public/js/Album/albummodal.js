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
    $('body').on('change', '#imageArea1', function () {
    //$('#imageArea1').on('change', function () {
        //$('#imagePathError').hide();
        $("#albumuploadform").ajaxSubmit({   //saving the image temporarily so that editing can be done in Aviary
            data: {
                filename: 'albumImagefile'
            },
            success: function (result) {
                //alert(result);//return false;
                var jsObject = JSON.parse(result);
                $('#canvasPlaceholdeId').html('<img id= "profile_pic_thumb" src="'+jsObject.imgFullName+'" style="height:360px;width:100%"/>')
                $("#albumPath").val(base_url_dynamic + jsObject.imgFullName);
                $("#aviaryPath").val(base_url_dynamic + jsObject.imgFullName);
                $("#albumName").val(jsObject.imgFilename);
                $("#albumFolder").val(base_url_dynamic + jsObject.imgFolder);
                $('#div-editphoto').show();
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
     $('body').on('keyup', '#albumFriend', function () {
        var friendsid = $(this).val().trim();
        //alert(friendsid);return false;
        if (friendsid != '') {
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/profile/getfriends',
                data: {},
                success: function (res) {
                    
                    jsObject = JSON.parse(res);
                    var htmlcreate = "",
                        profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (i = 0; i < jsObject.friendDetails.length; i++) {
                        var id = jsObject.friendDetails[i].friendsid;
                        var friendsname = jsObject.friendDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id), frndDetails) == '-1') {
                                if (jsObject.friendDetails[i].profileimage != null) {
                                    profileimage = jsObject.friendDetails[i].profileimage;
                                }
                                htmlcreate += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-album" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    
                    $('#frndlistAlbum').html(htmlcreate);
                    $('#frndlistAlbum').show();
                }
            });
        } else {
            $('#frndlistAlbum').hide();
        }
    });
    $('body').on('click', '#savealbumDetails', function () {
        var flag = 0;
        var albumTitle = $('#albumTitle').val();
        var albumPath = $('#aviaryPath').val();
        var albumName = $('#albumName').val();
        var albumFolder = $('#albumFolder').val();
        var editor = CKEDITOR.instances['albumtextDescription'];
        var albumDescription = CKEDITOR.instances['albumtextDescription'].getData();
        var friendsId = [];
        var colorselected = $("#colordropdown").children('.select').find('.color-preview').css("background-color");
        var show = "all";
        if($(".listshowclass").hasClass('addnew')){
            show = $(".addnew").val();
        }
         
        if (base_url_dynamic.indexOf('profile/showprofile') > -1) {
          var currentPageId = $("#currentPageId").val();
        } else {
            var currentPageId = '';
        }
        if($('#albumInsertModal').find('input.frndId').length !== 0)
        {
            var values = $("input[name='frndId[]']").map(function(){return $(this).val();}).get();
          
            for (var i=0;i<(values.length);i++)
            {
                friendsId.push(values[i]);
            }
        }
        else
        {
            friendsId = '';
        }
        
        if (albumTitle == '') {
            flag = 1;
            
            $('#imageTitleError').css('display','block');
            $('.error-style').css('margin-top','28px');
            
        } else {
            $('#imageTitleError').css('display','none');
            flag= 0;
        }
        if (albumDescription == '') {
            flag = 1;
            $('#imagetextDescriptionError').css('display','block');
            $('.error-style').css('margin-top','28px');
          
        } else {
            $('#albumtextDescriptionError').css('display','none');
            flag = 0;
        }
       
        if (albumDescription == '' && albumTitle == '') {
            $('.error-style').css('margin-top','-12px');
            flag = 1;    
        }
        if (albumDescription != '' && albumTitle != '') {
            $('.error-style').css('margin-top','46px');
            flag = 0;
        }
        if (albumPath  == '')
        {
            flag = 1;
            $('#imagePathError').css('display','block');
        }
        if (flag == 0) {
            $.ajax({                        // for unlinking the file from the temporary folder
                type: "POST",
                url: base_url_dynamic + '/createalbum/saveAlbumDetails',
                data: {
                    albumTitle : albumTitle,
                    albumPath : albumPath,
                    colorselected : colorselected,
                    show : show,
                    albumDescription : albumDescription,
                    albumfriendsId : friendsId,
                    pageId : currentPageId
                },
                success: function (res) {
                    //alert(res);
                    if(res == 1){

                                window.location.href = base_url_dynamic + "/createalbum/showafterpublish";
                            }

                    }
                
        });
        }
    });
    $('body').on('click', '.color', function () {
        $('.color').removeClass('active');
        $(this).addClass('active');
      //  alert($(this).html());
        $('#selectedvaluecolor').html($(this).html());

    });
    $('body').on('click', '.listshowclass', function () {
        $('.listshowclass').removeClass('addnew');
        $(this).addClass('addnew');
        var getselectedValue = $(this).val();
        //alert(getselectedValue);
        //$("#colordropdown").children('.select').html($(".active").html());

    });
    

});

function albumClick()
{
    $('#uploadModal').modal('show');
    $('#albumInsertModal').modal('hide');
}
