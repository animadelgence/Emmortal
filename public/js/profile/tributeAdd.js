/*
 * @Author: Shubhadip
 * @Date:   2017-06-14 17:46:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-26 17:34:26
 */
/*jslint browser: true */
/*global $, jQuery, alert,CKEDITOR */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global getTribute,radix:true,addtributemodal,friendtributemodal */
var base_url_dynamic = window.location.origin,
    jsObject = "",
    i = "";
$(document).ready(function () {
    "use strict";
    if ($('#friendtributeDescription').length) {
        CKEDITOR.replace('friendtributeDescription', {
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
    $('body').on('click', '.getTribute', function () {
        var frndId = $(this).data("id"),
            textDescription = "",
            tributeType = $(this).attr('data-cmd');
        addtributemodal(frndId, tributeType);
        if ($("#searchmodal").is(':visible') == true) {
            $('#searchmodal').css('z-index', '0');
        }
        getTribute(frndId, textDescription, tributeType);
    });
    $('body').on('click', '#frndAddTributeBtn', function () {
        var frndId = $(this).data("id"),
            tributeType = $(this).attr('data-cmd');
        friendtributemodal(frndId, tributeType);
    });
    $('body').on('click', '#publishFriendTribute', function () {
        var flag = 0,
            frndId = $('#friendId').val(),
            tributeType = $('#tributeType').val(),
            editor = CKEDITOR.instances.friendtributeDescription,
            textDescription = CKEDITOR.instances.friendtributeDescription.getData();
        if (textDescription == '') {
            flag = 1;
            $('#cke_friendtributeDescription').addClass('error-class');
            $('#friendtributeDescriptionError').show();
            $(".welcome").show();
            $(".closebtn").css('color', 'red');
            $(".showmsg").html("<span style='color:red;'><strong>Text</strong>:Required</span>");
        } else {
            $('#friendtributeDescriptionError').hide();
            $('#cke_friendtributeDescription').removeClass('error-class');
        }
        if (flag == 0) {
            getTribute(frndId, textDescription, tributeType);
            $('.close').trigger('click');
            $(".welcome").show();
            $(".closebtn").css('color', 'green');
            $(".showmsg").html("<span>Tribute record was successfully added</span>");
        }
    });
    $('body').on("hidden.bs.modal", '#tributeAddModal', function () {
        if ($("#searchmodal").is(':visible') == true) {
            $('#searchmodal').css('z-index', '99999');
            $('#searchmodal').css('position', 'absolute');
            $('#searchmodal').css('overflow', 'visible');
        }
    });
    $('body').on("hidden.bs.modal", '#friendTributeAddModal', function () {
        $('#tributeAddModal').css('z-index', '99999');
    });

    function getTribute(frndId, textDescription, tributeType) {
        //$('#tributeloader').css('display','block');
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/tribute/gettribute',
            data: {
                description: textDescription,
                frndId: frndId,
                tributeType: tributeType
            },
            success: function (res) {
                $('#tributeloader').css('display', 'none');
                $('.offcanvas-comments').css("height", "100%");
                jsObject = JSON.parse(res);
                $('#totalTribute').html(jsObject.tributeDetails.length);
                if (jsObject.tributeDetails.length > 0) {
                    $('#totalTribute').css('background', 'rgb(47, 109, 107)');
                    $('.offcanvas-comments-title').css('color', 'rgb(47, 109, 107)');
                }
                if (jsObject.tributeDetails.length > 0) {
                    var html = "",
                        profileimage = "/image/profile-deafult-avatar.jpg";
                    for (i = 0; i < jsObject.tributeDetails.length; i++) {
                        html += '<div class="e-comment"><div class="e-comment-header m-b-10"><div class="e-likes-wrapper pull-right"><div class="e-like btn e-btn btn-round full likeClick" data-id="' + jsObject.tributeDetails[i].tributesid + '" data-cmd="tribute" data-toggle="tooltip" data-placement="bottom" title="Like">' + jsObject.tributeDetails[i].like + '</div></div><div class="user-wrapper"><img class="img-responsive m-r-5" src="' + jsObject.tributeDetails[i].profileimage + '" onerror="this.src=\''+profileimage+'\'"><a class="user-names pointer" href="/profile/showprofile/'+jsObject.tributeDetails[i].uniqueUser+'">' + jsObject.tributeDetails[i].friendsname + '</a></div><div class="e-comment-title"><p>' + jsObject.tributeDetails[i].shortDescription + '</p></div></div><div class="e-comment-body"><div class="e-comment-content"><div><p>' + jsObject.tributeDetails[i].description + '</p></div></div><div class="e-comment-info"><a class="e-link pointer" href="#">View profile page</a><div class="e-brown"><small>' + jsObject.tributeDetails[i].addeddate + '</small></div></div><div class="clearfix"></div></div></div>';
                    }
                    $('#tributeAppend').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    $('#tributeloader').css('display', 'none');
                    if (frndId == '') {
                        $('#tribute-add-btn').hide();
                    }
                    $('#tributeAppend').html('<h2 class="text-center e-brown">There are no tributes yet.</h2>');
                }
            }
        });

    }
});