<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("classes/memberTools.class.php");

	$memberTools = new memberTools();

	if (isset($_POST['submit'])) {

		if ($memberTools->login($_POST['username'],$_POST['password'])) {

			header("Location: index.php");

		}

		else {

			$content = "<p><strong>Your login credentials were incorrect.</strong></p>";

		}

	}

	else {

		$content = "<p>You must login to view this are of the site!</p>";

	}

	$content .= "<br />";

	$heading = "Member Login";
	$include = "includes/login.inc.php";

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");
			
?>
