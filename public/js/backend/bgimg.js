/*
 * @Author: Rituparna
 * @Date:   2017-06-28 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-28 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jslint eqeq: true*/
/*global baseUrl, FileReader*/
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */

/*Preview Image for Background Image Edit*/
    window.onload = function () {
    "use strict";

    var pathname = window.location.pathname,
        parts = pathname.split("/"),
        part3 = parts[3],
        fileUpload = '',
        dvPreview = '',
        i = '',
        file = '',
        ext = '',
        size = '',
        reader = '';

        fileUpload = document.getElementById("fileupload");
        fileUpload.onchange = function preview(e) {
            var maxfilesize = 1024 * 1024; // 1MB

            if (typeof (FileReader) !== "undefined") {
                dvPreview = document.getElementById("upload_prev");
                dvPreview.innerHTML = "";
                for (i = 0; i < fileUpload.files.length; i++) {
                    file = fileUpload.files[i];
                    ext = file.name.split('.').pop().toLowerCase();
                    size = file.size;
                    if (ext === "jpg" || ext === "jpeg" || ext === "gif" || ext === "png" || ext === "bmp") {
                        if (size < maxfilesize) {
                            reader = new FileReader();
                            reader.onload = function (e) {
                                var img = document.createElement("IMG");
                                img.height = "100";
                                img.width = "100";
                                img.src = e.target.result;
                                img.style.marginRight = "12em";
                                img.style.marginTop = "5px";
                                dvPreview.appendChild(img);
                            };
                            reader.readAsDataURL(file);
                        }
                    } else {
                        $("#dynamicpagecreatepopupnewsbrief").fadeIn();
                        $('#hidden_newsbrief').html(file.name + " is not a valid image file.");
                        dvPreview.innerHTML = "";
                        return false;
                    }
                }
            } else {
                $("#dynamicpagecreatepopupnewsbrief").fadeIn();
                $('#hidden_newsbrief').html("This browser does not support HTML5 FileReader.");
            }
        };
//    }
};

$(document).ready(function () {
    "use strict";

/*Background Image Edit Validation(onchange)*/
    $('#fileupload').bind('change', function () {
        var ext = $('#fileupload').val().split('.').pop().toLowerCase(),
            picsize = (this.files[0].size);
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
            $('#errorImg2,#upload_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg1').css('display', 'block');
            $('#errorImg1').html("<font color='red'> Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF </font>");
            $('#bgImgSave').attr("disabled", true);
            return false;
        } else if (picsize > 1024000) {
            $('#errorImg1,#upload_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg2').css('display', 'block');
            $('#errorImg2').html("<font color='red'> Invalid Image Format! Maximum File Size Limit is 1MB </font>");
            $('.upload_prev').children('img').attr('src', '');
            $('#bgImgSave').attr("disabled", true);
            return false;
        } else {
            $('#errorImg1').css('display', 'none');
            $('#errorImg2').css('display', 'none');
            $('#upload_prev').css('display', 'block');
            $('#bgImgSave').attr("disabled", false);

        }
    });

/*Background Image Save button click*/
    $('body').on('click','#bgImgSave',function(){
            $('#bgimgEditForm').submit();
    });

});