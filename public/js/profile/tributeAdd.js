/*
 * @Author: Shubhadip
 * @Date:   2017-06-14 17:46:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-21 17:27:26
 */
/*jslint browser: true */
/*global $, jQuery, alert,CKEDITOR */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global radix:true */
var base_url_dynamic = window.location.origin,
    jsObject = "";
$(document).ready(function () {
    "use strict";
    $('body').on('blur', '.modal-dialog', function () {
        alert();
        /*$.ajax({
            type: "POST",
            url: base_url_dynamic + '/profile/getalbum',
            data: {},
            success: function (res) {
                $('.AID').html(res);
            }
        });*/
    });

});
