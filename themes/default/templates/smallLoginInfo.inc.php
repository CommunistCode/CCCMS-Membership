<?php

	require_once($fullPath."/membership/classes/member.class.php");

	$member = unserialize($_SESSION['member']);

	echo("Logged in as ".$member->getUsername()."<br />");
	echo("<br />");
	echo("<a href='".$directoryPath."/membership/index.php'>Members Area</a><br />");	
	echo("<a href='".$directoryPath."/membership/logout.php'>Logout</a>");

?>
