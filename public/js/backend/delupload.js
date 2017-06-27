/*
 * @Author: Rituparna
 * @Date:   2017-06-22 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-23 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jslint eqeq: true*/
/*global baseUrl, FileReader*/
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */

/*Popup Appear When clicked on Delete Upload Icon*/
$(".delUpload").on('click', function (event) {
    "use strict";
    var uploadId = $(this).parent().prev().val();
    $('#hidden_uploadid').val(uploadId);
    $("#dynamicdeluploadpopup").fadeIn();
});
