<?php 

	require_once("includes/memberGlobal.inc.php");

	$memberTools->logout();

  $page->set("title","Logout");
  $page->set("heading","Logout");
	$page->addContent( "<p>You have been logged out!</p>");
  $page->render("corePage.inc.php");

?>
