/*
 * @Author: Rituparna
 * @Date:   2017-06-22 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-23 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jslint eqeq: true*/
/*global baseUrl, FileReader*/
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */

$(document).ready(function(){
    "use strict";

 /* SEO edit validation */
    $('#btnSave').on("click", function () {
        alert("hi");
        var seoId = $('#seoId').val(),
            seoTitle = $('#seoTitle').val(),
            metaDesc = $('#metaDesc').val(),
            imgPath = $('#imgPath').val(),
            favicon = $('#favicon').val();


        if (seoTitle === '') { //template name field
            $('#errorDesc,#errorImg,#errorIcon').css('display', 'none');
            $('#errorTitle').css('display', 'block');
            $('#errorTitle').html("<font color='red'> Please enter the SEO title </font>");
            return false;
        } else if(metaDesc === ''){
            $('#errorTitle,#errorImg,#errorIcon').css('display', 'none');
            $('#errorDesc').css('display', 'block');
            $('#errorDesc').html("<font color='red'> Please enter the meta description </font>");
            return false;
        } else if(imgPath === ''){
            $('#errorTitle,#errorDesc,#errorIcon').css('display', 'none');
            $('#errorImg').css('display', 'block');
            $('#errorImg').html("<font color='red'> Please enter the image path </font>");
            return false;
        } else if(favicon === ''){
            $('#errorTitle,#errorImg,#errorDesc').css('display', 'none');
            $('#errorIcon').css('display', 'block');
            $('#errorIcon').html("<font color='red'> Please enter the favicon path </font>");
            return false;
        } else {
            $('#seoFormEdit').submit();
        }
    });

});

