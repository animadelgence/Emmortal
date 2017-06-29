var getUrl = window.location.origin;
$(function(){

	var getpath = document.URL;
           // alert(document.URL);return false;
            var actionname = getpath.split("/"),
             pathname = actionname[5],
             encryptedmailid = actionname[6];
            //alert(pathname);forgetpassword
        if(pathname == "confirmed"){
        	$('#squarespaceModalchangeimage').modal('show');
        }

});