/*
 * @Author: Shubhadip
 * @Date:   2017-06-14 17:46:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-19 10:52:26
 */
/*jslint browser: true */
/*global $, jQuery, alert,CKEDITOR */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global radix:true */
var base_url_dynamic = window.location.origin,
    frndDetails = [],
    jsObject = "",
    i = "0";
$(document).ready(function () {
    "use strict";
    CKEDITOR.replace('textDescription', {
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
    $( ".resizable" ).resizable({

      maxHeight: 364,
      maxWidth: 364,
      minHeight: 172,
      minWidth: 172,

       stop : function(event,ui) {
       var height = $(this).height();
        var width = $(this).width();
        var sizeX = "";
        var sizeY = "";
        if(height > 257){
            height = 364;
            sizeX = "W";
        } else {
             height = 172;
             sizeX = "H";
        }
        if(width > 257){
            width = 364;
            sizeY = "W";
        } else {
             width = 172;
             sizeY = "H";
        }
       $(this).css('height',height);
       $(this).css('width',width);
       var uploadId = $(this).find(".uploadId").val();
           $.ajax({
                type: "POST",
                //async:false,
                url: base_url_dynamic + '/profile/savefilestatus',
                data: {sizeX:sizeX,sizeY:sizeY,uploadId:uploadId},
                success: function (res) {

                }
            });

    }

    });
    // $('.resizable').on('mouseup' , function(){
    //    // alert(1)
    //     var height = $(this).height();
    //     var width = $(this).width();
    //     var H = "";
    //     var W = "";
    //     if(height > 257){
    //         height = 364;
    //         H = "H1";
    //     } else {
    //          height = 172;
    //          H = "H0";
    //     }
    //     if(width > 257){
    //         width = 364;
    //         W = "W1";
    //     } else {
    //          width = 172;
    //          W = "W0";
    //     }
    //    $(this).css('height',height);
    //    $(this).css('width',width);
    //     var uploadId = $(this).find(".uploadId").val();
    //        // $.ajax({
    //        //      type: "POST",
    //        //      //async:false,
    //        //      url: base_url_dynamic + '/profile/savefilestatus',
    //        //      data: {H:H,W:W,uploadId:uploadId},
    //        //      success: function (res) {
    //        //      alert(res);
    //        //      }
    //        //  });
    // });
    $('body').on('click', '#textInsert', function () {
        $('.close').trigger('click');
        $('#textTitleError').hide();
        $('#textTitle').removeClass('error-class');
        $('#textDescriptionError').hide();
        $('#textDescription').removeClass('error-class');
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/profile/getalbum',
            data: {},
            success: function (res) {
                $('.AID').html(res);
            }
        });
    });
    $("#textInsertModal").on("hidden.bs.modal", function () {
        $('#uploadModal').modal();
    });
    $('body').on('keyup', '.friendsid', function () {
        var friendsid = $(this).val().trim();
        if (friendsid != '') {
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/profile/getfriends',
                data: {},
                success: function (res) {
                    jsObject = JSON.parse(res);
                    var html = "",
                        id = "",
                        friendsname = "",
                        profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (i = 0; i < jsObject.friendDetails.length; i++) {
                        id = jsObject.friendDetails[i].friendsid;
                        friendsname = jsObject.friendDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id, 10), frndDetails) == '-1') {
                                if (jsObject.friendDetails[i].profileimage != null) {
                                    profileimage = jsObject.friendDetails[i].profileimage;
                                }
                                html += '<li class="frndlist-click dropdown-li" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    $('.frndlist').html(html);
                    $('.frndlist').show();
                }
            });
        } else {
            $('.frndlist').hide();
        }
    });
    $('body').on('click', '.frndlist-click', function () {
        var id = $(this).data("id"),
            name = $(this).text();
        frndDetails.push(id);

        $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div input[type="text"]');
        $('.frndlist').hide();
        $('.friendsid').val('');
    });
    $('body').on('click', '.frnd-cancel', function () {
        var removeItem = $(this).next().val();
        frndDetails = jQuery.grep(frndDetails, function (value) {
            return value != removeItem;
        });
        $(this).parent().remove();
    });
    $('body').on('click', '#textPublishBtn', function () {
        var flag = 0,
            currentPageId = "",
            textTitle = $('#textTitle').val(),
            editor = CKEDITOR.instances.textDescription,
            textDescription = CKEDITOR.instances.textDescription.getData(),
            pageURL = $(location).attr("href");
        if (pageURL.indexOf('profile/showprofile') > -1) {
            currentPageId = $("#currentPageId").val();
            $('#currentPage').val(currentPageId);
        }
        if (textTitle == '') {
            flag = 1;
            $('#textTitle').addClass('error-class');
            $('#textTitleError').show();
        } else {
            $('#textTitleError').hide();
            $('#textTitle').removeClass('error-class');
        }
        if (textDescription == '') {
            flag = 1;
            $('#cke_textDescription').addClass('error-class');
            $('#textDescriptionError').show();
        } else {
            $('#textDescriptionError').hide();
            $('#cke_textDescription').removeClass('error-class');
        }
        if (flag == 0) {
            $('#textAddForm').submit();
            $('.close').trigger('click');
            $(".welcome").show();
            $(".closebtn").css('color','green');
            $(".showmsg").html("<span>Text record was successfully added</span>");
        }
    });
    $(".rotate").click(function(){
 $(this).toggleClass("down");
 if($(".rotate").hasClass("down"))
 {
    setTimeout(function () {
                 $("#dropped_ui").show();
            }, 1);

 }
 else{
    setTimeout(function () {
                 $("#dropped_ui").hide();
            }, 1);

 }

});
});
