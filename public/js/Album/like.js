/*
 * @Author: Shubhadip
 * @Date:   2017-06-19 17:46:35
 * @Last Modified by:   Shubhadip
 * @Last Modified time: 2017-06-19 10:52:26
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
    $('[data-toggle="tooltip"]').tooltip();
    $('body').on('click', '.likeClick', function () {
        var datacmd = $(this).attr('data-cmd'),
            id = $(this).data('id'),
            $likeClick = $(this),
            likevalue = $(this).text(),
           colorvalue =$likeClick.css("background-color");
           alert(colorvalue);
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/albumdetails/likesave',
            data: {
                datacmd: datacmd,
                id: id
            },
            success: function (res) {
                if($("#lkcnt").is(':visible') == true){
                    $("#lkcnt").text(res);
                } else{
                    $likeClick.text(res);
                    if (parseInt(likevalue, 10) < parseInt(res, 10)) {
                        $likeClick.css('background', '#b4504e');
                    } else {
                        $likeClick.css('background-color', colorvalue);
                    }
                }
            }
        });
    });
 });
