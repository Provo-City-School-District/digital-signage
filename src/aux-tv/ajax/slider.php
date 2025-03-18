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
