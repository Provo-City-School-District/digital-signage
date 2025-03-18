//Slider Controls
$(document).ready(function(){
  $('#techNews').slick({
    autoplay: true,
	  	autoplaySpeed: 10000
  });
});


//Directory Pull
$("#sidebar").load("ajax/directory.php");
var auto_refresh_directory = setInterval(function () {
	$('#sidebar').load('ajax/directory.php');
}, 60000); // refresh every 60000 milliseconds(60 seconds)

//Calendar Pull
$("#calendar").load("ajax/calendar.php");
var auto_refresh_directory = setInterval(function () {
	$('#calendar').load('ajax/calendar.php');
}, 60000); // refresh every 60000 milliseconds(60 seconds)

//marquee Pull
$("#marquee").load("ajax/marquee.php");
var auto_refresh_directory = setInterval(function () {
	$('#marquee').load('ajax/marquee.php');
}, 60000); // refresh every 60000 milliseconds(60 seconds)