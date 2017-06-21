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
                $('.AID-class').html(res);
            }
        });

    });

    $('body').on('keyup', '#friendsidvideo', function () {
        var friendsid = $(this).val().trim();
        if (friendsid != '') {
            $.ajax({
                type: "POST",
                url: baseURL + '/profile/getfriends',
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
                                html += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-video" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    $('#frndlistvideo').html(html);
                    $('#frndlistvideo').show();
                }
            });
        } else {
            $('#frndlistvideo').hide();
        }
    });
    $('body').on('click', '#frndlist-click-video', function () {
        var id = $(this).data("id");
        frndDetails.push(id);
        var name = $(this).text();
        $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div-video input[type="text"]');
        $('#frndlistvideo').hide();
        $('#friendsidvideo').val('');
    });

     $('body').on('click', '.frnd-cancel', function () {
        var removeItem = $(this).next().val();
        frndDetails = jQuery.grep(frndDetails, function (value) {
            return value != removeItem;
        });
        $(this).parent().remove();
    });

 	$('#file').on('change', function () {
	     $("#videoupload").ajaxSubmit({

                    data: {
                        file: 'file'
                    },
                    success: function (result) {
						var response = JSON.parse(result);
                        if (response.error == 0 || response.error == 1) {
                            $("#uploadModal").hide();
                            $("#videoInsertModal").css("z-index","0");
                            $(".modal-backdrop").css("z-index","0");
                        	$(".welcome").show();
                            $(".showmsg").html("<span>please select a video</span>");
                                  
                                    }
                          else {
                        	$("#canvas-placeholderid").html('<video controls="controls" name="Video Name" id="videoId" src="/video/'+response.filePath+'" style="width:100%;height:100%;"></video>');
                        	$(".uploadedvideo").val(response.filePath);
                          }
                     
                    }
                });
	 });

    $('#publishid').on('click', function () {
      
         var flag = 0;
        var title = $("#title").val();
        var uploadedvideo = $("#uploadedvideo").val();
       var editor = CKEDITOR.instances['videoDescription'];
            var videoDescription = CKEDITOR.instances['videoDescription'].getData();
        var friendsId = [];
        var albumId = $(".AID-class" ).val();
            var pageURL = $(location).attr("href");
            if (pageURL.indexOf('profile/showprofile') > -1) {
                  var currentPageId = $("#currentPageId").val();
                } else{
                    var currentPageId = "";
                }
   
        if($('#videoInsertModal').find('input.frndId').length !== 0)
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
        if (title == '') {
            flag = 1;
            $('#title').addClass('error-class');
            $('#videoTitleError').show();
            $("#uploadModal").hide();
            $("#videoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please fill title field</span>");
        } else {
            $('#videoTitleError').hide();
            $('#title').removeClass('error-class');
           
        }
        if (videoDescription == '') {
            flag = 1;
            $('#videoDescription').addClass('error-class');
            $('#videoDescriptionError').show();
            $("#uploadModal").hide();
            $("#videoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please fill description field</span>");
        } else {
            $('#videoDescriptionError').hide();
            $('#videoDescription').removeClass('error-class');
        }
        if(uploadedvideo == ''){
            flag = 1;
            $('#file').addClass('error-class');
            $('#videouploaderror').show();
            $("#uploadModal").hide();
            $("#videoInsertModal").css("z-index","0");
            $(".modal-backdrop").css("z-index","0");
            $(".welcome").show();
            $(".showmsg").html("<span>please fill description field</span>");
        } else{
            $('#videouploaderror').hide();
            $('#file').removeClass('error-class');
        }
      
        if (flag == 0) {
            $.ajax({                     
                type: "POST",
                url: base_url_dynamic + '/video/videodetailssubmit',
                data: {
                    title : title,
                    uploadedvideo : uploadedvideo,
                    videoDescription : videoDescription,
                    friendsId : friendsId,
                    albumId: albumId,
                    currentPageId :currentPageId
                },
                success: function (res) {
                    if(res == 1){



                         if (pageURL.indexOf('profile/showprofile') > -1) {
                             $('.modal').modal('hide');
                              $(".profile-paginator__click.active").trigger("click");
                            } else{
                                window.location.href = baseURL + "/profile/showprofile";
                            }


                    }
                  //  alert(res);
                }
        });
        }





    });
$(".closebtn").click(function(){
    $(".welcome").hide();
    $("#uploadModal").show();
    $("#videoInsertModal").css("z-index","1305");
    $(".modal-backdrop").css("z-index","1040");
})

});
