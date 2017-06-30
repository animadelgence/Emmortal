var getUrl = window.location.origin;
$(function(){

});
function albummodalopen(){
    if($('#albumInsertModal').length) {
        $('#albumInsertModal').remove();
    }
	$.get(getUrl+"/modal/albuminsertmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#albumInsertModal').modal('show');
        $('#uploadModal').modal('hide');

    });
}

function squarespaceModalopen()
{
    $.get(getUrl+"/modal/signupmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#squarespaceModal2').modal('hide');;
        $('#squarespaceModal').modal('show');

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
 function textmodalopen(){   
    if($('#textInsertModal').length) {
        $('#textInsertModal').remove();
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

function videomodalopen(){
    if($('#videoInsertModal').length) {
        $('#videoInsertModal').remove();
    } 
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
        //$('#uploadModal').modal('hide');
        /*if($('#videoDescription').length) {
            CKEDITOR.replace('videoDescription', {
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
         }*/

    });
    

}
function uploadmodalopen(){
    if($('#uploadModal').length) {
        $('#uploadModal').remove();
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

    });

}
