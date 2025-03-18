<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome To Provo City School District</title>
  <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
  <link rel="stylesheet" href="style.css?v=1.0">
</head>
<body>
	<div id="wrapper">

		<section id="techNews">
			<?php
		    	$rss = new DOMDocument();
		    	$rss->load('https://employee.provo.edu/category/employee-news/technology-support/feed/');
		    	$feed = array();
		    	foreach ($rss->getElementsByTagName('item') as $node) {
		    		$htmlStr = $node->getElementsByTagName('description')->item(0)->nodeValue;
					$html = new DOMDocument();
					$html->loadHTML($htmlStr);
					//get the first image tag from the description HTML
					$img = $html->getElementsByTagName('img')->item(0)->getAttribute('src');
		    		$item = array (
		    			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
		    			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
		    			'image' => $img,
		    			//'img' => $node->getElementsByTagName('img')->item(0)->nodeValue
		    			//'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
		    			//'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		    			);
		    		array_push($feed, $item);
		    	}
		    	$limit = 3;
		    	for($x=0;$x<$limit;$x++) {
		    		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		    		$image = $feed[$x]['image'];
		    		//$link = $feed[$x]['link'];
		    		$description = $feed[$x]['desc'];
		    		$removeImage = preg_replace("/<img[^>]+\>/i", "", $description);
		    		$removeAnchor = preg_replace('#<a.*?>.*?</a>#i', '', $removeImage);
					//$result = explode(' </img>',$description);
		    		//$date = date('l F d, Y', strtotime($feed[$x]['date']));
		    		//echo '<p><strong>'.$title.'</strong><br />';
		    		//echo '<small><em>Posted on '.$date.'</em></small></p>';
		    		//echo '<p>'.$description.'</p>';
		    		?>
		    		<article class="slide" style="background-image: url(<?php echo $image ?>)">
			    		<div class="slide-text">
							<h2><?php echo $title ?></h2>
							<p><?php echo $removeAnchor ?></p>
			    		</div>
		    		</article>

		    		<?php
		    	}
		    ?>
		</section>

		<section id="calendar">

		</section>
	</div>
	<aside id="sidebar">
	</aside>
	<footer id="footer">
		<div id="marquee">

		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script src="scripts.js"></script>
</body>
</html>