/*
 * @Author: Rituparna
 * @Date:   2017-02-8 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-06-12 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*jslint eqeq: true*/
/*global baseUrl, FileReader*/
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */

/*Preview Image for Profile Image Edit*/
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

    if (pathname === '/usermanage/useredit/' + part3) {
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
    }
};

$(document).ready(function () {
    "use strict";

/*Profile Image Edit Validation(onchange)*/
    $('#fileupload').bind('change', function () {
        var ext = $('#fileupload').val().split('.').pop().toLowerCase(),
            picsize = (this.files[0].size);
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) === -1) {
            $('#errorRate,#errorLink,#errorName,#errorImg3,#errorImg2,#upload_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg1').css('display', 'block');
            $('#errorImg1').html("<font color='red'> Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF </font>");
            $('#btnSave').attr("disabled", true);
            return false;
        } else if (picsize > 1024000) {
            $('#errorRate,#errorLink,#errorName,#errorImg1,#errorImg3,#upload_prev').css('display', 'none'); // hides image along with other error messages
            $('#errorImg2').css('display', 'block');
            $('#errorImg2').html("<font color='red'> Invalid Image Format! Maximum File Size Limit is 1MB </font>");
            //($('.upload_prev').children('img').attr('src')) === "";
            $('.upload_prev').children('img').attr('src', '');
            $('#btnSave').attr("disabled", true);
            return false;
        } else {
            $('#errorImg1').css('display', 'none');
            $('#errorImg2').css('display', 'none');
            $('#upload_prev').css('display', 'block');
            $('#btnSave').attr("disabled", false);

        }
    });


 /* Useredit form submit */
    $('body').on('click', '#btnSave', function () {
        var userid = $('#userid').val(),
            userfName = $('#userfName').val(),
            userlName = $('#userlName').val(),
            activation = $('#activation').val();


        if (userfName === '') { //template name field
            $('#errorLname,#errorEmail,#errorImg3,#errorImg1,#errorImg2').css('display', 'none');
            $('#errorFname').css('display', 'block');
            $('#errorFname').html("<font color='red'> Please enter the first name of user </font>");
            return false;
        }else if (userlName === ''){
            $('#errorFname,#errorEmail,#errorImg3,#errorImg1,#errorImg2').css('display', 'none');
            $('#errorLname').css('display', 'block');
            $('#errorLname').html("<font color='red'> Please enter the last name of user </font>");
            return false;
        }else {
            $("#userFormEdit").ajaxSubmit({
                data: {
                    userid: userid,
                    userfName: userfName,
                    userlName: userlName,
                    activation: activation,
                    fileupload: 'fileupload'
                },
                success: function (response) {
                    console.log(response); return false;
                    if (response.trim() === "error") {
                        $('#errorName').html("<font color='red'> Invalid! Template name already exists </font>");
                        return false; //error message
                    } else {
                        $('#errorName').css('display', 'none');
                        window.location = baseUrl + '/usermanage/userdetails';
                    }
                }
            });

        }
    });

// /* Validation of (Add New User) User Registration Page */
//    $('#regSave').click(function () {
//        var email = $('#emailReg').val(),
//            password = $('#passReg').val(),
//            pattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[#$@!%&*?]).{8,20}$/,// for password
//
//
//            expr = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/; // for email
//
//        if (email == "") { // jshint ignore:line
//            $('#errorReg').css('display', 'block');
//            $('#errorReg').html("Please enter an Email");
//            $('#errorPass').css('display', 'none');
//            return false;
//        } else if (!expr.test(email)) { // regex validation for email
//            $('#errorReg').css('display', 'block');
//            $('#errorReg').html("Please enter a valid Email");
//            $('#errorPass').css('display', 'none');
//            return false;
//        } else if (password == "") { // jshint ignore:line
//            $('#errorPass').css('display', 'block');
//            $('#errorPass').html("Please enter a password");
//            $('#errorReg').css('display', 'none');
//            return false;
//        } else if (!pattern.test(password)) { // regex validation for password
//            $('#errorPass').css('display', 'block');
//            $('#errorPass').html("Password should contain minimum 8 characters - at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character");
//            $('#errorReg').css('display', 'none');
//            return false;
//        } else {
//
//            $.ajax({
//                type: "POST",
//                url: baseUrl + '/usermanage/saveuser',
//                data : { email : email, password: password},
//                success: function (response) {
//                    if (response.trim() == "error") {
//                        $('#errorReg').html("<font color='red'> Invalid! Email already exists </font>");
//                        return false; //error message
//                    } else {
//                        window.location = baseUrl + '/usermanage/userdetails';
//                    }
//                }
//            });
//
//        }
//    });
//
});

///*Popup Appear When clicked on Delete User Icon*/
//$(".deleteUser").on('click', function (event) {
//    "use strict";
//    var userId = $(this).parent().prev().val();
//    $('#hidden_userid').val(userId);
//    $("#dynamicpagecreatepopup").fadeIn();
//});
//
///*Popup appear when clicked on 'OK' of Delete User*/
//$("#delUser").on('click', function (event) {
//    "use strict";
//    var deleteId = $('#hidden_userid').val();
//    $('#hidden_uId').val(deleteId);
//    $("#dynamicpagecreatepopup").fadeOut();
//    $("#pubStatusPopup").fadeIn();
//});
//
///*Popup Appear When clicked on Restore User Icon*/
//$(".restoreUser").on('click', function (event) {
//    "use strict";
//    var deleteId = $(this).parent().prev().val();
//    $('#hidden_userid').val(deleteId);
//
//    $.ajax({
//        type: "POST",
//        url: baseUrl + '/userregistration/emailcheck',
//        data : { deleteId: deleteId},
//        success: function (response) {
//            if (response.trim() == "error") {
//                $("#dynamicalertpopup").fadeIn();
//                return false; //error message
//            } else {
//                $("#templateRestorePopup").fadeIn();
//            }
//        }
//    });
//});
