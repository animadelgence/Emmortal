function getRandomSize(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}
var gridster = "";

    $(function () {


gridster = $(".gridster ul").gridster({
            namespace: '.gridster',
            widget_base_dimensions: [182,181],
            widget_margins: [10, 10],
            max_cols:6
        }).data('gridster').disable();
    });


/*

for (var i = 0; i < 25; i++) {
  var width = getRandomSize(200, 400);
  var height =  getRandomSize(200, 400);
  $('#photos').append('<img src="//www.lorempixel.com/'+width+'/'+height+'/cats" alt="pretty kitty">');
}

    TwitterFacebookPocket*/
