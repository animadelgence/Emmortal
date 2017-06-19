$(document).ready(function () {
	//alert(1);
	if($(".welcome").css('display') == "block")
    {
    	//alert(2);
        setTimeout(function () {
                    $(".welcome").fadeOut(300, function () {});
                }, 8000);
                return false;
    }


});