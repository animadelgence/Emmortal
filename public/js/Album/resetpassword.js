  var rootpath = window.location.origin;

  $(function(){


var URL = document.URL;
            //alert(document.URL);return false;
            var actionname = URL.split("/"),
             pathname = actionname[5],
             encryptedmailid = actionname[6];
            //alert(pathname);forgetpassword
        if(pathname == "resetpassword"){
        	//alert(pathname);
        		$('#squarespaceModalepassword').modal('show');

        		
        		$("#savepassbutton").click(function(){
        			//alert();
        			var forgetpassword = $('#forgetpassword').val(),
        			forgetconfirmPassword = $('#forgetconfirmPassword').val(),
        			regexpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;

        			if(forgetpassword == ""){
						$(".alertmesage_signup").css("color","Red");
						$(".alertmesage_signup").text("Enter password").show();
						 setTimeout(function () {
				                $(".alertmesage_signup").fadeOut(300, function () {});
				            }, 8000);
				            return false;
					} else if(!forgetpassword.match(regexpassword)) {
						$(".alertmesage_signup").css("color","Red");
						$(".alertmesage_signup").text("Password should contain atleast one uppercae,one lowercase and minimum 8 characters.").show();
						 setTimeout(function () {
				                $(".alertmesage_signup").fadeOut(300, function () {});
				            }, 8000);
				            return false;
					} else if(forgetconfirmPassword == "") {
						$(".alertmesage_signup").css("color","Red");
						$(".alertmesage_signup").text("Please enter the confirm pasword").show();
						 setTimeout(function () {
				                $(".alertmesage_signup").fadeOut(300, function () {});
				            }, 8000);
				            return false;
					}else if(forgetpassword !== forgetconfirmPassword){
						$(".alertmesage_signup").css("color","Red");
						$(".alertmesage_signup").text("Password mismatch").show();
						 setTimeout(function () {
				                $(".alertmesage_signup").fadeOut(300, function () {});
				            }, 8000);
				            return false;

					} else {

	        			$("#resetpassword_form").ajaxSubmit({
			                data: {
			                	encryptedmailid : encryptedmailid,
			                    forgetpassword: forgetpassword
			                },
			                success: function (result) {
			                	alert(result);return false;
			                	window.location.href = rootpath + "/album/showalbum";
			                }
			            });
	        		}
        			

        		});
        		
            
        }
            return false;
        



  });

  
