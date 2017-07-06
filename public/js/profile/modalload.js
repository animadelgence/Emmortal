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

function squarespaceModalopen()
{
    var RandomNumber = Math.floor((Math.random() * 100) + 1);
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
    var RandomNumber = Math.floor((Math.random() * 100) + 1);
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
    if($('#relationshipsmodal').length) {
        $('#relationshipsmodal').remove();
    }
    var RandomNumber = Math.floor((Math.random() * 100) + 1);
    $.get(getUrl+"/modal/relationshipsmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#relationshipsmodal').modal('show');
        var name = $('.relationships').attr('data-name');
        $(".firstName").html(name);
        friendlist('AllFriend', '');

    });
}

function albumdetailsmodal()
{
    if($('#albumdetailsmodal').length) {
        $('#albumdetailsmodal').remove();
    }
    var RandomNumber = Math.floor((Math.random() * 100) + 1);
    $.get(getUrl+"/modal/albumdetailsmodal.php?version="+RandomNumber, function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#albumdetailsmodal').modal('show');
        var name = $('.relationships').attr('data-name');
        var id = $('.relationships').attr('id');
        $.ajax({
        type: "POST",
        url: getUrl + '/album/fetchAllAlbum',
        success: function (res) {
            var jsObject = JSON.parse(res);
                 var   i = 0;
                 var   appendHtml = "";
                 var i = jsObject.uploadDetails.length;
                    appendHtml += '<div class="m-t-5 ng-scope"><div class="album-preview ng-isolate-scope"><div class="album-preview-cover-wrapper m-r-10"><img class="img-responsive" src="'+getUrl+'/image/no_cover-e343970a522a1599bd04bb0453d26b90.jpg"></div><div class="album-preview-info"><a class="album-preview-title font-bold e-link ng-binding" href="">My chronicles</a><div class="e-brown m-b-10"><small class="album-preview-location"></small></div><div class="action-btns"><div tooltip-placement="bottom" tooltip="Likes" class="e-like btn e-btn btn-round full ng-binding ng-isolate-scope">0</div><div tooltip="Tributes" tooltip-placement="bottom" class="btn e-btn btn-brown btn-round full ng-binding ng-isolate-scope" content-id="47" >0</div></div></div><div class="album-preview-collection">';
           while(i == 3){
             appendHtml += ' <div class="image-wrapper ng-scope"><img class="img-responsive" src="'+jsObject.uploadDetails[0].uploadPath+'"></div></div>';

           }
          appendHtml += '</div></div></div></div>';
          
           $('.append_div').append(appendHtml);
        }
    });
        $(".firstName").html(name);

    });
}
function squarespaceModalemailopen()
{
    $.get(getUrl+"/modal/forgetpasswordmodal.php", function (result) {
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
    $.get(getUrl+"/modal/tributemodal.php", function (result) {
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
	$.get(getUrl+"/modal/albuminsertmodal.php", function (result) {
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
    $.get(getUrl+"/modal/textinsertmodal.php", function (result) {
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

    });

}

function imagemodalopen(){
    if($('#photoInsertModal').length) {
        $('#photoInsertModal').remove();
    }
    /*if($('.in').length) {
        $('.in').remove();
    }*/
    $.get(getUrl+"/modal/imageinsertmodal.php", function (result) {
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

    });


}
function addtributemodal(frndId,tributeType) {
    if($('#tributeAddModal').length) {
        $('#tributeAddModal').remove();
    }
    $.get(getUrl+"/modal/tributeaddmodal.php", function (result) {
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
    $.get(getUrl+"/modal/updatetributemodal.php", function (result) {
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
            //CKEDITOR.instances.tributeDescriptionUpdate.setData(tributedescription);
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
        }
    });
}
function friendtributemodal(frndId,tributeType) {
    $('#tributeAddModal').css('z-index','0');
    if($('#friendTributeAddModal').length) {
        $('#friendTributeAddModal').remove();
    }
    $.get(getUrl+"/modal/friendtributeaddmodal.php", function (result) {
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
    $.get(getUrl+"/modal/videoinsertmodal.php", function (result) {
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
function errormodalopen(param){
    if($('#errorModal').length) {
        $('#errorModal').remove();
    }
    $.get(getUrl+"/modal/errorModal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#errorModal').modal('show');
        $('#errorMessage').html(param);

    });

}
function uploadmodalopen(){
    if($('#uploadModal').length) {
        $('#uploadModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
    $.get(getUrl+"/modal/uploadmodal.php", function (result) {
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
    $.get(getUrl+"/modal/searchmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#searchmodal').modal('show');
        friendlist('AllFriend', '');

    });

}
function openalbumforedit(){
    if($('#albumInsertModal').length) {
        $('#albumInsertModal').remove();
    }
    if($('.in').length) {
        $('.in').remove();
    }
    $.get(getUrl+"/modal/albuminsertmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#albumInsertModal').modal('show');
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

    });
}
$(document).ready(function () {
    if($('#welcomeAlert').length) {
        setTimeout(function () {
            $('#welcome').css('display','block').fadeOut(10000, function () {});
            $('#welcome').css('top','-33px');
            $('#showmsg').html('Welcome!.');
        }, 500);
        return false;
    }
    $('body').on('click', '.close-msg', function () {
        $('#welcome').css('display','none');
        $(this).parents('body').children('#photoInsertModal').css('z-index','9999');
    });
});
