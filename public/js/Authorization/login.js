var URL = window.location.origin;
$(document).ready(function () {


	$('#signinbutton').click(function(){
		var loginemail = $("#loginemail").val(),
		loginpassword = $("#loginpassword").val();

		$("#login_form").ajaxSubmit({
                data: {
                    loginemail: loginemail,
                    loginpassword: loginpassword
                },
                success: function (result) {
                	//alert(result); return false;
                	if(result == "live"){
                		window.location.href = URL +"/newsfeed/news";
                	}
                	else if(result == "not activate"){
                		$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Please activate your account by clicking on confirmation link that has sent to your mail").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);
				        return false;
                	}
                	else
                	{
                		$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Mail id or password is invalid, Please check").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);
				        return false;

                	}
                }
            });
		/*$("#forgotmail").onclick(function(){
			
		});

		$("#back").click(function(){
			$('#squarespaceModalemail').modal('toggle');
			//$("#squarespaceModalemail").hide();
		});
*/
	});
	$("#signinbutton").click(function(){
		var recoveryemail = $("#recoveryemail").val();
		
		$("#recovery_form").ajaxSubmit({
                data: {
                    recoveryemail: recoveryemail
                },
                success: function (result) {

                	$(".alertmesage_recovery").css("color","Red");
					$(".alertmesage_recovery").text("a link has been sent to your mailid, Please click on that link to reset your password").show();
					 setTimeout(function () {
			                $(".alertmesage_recovery").fadeOut(300, function () {});
			            }, 8000);
			            return false;
                	$('.alertmesage_recovery').

                	//alert(result); return false;
                	//if(result == 1){


                		//$('#myModal').modal('show');
                	}
                	/*else if(result == "not activate"){
                		$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Please activate your account by clicking on confirmation link that has sent to your mail").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);
				        return false;
                	}
                	else
                	{
                		$(".alertmesage_signin").css("color","Red");
                		$(".alertmesage_signin").text("Mail id or password is invalid, Please check").show();
						setTimeout(function () {
				                $(".alertmesage_signin").fadeOut(300, function () {});
				        }, 8000);
				        return false;

                	}*/
                //}
            });

	});
});
function showhide(){
			
			$('.close').trigger('click');
			//$('#squarespaceModalemail').modal('toggle');
			
			
		}
/*function hideshow(){
	$('#squarespaceModalemail').modal('toggle');
}*/