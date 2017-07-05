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
var base_url_dynamic = window.location.origin,
    regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
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
//	$(".datepicker").datepicker({
//        dateFormat: 'yy-mm-dd'
//    });
    $('#acc-dob').datepicker({ dateFormat: 'dd-mm-yy' });
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
    $(document).on('change','.profileDetails', function(e){
        var accountFirstName = $("#acc-name").val(),
            accountLastName = $("#acc-lastname").val(),
            accountDOB = $("#acc-dob").val(),
            accountEmail = $("#acc-email").val(),
            profileimageNmae    = $("#pfimagePath").val(),
            backgroundimageName = $("#bkimagePath").val();
        alert(accountFirstName.trim()+accountLastName.trim()+accountDOB+accountEmail);   
        if ((accountFirstName.trim() != '') && (accountLastName.trim != '') && (accountEmail.match(regexemail)) && (accountEmail != '') && (accountDOB != '')) {
            alert(2);
            $('#changePersonalDetails').prop("disabled", false);
            $('#changePersonalDetails').css('cursor', 'pointer');
            //$("#changePersonalDetails").trigger("click");
        } else {
            alert(3);
            $('#changePersonalDetails').prop("disabled", true);
            $('#changePersonalDetails').css('cursor', 'not-allowed');
        }
    });
    $('body').on('keyup','.profileDetails', function(e){
        var accountFirstName = $("#acc-name").val(),
            accountLastName = $("#acc-lastname").val(),
            accountDOB = $("#acc-dob").val(),
            accountEmail = $("#acc-email").val(),
            profileimageNmae    = $("#pfimagePath").val(),
            backgroundimageName = $("#bkimagePath").val();
           alert(4); 
        if(e.keyCode == 8) { 
            alert(5);
            if ((accountFirstName.trim() != '') && (accountLastName.trim != '') && (accountEmail.match(regexemail)) && (accountEmail != '') && (accountDOB != '')) {
                alert(6);
                $('#changePersonalDetails').prop("disabled", false);
                $('#changePersonalDetails').css('cursor', 'pointer');
                $("#changePersonalDetails").trigger("click");
            } else {
                 alert(7);
                $('#changePersonalDetails').prop("disabled", true);
                $('#changePersonalDetails').css('cursor', 'not-allowed');
            }
        }
    });
    $('body').on('keypress','.profileDetails', function(e){
        $('#loginEmailError').css('display','none');
        var accountFirstName = $("#acc-name").val(),
            accountLastName = $("#acc-lastname").val(),
            accountDOB = $("#acc-dob").val(),
            accountEmail = $("#acc-email").val(),
            profileimageNmae    = $("#pfimagePath").val(),
            backgroundimageName = $("#bkimagePath").val();
            
        if ((accountFirstName.trim() != '') && (accountLastName.trim != '') && (accountEmail.match(regexemail)) && (accountEmail != '') && (accountDOB != '')) {
            $('#changePersonalDetails').prop("disabled", false);
            $('#changePersonalDetails').css('cursor', 'pointer');
            if (e.which == 13) { 

                $("#changePersonalDetails").trigger("click");
                return false;
            }
        }
        else {
            $('#changePersonalDetails').prop("disabled", true);
            $('#changePersonalDetails').css('cursor', 'not-allowed');
        }
        
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
                    window.location.reload();
                    $(".div--error_secondmsg").html('Account details updated').css('display', 'block');
                    setTimeout(function () {
                        $(".div--error_secondmsg").fadeOut(300, function () {});
                    }, 6000);
                    return false;

                    // trying to load a single div but not happening need to recheck
                    /*$('#secondnavbarimage').load(document.URL +'#secondnavbarimage');
                    $("#canvas-placeholderpfimage").html("<img src='"+profileimageNmae+" style='height:120px; width:160px;'>");
                    $("#canvas-placeholderbkimage").html("<img src='"+backgroundimageName+" style='height:120px; width:160px;'>");
                    $("#reloaddiv").html("<div class='btn e-btn btn-primary file-input-btn removeavtr' id='removeavtr'><i class='fa fa-times-circle'></i><input type = 'hidden' id = 'pfimagePath' value=''></div>");
                    $("#reloaddivbk").html("<div class='btn e-btn btn-primary file-input-btn removeavtr' id='removebgavtr'><i class='fa fa-times-circle'></i><input type = 'hidden' id = 'bkimagePath' value=''></div>");*/
                    
                   

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


    $('body').on('click', '#removeavtr', function() {

        var pfimage = $("#canvas-placeholderpfimage").find('img').attr("src");
        $.post(base_url_dynamic + "/settings/removeallavatar", {
                imageName: pfimage,
                imageCategory: "profileimage"
            })
            .done(function(data) {
                if (data == 1) {
                    window.location.reload();
                    // trying to load a single div but not happening need to recheck
                   /* $("#canvas-placeholderpfimage").html("<i class='fa fa-picture-o remove-fa-picture-icon' style='height:120px; width:160px;'></i>");
                    $("#reloaddiv").html("<div class='btn e-btn btn-primary file-input-btn'><i class='fa fa-upload'></i>Choose avatar<input name='profileimage' type='file' id='profileimagechange'><input type = 'hidden' id = 'pfimagePath' value=''></div>");*/
                    
                }

            });    
    });
    $('body').on('click', '#removebgavtr', function() {

        var bkimage = $("#canvas-placeholderbkimage").find('img').attr("src");
        $.post(base_url_dynamic + "/settings/removeallavatar", {
                imageName: bkimage,
                imageCategory: "backgroundimage"
            })
            .done(function(data) {
                if (data == 1) {
                    window.location.reload();
                    // trying to load a single div but not happening need to recheck
                    /*$("#canvas-placeholderbkimage").html("<i class='fa fa-picture-o remove-fa-picture-icon' style='height:120px; width:160px;'></i>");
                    $("#reloaddiv").html("<div class='btn e-btn btn-primary file-input-btn'><i class='fa fa-upload'></i>Choose avatar<input name='backgroundimage' type='file' id='backgroundimagechange'><input type = 'hidden' id = 'bkimagePath' value=''></div>");*/
                    
                }

            });
    });
});

