<?php

	require_once($fullPath . "/classes/dbConn.class.php");
	require_once($fullPath . "/classes/pdoConn.class.php");
	require_once($fullPath . "/membership/classes/member.class.php");
	
	class memberTools {

    private $pdoConn;

    function __construct() {

      $this->pdoConn = new pdoConn();

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

      $field = "username";
      $table = "members";
      
      $where[0]['column'] = "email";
      $where[0]['operator'] = "=";
      $where[0]['value'] = $email;

			$result = $this->pdoConn->select($field,$table,$where);

      $data = array_shift($result);

			if ($data) {

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

          $table = "members";
          
          $set[0]['column'] = "password";
          $set[0]['value'] = $hashedPassword;

          $where[0]['column'] = "email";
          $where[0]['value'] = $email;

					$updateResult = $this->pdoConn->update($table,$set,$where);
          
          if ($updateResult['error']) {

						return 0;

					} else {

						return 1;

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

			$hashedPassword = md5($password);

      $fields = array("memberID","username","password");
      $table = "members";

      $where[0]['column'] = "username";
      $where[0]['value'] = $username;

      $where[1]['column'] = "password";
      $where[1]['value'] = $hashedPassword;

			$result = $this->pdoConn->select($fields,$table,$where);
			
      if(count($result) == 1) {

				$_SESSION['member'] = serialize(new member($result[0]));
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

      $field = "username";
      $table = "members";

      $where[0]['column'] = "username";
      $where[0]['value'] = $username;

			$result = $this->pdoConn->select($field,$table,$where);

			if (count($result) == 1) {

				return false;
				
			}	

			else {

				return true;

			}
		
		}

		public function getSidebarLinks() {

			$linkArray = array();

      $field = "DISTINCT category";
      $table = "memberLinks";

			$result = $this->pdoConn->select($field,$table);
      
      $i = 0;

      foreach($result as $categoryRow) {

				$linkArray[$i]['categoryName'] = $categoryRow['category'];

        $fields = array("linkName","destination");
        $table = "memberLinks";

        $where[0]['column'] = "category";
        $where[0]['value'] = $categoryRow['category'];

				$subResult = $this->pdoConn->select($fields,$table,$where);

        $iSub = 0;

        foreach($subResult as $subRow) {

					$linkArray[$i][$iSub]['url'] = $subRow['destination'];
					$linkArray[$i][$iSub]['anchor'] = $subRow['linkName'];
 
          $iSub++;
	
				}

        $i++;

			}

			return $linkArray;

		}

		public function getUsername($id) {
			
      $field = "username";
      $table = "members";

      $where[0]['column'] = "memberID";
      $where[0]['value'] = $id;

			$result = $this->pdoConn->select($field,$table,$where);

      return ($result[0]['username']);
			
		}

	}

?>
