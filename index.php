<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("includes/checkLogin.inc.php");
	require_once("classes/memberTools.class.php");

	$memberTools = new memberTools();

	$heading = "Members Area";
	$content = unserialize($_SESSION['member'])->getUsername();

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");

?>
