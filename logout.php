<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("classes/memberTools.class.php");

	$memberTools = new memberTools();

	$memberTools->logout();

	$heading = "Logout";
	$content = "<p>You have been logged out!</p>";

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");

?>
