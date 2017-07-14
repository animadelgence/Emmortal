var gridster = "";
var base_url_dynamic = window.location.origin;


$(function () {
    
    var pageUrl = window.location.href;
    var pageUrlarray = pageUrl.split("/");
    var lastEl = pageUrlarray.slice(-1)[0];

    $.ajax({
        type: "POST",
        data : {
            userid : lastEl
        },
        url: base_url_dynamic + '/redirection/redirectuserdetails',
        success: function (res) {
            //alert(res);
            var jsObject = JSON.parse(res);
            if(jsObject.sessionid != jsObject.tempuserid) {
                    gridster = $(".gridster ul").gridster({
                    namespace: '.gridster',
                    widget_base_dimensions: [182, 181],
                    widget_margins: [10, 10],
                         max_cols: 6

                }).data('gridster').disable();
                
            } else {
                gridster = $(".gridster ul").gridster({
        
        namespace: '.gridster',
        widget_base_dimensions: [182, 181],
        widget_margins: [10, 10],
        resize: {
        enabled: true,
        max_size: [2, 2],

        stop: function (e, ui, $widget) {
            var newDimensions = this.serialize($widget)[0];
            var width =  newDimensions.size_x;
            var height =  newDimensions.size_y;
            var sizeX = "";
            var sizeY = "";
                if(height >= 2){
                    height = 2;
                    sizeY = "W";
                } else {
                     height = 1;
                     sizeY = "H";
                }
                if(width >= 2){
                    width = 2;
                    sizeX = "W";
                } else {
                     width = 1;
                     sizeX = "H";
                }

            var uploadId =  $widget.attr("data-id");
            $.ajax({
                type: "POST",
                //async:false,
                url: base_url_dynamic + '/profile/savefilestatus',
                data: {sizeX:sizeX,sizeY:sizeY,uploadId:uploadId},
                success: function (res) {

                }
            });
   
        }
    },
             max_cols: 6
      
    }).data('gridster').disable();
                
                $('.vid-sec').hover(function() {
   
    if(!$(this).find('.tile-show-settings-btn').length){
        $(this).removeClass('previewUploadedFile');
    $(this).append('<div class="tile-show-settings-btn" style="opacity: 1;"></div>');
}
});

$('.vid-sec').mouseleave(function() {
    $(this).addClass('previewUploadedFile');
   $(this).find('.tile-show-settings-btn').remove();
});
 $('body').on('click', '.tile-show-settings-btn', function () {
    $(this).append('<div class="settings-wrapper ng-scope"><div class="tile-edit-buttons"><i class="fa fa-trash delete-button"></i><span class="ng-scope"><i tooltip-placement="bottom" tooltip="Edit tile" class="fa fa-pencil edit-button ng-scope"></i></span><i class="fa fa-arrows drag-handle"></i></div></div>');
    });

                
                
            }
        }
    });
    $('body').on('click', '.delete-button', function () {
       var dataid = $(this).parents('.user_upload_part_section_content--inside').find("img").attr('id');
        $('#popuppopupfordelete').fadeIn();
        $('#popupSpan2').html('Are you sure you want to delete this data?');
        $(".confirmation").click(function () {
            $.ajax({
                type: "POST",
                url: base_url_dynamic + '/uploadoperation/deletedata',
                data: {dataid : dataid},
                success: function (res) {
                    $('#popuppopupfordelete').fadeOut();
                    if(res == 1) {
                        window.location.reload();
                    }
                }
            });
        });   
    });
    $('body').on('click', '.edit-button', function () {
        var dataid = $(this).parents('.user_upload_part_section_content--inside').find("img").attr('id');
        $.ajax({
                type: "POST",
                url: base_url_dynamic + '/uploadoperation/opendata',
                data: {dataid : dataid},
                success: function (res) {
                    console.log(res);
                    imagemodalopen(res);
                }
            });
    });

});
