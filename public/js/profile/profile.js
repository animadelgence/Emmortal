var base_url_dynamic = window.location.origin,
    frndDetails = [];
$(document).ready(function () {
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
                        profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (i = 0; i < jsObject.friendDetails.length; i++) {
                        var id = jsObject.friendDetails[i].friendsid;
                        var friendsname = jsObject.friendDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id), frndDetails) == '-1') {
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
        var id = $(this).data("id");
        frndDetails.push(id);
        var name = $(this).text();
        $('<span class="frnd-span-class">' + name + '<i class="fa fa-times frnd-cancel frnd-cross-class" aria-hidden="true"></i><input type="hidden" name="frndId[]" value="' + id + '"></span>&#59;').insertBefore('#append-div input[type="text"]');
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
        var flag = 0;
        var textTitle = $('#textTitle').val();
        var editor = CKEDITOR.instances['textDescription'];
        var textDescription = CKEDITOR.instances['textDescription'].getData();
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
        }
    })
})
