/*
 * @Author: Maitrayee
 * @Date:   2017-07-04 17:46:35
 * @Last Modified by:   Maitrayee
 * @Last Modified time: 2017-06-30 16:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jshint -W065 */
var base_url_dynamic = window.location.origin;
$(document).ready(function () {

	$('[data-toggle="tooltip"]').tooltip();   
	$('body').on('click', '.edit-menu-album', function () {
        if($(this).hasClass('open')) {
            $(this).removeClass('open');
        } else{
           $(this).addClass('open'); 
        }

    });


});