<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("includes/checkLogin.inc.php");
	require_once("classes/memberTools.class.php");

	$memberTools = new memberTools();

	$member = unserialize($_SESSION['member']);

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

	$heading = "Update Details";
	$include = "includes/editDetails.inc.php";

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");

?>
