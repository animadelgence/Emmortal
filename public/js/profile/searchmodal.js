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
    $('body').on('click', '#searchfriend', function () {
        $('#searchResults').html('');
        friendlist('AllFriend', '');
    });
    $('#allTabShow').css('display', 'block');
    $('body').on('click', '#allTab', function () {
        $('#searchResults').html('');
        friendlist('AllFriend', '','');
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
        $('#searchText').val('');
        friendlist('Onlyfriend', '','');
        $("#li-relationshipTab").addClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $('#relationshipTabShow').text('You have no relationships yet');
        /*$('#allTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');*/
    });
    $('body').on('click', '#incomingTab', function () {
        $('#searchText').val('');
        $('#searchResults').css('display', 'none');
        $('#globalSearch').css('display', 'none');
        friendlist('Incoming', '','');
        $("#li-incomingTab").addClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-relationshipTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        /*$('#incomingTabShow').css('display', 'block');*/
        $('#relationshipTabShow').text('There are no incoming relationships requests');
        /*$('#allTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');*/
    });
    $('body').on('click', '#outgoingTab', function () {
        $('#searchText').val('');
        $('#searchResults').css('display', 'none');
        $('#globalSearch').css('display', 'none');
        friendlist('Outgoing', '','');
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
        $('#searchResults').css('display', 'none');
        if (friendsid != '') {
            $('#globalSearch').css('display', 'block');
            friendlist('All', friendsid,'search');
        } else {
            $('#globalSearch').css('display', 'none');
            friendlist('AllFriend', '','search');
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
        //alert(userID);
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
    $('body').on('click', '.respondFriendRequest', function (e) {
        e.preventDefault();
        var toBeRespondedId = $(this).parents('.pending-actions-btn').attr('data-folder-target-id'),
            value = 'btn-section' + toBeRespondedId,
            action = $(this).text().trim();
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/friendrequests/responserequest',
            data: {
                userID: toBeRespondedId,
                action: action
            },
            success: function (res) {
                if (res == 1) {
                    var htmlData = "";
                    if(action == 'Accept') {
                        htmlData += '<div class="show-adds-btns" style="width:200px;" ><div class="inline btn e-btn btn-brown btn-round full getTribute" onclick ="getTributemodalopen();" data-id="" data-toggle="tooltip" data-placement="bottom" title="Tribute">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
                    } else {
                        htmlData += '<div class="relationship-btn" user="client"><button class="btnn e-btn btn-danger full sendFriendRequest" id="requestbtn"><div class="fa fa-times"></div> Declined</button></div>';
                    }
                    $('#'+value).html(htmlData);
                    $('[data-toggle="tooltip"]').tooltip();
                    $('#'+value).show();
                }
            }
        });
        //return false;
    });
});
function friendlist(param,search,searchParam)
{
    $('#loader').css('display','block');
    $.ajax({
        type: "POST",
        url: base_url_dynamic + '/friendrequests/searchfriends',
        data: {
            param:param
        },
        success: function (res) {
            jsObject = JSON.parse(res);
            var html ="";
            var additionalhtml= "";
           var profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
            for (i = 0; i < jsObject.userDetails.length; i++) {
                var chk = 0;
                var id = jsObject.userDetails[i].friendsid;
                var friendsname = jsObject.userDetails[i].friendsname;
                var frndname = friendsname.toLowerCase();
                if (jsObject.userDetails[i].profileimage != null) { // jshint ignore:line
                    profileimage = jsObject.userDetails[i].profileimage;
                }
                var formhtml="";
                var buttonhtml= "";
                var extrahtml= "";
                var tabShow= "";

                var additionalbuttonhtml= "";
                var additionalextrahtml= "";
                var incomingbuttonhtml= "";
                var incomingformhtml= "";
                if(search != ''){
                    if (frndname.indexOf(search.toLowerCase()) > -1) {
                        chk = 1;
                    }
                } else{
                    chk = 1;
                }
                if(jsObject.userDetails[i].status == 'Outgoing'){
                    if ((param == 'All' && $('#li-outgoingTab').hasClass('active')) || (param == 'All' && $('#li-allTab').hasClass('active'))) {
                        additionalbuttonhtml += '<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-warning full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-clock-o"></div> Request sent</button></div>';
                        //alert(additionalbuttonhtml);
                    }
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-warning full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-clock-o"></div> Request sent</button></div>';
                    //tabShow = 'outgoing';
                } else if(jsObject.userDetails[i].status == 'Incoming') {
                    if ((param == 'All' && $('#li-incomingTab').hasClass('active'))) {
                        incomingformhtml += '<form name="requestform" id="requestform" action="/friendrequests/responserequest" method="POST" enctype="multipart/form-data">';
                        incomingbuttonhtml += '<div class="pending-actions-btn text-right" user="client" data-folder-target-id="' + id + '"><button class="btnn btn e-btn btn-primary respondFriendRequest" id="acceptbtn' + id + '"><div class="fa fa-user-plus"></div> Accept </button>&nbsp;<button class="btnn btn e-btn btn-danger respondFriendRequest" id="declinebtn' + id + '"><div class="fa fa-user-times"></div> Decline </button></div>';
                        alert(incomingbuttonhtml);

                    }
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/responserequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="pending-actions-btn text-right" user="client" data-folder-target-id="' + id + '"><button class="btnn btn e-btn btn-primary respondFriendRequest" id="acceptbtn' + id + '"><div class="fa fa-user-plwhen do NaN shows in a js alertus"></div> Accept </button>&nbsp;<button class="btnn btn e-btn btn-danger respondFriendRequest" id="declinebtn' + id + '"><div class="fa fa-user-times"></div> Decline </button></div>';
                    //tabShow = 'incoming';
                } else if(jsObject.userDetails[i].status == 'Accepted'){
                    if ((param == 'All' && $('#li-allTab').hasClass('active')) || (param == 'All' && $('#li-relationshipTab').hasClass('active'))) {
                        additionalbuttonhtml += '<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
                        additionalextrahtml += '<a class="e-link pointer">View Relationship Page</a>';
                        //alert(additionalbuttonhtml);
                        //alert(additionalextrahtml);
                    }
                    buttonhtml +='<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
                    extrahtml += '<a class="e-link pointer">View Relationship Page</a>';
                } else if(jsObject.userDetails[i].status == 'Declined'){
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-danger full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div>Declined</button></div>';
                } else{
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div> Connect</button></div>';
                }
                if(chk == '1'){
                    if (param == 'All' && additionalbuttonhtml != '') {
                        if ($('#li-outgoingTab').hasClass('active')) {
                            additionalhtml += '<div class="user-field m-t-25 animated fadeIn"><div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3></div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+additionalbuttonhtml+'</div></form></div>';
                            additionalbuttonhtml = '';
                        } else if ($('#li-allTab').hasClass('active')) {
                            additionalhtml += '<div class="user-field m-t-25 animated fadeIn"><div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+additionalextrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+additionalbuttonhtml+'</div></form></div>';
                            additionalbuttonhtml = '';
                            //alert(additionalhtml);
                        } /*else if ($('#li-incomingTab').hasClass('active')) {
                            additionalhtml += '<div class="user-field m-t-25 animated fadeIn">'+incomingformhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3></div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+incomingbuttonhtml+'</div></form></div>';
                            incomingbuttonhtml = '';
                            alert(additionalhtml);
                        }*/
                 } else if (param == 'All' && $('#li-incomingTab').hasClass('active') && incomingformhtml != '') {
                        additionalhtml += '<div class="user-field m-t-25 animated fadeIn">'+incomingformhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3></div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+incomingbuttonhtml+'</div></form></div>';
                        incomingbuttonhtml = '';
                        alert(additionalhtml);
                 }
                 html += '<div class="user-field m-t-25 animated fadeIn">'+formhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+extrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                }
                
            }
            if (param == 'AllFriend') {
                $('#myRelationships').css('display', 'block');
            }
            else if(param == 'Outgoing' && html != ''){
                $('#outgoingTabshow').css('display', 'none');
                //$('#myRelationships').css('display', 'none');


            } else if(param == 'Incoming' && html != ''){
                $('#incomingTabShow').css('display', 'none');
                $('#myRelationships').css('display', 'none');
            } else if(param == 'Onlyfriend' && html != '') {
                $('#myRelationships').css('display', 'block');
                $('#relationshipTabShow').css('display', 'none');
            } else {
                $('#myRelationships').css('display', 'block');

            }//don't know required or not
            //alert(additionalhtml);
            if (searchParam == 'search' && param == 'All'){
                $('#searchResults').html(html);
                $('[data-toggle="tooltip"]').tooltip();
                $('#searchResults').show();
                $('#tabResults').html(additionalhtml);
                $('[data-toggle="tooltip"]').tooltip();
                $('#tabResults').show();
                if (additionalhtml == '' && $('#li-incomingTab').hasClass('active')) {
                    $('#myRelationships').css('display', 'none');
                    $('#relationshipTabShow').css('display', 'block');
                    $('#relationshipTabShow').text('There are no incoming relationships requests');
                } else if (additionalhtml == '' && $('#li-outgoingTab').hasClass('active')) {
                    $('#myRelationships').css('display', 'none');
                    $('#relationshipTabShow').css('display', 'block');
                    $('#relationshipTabShow').text('There are no outgoing relationships requests');
                }
            } else {
                $('#tabResults').html(html);
                $('[data-toggle="tooltip"]').tooltip();
                $('#tabResults').show();
            }

            $('#loader').css('display','none');
        }
    });
}



