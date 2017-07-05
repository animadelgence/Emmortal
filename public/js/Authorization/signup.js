/*
 * @Author: Maitrayee
 * @Date:   2017-06-14 17:46:35
 * @Last Modified by:   Rajyasree
 * @Last Modified time: 2017-06-19 10:52:26
 */
/*jslint browser: true */
/*global $, jQuery, alert,CKEDITOR */
/*jslint plusplus: true */
/*jshint -W065 */
/*jshint -W030 */
/*jslint eqeq: true */
/*global radix:true */
$(document).ready(function () {
    var regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
	$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
    $('body').on('change','.signupidenter', function(e){
        $('#signupbutton').prop("disabled", true);
        $('#signupbutton').css('cursor', 'not-allowed');
        var firstName = $("#fname").val(),
            lastName = $("#lname").val(),
            email = $("#email").val(),
            password = $("#password").val(),
            confirmpassword = $("#confirmPassword").val(),
            dob = $("#datepicker").val();
            
        if ((firstName != '') && (lastName != '') && (email != '') && (password != "") && (confirmpassword != "") && (email.match(regexemail))) { // jshint ignore:line
            //alert('up');
            $('#signupbutton').prop("disabled", false);
            $('#signupbutton').css('cursor', 'pointer');
        } else {
            $('#signupbutton').prop("disabled", true);
            $('#signupbutton').css('cursor', 'not-allowed');
        }
    });
    $('body').on('keypress', '.signupidenter', function (e) {
        "use strict";
        $('#confpasswordError').css('display', 'none');
        $('#passwordError').css('display', 'none');
        var firstName = $("#fname").val(),
            lastName = $("#lname").val(),
            email = $("#email").val(),
            password = $("#password").val(),
            confirmpassword = $("#confirmPassword").val(),
            dob = $("#datepicker").val(),
            regexpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
        if ((firstName != '') && (lastName != '') && (email != '') && (password != "") && (confirmpassword != "") && (email.match(regexemail))) { // jshint ignore:line
            $('#signupbutton').prop("disabled", false);
            $('#signupbutton').css('cursor', 'pointer');
            //return true;
            if (e.which == 13) {
                $("#signupbutton").trigger("click");
                return false;
            }
        } /*else {
            $('#signupbutton').prop("disabled", true);
            $('#signupbutton').css('cursor', 'not-allowed');      
        } */
    });


    $('body').on('click', '#signupbutton', function () {
        "use strict";
        var firstName = $("#fname").val(),
            lastName = $("#lname").val(),
            email = $("#email").val(),
            password = $("#password").val(),
            confirmpassword = $("#confirmPassword").val(),
            dob = $("#datepicker").val(),
            regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/,
            regexpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
        /*if(firstName == "")
        {
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Enter your First name").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;

        }
        else if(lastName == "")
        {
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Enter your Last name").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;

        }
        else if(email == "")
        {
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Enter your email").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;

        } else if(!email.match(regexemail)){
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Enter a valid email address").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;
        }
        else if(password == ""){
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Enter password").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;
        } else if(!password.match(regexpassword)) {
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Password should contain atleast one uppercase,one lowercase and minimum 8 characters.").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;
        } else if(confirmpassword == "") {
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Please enter the confirm pasword").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;
        }else if((password !== confirmpassword) && (!password.match(regexpassword))){
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("Password mismatch").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
            return false;

        }else if(dob == ''){
            $(".alertmesage_signup").css("color","Red");
            $(".alertmesage_signup").text("enter your date of birth").show();
             setTimeout(function () {
                    $(".alertmesage_signup").fadeOut(300, function () {});
                }, 8000);
                return false;



        }*/
        if ((password !== confirmpassword) && (!password.match(regexpassword))) {
            $('#confpasswordError').css('display', 'block');
            $('#passwordError').css('display', 'block');
            return false;

        } else if (password !== confirmpassword) {
            $('#confpasswordError').css('display', 'block');
            return false;
        } else if (!password.match(regexpassword)) {
            $('#passwordError').css('display', 'block');
            return false;
        } else {
            $("#signup_form").ajaxSubmit({
                data: {
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    password: password,
                    dob: dob
                },
                success: function (result) {
                    //alert(result);
                    //return false;
                    if (result == 1) {
                        alert("welcome to emmortal,please check your mail and confirm the link to logged in");
                        $('.close').trigger('click');
                    } else {
                        alert("Already have an account with this mail id");
                    }

                    return false;


                }
            });
        }
	});
/*$("#signin").click(function(){
	$(".signin_popup").show();
	$(".signup_popup").hide();
	
});*/

	


});
function showhide() {
	"use strict";
    $('.close').trigger('click');
    //$('#squarespaceModalemail').modal('toggle');


}