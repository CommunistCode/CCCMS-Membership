<?php 

	require_once("includes/memberGlobal.inc.php");
	
	$heading = "Forgotten Password";

	if (isset($_POST['email'])) {

		$include = "includes/sendNewDetails.inc.php";

	} else {

		$include = "includes/forgottenPasswordForm.inc.php";

	}

  $page->set("title","Forgotten Password");
  $page->set("heading","Forgotten Password");
  $page->addInclude($include);
  $page->render("corePage.inc.php");

?>
