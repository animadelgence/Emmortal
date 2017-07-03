/*
 * @Author: Anima
 * @Date:   2017-06-30 11:15:35
 * @Last Modified by:   Anima
 * @Last Modified time: 2017-06-30 16:46:35
 */
/*jslint browser: true*/
/*global $, jQuery, alert,  Aviary, currentImage, csdkImageEditor, console, launchImageEditor,validateFileType, loadtheuploadbutton, showTheEditButtons, elementclick,getUrl,arrowHideShow*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */

/*jslint eqeq: true*/
/*@Modal open*/
var getUrl = window.location.origin;
$(function () {
    "use strict";
    $('body').on('click', '.previewUploadedFile', function () {

        var count = $('.previewUploadedFile').length,
            liIndex = $(this).index(),
            datacmd = $(this).attr('data-cmd'),
            uploadId = $(this).data('id'),
            datasizey = $(this).attr('data-sizey'),
            datasizex = $(this).attr('data-sizex'),
            datacol = $(this).attr('data-col'),
            datarow = $(this).attr('data-row'),
            imageUrl = "",
            textTitle = "",
            textDescription = "",
            videoUrl = "",
            html = "",
            row = 1;
        row = rowCount();
        $.ajax({
            type: "POST",
            url: getUrl + '/albumdetails/getupload',
            data: {
                datacmd: datacmd,
                uploadId: uploadId
            },
            success: function (res) {
                jsObject = JSON.parse(res);
                var profileimage = "/image/profile-deafult-avatar.jpg";
                if(jsObject.uploadDetails[0].userimage !=''){
                    profileimage = jsObject.uploadDetails[0].userimage;
                }
                html +='<div class="col-md-12" style="margin:5px;background-color: #fff;margin-left: 21px;"><div class="col-md-1 item active"><img src="'+profileimage+'" style="border-radius: 25px;height:50px;width:50px;margin-top:22px;"alt="" title=""></div><div class="col-md-11 item active"><h2 style="font-size: 20px;">'+jsObject.uploadDetails[0].uploadTitle+'</h2><p>by '+jsObject.uploadDetails[0].username+' on '+jsObject.uploadDetails[0].dateTime+'</p></div></div><div class="col-md-12" style="min-height: 500px;margin-top:10px;padding:0px;"><div class="col-md-6" style="min-height: 200px;"><div class="col-md-12" style="min-height: 200px;margin: 5px;background-color: #fff;border: 1px solid #ddd;"><div class="item active" style="line-height: 1.42857143;background-color: #fff;border: 1px solid #ddd;border-radius: 4px;min-height: 200px;margin: 17px 7px 17px 7px;">';
                if (datacmd == 'text') {
                    var textTitle = jsObject.uploadDetails[0].uploadTitle;
                    var textDescription = jsObject.uploadDetails[0].uploadDescription;
                    html += '<p style="margin-left: 10px;margin-top: 5px;font-size: 20px;">' + textTitle + '</p><p style="margin-left: 10px;margin-top: 5px;">' + textDescription + '</p>';
                } else if (datacmd == 'image') {
                    var imageUrl = jsObject.uploadDetails[0].uploadPath;
                    html += '<img class="img-responsive" src="' + imageUrl + '" alt="...">';
                } else if (datacmd == 'video') {
                    var videoUrl = jsObject.uploadDetails[0].uploadPath;
                    html += '<video controls="controls" name="Video Name" id="" src="' + videoUrl + '" style="width:100%;height:100%;"></video>';
                }
                
              html +='</div></div><div class="col-md-12" style="margin-top: 20px;"><p>'+jsObject.uploadDetails[0].uploadDescription+'</p></div>';
                html +='<div class="col-md-12" style="margin-top:5px;border-bottom:1px solid #ddd;"><p><span>11</span> <strong>Responses</strong></p></div>';
                        html +='<div class="col-md-12" style="margin-top:5px;border-bottom:1px solid #ddd;"><div class="col-md-2 item active" style="padding: 0;"><img src="/image/profile-deafult-avatar.jpg" style="border-radius: 25px;height:50px;width:50px;margin-top:22px;"alt="" title=""></div><div class="col-md-10 item active"><h2 style="font-size: 20px;">commented By</h2><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p></div></div>';
                html +='</div>';
                html +='<div class="col-md-6" style="min-height:200px;"><div class="col-md-12" ><ul><li style="margin-top:5px;border-bottom:1px solid #ddd;"><span><img src="/image/like.png"><span> '+jsObject.uploadDetails[0].likeCount+' likes</span></span></li></ul></div></div></div>';
                if ($('#slidermodal').length > 0) {
                    $('#slidermodal').modal('show');
                    $('#appendDiv').html(html);
                    $("#appendDiv").show("slide", { direction: "left" }, 1000).parent().siblings().hide("slide", { direction: "left" }, 1000);
                    arrowHideShow(count, datasizey, datasizex, datacol, datarow);
                } else {
                    $.get(getUrl + "/modal/slidermodal.php", function (result) {
                        $('body').append(result);
                        $('#slidermodal').modal('show');
                        $('#appendDiv').html(html);
                        $("#appendDiv").show("slide", { direction: "left" }, 1000).parent().siblings().hide("slide", { direction: "left" }, 1000);
                        arrowHideShow(count, datasizey, datasizex, datacol, datarow);
                    });
                }
            }
        });
        
        
    });


    $('body').on('click', '#nextDivContent', function () {
        var liindex = $('#appendDiv').index(),
            datasizey = $('#appendDiv').attr('data-sizey'),
            datasizex = $('#appendDiv').attr('data-sizex'),
            datacol = $('#appendDiv').attr('data-col'),
            datarow = $('#appendDiv').attr('data-row'),
            row = rowCount(),
            nextdatacol = "";
        for (var i = datarow; i <= row; i++) {
            var brk = 0;
            if(i==datarow){
                nextdatacol = parseInt(datacol, 10) + parseInt(1, 10);
            } else{
                nextdatacol =1;
            }
            for(var j= nextdatacol;j<=6;j++){
                var checkn = liPresentCheck(j, i);
                if (checkn == 1) {
                    $("#outer-wrap li[data-col='" + j + "'][data-row='" + i + "']").trigger('click');
                    brk = 1;
                    break;
                }
            }
            if (brk == 1) {
                break;
            }
        }
    });
    $('body').on('click', '#priviousDivContent', function () {
        var liindex = $('#appendDiv').index(),
            datasizey = $('#appendDiv').attr('data-sizey'),
            datasizex = $('#appendDiv').attr('data-sizex'),
            datacol = $('#appendDiv').attr('data-col'),
            datarow = $('#appendDiv').attr('data-row'),
            row = rowCount(),
            prevdatacol = "";
        for (var i = datarow; i >= 1; i--) {
            var brk = 0;
            if(i==datarow){
                prevdatacol = parseInt(datacol, 10) - parseInt(1, 10);
            } else{
                prevdatacol =6;
            }
            for(var j= prevdatacol;j>=1;j--){
                var checkn = liPresentCheck(j, i);
                if (checkn == 1) {
                    $("#outer-wrap li[data-col='" + j + "'][data-row='" + i + "']").trigger('click');
                    brk = 1;
                    break;
                }
            }
            if (brk == 1) {
                break;
            }
        }
    });

    function liPresentCheck(nextCol, datarow) {
        if ($("#outer-wrap li[data-col='" + nextCol + "'][data-row='" + datarow + "']").length > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    function rowCount() {
        var row = 1;
        $('#outer-wrap li').each(function () {
            var position = $(this).attr('data-row');
            if (position > row) {
                row = position;
            }
        });
        return row;
    }

    function arrowHideShow(count, datasizey, datasizex, datacol, datarow) {
        $('#appendDiv').attr('data-sizey', datasizey);
        $('#appendDiv').attr('data-sizex', datasizex);
        $('#appendDiv').attr('data-col', datacol);
        $('#appendDiv').attr('data-row', datarow);
        var prevArrowShow = previousLiCount(count, datacol, datarow);
        var nextArrowShow = nextLiCount(count, datacol, datarow);
        if (prevArrowShow == 0 && nextArrowShow>0) {
            $('#priviousDivContent').hide();
            $('#nextDivContent').show();
        }
        if (prevArrowShow >0  && nextArrowShow==0){
            $('#priviousDivContent').show();
            $('#nextDivContent').hide();
        }
        if (prevArrowShow ==0  && nextArrowShow==0){
            $('#priviousDivContent').hide();
            $('#nextDivContent').hide();
        }
        if (prevArrowShow >0  && nextArrowShow>0){
            $('#priviousDivContent').show();
            $('#nextDivContent').show();
        }
    }
    function nextLiCount(cnt, datacol, datarow){
        var count = 0,
            nextdatacol="",
            nextdatarow="";
        for (var i = datarow; i <= cnt; i++) {
            if(i==datarow){
                nextdatacol = parseInt(datacol, 10) + parseInt(1, 10);
                nextdatarow = datarow;
            } else{
                nextdatacol =1;
            }
            for(var j= nextdatacol;j<=6;j++){
                var checkn = liPresentCheck(nextdatacol, nextdatarow);
                if (checkn == 1) {
                    count ++;
                }
            }
            nextdatarow = parseInt(nextdatarow, 10) + parseInt(1, 10);
        }
        return count;
    }
    function previousLiCount(cnt, datacol, datarow){
        var count = 0,
            prevdatacol="",
            prevdatarow="";
        for (var i = datarow; i >= 1; i--) {
            if(i==datarow){
                prevdatacol = parseInt(datacol, 10) - parseInt(1, 10);
                prevdatarow = datarow;
            } else{
                prevdatacol =6;
            }
            for(var j= prevdatacol;j>=1;j--){
                var checkn = liPresentCheck(prevdatacol, prevdatarow);
                if (checkn == 1) {
                    count ++;
                }
            }
            prevdatarow = parseInt(prevdatarow, 10) - parseInt(1, 10);
        }
        return count;
        
    }
});