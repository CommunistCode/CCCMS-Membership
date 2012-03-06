<?php 

	require_once("includes/memberGlobal.inc.php");

  $content = "";

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

	$include = "includes/login.inc.php";

  $page->set("title","Member Login");
  $page->set("heading","Member Login");
  $page->addContent($content);
  $page->addInclude("includes/login.inc.php");
  $page->render("corePage.inc.php");  

?>
