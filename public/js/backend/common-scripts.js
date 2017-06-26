/*
 * @Author: Rituparna
 * @Date:   2017-06-22 17:46:35
 * @Last Modified by: Rituparna
 * @Last Modified time: 2017-06-26 19:21:42
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
/*global diff:true*/

var baseUrl = window.location.origin;

var Script = (function () {
    "use strict";

    //    sidebar dropdown menu auto scrolling

    jQuery('#sidebar .sub-menu > a').click(function () {

        var o = ($(this).offset());
        diff = 250 - o.top;
        if (diff > 0) {
            $("#sidebar").scrollTo("-=" + Math.abs(diff), 500);
        } else {
            $("#sidebar").scrollTo("+=" + Math.abs(diff), 500);
        }
    });

    $(function () {
        var pathname = window.location.pathname,
            parts = pathname.split("/"),
            part1 = parts[0],
            part2 = parts[1],
            part3 = parts[2],
            part4 = parts[3],
            part5 = parts[4];

        if (pathname === '/usermanage/userdetails') {
            $('.common_class').removeClass('active');
            $('.usermanage').addClass('active');
        } else if (pathname === '/usermanage/useredit/' + part4) {
            $('.common_class').removeClass('active');
            $('.usermanage').addClass('active');
        } else if (pathname === '/usermanage/userbackupdet') {
            $('.common_class').removeClass('active');
            $('.usermanage').addClass('active');
        } else if (pathname === '/userregistration/adduser') {
            $('.common_class').removeClass('active');
            $('.userreg').addClass('active');
        } else if (pathname === '/seomanage/seoview') {
            $('.common_class').removeClass('active');
            $('.seomanage').addClass('active');
        }  else if (pathname === '/uploads/view') {
            $('.common_class').removeClass('active');
            $('.uploads').addClass('active');
        }


        $('ul').on('click', 'li', function () {

            if ($('ul').children('li').hasClass('active')) {
                $('ul').children('li').removeClass('active');
            }
            $(this).addClass('active');
            var className = $(this).attr('class');

            if (className === 'usermanage common_class active') {
                window.location.href = baseUrl + '/usermanage/userdetails';
            } else if (className === 'seomanage common_class active'){
                window.location.href = baseUrl + '/seomanage/seoview';
            } else if (className === 'uploads common_class active'){
                window.location.href = baseUrl + '/uploads/view';
            }

        });

    });

    //    sidebar toggle

    $(function () {
        function responsiveView() {
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#container').addClass('sidebar-close');
                $('#sidebar > ul').hide();
            }

            if (wSize > 768) {
                $('#container').removeClass('sidebar-close');
                $('#sidebar > ul').show();
            }
        }
        $(window).on('load', responsiveView);
        $(window).on('resize', responsiveView);
    });


    $('.fa-bars').click(function () {
        if (!$("#sidebar").hasClass('hasEditor')) {
            if ($('#sidebar > ul').is(":visible") === true) {
                $('#main-content').css({
                    'margin-left': '0px'
                });
                $('#sidebar').css({
                    'margin-left': '-210px'
                });
                $('#sidebar > ul').hide();
                $("#container").addClass("sidebar-closed");
            } else {
                $('#main-content').css({
                    'margin-left': '210px'
                });
                $('#sidebar > ul').show();
                $('#sidebar').css({
                    'margin-left': '0'
                });
                $("#container").removeClass("sidebar-closed");
            }
        } else {
            if ($('#sidebar > ul').is(":visible") === true) {
                $('#sidebar').css({
                    'margin-left': '-210px'
                });
                $('#sidebar > ul').hide();
                $("#container").addClass("sidebar-closed");
            } else {
                $('#sidebar > ul').show();
                $('#sidebar').css({
                    'margin-left': '0'
                });
                $("#container").removeClass("sidebar-closed");
            }
        }
    });

    // custom scrollbar
    $("#sidebar").niceScroll({
        styler: "fb",
        cursorcolor: "#4ECDC4",
        cursorwidth: '3',
        cursorborderradius: '10px',
        background: '#404040',
        spacebarenabled: false,
        cursorborder: ''
    });

    $("html").niceScroll({
        styler: "fb",
        cursorcolor: "#4ECDC4",
        cursorwidth: '6',
        cursorborderradius: '10px',
        background: '#404040',
        spacebarenabled: false,
        cursorborder: '',
        zindex: '1000'
    });

    // widget tools

    jQuery('.panel .tools .fa-chevron-down').click(function () {
        var el = jQuery(this).parents(".panel").children(".panel-body");
        if (jQuery(this).hasClass("fa-chevron-down")) {
            jQuery(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.panel .tools .fa-times').click(function () {
        jQuery(this).parents(".panel").parent().remove();
    });


    if ($(".custom-bar-chart")) {
        $(".bar").each(function () {
            var i = $(this).find(".value").html();
            $(this).find(".value").html("");
            $(this).find(".value").animate({
                height: i
            }, 2000);
        });
    }


}());
