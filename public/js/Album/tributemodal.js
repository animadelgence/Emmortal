 $(document).ready(function () {
    var baseURL = window.location.origin;
    var frndDetails =[];
    if($('#tributeDescription').length){
        CKEDITOR.replace('tributeDescription', {
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

    $('body').on('keyup', '#friendsidtribute', function () {
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
                                html += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-tribute" data-id="' + jsObject.friendDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.friendDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    $('#frndlisttribute').html(html);
                    $('#frndlisttribute').show();
                }
            });
        } else {
            $('#frndlisttribute').hide();
        }
    });
     $("#tributemodal").on("hidden.bs.modal", function () {
        $('#uploadModal').modal();
    });
    $('body').on('click', '#frndlist-click-tribute', function () {
        var id = $(this).data("id");
        frndDetails.push(id);
        var name = $(this).text();
        //alert($("#append-div-tribute").children().find(".frnd-span-class").length);
        if($("#append-div-tribute").children().html() == "" ){
            $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" id="idvalue_'+id+'" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div-tribute input[type="text"]');
        }else{
           var prevId = $("#append-div-tribute").find(".frndId").val();
            frndDetails.pop();
            $("#idvalue_"+prevId).trigger("click");
             $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" id="idvalue_'+id+'" aria-hidden="true"></i><input type="hidden" class = "frndId" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div-tribute input[type="text"]');
            
        }
        $('#frndlisttribute').hide();
        $('#friendsidtribute').val('');
    });

     $('body').on('click', '.frnd-cancel', function () {
        var removeItem = $(this).next().val();
        frndDetails = jQuery.grep(frndDetails, function (value) {
            return value != removeItem;
        });
        $(this).parent().remove();
    });

     $('body').on('click', '#publishidtribute', function () {
     //$("#publishidtribute").click(function(){
        var flag = 0;
            var editor = CKEDITOR.instances['tributeDescription'];
            var tributeDescription = CKEDITOR.instances['tributeDescription'].getData();
            if($("#append-div-tribute").find(".frnd-span-class").length > 0){
                $('#tributefriendError').hide();
                $('#friendsidtribute').removeClass('error-class');
            } else{
                flag = 1;
                $('#friendsidtribute').addClass('error-class');
                $('#tributefriendError').show();
                $("#tributemodal").css("z-index","0");
                $(".modal-backdrop").css("z-index","0");
                errormodalopen('please select your friend','tribute');
            }
            if(tributeDescription == ""){
                flag = 1;
                $('#tributeDescription').addClass('error-class');
                $('#tributeDescriptionError').show();
                $("#tributemodal").css("z-index","0");
                $(".modal-backdrop").css("z-index","0");
                errormodalopen('please put the Description','tribute');

            } else {
                $('#tributeDescriptionError').hide();
                $('#tributeDescription').removeClass('error-class');
            }
            if(flag == 0 ){
                $('#tributecreate').submit();
            }
            else{
                return false;
            }

     });
});
function tributefunctionClick() {
    /*tributemodalopen();
    $('#errorModal').modal('hide');*/
    $("#tributemodal").css("z-index","9999");
    $('#errorModal').remove();
}
function tributeClick()
{
    uploadmodalopen();
    //$('#uploadModal').modal('show');
    $('#tributemodal').modal('hide');
}
