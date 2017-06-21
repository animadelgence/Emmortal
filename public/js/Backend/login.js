/*
 * @Author: Rituparna
 * @Date:   2017-02-8 17:46:35
 * @Last Modified by:   Rituparna
 * @Last Modified time: 2017-04-24 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global baseUrl*/
$(document).ready(function () {
    "use strict";

    $("#submitbtn").on('click', function (event) {
        event.preventDefault();
        var userid = $('#userId').val(),
            passwrd = $('#password').val();
        if (userid === "") {
            $('#errormsg').html("<font color='red'> Please enter the User ID </font>");
            return false;
        } else if (passwrd === "") {
            $('#errormsg').html("<font color='red'> Please enter the Password </font>");
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: baseUrl + '/adminlogin/submit',
                data: {
                    userId: userid,
                    password: passwrd
                },
                success: function (response) {
                    if (response.trim() === "error") {
                        $('#errormsg').html("<font color='red'> Please enter correct User ID / Password </font>");
                        return false;
                    } else {
                        window.location = baseUrl + '/userregistration/userdetails';
                    }
                }
            });
        }

    });
});
