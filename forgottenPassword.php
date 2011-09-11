<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("classes/memberTools.class.php");
	
	$heading = "Forgotten Password";

	if (isset($_POST['email'])) {

		$include = "includes/sendNewDetails.inc.php";

	} else {

		$include = "includes/forgottenPasswordForm.inc.php";

	}

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");

?>
