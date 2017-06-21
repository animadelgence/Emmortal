
/*
 * @Author: Rajyasree
 * @Date:   2017-06-21 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-06-21 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl*/
$(document).ready(function () {
    "use strict";
    $("#allTab").trigger("click");
    //alert('search moda js calling');
    $('body').on('click', '#allTab', function () {
        alert();
        $('#allTabShow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#relationshipTab', function () {
        $('#relationshipTabShow').css('display', 'block');
        $('#allTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#incomingTab', function () {
        $('#incomingTabShow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#allTabShow').css('display', 'none');
        $('#outgoingTabshow').css('display', 'none');
    });
    $('body').on('click', '#outgoingTab', function () {
        $('#outgoingTabshow').css('display', 'block');
        $('#relationshipTabShow').css('display', 'none');
        $('#allTabShow').css('display', 'none');
        $('#incomingTabShow').css('display', 'none');
    });
});
