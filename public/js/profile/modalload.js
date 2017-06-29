var getUrl = window.location.origin;
$(function(){

});
function modalopen(){

	$.get(getUrl+"/modal/albuminsertmodal.php", function (result) {
        // append response to body
        $('body').append(result);
        // open modal
        $('#albumInsertModal').modal('show');

    });

}