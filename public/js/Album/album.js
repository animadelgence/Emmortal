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
        if (datacmd == 'text') {
            textTitle = $(this).children().children().children('p:first-child').text();
            textDescription = $(this).children().children().children().next().text();
            html += '<p>' + textTitle + '</p><p>' + textDescription + '</p>';
        } else if (datacmd == 'image') {
            imageUrl = $(this).children().children().attr('src');
            html += '<img class="img-responsive" src="' + imageUrl + '" alt="...">';
        } else if (datacmd == 'video') {
            videoUrl = $(this).children().children().attr('src');
            html += '<video controls="controls" name="Video Name" id="" src="' + videoUrl + '" style="width:100%;height:100%;"></video>';

        }
        if ($('#slidermodal').length > 0) {
            $('#slidermodal').modal('show');
            $('#appendDiv').html(html);
            arrowHideShow(liIndex, count, datasizey, datasizex, datacol, datarow);
        } else {
            $.get(getUrl + "/modal/slidermodal.php", function (result) {
                $('body').append(result);
                $('#slidermodal').modal('show');
                $('#appendDiv').html(html);
                arrowHideShow(liIndex, count, datasizey, datasizex, datacol, datarow);
            });
        }
    });


    $('body').on('click', '#nextDivContent', function () {
        var liindex = $('#appendDiv').index(),
            datasizey = $('#appendDiv').attr('data-sizey'),
            datasizex = $('#appendDiv').attr('data-sizex'),
            datacol = $('#appendDiv').attr('data-col'),
            datarow = $('#appendDiv').attr('data-row'),
            row = rowCount(),
            nextdatarow="",
            nextdatacol="",
            nextCol = parseInt(datacol,10) + parseInt(datasizex,10);
        for(var i=datarow;i<=row;i++){
            var brk= 0;
            console.log(nextCol);
            if(nextCol>6){
                nextdatarow = parseInt(datarow,10) + parseInt(1,10);
                nextdatacol= 1;
                console.log("Here");
                console.log("nextdatacol--"+nextdatacol+"--nextdatarow--"+nextdatarow);
                for(var k= nextdatacol;k<=6;k++){
                    nextdatarow=nextdatarow;
                    nextdatacol=k;
                    var checkn = liPresentCheck(nextdatacol,nextdatarow);
                    console.log(checkn);
                    console.log("datacol--"+nextdatacol+"--datarow--"+nextdatarow);
                    if(checkn==1){
                        $("#outer-wrap li[data-col='"+nextdatacol+"'][data-row='"+nextdatarow+"']").trigger('click');
                        brk=1;
                        break;
                    }
                }
                
            } else{
                for(var j= nextCol;j<=6;j++){
                    nextdatarow=datarow;
                    nextdatacol=j;
                    var check = liPresentCheck(nextdatacol,nextdatarow);
                    if(check==1){
                        $("#outer-wrap li[data-col='"+nextCol+"'][data-row='"+datarow+"']").trigger('click');
                        brk= 1;
                        //console.log("datacol--"+nextdatacol+"--datarow--"+nextdatarow);
                        break;
                    }
                }
            }
            if(brk == 1){
            break;
            }
        }
        
    });
    $('body').on('click', '#priviousDivContent', function () {
       /* var liindex = $('#appendDiv').index(),
            datasizey = $('#appendDiv').attr('data-sizey'),
            datasizex = $('#appendDiv').attr('data-sizex'),
            datacol = $('#appendDiv').attr('data-col'),
            datarow = $('#appendDiv').attr('data-row'),
            row = rowCount(),
            nextdatarow="",
            nextdatacol="",
            nextCol = parseInt(datacol,10) + parseInt(datasizex,10);
        for(var i=datarow;i<=row;i++){
            var brk= 0;
            if(nextCol>6){
                nextdatarow = parseInt(datarow,10) + parseInt(1,10);
                nextdatacol= 1;
                console.log("Here");
                console.log("nextdatacol--"+nextdatacol+"--nextdatarow--"+nextdatarow);
                for(var k= nextdatacol;k<=6;k++){
                    nextdatarow=nextdatarow;
                    nextdatacol=k;
                    var checkn = liPresentCheck(nextdatacol,nextdatarow);
                    console.log(checkn);
                    console.log("datacol--"+nextdatacol+"--datarow--"+nextdatarow);
                    if(checkn==1){
                        $("#outer-wrap li[data-col='"+nextdatacol+"'][data-row='"+nextdatarow+"']").trigger('click');
                        brk=1;
                        break;
                    }
                }
                
            } else{
                for(var j= nextCol;j<=6;j++){
                    nextdatarow=datarow;
                    nextdatacol=j;
                    var check = liPresentCheck(nextdatacol,nextdatarow);
                    if(check==1){
                        $("#outer-wrap li[data-col='"+nextCol+"'][data-row='"+datarow+"']").trigger('click');
                        brk= 1;
                        //console.log("datacol--"+nextdatacol+"--datarow--"+nextdatarow);
                        break;
                    }
                }
            }
            if(brk == 1){
            break;
            }
        }*/
        
    });
    function liPresentCheck(nextCol,datarow){
        if($("#outer-wrap li[data-col='"+nextCol+"'][data-row='"+datarow+"']").length>0){
            return 1;
        } else{
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

    function arrowHideShow(liIndex, count, datasizey, datasizex, datacol, datarow) {
        var lastcnt = "";
        if (count > 0) {
            lastcnt = parseInt(count, 10) - 1;
        }
        $('#appendDiv').attr('data-id', liIndex);
        $('#appendDiv').attr('data-sizey', datasizey);
        $('#appendDiv').attr('data-sizex', datasizex);
        $('#appendDiv').attr('data-col', datacol);
        $('#appendDiv').attr('data-row', datarow);
        if (count == 1) {
            $('#priviousDivContent').hide();
            $('#nextDivContent').hide();
        } else if (liIndex == 0 && count > 1) {
            $('#priviousDivContent').hide();
            $('#nextDivContent').show();
        } else if (liIndex == lastcnt) {
            $('#priviousDivContent').show();
            $('#nextDivContent').hide();
        }
    }
});