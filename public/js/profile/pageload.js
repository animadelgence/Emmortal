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
    var baseUrl = window.location.origin;
    $("body").on("click",".add-page-btn",function(){
        $.ajax({
          type: "POST",
          url: baseUrl + "/page/newpagecreate",
          success:function (result) {
              var jsObject = JSON.parse(result);
              $(".close-new").trigger("click");
              if(jsObject.noredirect==1){
                  window.location.href( baseUrl + "/profile/showprofile");
              }
              else{
                  $(".profile-paginator ul").append('<li class="profile-paginator__click" data-fetch-id="'+jsObject.gotostep+'"></li>');
                  $(".profile-paginator ul li:last").trigger("click");
              }
          }

        });
    });
    $("body").on("click",".profile-paginator__click",function(){
        var getClickedId = $(this).attr("data-fetch-id");
        $.ajax({
          type: "POST",
          data:{pageid:getClickedId}
          url: baseUrl + "/page/selectpage",
          success:function (result) {
              var jsObject = JSON.parse(result);
              console.log(jsObject);
          }

        });

    });

});
