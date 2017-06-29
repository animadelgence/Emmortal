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
            likevalue = $(this).text();
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/albumdetails/likesave',
            data: {
                datacmd: datacmd,
                id: id
            },
            success: function (res) {
                $likeClick.text(res);
                if (parseInt(likevalue, 10) < parseInt(res, 10)) {
                    $likeClick.css('background', '#b4504e');
                } else {
                    $likeClick.css('background', '#aaa897');
                }
            }
        });
    });
    $('body').on('click', '.previewUploadedFile', function () {
        var uploadId = $(this).data("id"),
            uploadType = $(this).attr('data-cmd'),
            jsObject = "";
        $.ajax({
            type: "POST",
            url: base_url_dynamic + '/albumdetails/getupload',
            data: {
                uploadId: uploadId
            },
            success: function (res) {
                jsObject = JSON.parse(res);
                if (uploadType == 'text') {
                    $('#textTitleLabel').text(jsObject.uploadDetails[0].uploadTitle);
                    $('#textuploadedBy').text(jsObject.uploadDetails[0].username);
                    $('#textTitleDescription').html(jsObject.uploadDetails[0].uploadDescription);
                    $('#textUploadedDate').text(jsObject.uploadDetails[0].dateTime);
                    $('#TextLikeCount').text(jsObject.uploadDetails[0].likeCount);
                    $('#TextLikeCount').attr('data-id', uploadId);
                    $('#textPreviewModal').modal('show');
                } else if (uploadType == 'image') {
                    $('#imagelink').attr('src', jsObject.uploadDetails[0].uploadPath);
                    $(".fancyboxanchor").attr('href', jsObject.uploadDetails[0].uploadPath);
                    $('#imageTitleLabel').text(jsObject.uploadDetails[0].uploadTitle);
                    $('#imageuploadedBy').text(jsObject.uploadDetails[0].username);
                    $('#imageDescription').html(jsObject.uploadDetails[0].uploadDescription);
                    $('#imageUploadedDate').text(jsObject.uploadDetails[0].dateTime);
                    $('#ImageLikeCount').text(jsObject.uploadDetails[0].likeCount);
                    $('#ImageLikeCount').attr('data-id', uploadId);
                    $('#imagePreviewModal').modal('show');
                } else if (uploadType == 'video') {
                    $('#videolink').attr('src', jsObject.uploadDetails[0].uploadPath);
                    $('#videoTitleLabel').text(jsObject.uploadDetails[0].uploadTitle);
                    $('#videouploadedBy').text(jsObject.uploadDetails[0].username);
                    $('#videoDescription').html(jsObject.uploadDetails[0].uploadDescription);
                    $('#videoUploadedDate').text(jsObject.uploadDetails[0].dateTime);
                    $('#videoLikeCount').text(jsObject.uploadDetails[0].likeCount);
                    $('#videoLikeCount').attr('data-id', uploadId);
                    $('#videoPreviewModal').modal('show');
                }
            }
        });
    });


 $('body').on('click', '.imagepreview', function () {

var imageSrc = $(this).parents().find("#imagelink").attr("src");

$(".showmodalimagepreview").attr("src", imageSrc);


 });


});
