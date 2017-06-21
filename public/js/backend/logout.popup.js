/*
 * @Author: Rituparna
 * @Date:   2017-02-8 17:46:35
 * @Last Modified by:   Rituparna
 * @Last Modified time: 2017-04-24 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl*/
$(function () {
    "use strict";

    $("#date-popover").hide();
    $("#date-popover").click(function (e) {
        $(this).hide();
    });

    $(".logout_popup").click(function () {
        $('#dynamicpagecreatepopuppopup').fadeIn();
    });

});

function myNavFunction(id) {
    "use strict";

    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation"),
        to = $("#" + id).data("to");
}

