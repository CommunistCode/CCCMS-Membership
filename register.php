<?php 

	require_once("../config/config.php");
	require_once("../includes/global.inc.php");
	require_once("classes/memberTools.class.php");

	$registration = 0;

	//Have the default include for this page with no parameters passed
	$include = "includes/registrationForm.php";
	$heading = "Registration";

	$memberTools = new memberTools();
	
	if (isset($_POST['submit'])) {

		$checkUsername = $memberTools->checkUsername($_POST['username']);
		$checkEmail = $memberTools->checkEmail($_POST['email']);
		$checkPassword = strcmp($_POST['password'],$_POST['confirmPassword']);

		if ($checkUsername AND $checkEmail AND $checkPassword == 0 /*AND isset($_POST['tandc'])*/) {

			$location = trim($_POST['town']) .", ".$_POST['country'];

			$memberTools->createMember($_POST['username'],md5($_POST['password']),$_POST['email'],$location);
		
			//Member succesfully created
			$registration = 2;
			$content = "<p>Registration was sucessfull please <a href='login.php'>login here</a>.</p>";
			$include = NULL;

		}

		else {
		
			//Registration details did not comply to rules 
			$registration = 1;
			$content = "<p><strong>An error was found with your registration form!</strong><p>";
			$include = "includes/registrationForm.php";

		}
	}

	require_once("themes/".$pageTools->getTheme("membership")."/templates/template.inc.php");

?>
