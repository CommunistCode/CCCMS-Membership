<?php 
	
  require_once("includes/memberGlobal.inc.php");
	require_once("includes/checkLogin.inc.php");

	$member = unserialize($_SESSION['member']);
  $content = NULL;

	if (isset($_POST['updateDetailsSubmit'])) {

		if ( $member->updateLocation($_POST['location']) && $member->updateEmail($_POST['email']) ) {

			$content = "<font color='green'>Details Updated!</font>";

		} else {

			$content = "<font color='red'>Update Failed!</font>";
		}

	}

	if (isset($_POST['changePassword'])) {

		if ($memberTools->checkPassword($_POST['currentPassword'],$_POST['newPass'],$_POST['confirmPass'])) {

			$content = "<font color='green'>Password Updated!</font>";

		} else {

			$content = "<font color='red'>Password could not be updated!</font>";

		}

	}

  $page->set("title","Update Details");
  $page->set("heading","Update Details");
  $page->addContent($content);
  $page->addInclude("includes/editDetails.inc.php",array("member"=>$member));
  $page->render("corePage.inc.php");

?>
