<?php

	require_once($fullPath . "/classes/dbConn.class.php");
	require_once($fullPath . "/membership/classes/member.class.php");
	
	class memberTools {

		
		function generatePassword($length = 8) {

			$password = "";

			$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

			$maxlength = strlen($possible);
											  
			if ($length > $maxlength) {
			  $length = $maxlength;
			}
														
			$i = 0; 
															    
			while ($i < $length) { 

				$char = substr($possible, mt_rand(0, $maxlength-1), 1);
																					        
				if (!strstr($password, $char)) { 
					$password .= $char;
			    $i++;
			
				}

			}

		  return $password;

		}
		
		public function sendNewDetails($email) {

			$db = new dbConn();

			$result = $db->selectWhere("username","members","email='".$email."'");

			if ($data = $result->fetch_assoc()) {

				$newPassword = $this->generatePassword(8);

				$message = "Your MantisMarket password has been reset, please find your new details below:\n\nUsername: ".$data['username']."\nPassword: ".$newPassword."\n\nThank you for using MantisMarket.";

				$to = $data['username'] ."<". $email .">";
  	    $subject = "MantisMarket: Password Reset";
    	  $message = wordwrap($message,70);
      	$headers = 'From: MantisMarket Admin <no-reply@mantismarket.co.uk>'."\r\n";

				if (mail($to,$subject,$message,$headers)) {

					$hashedPassword = MD5($newPassword);

					if ($db->update("members","password='".$hashedPassword."'","email='".$email."'")) {

						return 1;

					} else {

						return 0;

					}

				} else {

					return 0;

				}

			}

		}
		
		public function checkPassword($currentPassword,$newPass,$newPassConfirm) {

			if (!strcmp($newPass,$newPassConfirm)) {

				$member = unserialize($_SESSION['member']);

				if ($this->login($member->getUsername(),$currentPassword)) {

					$member->updatePassword(md5($newPass));
					return true;

				}

			} else {

				return false;

			}

		}
		
		public function login($username, $password) {

			$db = new dbConn();

			$hashedPassword = md5($password);
			$result = $db->selectWhere("memberID,username,password","members","username='".$username."' AND password='".$hashedPassword."'",0);

			if($result->num_rows == 1) {

				$_SESSION['member'] = serialize(new member($result->fetch_array(MYSQLI_ASSOC)));
				$_SESSION['memberLoggedIn'] = 1;
				return true;

			}

			else {
	
				return false;

			}

		}

		public function logout() {

			unset($_SESSION['member']);
			unset($_SESSION['memberLoggedIn']);
			session_destroy();	

		}

		public function createMember($username,$password,$email,$location) {

			$db = new dbConn();

			if ($db->insert("members","username, password, email, location","'".$username."','".$password."','".$email."','".$location."'",0)) {

				return true;

			}

			else {

				return false;

			}

		}

		public function checkEmail($email) {

			if(preg_match("~^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$~", $email)) {

				return true;
	
			}

			else {

				return false;

			}

		}

		public function checkUsername($username) {

			$db = new dbConn();

			$result = $db->selectWhere("username","members","username='".$username."'",0);

			if ($result->num_rows == 1) {

				return false;
				
			}	

			else {

				return true;

			}
		
		}

		public function renderLinks() {

			$db = new dbConn();

			$result = $db->select("DISTINCT category","memberLinks",0);

			echo("<ul>");

			while ($row = $result->fetch_assoc()) {

				echo("<li><strong>".$row['category']."</strong></li>");

				$subResult = $db->selectWhere("linkName,destination","memberLinks","category='".$row['category']."'",0);

				while ($subRow = $subResult->fetch_assoc()) {

					echo("<li><a href='".$subRow['destination']."'>".$subRow['linkName']."</a></li>");

	
				}

			}

			echo("</ul>");

		}

	}

?>
