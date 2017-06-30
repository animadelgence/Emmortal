/*
 * @Author: Anima
 * @Date:   2017-06-29 10:46:35
 * @Last Modified by:   shilpita
 * @Last Modified time: 2017-06-29 16:46:35
 */
/*jslint browser: true*/
/*global $, jQuery, alert,  Aviary, currentImage, csdkImageEditor, console, launchImageEditor,validateFileType, loadtheuploadbutton, showTheEditButtons, elementclick*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */

/*jslint eqeq: true*/
function getRandomSize(min, max) {
    return Math.round(Math.random() * (max - min) + min);
}
var gridster = "";

$(function () {
    gridster = $(".gridster ul").gridster({
        namespace: '.gridster',
        widget_base_dimensions: [182, 181],
        widget_margins: [10, 10],
        max_cols: 6
    }).data('gridster').disable();
});


/*

for (var i = 0; i < 25; i++) {
  var width = getRandomSize(200, 400);
  var height =  getRandomSize(200, 400);
  $('#photos').append('<img src="//www.lorempixel.com/'+width+'/'+height+'/cats" alt="pretty kitty">');
}

    TwitterFacebookPocket*/
