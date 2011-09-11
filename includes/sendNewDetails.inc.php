<?php

	$memberTools = new memberTools();
	$db = new dbConn();

	if ($db->checkExists("members","email",$_POST['email'])) {

		if ($memberTools->sendNewDetails($_POST['email'])) {

			echo("<p>Your email matched details in our database and your username and a new password has been sent to the address given.</p>");		

		} else {

			echo("Your email matched our records but an error occurred sending out new details, please try again!");

		}

	} else {

		echo("<p>The email given did not match any of our records!</p>");

	}

?>
