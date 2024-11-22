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
	<div id="wrapper">
		<header id="header">
			<img src="assets/pcsd-logo-website-header-x2.png" />
			<div class='time-frame'>
				<div id='date-part'></div>
				<div id='time-part'></div>
			</div>
		</header>
		<main>
			<section id="news">

				<?php
				error_reporting(E_ALL);
				ini_set('display_errors', 1);

				$rss = new DOMDocument();
				$context = stream_context_create(array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
					),
				));
				libxml_set_streams_context($context);
				libxml_use_internal_errors(true); // Suppress XML parsing errors

				// Fetch the RSS feed
				$rssContent = @file_get_contents('https://provo.edu/category/news/feed/');

				if ($rssContent === false) {
					// Log detailed error message
					$error = error_get_last();
					echo "Error: Unable to fetch RSS feed. Details: " . $error['message'];
				} else {
					// Clean the RSS feed using Tidy
					$tidy = new tidy();
					$config = array(
						'input-xml' => true,
						'output-xml' => true,
						'wrap' => 200
					);
					$tidy->parseString($rssContent, $config, 'utf8');
					$tidy->cleanRepair();

					// Load the cleaned RSS feed into DOMDocument
					if ($rss->loadXML($tidy)) {
						// Process the RSS feed
					} else {
						// Handle the error if the XML cannot be loaded
						echo "Error: Unable to load RSS feed.";
					}
				}

				$feed = array();
				foreach ($rss->getElementsByTagName('item') as $node) {

					$htmlStr = $node->getElementsByTagName('description')->item(0)->nodeValue;
					$html = new DOMDocument();
					libxml_use_internal_errors(true); // Suppress HTML parsing errors
					@$html->loadHTML($htmlStr);
					if (libxml_get_errors()) {
						foreach (libxml_get_errors() as $error) {
							echo "HTML Error: ", $error->message;
						}
						libxml_clear_errors();
					}
					$img = $html->getElementsByTagName('img')->item(0) ? $html->getElementsByTagName('img')->item(0)->getAttribute('src') : '';

					$item = array(
						'title' => $node->getElementsByTagName('title')->item(0) ? $node->getElementsByTagName('title')->item(0)->nodeValue : '',
						'desc' => $node->getElementsByTagName('description')->item(0) ? $node->getElementsByTagName('description')->item(0)->nodeValue : '',
						'image' => $img,
						'postcontent' => $node->getElementsByTagName('encoded')->item(0) ? $node->getElementsByTagName('encoded')->item(0)->nodeValue : '',
						'author' => $node->getElementsByTagName('creator')->item(0) ? $node->getElementsByTagName('creator')->item(0)->nodeValue : '',
						'category' => $node->getElementsByTagName('category')->item(0) ? $node->getElementsByTagName('category')->item(0)->nodeValue : '',
						'date' => $node->getElementsByTagName('pubDate')->item(0) ? $node->getElementsByTagName('pubDate')->item(0)->nodeValue : ''
					);
					array_push($feed, $item);
				}

				$limit = 3; // Limit to 3 items
				for ($x = 0; $x < $limit && $x < count($feed); $x++) {
					$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
					$image = $feed[$x]['image'];
					$author = $feed[$x]['author'];
					$postcontent = $feed[$x]['postcontent'];
					$category = $feed[$x]['category'];
					$description = $feed[$x]['desc'];
					$removeImage = preg_replace("/<img[^>]+\>/i", "", $postcontent);
					$removeImage = preg_replace("/<video[^>]+\>/i", "", $removeImage);
					$removeAnchor = preg_replace('#<a.*?>.*?</a>#i', '', $removeImage);
					$postdate = date('l F d, Y', strtotime($feed[$x]['date']));
				?>

					<article class="slide">
						<img src="<?php echo $image ?>" />
						<h1><?php echo $title ?></h1>
						<ul>
							<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php echo $postdate; ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/person-ltblue.svg" alt="" /><?php echo $author; ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/hamburger-ltblue.svg" alt="" /><?php echo $category; ?></li>
						</ul>
						<div class="slide-text">
							<?php echo $removeAnchor ?>
						</div>
					</article>

				<?php
				}
				?>

			</section>

			<section id="sidebar">

			</section>



		</main>
		<footer class="read-more">
			<p>Please visit Provo.edu to read entire story.</p>
		</footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script>
		<script type="text/javascript" src="moment.js"></script>
		<script type="text/javascript" src="scripts.js"></script>
</body>

</html>