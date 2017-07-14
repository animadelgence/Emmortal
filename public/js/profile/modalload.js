/*
 * @Author: shilpita
 * @Date:   2017-06-19 18:46:35
 * @Last Modified by:   shilpita
 * @Last Modified time: 2017-06-19 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */
/*jshint -W065 */
/*jslint devel: true */
/*jslint eqeq: true*/
//$.noConflict();
var getUrl = window.location.origin;
$(function(){

});
var RandomNumber = Math.floor((Math.random() * 100) + 1);
function squarespaceModalopen()
{

    $.get(getUrl+"/modal/signupmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        //$.noConflict();
        $('#squarespaceModal2').modal('hide');
        $('#squarespaceModal').modal('show');
        if($('#datetimepicker1').length)
            {
            $('#datetimepicker1').datetimepicker({format: 'DD/MM/YYYY' });
            }
    });
}
function squarespaceModal2open()
{
    $.get(getUrl+"/modal/loginmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#squarespaceModal').modal('hide');
        $('#squarespaceModal2').modal('show');

    });
}

function relationshipsmodal()
{
//    if($('#relationshipsmodal').length) {
//        $('#relationshipsmodal').remove();
//    }
    var pageUrl = window.location.href;
    var pageUrlarray = pageUrl.split("/");
    var lastEl = pageUrlarray.slice(-1)[0];
    if(lastEl == ""){
            lastEl = "user";
    }
    //console.log(lastEl); return false;

    $.ajax({
        type: "POST",
        data : {
            userid : lastEl
        },
        url: getUrl + '/redirection/redirectuserdetails/'+lastEl,
        success: function (res) {
            //console.log(res); return false;
            var jsObject = JSON.parse(res),
                buttonhtml = '',
                extrahtml = '',
                html = '',
                jsObjectSecond = '';
            if(jsObject.sessionid != jsObject.tempuserid) {
                
                $.get(getUrl+"/modal/temprelationshipmodal.php?version="+RandomNumber, function (result) {
                    //alert();
                    //console.log(result); return false;
                    // append response to body
                    $('body').append(result);
                    $('#temprelationshipmodal').modal('show');
                    var name = $('.relationships').attr('data-name');
                    $(".firstName").html(name);
                    $.ajax({
                        type: "POST",
                        data : {
                            tempuserid  : jsObject.tempuserid
                        },
                        url: base_url_dynamic + '/redirection/searchrelationship',
                        success: function (res) {
                            //alert();
                            //console.log(res);return false;
                            jsObjectSecond = JSON.parse(res);
                            for (i = 0; i < jsObjectSecond.userDetails.length; i++) {
                                extrahtml = '',
                                buttonhtml = '';   
                                var id = jsObjectSecond.userDetails[i].friendsid,
                                    friendsname = jsObjectSecond.userDetails[i].friendsname,
                                    profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg",
                                    uniqueuser = jsObjectSecond.userDetails[i].uniqueUser;
                                if (jsObjectSecond.userDetails[i].profileimage != null) { // jshint ignore:line
                                    profileimage = jsObjectSecond.userDetails[i].profileimage;
                                }
                                buttonhtml +='<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute" data-cmd="relationship">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';

                                extrahtml += '<a class="e-link pointer">View Relationship Page</a>';

                                html += '<div class="user-field m-t-25 animated fadeIn"><input type = "hidden" value = "'+friendsname+'"><div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" href="/profile/showprofile/'+uniqueuser+'"><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+extrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                                $('#tempResult').html(html);
                            }
                        }
                    });
                });
            } else {
                $.get(getUrl+"/modal/relationshipsmodal.php?version="+RandomNumber, function (result) {
                    $('body').append(result);
                    $('#relationshipsmodal').modal('show');
                    var name = $('.relationships').attr('data-name');
                    $(".firstName").html(name);
                    //friendlist('AllFriend', '');
                    $.ajax({
                        type: "POST",
                        data : {
                            tempuserid  : jsObject.sessionid
                        },
                        url: base_url_dynamic + '/redirection/searchrelationship',
                        success: function (res) {
                            //alert();
                            //console.log(res);
                            jsObjectSecond = JSON.parse(res);
                            for (i = 0; i < jsObjectSecond.userDetails.length; i++) {
                                extrahtml = '',
                                buttonhtml = '';
                                var id = jsObjectSecond.userDetails[i].friendsid,
                                    friendsname = jsObjectSecond.userDetails[i].friendsname,
                                    profileimage = "/image/bg-30f1579a38f9a4f9ee2786790691f8df.jpg",
                                    uniqueuser = jsObjectSecond.userDetails[i].uniqueUser;
                                if (jsObjectSecond.userDetails[i].profileimage != null) { // jshint ignore:line
                                    profileimage = jsObjectSecond.userDetails[i].profileimage;
                                }
                                buttonhtml +='<div class="show-adds-btns" style="width:200px;" data-folder-target-id="' + id + '"><div class="inline btn e-btn btn-brown btn-round full getTribute" data-id="'+id+'" data-toggle="tooltip" data-placement="bottom" title="Tribute" data-cmd="relationship">0</div><div class="btn e-btn btn-round full btn-brown likeClick" data-id="'+id+'" data-cmd="friend" data-toggle="tooltip" data-placement="bottom" title="Like">0</div><div class="inline e-like btn e-btn btn-round full">0</div></div>';

                                extrahtml += '<a class="e-link pointer">View Relationship Page</a>';

                                html += '<div class="user-field m-t-25 animated fadeIn"><input type = "hidden" value = "'+friendsname+'"><div class="media-left media-middle"><img class="media-object user-img" src="' + profileimage + '" class="img-circle frnd-image-class"></div><div class="media-body media-middle"><h3 class="m-t-0"><a class="e-brown e-link" href="/profile/showprofile/'+uniqueuser+'"><span class="friendsname">' + friendsname + '</span><input type="hidden" id="userid" name="userId" value="' + id + '"></a></h3>'+extrahtml+'</div><div class="media-right media-middle btn-section" id="btn-section'+ id + '" data-folder-target-id="' + id + '">'+buttonhtml+'</div></form></div>';
                                $('#tabResults').html(html);
                            }
                        }
                    });
                });
            }
        }
    });

    /*$.get(getUrl+"/modal/relationshipsmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        
       /* $('#relationshipsmodal').modal('show');
        var name = $('.relationships').attr('data-name');
        $(".firstName").html(name);
        friendlist('AllFriend', '');*/

    //});*/
}

function tributedetailsmodal()
{
    if($('#tributedetailsmodal').length) {
        $('#tributedetailsmodal').remove();
    }
    $.get(getUrl+"/modal/tributedetailsmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        var pageUrl = window.location.href;
        var pageUrlarray = pageUrl.split("/");
        var lastEl = pageUrlarray.slice(-1)[0];
        if(lastEl == ""){
            lastEl = "user";
        }
        //console.log(lastEl); return false;
        $('body').append(result);
        // open modal
        $('#tributedetailsmodal').modal('show');
        var name = $('.relationships').attr('data-name');
        $(".firstName").html(name);
       // friendlist('AllFriend', '');

    });
}


function albumdetailsmodal()
{
    if($('#albumdetailsmodal').length) {
        $('#albumdetailsmodal').remove();
    }
    $.get(getUrl+"/modal/albumdetailsmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        var pageUrl = window.location.href;
        var pageUrlarray = pageUrl.split("/");
        var lastEl = pageUrlarray.slice(-1)[0];
        if(lastEl == ""){
            lastEl = "user";
        }
        //console.log(lastEl); return false;
        $('body').append(result);
        // open modal
        $('#albumdetailsmodal').modal('show');
        var name = $('.relationships').attr('data-name');
        var id = $('.relationships').attr('id');
        var encodeUploadIdStatic = btoa('1');
        $.ajax({
        type: "POST",
        url: getUrl + '/album/fetchallalbum/'+lastEl,
        success: function (res) {
            //console.log(res);
            var jsObject = JSON.parse(res);
                 var   i = 0;
                 var   appendHtml = "";
                 var k = jsObject.uploadDetails.length;
                 if(k){
                    appendHtml += '<div class="m-t-5 ng-scope"><div class="album-preview ng-isolate-scope"><div class="album-preview-cover-wrapper m-r-10"><img class="img-responsive" src="'+getUrl+'/image/no_cover-e343970a522a1599bd04bb0453d26b90.jpg"></div><div class="album-preview-info"><a class="album-preview-title font-bold e-link ng-binding" href="'+getUrl+'/createalbum/showafterpublishforstatic/'+encodeUploadIdStatic+'/'+lastEl+'">My chronicle</a><div class="e-brown m-b-10"><small class="album-preview-location"></small></div><div class="action-btns"><div tooltip-placement="bottom" tooltip="Likes" class="e-like btn e-btn btn-round full ng-binding ng-isolate-scope">0</div><div tooltip="Tributes" tooltip-placement="bottom" class="btn e-btn btn-brown btn-round full ng-binding ng-isolate-scope" content-id="47" >0</div></div></div>';
            appendHtml += '<div class="album-preview-collection">';
                
                for(var l = 0; l < k; l++){
                   
                if(l <3){
              
                    if(jsObject.uploadDetails[l].uploadDetails[0].uploadType == "image"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><img class="img-responsive" src="'+jsObject.uploadDetails[l].uploadDetails[0].uploadPath+'" style="height:100px%;"></div>';
                    } else if(jsObject.uploadDetails[l].uploadDetails[0].uploadType == "video"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><video controls="controls" name="Video Name" id="" src="'+jsObject.uploadDetails[l].uploadDetails[0].uploadPath+'" style="height: 102px;max-width: 100px;"></video></div>';
                    }
                          else if(jsObject.uploadDetails[l].uploadDetails[0].uploadType == "text"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><label name="text Name" style="height:100%;"><p>'+jsObject.uploadDetails[l].uploadDetails[0].uploadTitle+'</p><p>'+jsObject.uploadDetails[l].uploadDetails[0].uploadDescription+'</p></label></div>';
                    }

                }
                
}
  appendHtml += '</div>';
          appendHtml += '</div></div></div>';
      }
          

    var m = jsObject.albumValue.length;
      if(m){
        for(var n = 0; n < m; n++){
            var albumId = jsObject.albumValue[n].AID;
            
            var encodeUploadId = btoa(albumId);
                        appendHtml += '<div class="m-t-5 ng-scope"><div class="album-preview ng-isolate-scope"><div class="album-preview-cover-wrapper m-r-10"><img class="img-responsive" src="'+jsObject.albumValue[n].albumimagepath+'" style="height:100%;"></div><div class="album-preview-info"><a class="album-preview-title font-bold e-link ng-binding" href="'+getUrl+'/createalbum/showafterpublish/'+encodeUploadId+'/'+lastEl+'">'+jsObject.albumValue[n].title+'</a><div class="e-brown m-b-10"><small class="album-preview-location"></small></div><div class="action-btns"><div tooltip-placement="bottom" tooltip="Likes" class="e-like btn e-btn btn-round full ng-binding ng-isolate-scope">0</div><div tooltip="Tributes" tooltip-placement="bottom" class="btn e-btn btn-brown btn-round full ng-binding ng-isolate-scope" content-id="47" >0</div></div></div>';
            appendHtml += '<div class="album-preview-collection">';
                    var s = jsObject.albumValue[n].uploadDetails.length;
                    for(var t=0; t<s; t++){
                  if(jsObject.albumValue[n].uploadDetails[t].uploadType != "album"){ 
                if(t <= 3){
                    if(jsObject.albumValue[n].uploadDetails[t].uploadType == "image"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><img class="img-responsive" src="'+jsObject.albumValue[n].uploadDetails[t].uploadPath+'" style="height:100px;"></div>';
                    } else if(jsObject.albumValue[n].uploadDetails[t].uploadType == "video"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><video controls="controls" name="Video Name" id="" src="'+jsObject.albumValue[n].uploadDetails[t].uploadPath+'" style="height: 102px;max-width: 100px;"></video></div>';
                    }
                          else if(jsObject.albumValue[n].uploadDetails[t].uploadType == "text"){
                        appendHtml += ' <div class="image-wrapper ng-scope"><label name="text Name" style="height:100%;"><p>'+jsObject.albumValue[n].uploadDetails[t].uploadTitle+'</p><p>'+jsObject.albumValue[n].uploadDetails[t].uploadDescription+'</p></label></div>';
                    }
                }
                }
              }
                

        appendHtml += '</div>';
          appendHtml += '</div></div></div>';


}


           
        
          }
           $('.append_div').append(appendHtml);
        }
    });
        $(".firstName").html(name);

    });
}
function squarespaceModalemailopen()
{
    $.get(getUrl+"/modal/forgetpasswordmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#squarespaceModal2').modal('hide');
        $('#squarespaceModalemail').modal('show');

    });
}
function tributemodalopen()
{
    if($('#tributemodal').length) {
        $('#tributemodal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
    $.get(getUrl+"/modal/tributemodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#tributemodal').modal('show');
        $('#uploadModal').modal('hide');
        if($('#tributeDescription').length) {
            CKEDITOR.replace('tributeDescription', {
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
    });
}
function albummodalopen(){
    if($('#albumInsertModal').length) {
        $('#albumInsertModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
	$.get(getUrl+"/modal/albuminsertmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#albumInsertModal').modal('show');
        $('#uploadModal').modal('hide');
        if($('#albumtextDescription').length) {
            CKEDITOR.replace('albumtextDescription', {
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

    });
}

 function textmodalopen(){   
    if($('#textInsertModal').length) {
        $('#textInsertModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
    $.get(getUrl+"/modal/textinsertmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#textInsertModal').modal('show');
        $('#uploadModal').modal('hide');
        if($('#textDescription').length) {
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
        }
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/profile/getalbum',
            data: {},
            success: function (res) {
                $('.AID').html(res);
            }
        });

    });

}

function imagemodalopen(arrayvalue){
    if($('#photoInsertModal').length) {
        $('#photoInsertModal').remove();
    }
    /*if($('.in').length) {
        $('.in').remove();
    }*/
    $.get(getUrl+"/modal/imageinsertmodal.php?version="+RandomNumber, function (result) {
        $('#div-editphoto').hide();
        // append response to body
        $('body').append(result);
        // open modal
        $('#photoInsertModal').modal('show');
        if($('#imagetextDescription').length) {
            CKEDITOR.replace('imagetextDescription', {
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
        if(arrayvalue) {

            jsObject = JSON.parse(arrayvalue);
            $('#uploadId').val(jsObject.uploadId);
            $('#imageTitle').val(jsObject.uploadTitle);
            $('#imagetextDescription').val(jsObject.uploadDescription);
            $('#canvasPlaceholdeId').html('<img id= "profile_pic_thumb" src="'+jsObject.uploadPath+'" style="height:360px;width:100%"/>');
            $("#imagePath").val(jsObject.uploadPath);
            $("#aviaryPath").val(jsObject.uploadPath);
            $("#imageName").val(jsObject.uploadimagePath);
            $('#div-editphoto').show();
            //$("#listing :selected").val(jsObject.AID);
            $.ajax({
                    type: "POST",
                    url: base_url_dynamic + '/profile/getalbum',
                    data: {},
                    success: function (res) {
                        $('#listing').html(res);
                        $('#listing option[value="'+jsObject.AID+'"]').attr('selected', true);
                    }
            });

        }

    });


}
function addtributemodal(frndId,tributeType) {
    if($('#tributeAddModal').length) {
        $('#tributeAddModal').remove();
    }
    $.get(getUrl+"/modal/tributeaddmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#tributeAddModal').modal('show');
        $('#frndAddTributeBtn').attr('data-id',frndId);
        $('#frndAddTributeBtn').attr('data-cmd',tributeType);
    });
}

function onupdateTribute() {
    if($('#tributeUpdatemodal').length) {
        $('#tributeUpdatemodal').remove();
    }
    $.get(getUrl+"/modal/updatetributemodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        var name = $('.friendId').val();
        var tributedescription = $('.tributedescription').val();
        var friendId = $('.friendId').val();
        $('#tributeUpdatemodal').modal('show');
        $('.friendname').html(name);
        $('.frndId').val(friendId);
        if($('#tributeDescriptionUpdate').length) {
            
            CKEDITOR.replace('tributeDescriptionUpdate', {
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
            CKEDITOR.instances.tributeDescriptionUpdate.setData(tributedescription);
        }
    });
}
function friendtributemodal(frndId,tributeType) {
    $('#tributeAddModal').css('z-index','0');
    if($('#friendTributeAddModal').length) {
        $('#friendTributeAddModal').remove();
    }
    $.get(getUrl+"/modal/friendtributeaddmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#friendTributeAddModal').modal('show');
        $('#friendId').val(frndId);
        $('#tributeType').val(tributeType);
        if($('#friendtributeDescription').length) {
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
    });
}

function videomodalopen() {
    if($('#videoInsertModal').length) {
        $('#videoInsertModal').remove();
    }
    /*if($('.in').length) {
        $('.in').remove();
    }*/
    $.get(getUrl+"/modal/videoinsertmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#videoInsertModal').modal('show');
        if($('#videotextDescription').length) {
            CKEDITOR.replace('videotextDescription', {
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
    });
}
function errormodalopen(param,secondParam){
    if($('#errorModal').length) {
        $('#errorModal').remove();
    }
    if($('.modal-backdrop').length) {
        $('.modal-backdrop').remove();
    }
    $.get(getUrl+"/modal/errorModal.php?version="+RandomNumber, function (result) {

        // append response to body
        $('body').append(result);
        // open modal
        $('#errorModal').modal('show');
        $('#errorMessage').html(param);
        if(secondParam == 'image') {
            if($('.closebtn').length) {
                $('.closebtn').remove();
            }
            $('#onclickAppend').append('<i aria-hidden="true" class="fa fa-times closebtn" onclick="imagefunctionClick();"></i>');
        }
        if(secondParam == 'video') {
            if($('.closebtn').length) {
                $('.closebtn').remove();
            }
            $('#onclickAppend').append('<i aria-hidden="true" class="fa fa-times closebtn" onclick="videofunctionClick();"></i>');
        }
        if(secondParam == 'text') {
            if($('.closebtn').length) {
                $('.closebtn').remove();
            }
            $('#onclickAppend').append('<i aria-hidden="true" class="fa fa-times closebtn" onclick="textfunctionClick();"></i>');
        }
        if(secondParam == 'album') {
            if($('.closebtn').length) {
                $('.closebtn').remove();
            }
            $('#onclickAppend').append('<i aria-hidden="true" class="fa fa-times closebtn" onclick="albumfunctionClick();"></i>');
        }
        if(secondParam == 'tribute') {
            if($('.closebtn').length) {
                $('.closebtn').remove();
            }
            $('#onclickAppend').append('<i aria-hidden="true" class="fa fa-times closebtn" onclick="tributefunctionClick();"></i>');
        }
    });

}
function uploadmodalopen(){
    if($('#uploadModal').length) {
        $('#uploadModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
    $.get(getUrl+"/modal/uploadmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#uploadModal').modal('show');

    });

}
function searchmodalopen(){
    if($('#searchmodal').length) {
        $('#searchmodal').remove();
    }
    $.get(getUrl+"/modal/searchmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#searchmodal').modal('show');
        friendlist('AllFriend', '');

    });

}
function openalbumforedit(valid){
    //alert(valid);return false;
    var albumtitleid = $("#albumtitleid").text();
    var friendsidalbum = $("#friendsidalbum").val();
    var descriptionidalbum = $("#descriptionidalbum").val();
    var coloridalbum = $("#coloridalbum").val();
    var statusidalbum = $("#statusidalbum").val();
    var albumimagefullpath = $("#albumimagefullpath").attr('src');

    if($('#albumEditModal').length) {
        $('#albumEditModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }

    $.get(getUrl+"/modal/updatealbummodal.php", function (result) {

        // append response to body
        $('body').append(result);
        $('#albumpictureidedit').attr('src',albumimagefullpath);
        //$('#albumpictureidedit').css({"heigh","360px"},{"width","100%"});
        //$('#albumpictureidedit').css("width","100%");//lheight:360px;width:100%
        $("#albumTitle").val(albumtitleid);
        
        $("select#listing option").each(function(){
            $('.listshowclass').removeClass('addnew');
            if($(this).val() == statusidalbum){ 
                $(this).attr("selected","selected");
                $(this).addClass("addnew");    
            }
        });
        // open modal
        $('#albumEditModal').modal('show');
        $('#uploadModal').remove();
       // var friendsidalbum =
        if($('#albumtextDescription').length) {
            CKEDITOR.replace('albumtextDescription', {
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
        CKEDITOR.instances.albumtextDescription.setData(descriptionidalbum);

    });
}
$(document).ready(function () {
    if($('#welcomeAlert').length) {
        setTimeout(function () {
            $('#welcome').css('display','block');
            $('#welcome').css('top','-33px');
            $('#showmsg').html('Welcome!.');
        }, 500);
        $('body').on('click', '#close-msg', function () {
            $("#welcome").css('display','none');
        });
    }
});
