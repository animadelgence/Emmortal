/*
 * @Author: Rajyasree
 * @Date:   2017-07-07 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-07-07 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl*/
/*jslint eqeq: true*/

var base_url_dynamic = window.location.origin,
    jsObject = '',
    i = 0;
$(document).ready(function () {
    "use strict";
    $('body').on('click', '#searchfriend', function () {
        //alert();
        if($('#searchmodal').length) {
            friendlist();
        } 
    });
    $('body').on('keyup', '#searchText', function () {
        var friendsid = $(this).val().trim();
        $('#searchResults').css('display', 'none');
        if (friendsid != '') {
            
            //myFunction(friendsid);
        }
    });
    
});

function friendlist() {
    "use strict";
    $('#loader').css('display', 'block');
    if($('#searchfriend').length) {
       $.ajax({
        type: "POST",
        url: base_url_dynamic + '/friendrequests/searchfriends',
        data: {
            //param: param
        },
        success: function (res) {
            //console.log(res);return false;
            jsObject = JSON.parse(res);
            var html = "",
                buttonhtml = "'",
                formhtml = "",
                extrahtml = "",
                profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
            for (i = 0; i < jsObject.userDetails.length; i++) {
                var chk = 0,
                    id = jsObject.userDetails[i].friendsid,
                    friendsname = jsObject.userDetails[i].friendsname,
                    frndname = friendsname.toLowerCase(),
                    formhtml = '',
                    buttonhtml = '',
                    extrahtml = '';
                if (jsObject.userDetails[i].profileimage != null) { // jshint ignore:line
                    profileimage = jsObject.userDetails[i].profileimage;
                }
                if (jsObject.userDetails[i].status == 'outgoing') {
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-warning full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-clock-o"></div> Request sent</button></div>';
                } else if(jsObject.userDetails[i].status == 'incoming') {
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/responserequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="pending-actions-btn text-right" user="client" data-folder-target-id="' + id + '"><button class="btnn btn e-btn btn-primary respondFriendRequest" id="acceptbtn' + id + '"><div class="fa fa-user-plwhen do NaN shows in a js alertus"></div> Accept </button>&nbsp;<button class="btnn btn e-btn btn-danger respondFriendRequest" id="declinebtn' + id + '"><div class="fa fa-user-times"></div> Decline </button></div>';
                } else if(jsObject.userDetails[i].status == 'accepted') {
                    buttonhtml +='<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute" data-cmd="relationship">'+jsObject.userDetails[i].noOfTributes+'</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">'+jsObject.userDetails[i].friendslikes+'</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
                    extrahtml += '<a class="e-link pointer">View Relationship Page</a>';
                } else if(jsObject.userDetails[i].status == 'declined') {
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-danger full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div>Declined</button></div>';
                } else {
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div> Connect</button></div>';
                }
                html += '<div class="user-field m-t-25 animated fadeIn"><input type = "hidden" value = "'+friendsname+'">'+formhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+extrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                $('#searchResults').html(html);
            }
            $('#loader').css('display','none');
        }
    });
    }
}