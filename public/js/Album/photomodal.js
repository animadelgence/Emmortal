
$(document).ready(function () {
    //alert();
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
    $('body').on('click', '#photoInsert', function () {
        $('.close').trigger('click');
        $('#imagetextTitleError').hide();
        $('#imagetextTitle').removeClass('error-class');
        $('#imagetextDescriptionError').hide();
        $('#imagetextDescription').removeClass('error-class');
        $.ajax({
            type: "POST",
            
            data: {},
            success: function (res) {
                $('#AID').html(res);
            }
        });
    });
});