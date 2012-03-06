<?php 

	require_once("includes/memberGlobal.inc.php");

  $page->set("title","Registration");
  $page->set("heading","Registration");

	$registration = 0;

	if (isset($_POST['submit'])) {

		$checkUsername = $memberTools->checkUsername($_POST['username']);
		$checkEmail = $memberTools->checkEmail($_POST['email']);
		$checkPassword = strcmp($_POST['password'],$_POST['confirmPassword']);

		if ($checkUsername AND $checkEmail AND $checkPassword == 0 /*AND isset($_POST['tandc'])*/) {

			$location = trim($_POST['town']) .", ".$_POST['country'];

			$memberTools->createMember($_POST['username'],md5($_POST['password']),$_POST['email'],$location);
		
			//Member succesfully created
			$registration = 2;
			$page->addContent("<p>Registration was sucessfull please <a href='login.php'>login here</a>.</p>");

		}

		else {
		
			//Registration details did not comply to rules 
			$registration = 1;
			$page->addContent("<p><strong>An error was found with your registration form!</strong><p>");
			$page->addInclude("includes/registrationForm.php");

		}

	} else {

	  $page->addInclude("includes/registrationForm.php");

  }

  $page->render("corePage.inc.php");

?>
