/*
 * @Author: shilpita
 * @Date:   2017-06-26 16:46:35
 * @Last Modified by:   shilpita
 * @Last Modified time: 2017-06-26 16:46:35
 */
/*jslint browser: true*/
/*global $, jQuery, alert,  Aviary, currentImage, csdkImageEditor, console, launchImageEditor,validateFileType, loadtheuploadbutton, showTheEditButtons, elementclick*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */

/*jslint eqeq: true*/


function yHandler() {
    $('#loader-icon').css('display', 'block');
    console.log("dfdfg")
    var noofScroll = $('#valuetobeIncremented').val();
    var wrap = '';
    var contentHeight = '';
    var yOffset = '';
    var y = '';
    var no_of_template_div = '';
    var baseUrl = window.location.origin;
    i = '';
    //  id_string = '';
    if (($('#noOfTemplates').val) > 15) {
       // $('#loader-icon').css('display', 'block');
    }
    /* jshint ignore:start */
    if ($("#checker").val() == 0) {
        $('#loader-icon').css('display', 'none');

        return false;
    }
    /* jshint ignore:end */
    wrap = document.getElementById("outer-wrap");
    contentHeight = wrap.offsetHeight;
    yOffset = window.pageYOffset;
    y = yOffset + window.innerHeight;
    no_of_template_div = $('#outer-wrap').children().length;
//console.log(yOffset+"--"+y+"--"+contentHeight);
    i = parseInt(no_of_template_div, 10);

    //id_string = $('#category_string').html();

    if (y >= contentHeight) {
        if ($("#isAjaxStart").val() != 0) { // jshint ignore:line
            return false;
        } else {
            $("#isAjaxStart").val(1);
        }
        $.ajax({
            async: false,
            type: "POST",
            url: baseUrl + "/lazyload/load",
            data: {
                counter: i,
                noofScroll: noofScroll,
                // tem_id: id_string
            },
            success: function (response) {
                // alert(response);return false;
                var jsObject = JSON.parse(response);

                noofScroll++;
                $("#isAjaxStart").val(0);
                $("#checker").val(jsObject.checker);
                i++;
                $("#counterOfTheTemplate").val(i);
                if (jsObject.checker != 0) { // jshint ignore:line
                    // $("#outer-wrap").append(jsObject.galleryStruct);
                    $(".clickme").html(jsObject.galleryStruct);
                    $item = $(".clickme li");


                    /* Gridster setup code */
                    var gridster = $(".gridster ul").gridster({
                        namespace: '.gridster',
                        widget_base_dimensions: [182, 181],
                        widget_margins: [5, 5],
                        max_cols: 6
                    }).data('gridster');
                    $item.each(function (index) {

                        var sizey = parseInt($(this).attr("data-sizey")),
                            sizex = parseInt($(this).attr("data-sizex"));
                        gridster.add_widget($(this),sizex,sizey);
                    })
                    $(".gridster ul").gridster({
                        namespace: '.gridster',
                        widget_base_dimensions: [182, 181],
                        widget_margins: [5, 5],
                        max_cols: 6
                    }).data('gridster');


                   //$('#loader-icon').css('display', 'none');
                    $('#valuetobeIncremented').val(noofScroll);
                }

                return false;
            },
            complete: function () {
                $('#loader-icon').css('display', 'none');

            }

        });



    }
}

$(document).ready(function () {
    "use strict";
    $("#checker").val('1');
    //$("#fullwrapnew").fixedBG();
    var noOfTemplates = $("#noOfTemplates").val();


    if (noOfTemplates > 15) {

        window.onscroll = yHandler;

    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                });
