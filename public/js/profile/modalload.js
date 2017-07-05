var getUrl = window.location.origin;
$(function(){

});

function squarespaceModalopen()
{
    $.get(getUrl+"/modal/signupmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#squarespaceModal2').modal('hide');;
        $('#squarespaceModal').modal('show');
        if($('#datepickercustom').length)
           $('body').on('focus',"#datepickercustom", function(){
                $(this).datepicker({
               dateFormat: 'dd-mm-yy',
               changeMonth:true,
               changeYear:true,
               yearRange: '-100y:c+nn',
               maxDate: '-1d'
           });
});
    });
}
function squarespaceModal2open()
{
    $.get(getUrl+"/modal/loginmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#squarespaceModal').modal('hide');
        $('#squarespaceModal2').modal('show');

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
function addtributemodal() {
    if($('#tributeAddModal').length) {
        $('#tributeAddModal').remove();
    }
    $.get(getUrl+"/modal/tributeaddmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#tributeAddModal').modal('show');

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
function friendtributemodal() {
    $('#tributeAddModal').css('z-index','0');
    if($('#friendTributeAddModal').length) {
        $('#friendTributeAddModal').remove();
    }
    $.get(getUrl+"/modal/friendtributeaddmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#friendTributeAddModal').modal('show');
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
