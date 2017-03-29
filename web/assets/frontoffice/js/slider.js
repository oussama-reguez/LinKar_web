$( document ).ready(function() {
   
$("#slideshowSky > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshowSky > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshowSky');
},  10000);

$("#slideshowBann > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshowBann > div:first')
    .fadeOut(1000)
    .next()
    .fadeIn(1000)
    .end()
    .appendTo('#slideshowBann');
},  10000);

});