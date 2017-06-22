var Url = window.location.origin;
$(function(){
	//alert(1);
	$("#squarespaceModalchangeimage").modal('show');
	$(".upgradelink").click(function () {
        $('#error-message').fadeIn();
        $('.message-error').html("Your account seems to be inactive. Please contact us to finish publishing.<br/>Phone: 088-1415001<br/>E-mail: info@smartfanpage.com");
        $('body').css('overflow-y', 'hidden');
    });
    $('#profileimagechange').on('change', function () {

        var file        = this.files[0],
            filesize    = file.size / 1024,
            sFileName   = file.name;

        if (filesize < 5120) {
            $("#profileimagechangeform").ajaxSubmit({
                data: {
                    filename : 'profileimage',
                    value    : 'profile'
                },
                success: function (result) {
                    	
                    var response = JSON.parse(result);
                    if (response.error == 0 || response.error == 1) {

                        $(".welcome").show();
                        $(".showmsg").html("<span>please select an image</span>");
                    
                    } else {
                           
                        $("#canvas-placeholderpfimage").html('<img name="image Name" id="pfimgId" src="/upload/profileImage/'+response.filePath+'" style="width:100%;height:100%;">');
                        $("#pfimagePath").val(response.filePath);

                    }
                }
            });
        } else {

                $('#imagechange').val('');
                $('#error-message').fadeIn();
                $('.message-error').html(sFileName + " size is more than 5MB. Please upload an image less than 1MB");
                $('body').css('overflow-y', 'hidden');
        }

    });

    $("#backgroundimagechange").on('change', function () {
        
        var file        = this.files[0],
            filesize    = file.size / 1024,
            sFileName   = file.name;



        if (filesize < 5120) {
            $("#profileimagechangeform").ajaxSubmit({
                data: {
                    filename    : 'backgroundimage',
                    value       : 'background'
                },
                success: function (result) {
                       
                    var response = JSON.parse(result);
                    if (response.error == 0 || response.error == 1) {

                        $(".welcome").show();
                        $(".showmsg").html("<span>please select an image</span>");

                    } else {
                           
                        $("#canvas-placeholderbkimage").html('<img name="image Name" id="bkimgId" src="/upload/backgroundImage/'+response.filePath+'" style="width:100%;height:100%;">');
                        $("#bkimagePath").val(response.filePath);
                    }
                }
            });

        } else {
                $('#imagechange').val('');
                $('#error-message').fadeIn();
                $('.message-error').html(sFileName + " size is more than 5MB. Please upload an image less than 1MB");
                $('body').css('overflow-y', 'hidden');
            }
    });

    $("#profilesaveimageDetails").click(function(){

        var profileimageNmae    = $("#pfimagePath").val(),
            backgroundimageName = $("#bkimagePath").val();

        $.ajax({
            type : "POST",
            Url  : Url + "/account/saveboth",
            data : {
                profileimageNmae    : profileimageNmae,
                backgroundimageName : backgroundimageName
            },
            success: function (result) {
                alert(result);return false;
            }
        });

    });
});
