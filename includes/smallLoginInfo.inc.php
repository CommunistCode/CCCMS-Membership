<?php

	$member = unserialize($_SESSION['member']);

	echo("Logged in as ".$member->getUsername()."<br />");
	echo("<a href='".$directoryPath."/membership/index.php'>Members Area</a><br />");	
	echo("<a href='".$directoryPath."/membership/logout.php'>Logout</a>");

?>
