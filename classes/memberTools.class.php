<?php

	require_once($fullPath . "/classes/dbConn.class.php");
	require_once($fullPath . "/membership/classes/member.class.php");
	
	class memberTools {

		public function getUsername($id) {

			$db = new dbConn();

			$result = $db->selectWhere("username","members","memberID=".$id);

			$data = $result->fetch_assoc();

			return $data['username'];

		}
		
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

			require_once("Mail.php");
		
			ini_set('display_errors',0);

			$db = new dbConn();

			$result = $db->selectWhere("username","members","email='".$email."'");

			if ($data = $result->fetch_assoc()) {

				$newPassword = $this->generatePassword(8);

				$message = "Your MantisMarket password has been reset, please find your new details below:\n\nUsername: ".$data['username']."\nPassword: ".$newPassword."\n\nThank you for using MantisMarket.";

				$to = $data['username'] ."<". $email .">";
  	    $subject = "MantisMarket: Password Reset";
    	  $message = wordwrap($message,70);

				$from = "MantisMarket Admin <no-reply@mantismarket.co.uk>";				
				
				$headers = array ('From' => $from,
						'To' => $to,
						'Subject' => $subject);

				$host = "ssl://mail.mantismarket.co.uk";
				$port = "465";
				$username = "all@mantismarket.co.uk";
				$password = "mitchell";

				$smtp = Mail::factory('smtp',array('host' => $host,
							'port' => $port,
							'auth' => true,
							'username' => $username,
							'password' => $password));
				
				$mail = $smtp->send($to,$headers,$message);

				if (!PEAR::isError($mail)) {

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

		public function getSidebarLinks() {

			$db = new dbConn();

			$linkArray = array();

			$result = $db->select("DISTINCT category","memberLinks",0);

			for ($i=0; $i<$result->num_rows; $i++) {

				$categoryRow = $result->fetch_assoc();

				$linkArray[$i]['categoryName'] = $categoryRow['category'];

				$subResult = $db->selectWhere("linkName,destination","memberLinks","category='".$categoryRow['category']."'",0);

				for ($iSub=0; $iSub<$subResult->num_rows; $iSub++) {

					$subRow = $subResult->fetch_assoc();

					$linkArray[$i][$iSub]['url'] = $subRow['destination'];
					$linkArray[$i][$iSub]['anchor'] = $subRow['linkName'];
	
				}

			}

			return $linkArray;

		}

	}

?>
