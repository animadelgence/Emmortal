/*
 * @Author: Anima
 * @Date:   2017-06-19 18:46:35
 * @Last Modified by:   Anima
 * @Last Modified time: 2017-06-19 18:52:26
 */
/*jslint browser: true*/
/*global $, jQuery, alert*/
/*jslint plusplus: true */
/*jslint indent: 4, maxerr: 50, vars: true, regexp: true, sloppy: true */
/*jshint -W065 */
/*jslint devel: true */
/*jslint eqeq: true*/
$(function () {
    $("body").on("click",".profile-paginator__click",function(){
        var getClickedId = $(this).attr("data-fetch-id"),
            baseUrl = window.location.origin;
        $.get(baseUrl+"/page/selectpage", { pageid:getClickedId });
    });

});
