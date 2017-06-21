/*
 * @Author: Rajyasree
 * @Date:   2017-06-21 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-06-21 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl*/
/*jslint eqeq: true*/
var base_url_dynamic = window.location.origin;
$(document).ready(function () {
    "use strict";
    $('#allTabShow').css('display', 'block');
    $('body').on('click', '#allTab', function () {
        $("#li-allTab").addClass("active");
        $("#li-relationshipTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $('#allTabShow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#relationshipTab', function () {
        $("#li-relationshipTab").addClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $('#relationshipTabShow').css('display', 'block');
        $('#allTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#incomingTab', function () {
        $("#li-incomingTab").addClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-relationshipTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $('#incomingTabShow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#allTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#outgoingTab', function () {
        $("#li-outgoingTab").addClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-relationshipTab").removeClass("active");
        $('#outgoingTabshow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#allTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
    });
    $('body').on('keyup', '#searchText', function () {
        var friendsid = $(this).val().trim();
        alert(friendsid);
        if (friendsid != '') { // jshint ignore:line
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/friendrequests/searchfriends',
                data: {},
                success: function (res) {
                   // console.log(res);
                    //return false;
                    var jsObject = JSON.parse(res);
                    var html = "",
                        profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (var i = 0; i < jsObject.userDetails.length; i++) {
                        var id = jsObject.userDetails[i].friendsid;
                        var friendsname = jsObject.userDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id), frndDetails) == '-1') {
                                if (jsObject.userDetails[i].profileimage != null) {
                                    profileimage = jsObject.userDetails[i].profileimage;
                                }
                                html += '<li class="frndlist-click-class dropdown-li" id="frndlist-click-image" data-id="' + jsObject.userDetails[i].friendsid + '"><img src="' + profileimage + '" class="img-circle frnd-image-class" alt="Cinque Terre" ><span class="frnd-list-name" id="frnd-list-name-id">' + jsObject.userDetails[i].friendsname + '</span></li>';
                            }
                        }
                    }
                    alert(html);
                    /*$('#frndlistImage').html(html);
                    $('#frndlistImage').show();*/
                }
            });
        }
    });
});
