//Slider Controls
$(document).ready(function(){
  $('.websiteNews').slick({
    autoplay: true,
	autoplaySpeed: 20000,
	arrows: false
  });
});


//Directory Pull
//$("#sidebar").load("ajax/directory.php");
//var auto_refresh_directory = setInterval(function () {
//	$('#sidebar').load('ajax/directory.php');
//}, 60000); // refresh every 60000 milliseconds(60 seconds)

//Calendar Pull
$(".meetingTimes").load("ajax/calendar.php");
var auto_refresh_directory = setInterval(function () {
	$('.meetingTimes').load('ajax/calendar.php');
}, 60000); // refresh every 60000 milliseconds(60 seconds)

//marquee Pull
//$("#marquee").load("ajax/marquee.php");
//var auto_refresh_directory = setInterval(function () {
//	$('#marquee').load('ajax/marquee.php');
//}, 60000); // refresh every 60000 milliseconds(60 seconds)


/*
$(document).ready(function(){
		
		
		var show_time='time';
		show_t(show_time);
		
		setInterval(function(){show_t(show_time); },1000);
	});
	function show_t(show_time){
		$.ajax({
			url:"show_time_using_ajax.php",
			method:"post",
			data:{show_time:show_time},
			success:function(data){
				$('#time').html(data);
			}
		})
	}
	*/
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('MMMM DD, YYYY') + ' '
                           // + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('hh:mm:ss A'));
    }, 100);
});