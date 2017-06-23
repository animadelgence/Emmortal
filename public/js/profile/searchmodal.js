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
var base_url_dynamic = window.location.origin,
    html = '';
$(document).ready(function () {
    outgoingfriendlist();
    
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
        incomigFriendList();
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
        $('#searchResults').html('');
        outgoingfriendlist();
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
        $('#globalSearch').css('display', 'block');
        var friendsid = $(this).val().trim(),
            jsObject = '',
            html = '',
            i = '',
            id = '',
            friendsname = '',
            profileimage = '',
            frndDetails = [];
        //alert(friendsid);
        if (friendsid != '') { // jshint ignore:line
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/friendrequests/searchfriends',
                data: {},
                success: function (res) {
                    /**/
                    jsObject = JSON.parse(res);
                    /*console.log(jsObject);
                    return false;*/
                    profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                    for (i = 0; i < jsObject.userDetails.length; i++) {
                        id = jsObject.userDetails[i].friendsid;
                        friendsname = jsObject.userDetails[i].friendsname.toLowerCase();
                        if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                            if ($.inArray(parseInt(id), frndDetails) == '-1') {
                                if (jsObject.userDetails[i].profileimage != null) { // jshint ignore:line
                                    profileimage = jsObject.userDetails[i].profileimage;
                                }
                                if ((jsObject.userDetails[i].status) != 'Incoming') { // jshint ignore:line
                                    html += '<div class="user-field m-t-25 animated fadeIn"><form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data"><div class="media">   <div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div>   <div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="">' + jsObject.userDetails[i].friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + jsObject.userDetails[i].friendsid + '"></a></h3></div><div class="media-right media-middle btn-section"><div class="relationship-btn" user="client" data-folder-target-id="' + jsObject.userDetails[i].friendsid + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + jsObject.userDetails[i].friendsid + '">';

                                    if ((jsObject.userDetails[i].status) == 'Outgoing') {
                                        html += '<div class="fa fa-plus"></div> Request sent</button></div></div></div></form></div>';
                                    } else if ((jsObject.userDetails[i].status) == 'New') {
                                        html += '<div class="fa fa-plus"></div> Connect</button></div></div></div></form></div>';
                                    }
                                }
                            }
                        }
                    }
                    $('#searchResults').html(html);
                    $('#searchResults').show();
                }
            });
        }
    });
    $('body').on('click', '#userId', function () {
        /*var userid = $('#userid').val();
        alert(userid);
        $("#requestform").ajaxSubmit({
            data: {
                userid: userid
            },
            success: function (result) {
                alert(result);
                alert("jftrdrtu");
                return false;
            }
        });*/
    });
    $('body').on('click', '.sendFriendRequest', function (e) {
        e.preventDefault();
        var userID = $(this).parents('.relationship-btn').attr('data-folder-target-id'),
            value = $(this);
        alert(userID);
        //return false;
        $("#requestform").ajaxSubmit({
            data: {
                userID: userID
            },
            success: function (result) {
                
                var jsObject = JSON.parse(result);
                //console.log(jsObject);
                if (jsObject.status == 'Request sent') {
                    //if($(".relationship-btn").attr('data-folder-target-id') == userID)
                    value.text('Request sent');
                }
                return false;
            }
        });
        return false;
    });
});
function outgoingfriendlist()
{
    $('#searchResults').html('');
    $.ajax({
        type: "POST",
        url: base_url_dynamic + '/friendrequests/searchfriends',
        data: {},
        success: function (res) {
            /**/
            jsObject = JSON.parse(res);
            /*console.log(res);
            return false;*/
            profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
            for (i = 0; i < jsObject.userDetails.length; i++) {
                id = jsObject.userDetails[i].friendsid;
                friendsname = jsObject.userDetails[i].friendsname.toLowerCase();
                //if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                 //   if ($.inArray(parseInt(id), frndDetails) == '-1') {
                        if (jsObject.userDetails[i].profileimage != null) { // jshint ignore:line
                            profileimage = jsObject.userDetails[i].profileimage;
                        }
                        if ((jsObject.userDetails[i].status) == 'Outgoing') { // jshint ignore:line
                            $('#allTabShow').css('display', 'none');
                            $('#outgoingTabshow').css('display', 'none');
                            html += '<div class="user-field m-t-25 animated fadeIn"><form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data"><div class="media">   <div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div>   <div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="">' + jsObject.userDetails[i].friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + jsObject.userDetails[i].friendsid + '"></a></h3></div><div class="media-right media-middle btn-section"><div class="relationship-btn" user="client" data-folder-target-id="' + jsObject.userDetails[i].friendsid + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + jsObject.userDetails[i].friendsid + '"><div class="fa fa-plus"></div> Request sent</button></div></div></div></form></div>';
                        }
                        
                 //   }
               // }
            }
            $('#searchResults').html(html);
            $('#searchResults').show();
        }
    });
}
function incomigFriendList() {
    $('#searchResults').html();
    $.ajax({
        type: "POST",
        url: base_url_dynamic + '/friendrequests/searchfriends',
        data: {},
        success: function (res) {
            /**/
            jsObject = JSON.parse(res);
            /*console.log(jsObject);
            return false;*/
            profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
            for (i = 0; i < jsObject.userDetails.length; i++) {
                id = jsObject.userDetails[i].friendsid;
                friendsname = jsObject.userDetails[i].friendsname.toLowerCase();
               // if (friendsname.indexOf(friendsid.toLowerCase()) > -1) {
                    //if ($.inArray(parseInt(id), frndDetails) == '-1') {
                        if (jsObject.userDetails[i].profileimage != null) { // jshint ignore:line
                            profileimage = jsObject.userDetails[i].profileimage;
                        }
                        if ((jsObject.userDetails[i].status) == 'Incoming') { // jshint ignore:line
                            $('#incomingTabShow').css('display', 'none');
                            html += '<div class="user-field m-t-25 animated fadeIn"><form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data"><div class="media">   <div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div>   <div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="">' + jsObject.userDetails[i].friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + jsObject.userDetails[i].friendsid + '"></a></h3></div><div class="media-right media-middle btn-section"><div class="relationship-btn" user="client" data-folder-target-id="' + jsObject.userDetails[i].friendsid + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + jsObject.userDetails[i].friendsid + '"><div class="fa fa-plus"></div> Accept/ Decline</button></div></div></div></form></div>';
                        }
                   // }
               // }
            }
            $('#searchResults').html(html);
            $('#searchResults').show();
        }
    });
}

