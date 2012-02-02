<?php

	if (isset($_SESSION['memberLoggedIn'])) {
	
		require_once ("classes/memberTools.class.php");

		$memberTools = new memberTools();

		$linkArray = $memberTools->getSidebarLinks();
		$firstRun = 1;

		foreach ($linkArray as $category) {

			$categoryName = array_shift($category);

			if ($firstRun ) {
				
				echo("<div class='linkHeader linkHeaderTop'>".$categoryName."</div>");

			} else {

				echo("<div class='linkHeader'>".$categoryName."</div>");

			}

			echo("<ul>");

			foreach ($category as $link) {

				echo("<li><a href='".$link['url']."'>".$link['anchor']."</a></li>");

			}

			echo("</ul>");

			$firstRun = 0;

		}

	}

?>
