/*
 * @Author: Shubhadip
 * @Date:   2017-06-29 11:16:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-29 10:52:26
 */
/*jslint browser: true */
/*global $, jQuery, alert */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global radix:true,base_url_dynamic */
var base_url_dynamic = window.location.origin;
$(document).ready(function () {
    "use strict";
    /*setInterval(function () {
        $.get("demo_test.asp", function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        });
    }, 3000);*/
    $('body').on('click', '.notification-click', function () {
        if ($("#notification-div").is(':visible')) {
            $('#notification-div').hide('show');
        } else {
            $.get(base_url_dynamic + "/modal/notificationmodal.php", function (result) {
                $('#notification-div').html(result);
                $('#notification-div').slideToggle('show');
            });
        }
    });
});