var URL = window.location.origin;
$(document).ready(function (){
	$('body').on('keypress','.loginid', function(e){
	   var  loginemail = $("#loginemail").val(),
            loginpassword = $("#loginpassword").val(),
            regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
        if ((loginemail != '') && (loginpassword != '') && (loginemail.match(regexemail))) {
            $('#signinbutton').prop("disabled", false);
            //return true;
            if (e.which == 13) { 

                $("#signinbutton").trigger("click");
                return false;
            }
        } 
        
    });
    $('body').on('keypress','.recoverymailid', function(e){
    
        if (e.which == 13) { 

            $("#recoverybutton").trigger("click");
            return false;
        }
    });

	
	$('body').on('click','#signinbutton', function(){
		//alert(12);
		var loginemail = $("#loginemail").val(),
		loginpassword = $("#loginpassword").val();

		$("#login_form").ajaxSubmit({
                data: {
                    loginemail: loginemail,
                    loginpassword: loginpassword
                },
                success: function (result) {
                	//alert(result);return false;
                	if(result == "live"){
                		window.location.href = URL +"/profile/newsfeed";
                	}
                	/*else if(result == "not activate"){
                		$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Please activate your account by clicking on confirmation link that has sent to your mail").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);
				        return false;
                	}*/
                	else
                	{
                		/*$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Mail id or password is invalid, Please check").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);*/
                        $('#loginEmailError').css('display','block');
				        return false;

                	}
                }
            });
	});
	
	
	$('body').on('click','#recoverybutton', function(){	
		var recoveryemail = $("#recoveryemail").val(),
		regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/;
		if(recoveryemail == "")  
		{
			$(".alertmesage_signup").css("color","Red");
			$(".alertmesage_signup").text("Enter your email").show();
			 setTimeout(function () {
	                $(".alertmesage_signup").fadeOut(300, function () {});
	            }, 8000);
	            return false;
			
		} else if(!recoveryemail.match(regexemail)){
			$(".alertmesage_signup").css("color","Red");
			$(".alertmesage_signup").text("Enter a valid email address").show();
			 setTimeout(function () {
	                $(".alertmesage_signup").fadeOut(300, function () {});
	            }, 8000);
	            return false;
		}else{
		
			$("#recovery_form").ajaxSubmit({
	                data: {
	                    recoveryemail: recoveryemail
	                },
	                success: function (result) {
	                	//alert(result);return false;  
	                	$(".alertmesage_recovery").css("color","Red");
						$(".alertmesage_recovery").text("a link has been sent to your mailid, Please click on that link to reset your password").show();
						 setTimeout(function () {
				                $(".alertmesage_recovery").fadeOut(300, function () {});
				            }, 8000);
				            return false;
	                }
	        });
		}

	});
		
});	

function showhide(){
			
	$('.close').trigger('click');
			
}

