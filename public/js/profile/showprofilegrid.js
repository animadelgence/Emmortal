

var gridster = "";

$(function () {
    gridster = $(".gridster ul").gridster({
        namespace: '.gridster',
        widget_base_dimensions: [182, 181],
        widget_margins: [10, 10],
      
        collision: {
					wait_for_mouseup: true
				},
        max_cols: 6
    }).data('gridster').disable();
});