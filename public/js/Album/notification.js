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
    
    setInterval(function () {
        if($('.notification-click').length>0){
            getNotification();
        } else{
            console.log("Please Log In");
        }
    }, 2000);
    
    $('body').on('click', '.notification-click', function () {
        if ($("#notification-div").is(':visible')) {
            $('#notification-div').hide('show');
        } else {
            $.get(base_url_dynamic + "/modal/notificationmodal.php", function (result) {
                $('#notification-div').html(result);
                getNotification();
                $('#notification-div').slideToggle('show');
            });
        }
    });
    $('body').on('click', '.not-seen', function () {
        var notificationid = $(this).data("id");
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: getUrl + '/notification/notificationupdate',
            data: {
                notificationid : notificationid,
                notificationupdate : "single"
            },
            success: function (res) {
                $this.removeClass('not-seen').addClass('seen');
            }
        });
    });
    $('body').on('click', '.all-seen', function () {
        $.ajax({
            type: "POST",
            url: getUrl + '/notification/notificationupdate',
            data: {
                notificationid : '',
                notificationupdate : "all"
            },
            success: function (res) {
                $('.e-notification').removeClass('not-seen').addClass('seen');
                $('#notification-count').text(res);
                if(res>0){
                    $('#noticnt').text(res);
                } else{
                    $('#noticnt').text('');
                }
            }
        });
    });
    function getNotification(){
        $.ajax({
            type: "POST",
            url: getUrl + '/notification/getnotification',
            data: {
            },
            success: function (res) {
                var appengHtml="";
                jsObject = JSON.parse(res);
                for(var i=0;i<jsObject.notificationDetails.length;i++){
                    appengHtml += jsObject.notificationDetails[i].html;
                } 
                if(jsObject.notificationDetails.length>0){
                     $('#all-notification').html(appengHtml);
                     $('#all-notification').css('display','block');
                     $('#notificationPresent').css('display','block');
                     $('#notification-count').text(jsObject.notificationDetails[0].unread);
                     if(jsObject.notificationDetails[0].unread>0){
                        $('#noticnt').text(jsObject.notificationDetails[0].unread);
                     } else{
                        $('#noticnt').text('');
                     }
                     $('#no-notification').css('display','none');
                } 
            }
        });
    }
});