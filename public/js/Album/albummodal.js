/*
 * @Author: Maitrayee
 * @Date:   2017-06-30 17:46:35
 * @Last Modified by:   Maitrayee
 * @Last Modified time: 2017-06-30 16:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
var base_url_dynamic = window.location.origin;
$(document).ready(function () {
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
    $('body').on('click','#colordropdown',function(){
        //$(this).toggle(function(){
            if($(this).hasClass('open'))
            {
                $(this).removeClass('open');
            }
            else{
               $(this).addClass('open'); 
            }
            

          //  });
    });
});
function albumClick()
{
    $('#uploadModal').modal('show');
    $('#albumInsertModal').modal('hide');
}
