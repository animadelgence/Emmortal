/*
 * @Author: Anima
 * @Date:   2017-06-19 18:46:35
 * @Last Modified by:   Anima
 * @Last Modified time: 2017-06-19 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */
/*jshint -W065 */
/*jslint devel: true */
/*jslint eqeq: true*/
$(function () {
    var baseUrl = window.location.origin;
    $("body").on("click", ".add-page-btn", function () {
        $.ajax({
            type: "POST",
            url: baseUrl + "/page/newpagecreate",
            success: function (result) {
                var jsObject = JSON.parse(result);
                $(".close-new").trigger("click");
                if (jsObject.noredirect == 1) {
                    window.location.href(baseUrl + "/profile/showprofile");
                } else {
                    if($(".profile-paginator").length){
                    $(".profile-paginator ul").append('<li class="profile-paginator__click" data-fetch-id="' + jsObject.gotostep + '"></li>');
                    }
                    else{
                        $(".user_profile_section").append('<div class="profile-paginator"><ul><li data-fetch-id="'+$("#currentPageId").val()+'" class="profile-paginator__click"></li><li data-fetch-id="'+jsObject.gotostep+'" class="profile-paginator__click "></li></ul></div>');
                    }
                    $(".profile-paginator ul li:last").trigger("click");
                    $("#currentPageId").val(jsObject.gotostep);
                }
            }

        });
    });
    $("body").on("click", ".profile-paginator__click", function () {
        var getClickedId = $(this).attr("data-fetch-id"),
            prevSelection = $(".profile-paginator__click").parent('ul').find('.active').index(),
            currentClicked = $(this).index();
        $("#currentPageId").val(getClickedId);
        if(currentClicked > prevSelection) {
                   $(".container-of-sections").addClass('classuptodownhide');
                }
                else {
					$(".container-of-sections").addClass('classdowntouphide');
                }
        $(".profile-paginator__click").removeClass('active');
        $(this).addClass('active');
        $.ajax({
            type: "POST",
            data: {
                pageid: getClickedId
            },
            url: baseUrl + "/page/selectpage",
            success: function (result) {
                var jsObject = JSON.parse(result),
                    i = 0,
                    appendHtml = "";

				if(currentClicked > prevSelection) {
					appendHtml = "<div class='container-of-sections classuptodownvisible'>";
				} else {
					appendHtml = "<div class='container-of-sections classdowntoupvisible'>";
				}
                appendHtml += "<div class='gridster ready'><ul class='outer-wrap' id='outer-wrap'>";

                if (jsObject.defaultPage == 1) {
                    if(jsObject.profileImage!=1)
                    appendHtml += '<li class="user_profile_image_section" data-col="1" data-row="1"><img src="' + jsObject.profileImage + '"></li><li class="user_profile_name_section" data-col="1" data-row="1"><span>' + jsObject.DOB + '</span><br><span>' + jsObject.Name + '</span></li>';
                }
                if (jsObject.NoPage == 1) {
                    appendHtml += '<li class="user_upload_part_section no-resize" data-col="1" data-row="1" data-sizex="2" data-sizey="1"><div  onclick="uploadmodalopen();" href="javascript:void(0);" class="fa fa-plus add-page-plus-icon"></div><div class=""><p>Add your Life moments: upload photos and videos.</p><p>Create Albums, Tributes and add valuable texts.</p><p>"Add" button is always accessible on right top menu.</p></div></li>';
                } else {
                  // appendHtml += '<div class="user_upload_part_section_content">';
                    for (i = 0; i < jsObject.uploaddetails.length; i++) {
                        if(jsObject.uploaddetails[i].uploadType == "video"){

                                    appendHtml +='<li class="gs-w user_upload_part_section_content--inside vid-sec resizable previewUploadedFile" data-col="1" data-row="1" data-cmd="video" data-sizey="'+jsObject.uploaddetails[i].sizeY+'" data-sizex="'+jsObject.uploaddetails[i].sizeX+'" data-id="'+jsObject.uploaddetails[i].uploadId+'"><span><video controls="controls" name="Video Name" id="" src="'+jsObject.uploaddetails[i].uploadPath+'" style="width:100%;height:100%;"></video></span><div class="inner-box"> 0 </div></li>';
                         } else if(jsObject.uploaddetails[i].uploadType == "image"){
                            
                                 appendHtml +='<li class="gs-w user_upload_part_section_content--inside vid-sec resizable previewUploadedFile" data-col="1" data-row="1" data-cmd="video" data-sizey="'+jsObject.uploaddetails[i].sizeY+'" data-sizex="'+jsObject.uploaddetails[i].sizeX+'" data-id="'+jsObject.uploaddetails[i].uploadId+'"><span><img name="Image Name" id="" src="'+jsObject.uploaddetails[i].uploadPath+'" style="width:100%;height:100%;"></span><div class="inner-box"> 0 </div><input type="hidden" class="uploadId" value="'+jsObject.uploaddetails[i].uploadId+'"></li>';
                        } else if(jsObject.uploaddetails[i].uploadType == "text"){
                             appendHtml +='<li class="gs-w user_upload_part_section_content--inside vid-sec text-sec resizable previewUploadedFile" data-col="1" data-row="1" data-cmd="video" data-sizey="'+jsObject.uploaddetails[i].sizeY+'" data-sizex="'+jsObject.uploaddetails[i].sizeX+'" data-id="'+jsObject.uploaddetails[i].uploadId+'"><span><label name="text Name">'+jsObject.uploaddetails[i].uploadPath+'</label></span><div class="inner-box"> 0 </div><input type="hidden" class="uploadId" value="'+jsObject.uploaddetails[i].uploadId+'"></li>';
                        } else{

                        }
                        
                        }
                       
                    //appendHtml+= '</div>';
                }
                 appendHtml+= '</ul></div>';
                appendHtml += "</div>";
                $(".container-of-sections").remove();
                    $(".user_profile_section").prepend(appendHtml);

                    $item = $(".profile-paginator__click.active");


                    /* Gridster setup code */
                    var gridster = $(".gridster ul").gridster({
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
                url: baseUrl + '/profile/savefilestatus',
                data: {sizeX:sizeX,sizeY:sizeY,uploadId:uploadId},
                success: function (res) {

                }
            });
   
        }
    },
             max_cols: 6
      
    }).data('gridster').disable();
                    
                /*$(".user_profile_section .container-of-sections").css(fadeOUT).slideUp(1500, function() {
                    $(".user_profile_section").html(appendHtml);
                    $(".user_profile_section .container-of-sections").css(fadeIN).slideUp(1000);
                });*/
                
            }

        });

    });

});
