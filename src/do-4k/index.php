<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome To Provo City School District</title>
	<link rel="stylesheet" type="text/css" href="slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
	<link rel="stylesheet" href="style.css?v=1.0">
</head>

<body>
	<header class="mainHeader">
		<img src="assets/pcsd-logo-website-header-x2.png" />
		<div class='time-frame'>
			<div id='date-part'></div>
			<div id='time-part'></div>
		</div>
	</header>
	<div class="container">

		<div class="leftColumn">
			<section class="directory">

				<?php
				$cnmenuhandle = curl_init();
				$cnmenuurl = "https://provo.edu/directory_page/district-tv-kiosk/";
				// Set the url
				curl_setopt($cnmenuhandle, CURLOPT_URL, $cnmenuurl);
				// curl_setopt($cnmenuhandle, CURLOPT_SSL_FALSESTART, true);
				// Set the result output to be a string.
				curl_setopt($cnmenuhandle, CURLOPT_RETURNTRANSFER, true);
				// dont verify SSL
				curl_setopt($cnmenuhandle, CURLOPT_SSL_VERIFYPEER, false);
				$cnmenuoutput = curl_exec($cnmenuhandle);
				// close the curl connection
				curl_close($cnmenuhandle);
				echo $cnmenuoutput;
				?>
			</section>
		</div>
		<div class="rightColumn">
			<!--
				<section class="websiteNews">

				</section>


				<section class="read-more">
					<p>Please visit Provo.edu to read story.</p>
				</section>
				-->
			<section class="meetingTimes">
				<!-- produced from calendar.php -->
			</section>
		</div><!-- end of leftColumn -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script>
		<script type="text/javascript" src="moment.js"></script>
		<script type="text/javascript" src="scripts.js"></script>
</body>

</html>