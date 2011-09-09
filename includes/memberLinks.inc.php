<?php

	if (isset($_SESSION['memberLoggedIn'])) {
	
		require_once ("classes/memberTools.class.php");

		$memberTools = new memberTools();

		$memberTools->renderLinks();

	}

?>
