function getRandomSize(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}
var gridster = [];

    $(function () {


$(".clickme").click(function(){
    alert("cc")
     gridster[0] = $(".gridster ul").gridster({
            namespace: '.gridster',
            widget_base_dimensions: [182,181],
            widget_margins: [5, 5],
            max_cols:6
        }).data('gridster').disable();
    });
$(".clickme").trigger("click");
    });
/*

for (var i = 0; i < 25; i++) {
  var width = getRandomSize(200, 400);
  var height =  getRandomSize(200, 400);
  $('#photos').append('<img src="//www.lorempixel.com/'+width+'/'+height+'/cats" alt="pretty kitty">');
}

    TwitterFacebookPocket*/
