var gridster = "";
var base_url_dynamic = window.location.origin;

$(function () {
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

});