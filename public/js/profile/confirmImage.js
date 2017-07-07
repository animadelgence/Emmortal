var getUrl = window.location.origin;

//$(function(){
//
//	var getpath = document.URL;
//           // alert(document.URL);return false;
//            var actionname = getpath.split("/"),
//             pathname = actionname[5],
//             encryptedmailid = actionname[6];
//            //alert(pathname);forgetpassword
//        if(pathname == "confirmed"){
//        	$('#squarespaceModalchangeimage').modal('show');
//        }
//
//});

/* Image Fileupload */
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
        if(fileUpload!=null){
        fileUpload.onchange = function preview(e) {
            var maxfilesize = 1024 * 1024; // 1MB

            if (typeof (FileReader) !== "undefined") {
                dvPreview = document.getElementById("img_prev"); //upload_prev
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
   }
};

$(document).ready(function () {
    "use strict";
//alert(getUrl); return false;
/*Background Image Edit Validation(onchange)*/
    $('#fileupload').bind('change', function () {
        var ext = $('#fileupload').val().split('.').pop().toLowerCase(),
            picsize = (this.files[0].size);
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
            $('#errorImg2,#img_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg1').css('display', 'block');
            $('#errorImg1').html("<font color='red'> Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF </font>");
            $('.save').attr("disabled", true);
            return false;
        } else if (picsize > 1024000) {
            $('#errorImg1,#img_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg2').css('display', 'block');
            $('#errorImg2').html("<font color='red'> Invalid Image Format! Maximum File Size Limit is 1MB </font>");
            $('.img_prev').children('img').attr('src', '');
            $('.save').attr("disabled", true);
            return false;
        } else {
            $('#errorImg1').css('display', 'none');
            $('#errorImg2').css('display', 'none');
            $('#img_prev').css('display', 'block');
            $('.save').attr("disabled", false);

        }
    });

/*Background Image Save button click*/
    $('body').on('click','#bgImgSave',function(){
            $('#bgimgEditForm').submit();
    });

/*Pattern -- Modal Tab Content Show*/
    $('body').on('click','#browse',function(){
        //alert(); return false;
        $.get(getUrl+"/seomanage/pattern", function (result) {
            //console.log(result); return false;

            var jsObject = JSON.parse(result);
            //console.log(result); return false;
            var appendStructure = '<ul class="emmortal-tab-pattern__list">';
            $.each(jsObject, function(i, item) {
    			appendStructure += jsObject[i];
			});
            appendStructure+="</ul>";
            $('#imgAppend').html(appendStructure);
            });

            $('#uploadTab').hide();
            $('#browse').show();
            $('#browseTab').show();
    });

/*Upload Image -- Modal Tab Content Show*/
    $('body').on('click','#bgimageBtn',function(){
        $.get(getUrl+"/settings/uploadimg", function (result) {

            //console.log(result);return false;
            var jsObject = JSON.parse(result);
            var appendStructure = '<ul class="emmortal-tab-image__list">';
            $.each(jsObject, function(i, item) {
    			appendStructure += jsObject[i];
			});
            appendStructure+="</ul>";
            $('#savedImg').html(appendStructure);
            });
    });

    $('body').on('click','#upload',function(){
            $('#browseTab').hide();
            $('#upload').show();
            $('#uploadTab').show();
    });

/*Clicking on a Pattern */
    $('body').on('click', '#imgAppend ul li strong a img', function (event) {
        event.preventDefault();
        event.stopPropagation();
        var imgSrc = $(this).attr('src');
        $('#imgSrc').val(imgSrc);
    });

/*Clicking on a Saved Image */
    $('body').on('click', '#savedImg ul li strong a img', function (event) {
        event.preventDefault();
        event.stopPropagation();
        var imgSrc = $(this).attr('src');
        $('#imgSrc').val(imgSrc);
        $('#img_prev').html("<img src='"+imgSrc+"' height='100px' width='100px' style='margin: 5px 12em 0 0;' />");
    });

/*Clicking on 'Save Changes' modal button */
     $('body').on('click', '.save', function () {
        var imgSrc = $.trim($('#imgSrc').val());

         if (imgSrc != ""){
            $('#canvas-placeholderbkimage').html("<img src='"+imgSrc+"' height='100%' width='100%' />");
         } else {
               $("#imgUploadForm").ajaxSubmit({
                data: { fileupload: 'fileupload' },
                success: function (response) {
                     //console.log(response); return false;
                    var jsObject = JSON.parse(response);
                    $('#imgSrc').val(jsObject.originalPath);
                    $('#canvas-placeholderbkimage').html("<img src='"+jsObject.originalPath+"' height='100%' width='100%' />");
                }
            });

         }
     });

});

