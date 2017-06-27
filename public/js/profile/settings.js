/*
 * @Author: Anima
 * @Date:   2017-06-20 17:10:35
 * @Last Modified by:   Anima
 * @Last Modified time: 2017-06-20 17:20:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */
/*jshint -W065 */
/*jslint devel: true */
/*jslint eqeq: true*/
var base_url_dynamic = window.location.origin;
$(function () {
     // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
});
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

$(document).ready(function () {
    "use strict";
	$(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('body').on('click', '#password_save', function () {
        var regexpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/,
            currentPassword = $("#acc-cur-pass").val(),
            newPassword = $("#acc-pass").val(),
            repeatPassword = $("#acc-pass-rep").val();
        if (currentPassword === "") {
            $(".div--error_secondmsg").html('Enter current password').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }

        if (newPassword === "") {
            $(".div--error_secondmsg").html('Enter new password').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }
        if (repeatPassword === "") {
            $(".div--error_secondmsg").html('Enter retype password').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }
        if (!newPassword.match(regexpassword)) {
            $(".div--error_secondmsg").html('Password should contain atleast one uppercae,one lowercase and minimum 8 characters').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }
        if (newPassword !== repeatPassword) {
            $(".div--error_secondmsg").html('Password not matched').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }
        if (currentPassword === newPassword) {
            $(".div--error_secondmsg").html('Current password and new password are same').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
            return false;
        }
        $("#form__changepassword").ajaxSubmit({
            data: {
                newPassword: newPassword,
                currentPassword: currentPassword
            },
            success: function (result) {
                //console.log(result);
                
                var jsObject = JSON.parse(result);
                //console.log(jsObject);
                //return false;
                $(".div--error_secondmsg").html(jsObject.Message).css('display', 'block');
                setTimeout(function () {
                    $(".div--error_secondmsg").fadeOut(300, function () {});
                }, 6000);
                return false;
            }
        });
        
    });
    $("#changePersonalDetails").click(function (e) {

        e.preventDefault();
        var accountFirstName = $("#acc-name").val(),
            accountLastName = $("#acc-lastname").val(),
            accountDOB = $("#acc-dob").val(),
            profileimageNmae    = $("#pfimagePath").val(),
            backgroundimageName = $("#bkimagePath").val();
            
        if (accountFirstName.trim() === "") {
            $(".div--error_secondmsg").html('Enter Your First Name').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
        } else if ((accountLastName.trim === "")) {
            $(".div--error_secondmsg").html('Enter Your Last Name').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
        } else {
            $.ajax({
                url: base_url_dynamic + "/settings/changedetails",
                type: "POST",
                data: {
                    accountFirstName: accountFirstName,
                    accountLastName: accountLastName,
                    accountDOB: accountDOB,
                    profileimageNmae    : profileimageNmae,
                    backgroundimageName : backgroundimageName
                },
                success: function (result) {
                    //console.log(result);return false;
                    $(".profile-image-name-menu").reload();
                    $(".div--error_secondmsg").html('Account details updated').css('display', 'block');
                    setTimeout(function () {
                        $(".div--error_secondmsg").fadeOut(300, function () {});
                    }, 6000);
                    return false;

                }

            });
        }
        
    });
    $('body').on('click', '#saveQuestion', function () {
        var questionDetails = $('#questionDetails').val();
        if (questionDetails.trim() === "") {
            $(".div--error_secondmsg").html('Enter Your Question').css('display', 'block');
            setTimeout(function () {
                $(".div--error_secondmsg").fadeOut(300, function () {});
            }, 6000);
        } else {
            $.ajax({
                url: base_url_dynamic + "/settings/sendQuestion",
                type: "POST",
                data: {
                    questionDetails: questionDetails
                },
                success: function (result) {
                    console.log(result);//return false;
                    $(".div--error_secondmsg").html('Query sent').css('display', 'block');
                    setTimeout(function () {
                        $(".div--error_secondmsg").fadeOut(300, function () {});
                    }, 6000);
                    return false;
                }

            });
        }
    });
    $('body').on('change', '#profileView', function () {
        var optionValue = $(this).val(),
            type = 'profile';
        //alert(optionValue);
        $.ajax({
            url: base_url_dynamic + "/settings/viewProfilePermission",
            type: "POST",
            data: {
                optionValue: optionValue,
                type: type
            },
            success: function (result) {
                console.log(result);
                return false;

            }

        });
    });
    $('body').on('change', '#nameView', function () {
        var optionValue = $(this).val(),
            type = 'name';
        //alert(optionValue);
        $.ajax({
            url: base_url_dynamic + "/settings/viewProfilePermission",
            type: "POST",
            data: {
                optionValue: optionValue,
                type: type
            },
            success: function (result) {
                console.log(result);
                return false;

            }

        });
    });
});