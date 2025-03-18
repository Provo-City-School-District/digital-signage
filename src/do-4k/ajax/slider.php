<?php
	$feed = array();
	$rss = new DOMDocument();
	$rss->load('http://provo.edu/feed/?cat=192');
//print_r($rss);

	foreach ($rss->getElementsByTagName('item') as $node) {
		$counter = 0;
		$htmlStr = $node->getElementsByTagName('description')->item(0)->nodeValue;
		$html = new DOMDocument();
		$html->loadHTML($htmlStr);

		//get the first image tag from the description HTML
		$img = $html->getElementsByTagName('img')->item(0)->getAttribute('src');
		$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'image' => $img,
			'postcontent' => $node->getElementsByTagName('encoded')->item(0)->nodeValue,
			'author' => $node->getElementsByTagName('creator')->item(0)->nodeValue,
			'category' => $node->getElementsByTagName('category')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
			);

		//array_push($feed, $item);
		//print_r($item);
		$feed[$counter]['title'] = $node->getElementsByTagName('title')->item(0)->nodeValue;
		$counter++;
	}
	print_r($feed);
	$limit = 3;
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$image = $feed[$x]['image'];
		$author = $feed[$x]['author'];
		$postcontent = $feed[$x]['postcontent'];
		$category = $feed[$x]['category'];
		//$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$removeImage = preg_replace("/<img[^>]+\>/i", "", $postcontent);
		$removeImage = preg_replace("/<video[^>]+\>/i", "", $removeImage);
		$removeAnchor = preg_replace('#<a.*?>.*?</a>#i', '', $removeImage);
		//$result = explode(' </img>',$description);
		$postdate = date('l F d, Y', strtotime($feed[$x]['date']));
		//echo '<p><strong>'.$title.'</strong><br />';
		//echo '<small><em>Posted on '.$date.'</em></small></p>';
		//echo '<p>'.$description.'</p>';
		?>
		<article class="slide">
			<h2><?php echo $title ?></h2>
			<ul>
				<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php echo $postdate; ?></li>
				<!-- <li><img src="//globalassets.provo.edu/image/icons/person-ltblue.svg" alt="" /><?php echo $author; ?></li> -->
				<!-- <li><img src="//globalassets.provo.edu/image/icons/hamburger-ltblue.svg" alt="" /><?php echo $category; ?></li> -->
			</ul>
			<img src="<?php echo $image ?>" />


			<!--
			<div class="slide-text">
				<p><?php echo $removeAnchor ?></p>
			</div>
			-->
		</article>

		<?php
	}
?>
