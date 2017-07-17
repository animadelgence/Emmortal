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
        if($('#searchmodal').length) {
            $("#li-allTab").addClass("active");
            friendlist();
        } 
    });
    /*$('body').on('click', '.Tab', function () {
        $('#globalSearch').hide();
        //$('#tabResults').hide();
        $('#searchResults').hide();
        var tabId = $(this).attr('id');
        //alert(tabId);
        if (tabId == 'incomingTab') {
            $("#incomingTab").trigger("click");
        } else if (tabId == 'outgoingTab') {
            $("#outgoingTab").trigger("click");
        } else if (tabId == 'relationshipTab') {
            $("#relationshipTab").trigger("click");
        } else {
            $("#allTab").trigger("click");
        }
    });*/
    $('body').on('click', '#incomingTab', function () {
        //alert();
        $('#searchText').val('');
        $('#globalSearch').hide();
        $('.displayTab').hide();
        $('#searchResults').hide();
        //$('#tabResults').hide();

        $("#li-allTab").removeClass("active");
        $("#li-relationshipTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $("#li-incomingTab").addClass("active");

        $("#tabResults .animated").hide();
        $("#tabResults .incoming").show();
        showmessage();
        //alert(2);
    });
    $('body').on('click', '#outgoingTab', function () {
        $('#globalSearch').hide();
        $('.displayTab').hide();
        //$('#tabResults').hide();
        $('#searchText').val('');
        $('#searchResults').hide();

        $("#li-relationshipTab").removeClass("active");
        $("#li-allTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").addClass("active");

        $("#tabResults .animated").hide();
        $('#searchResults .outgoing').hide();
        $("#tabResults .outgoing").show();
        showmessage();
    });
    $('body').on('click', '#relationshipTab', function () {
        //alert();
        $('#searchText').val('');
        $('.displayTab').hide();
        $('#globalSearch').hide();
        //$('#tabResults').hide();
        $('#searchResults').hide();


        $("#li-allTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $("#li-relationshipTab").addClass("active");

        $("#tabResults .animated").hide();
        $("#tabResults .outgoing").show();
        $("#tabResults .incoming").show();
        $("#tabResults .accepted").show();
        showmessage();
    });
    $('body').on('click', '#allTab', function () {
        $('#searchText').val('');
        $('.displayTab').hide();
        $('#globalSearch').hide();
        //$('#tabResults').hide();
        $('#searchResults').hide();

        $("#li-relationshipTab").removeClass("active");
        $("#li-incomingTab").removeClass("active");
        $("#li-outgoingTab").removeClass("active");
        $("#li-allTab").addClass("active");

        $("#tabResults .animated").hide();
        $("#tabResults .outgoing").show();
        $("#tabResults .incoming").show();
        $("#tabResults .accepted").show();
        showmessage();
    });
    $('body').on('keyup', '#searchText', function () {
        $('.displayTab').hide();
        $('#globalSearch').show();
        $('#myRelationships').css('display', 'block');
        var friendsid = $(this).val().trim(),
            noOfDivs = '';
        //alert(friendsid);
        if(friendsid != '') {
            $("#searchResults .animated").hide();
            $("#searchResults .animated > input[type='hidden']").each(function(){
                //alert($(this).html());
                if($(this).val().toLowerCase().indexOf(friendsid.toLowerCase()) > -1) {
                    $(this).parent().show();
                    $(this).val().indexOf(friendsid.toLowerCase());
                }
            });

            //$("#tabResults .animated").hide();
            $("#tabResults .animated:visible > input[type='hidden']").each(function(){
                //alert($(this).val());
                $("#tabResults .animated").hide();
               // $("#tabResults .animated > div[display='block']").each(function(){
                    if($(this).val().toLowerCase().indexOf(friendsid.toLowerCase()) > -1) {
                        /*console.log(1);
                        alert($(this).parent().parent().html());*/
                        $(this).parent().show();
                        $(this).val().indexOf(friendsid.toLowerCase());
                    }
                ////});
            });
            $("#tabResults").show();
            $("#searchResults").show();
        } else {
            $('#searchResults').hide();
            var tabName = $(".nav-pills li.active").attr('id');
            if (tabName == 'li-outgoingTab') {
               $("#outgoingTab").trigger("click");
            } else if (tabName == 'li-incomingTab') {
               $("#incomingTab").trigger("click");
            } else if (tabName == 'li-relationshipTab') {
               $("#relationshipTab").trigger("click");
            } else {
               $("#allTab").trigger("click");
            }
        }
        showmessage();
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
                console.log(res);
                //return false;
                if (res == 1) {
                    var htmlData = "";
                    if(action == 'Accept') {
                        htmlData += '<div class="show-adds-btns" style="width:200px;" ><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="" data-toggle="tooltip" data-placement="bottom" title="Tribute">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
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
function showmessage() {
    var noOfDivs = $("#tabResults > div").filter(function() {
                        return $(this).css('display') == 'block';
                    }).length;
        //$("#searchResults").show();
    if(noOfDivs < 1) {
        $('.displayTab').show();
        $('#showTabMessage').html('There are no relationships yet');
        $('#myRelationships').css('display', 'none');
    }
}
function friendlist() {
    $("#searchResults").hide();
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
            var jsObject = JSON.parse(res);
            var html = "",
                buttonhtml = "'",
                formhtml = "",
                extrahtml = "",
                outgoinghtml = "",
                bothHtml = '',
                incominghtml = '',
                profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
            for (i = 0; i < jsObject.userDetails.length; i++) {
                var chk = 0,
                    id = jsObject.userDetails[i].friendsid,
                    friendsname = jsObject.userDetails[i].friendsname,
                    uniqueuser = jsObject.userDetails[i].uniqueUser,
                    frndname = friendsname.toLowerCase(),
                    formhtml = '',
                    buttonhtml = '',
                    extrahtml = '';
                if ((jsObject.userDetails[i].profileimage == null) || (jsObject.userDetails[i].profileimage == '')) { // jshint ignore:line
                    profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg";
                } else  {
                    profileimage = jsObject.userDetails[i].profileimage;
                }
                if (jsObject.userDetails[i].status == 'outgoing') {
                    //alert(1);
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-warning full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-clock-o"></div> Request sent</button></div>';
                    //outgoinghtml += '<div class="user-field m-t-25 animated fadeIn"><input type = "hidden" value = "'+friendsname+'"><div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3></div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                } else if(jsObject.userDetails[i].status == 'incoming') {
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/responserequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="pending-actions-btn text-right" user="client" data-folder-target-id="' + id + '"><button class="btnn btn e-btn btn-primary respondFriendRequest" id="acceptbtn' + id + '"><div class="fa fa-user-plus"></div> Accept </button>&nbsp;<button class="btnn btn e-btn btn-danger respondFriendRequest" id="declinebtn' + id + '"><div class="fa fa-user-times"></div> Decline </button></div>';
                    //incominghtml += '<div class="user-field m-t-25 animated fadeIn"><input type = "hidden" value = "'+friendsname+'">'+formhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" ><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3></div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                } else if(jsObject.userDetails[i].status == 'accepted') {
                    buttonhtml +='<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute" data-cmd="relationship">'+jsObject.userDetails[i].noOfTributes+'</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">'+jsObject.userDetails[i].friendslikes+'</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';
                    extrahtml += '<a class="e-link pointer">View Relationship Page</a>';
                } else if(jsObject.userDetails[i].status == 'declined') {
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-danger full sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div>Declined</button></div>';
                } else {
                    formhtml +='<form name="requestform" id="requestform" action="/friendrequests/sendingrequest" method="POST" enctype="multipart/form-data">';
                    buttonhtml +='<div class="relationship-btn" user="client" data-folder-target-id="' + id + '"><button class="btnn e-btn btn-info sendFriendRequest" id="requestbtn' + id + '"><div class="fa fa-plus"></div> Connect</button></div>';
                }
                html += '<div class="user-field m-t-25 animated fadeIn '+jsObject.userDetails[i].status+'"><input type = "hidden" value = "'+friendsname+'">'+formhtml+'<div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" href="/profile/showprofile/'+uniqueuser+'"><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+extrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                $('#searchResults').html(html);
                $('#tabResults').html(html);
            }
            $('#loader').css('display','none');
            $("#allTab").trigger("click");
        }
    });
    }
}
