/*
 * @Author: Anima
 * @Date:   2017-06-19 18:46:35
 * @Last Modified by:   Anima
 * @Last Modified time: 2017-06-19 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */
/*jshint -W065 */
/*jslint devel: true */
/*jslint eqeq: true*/
$(function () {
    var baseUrl = window.location.origin;
    $("body").on("click", ".add-page-btn", function () {
        $.ajax({
            type: "POST",
            url: baseUrl + "/page/newpagecreate",
            success: function (result) {
                var jsObject = JSON.parse(result);
                $(".close-new").trigger("click");
                if (jsObject.noredirect == 1) {
                    window.location.href(baseUrl + "/profile/showprofile");
                } else {
                    $(".profile-paginator ul").append('<li class="profile-paginator__click" data-fetch-id="' + jsObject.gotostep + '"></li>');
                    $(".profile-paginator ul li:last").trigger("click");
                }
            }

        });
    });
    $("body").on("click", ".profile-paginator__click", function () {
        var getClickedId = $(this).attr("data-fetch-id");
        $.ajax({
            type: "POST",
            data: {
                pageid: getClickedId
            },
            url: baseUrl + "/page/selectpage",
            success: function (result) {
                var jsObject = JSON.parse(result),
                    i = 0,
                    appendHtml = "";
                if (jsObject.defaultPage == 1) {
                    appendHtml += '<div class="user_profile_image_section"><img src="' + jsObject.profileImage + '"></div><div class="user_profile_name_section"><span>' + jsObject.DOB + '</span><br><span>' + jsObject.Name + '</span></div>';
                }
                if (jsObject.NoPage == 1) {
                    appendHtml += '<div class="user_upload_part_section"><div class="fa fa-plus add-page-plus-icon"></div><div class=""><p>Add your Life moments: upload photos and videos.</p><p>Create Albums, Tributes and add valuable texts.</p><p>"Add" button is always accessible on right top menu.</p></div></div>';
                } else {
                   appendHtml += '<div class="user_upload_part_section_content">';
                    for (i = 0; i < jsObject.uploaddetails.length; i++) {
                        appendHtml +='<div class="user_upload_part_section_content--inside"><span>'+jsObject.uploaddetails[i].uploadPath+'</span><span>'+jsObject.uploaddetails[i].uploadType+'</span></div>';
                        }
                    appendHtml+= '</div>';
                }
                $(".user_profile_section").html(appendHtml);
            }

        });

    });

});
