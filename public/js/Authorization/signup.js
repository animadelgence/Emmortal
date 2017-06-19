$(document).ready(function () {

	$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });

$('#signupbutton').click(function(){

	var firstName = $("#fname").val(),
	lastName = $("#lname").val(),
	email = $("#email").val(),
	password = $("#password").val(),
	confirmpassword = $("#confirmPassword") .val(),
	dob = $("#datepicker").val(),
	regexemail = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/,
	regexpassword = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
	if(firstName == "")
	{
		$(".alertmesage_signup").css("color","Red");
		$(".alertmesage_signup").text("Enter your First name").show();
		 setTimeout(function () {
                $(".alertmesage_signup").fadeOut(300, function () {});
            }, 8000);
            return false;
		
	}
	if(lastName == "")
	{
		$(".alertmesage_signup").css("color","Red");
		$(".alertmesage_signup").text("Enter your Last name").show();
		 setTimeout(function () {
                $(".alertmesage_signup").fadeOut(300, function () {});
            }, 8000);
            return false;
		
	}
	if(email == "")
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
	if(password == ""){
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
	}else if(password !== confirmpassword){
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



	}else{

		$("#signup_form").ajaxSubmit({
                data: {
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    password: password,
                    dob: dob
                },
                success: function (result) {
                	//alert(result);return false;
                	if(result == 1){
                		alert("welcome to emmortal,please check your mail and confirm the link to logged in");
                	}else {
                		alert("Already have an account with this mail id");
                	}
                    
                    //return false;
                    

                }
            });
		}
	});
/*$("#signin").click(function(){
	$(".signin_popup").show();
	$(".signup_popup").hide();
	
});*/

	


});
function showhide(){
			
			$('.close').trigger('click');
			//$('#squarespaceModalemail').modal('toggle');
			
			
		}