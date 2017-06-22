/*
 * @Author: Shubhadip
 * @Date:   2017-06-14 17:46:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-22 13:57:26
 */
/*jslint browser: true */
/*global $, jQuery, alert,CKEDITOR */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global getAlbum,radix:true */
var base_url_dynamic = window.location.origin,
    jsObject = "",
    i = "";
$(document).ready(function () {
    "use strict";
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
    $('body').on('click', '.getTribute', function () {
        var frndId = $(this).data("id"),
            textDescription = "";
        $('#friendId').val(frndId);
        getAlbum(frndId, textDescription);
    });
    $('body').on('click', '#publishFriendTribute', function () {
        var flag = 0,
            frndId = $('#friendId').val(),
            editor = CKEDITOR.instances.friendtributeDescription,
            textDescription = CKEDITOR.instances.friendtributeDescription.getData();
        if (textDescription == '') {
            flag = 1;
            $('#cke_friendtributeDescription').addClass('error-class');
            $('#friendtributeDescriptionError').show();
        } else {
            $('#friendtributeDescriptionError').hide();
            $('#cke_friendtributeDescription').removeClass('error-class');
        }
        if (flag == 0) {
            getAlbum(frndId, textDescription);
            $('.close').trigger('click');
        }
    });

    function getAlbum(frndId, textDescription) {
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/tribute/gettribute',
            data: {
                description: textDescription,
                frndId: frndId
            },
            success: function (res) {
                jsObject = JSON.parse(res);
                $('#totalTribute').html(jsObject.tributeDetails.length);
                if (jsObject.tributeDetails.length > 0) {
                    var html = "",
                        profileimage = "/image/profile-deafult-avatar.jpg";
                    for (i = 0; i < jsObject.tributeDetails.length; i++) {
                        if (jsObject.tributeDetails[i].profileimage != null) {
                            profileimage = jsObject.tributeDetails[i].profileimage;
                        }
                        html += '<div class="e-comment"><div class="e-comment-header m-b-10"><div class="e-likes-wrapper pull-right"><div class="e-like btn e-btn btn-round full likeClick" data-id="' + jsObject.tributeDetails[i].tributesid + '" data-cmd="tribute">' + jsObject.tributeDetails[i].like + '</div></div><div class="user-wrapper"><img class="img-responsive m-r-5" src="' + profileimage + '"><a class="user-names pointer" href="#">' + jsObject.tributeDetails[i].friendsname + '</a></div><div class="e-comment-title"><p>' + jsObject.tributeDetails[i].shortDescription + '</p></div></div><div class="e-comment-body"><div class="e-comment-content"><div><p>' + jsObject.tributeDetails[i].description + '</p></div></div><div class="e-comment-info"><a class="e-link pointer" href="#">View profile page</a><div class="e-brown"><small>' + jsObject.tributeDetails[i].addeddate + '</small></div></div><div class="clearfix"></div></div></div>';
                    }
                    $('#tributeAppend').html(html);
                } else {
                    $('#tributeAppend').html('<h2 class="text-center e-brown">There are no tributes yet.</h2>');
                }
            }
        });
    }

});