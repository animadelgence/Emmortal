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
        var getClickedId = $(this).attr("data-fetch-id"),
            prevSelection = $(".profile-paginator__click").parent('ul').find('.active').index(),
            currentClicked = $(this).index(),
            fadeOUT = { opacity: 0, transition: 'opacity 0.5s' },
            fadeIN = { opacity: 1, transition: 'opacity 0.5s' };
        if(currentClicked > prevSelection) {
                   $(".container-of-sections").css(fadeOUT).slideDown(1500).remove();
                }
                else {
                    $(".container-of-sections").css(fadeOUT).slideUp(1500).remove();
                }
        $(".profile-paginator__click").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            type: "POST",
            data: {
                pageid: getClickedId
            },
            url: baseUrl + "/page/selectpage",
            success: function (result) {
                var jsObject = JSON.parse(result),
                    i = 0,
                    appendHtml = "<div class='container-of-sections' style='opacity:0;'>";
                if (jsObject.defaultPage == 1) {
                    appendHtml += '<div class="user_profile_image_section"><img src="' + jsObject.profileImage + '"></div><div class="user_profile_name_section"><span>' + jsObject.DOB + '</span><br><span>' + jsObject.Name + '</span></div>';
                }
                if (jsObject.NoPage == 1) {
                    appendHtml += '<div class="user_upload_part_section"><div data-target="#uploadModal" data-toggle="modal"  class="fa fa-plus add-page-plus-icon"></div><div class=""><p>Add your Life moments: upload photos and videos.</p><p>Create Albums, Tributes and add valuable texts.</p><p>"Add" button is always accessible on right top menu.</p></div></div>';
                } else {
                   appendHtml += '<div class="user_upload_part_section_content">';
                    for (i = 0; i < jsObject.uploaddetails.length; i++) {
                        appendHtml +='<div class="user_upload_part_section_content--inside"><span>'+jsObject.uploaddetails[i].uploadPath+'</span><span>'+jsObject.uploaddetails[i].uploadType+'</span></div>';
                        }
                    appendHtml+= '</div>';
                }
                appendHtml += "</div>";
                
                if(currentClicked > prevSelection) {
                    $(".user_profile_section").prepend(appendHtml);
                    $(".container-of-sections:eq(0)").css(fadeIN).slideDown(1500);
                        
                }
                else {
                    $(".user_profile_section").prepend(appendHtml);
                    $(".container-of-sections:eq(0)").css(fadeIN).slideUp   (1500);
                }
                /*$(".user_profile_section .container-of-sections").css(fadeOUT).slideUp(1500, function() {
                    $(".user_profile_section").html(appendHtml);
                    $(".user_profile_section .container-of-sections").css(fadeIN).slideUp(1000);
                });*/
                
            }

        });

    });

});
