<?php 
require_once('encrypt.inc.php');
require_once('utility.class.php'); 

class Login extends Utility{
	use DBConnection;


	/*
		THIS FUNCTION WILL VALIDATE THE USER AND RETURN THE 
		$login 		= user input for login name
		$password 	= user input for password
		$dbLogin    = database login column name
		$dbPass     = database password column name
		$table      = table name to query
	*/

	function validate($login, $password, $bdLogin, $dbPass, $table, $frdUrl){


		$select     = "SELECT * FROM ".$table." WHERE ".$bdLogin." = '$login'";
		$query      = $this->conn->query($select);
		$rows 		= $query->num_rows;
		$result 	= $query->fetch_array();

		//echo $select." ".mysql_num_rows($query);echo $select ;echo "DB Pass = ".$x_password.", Encrypted pass = ".$dbpass;exit;
		//echo $select.mysql_error();exit;

	
		if($rows > 0){

			//get the password
			$dbpass	    = $result[$dbPass];
			$x_password = md5_decrypt($dbpass,USER_PASS);

			// echo $x_password;exit;
			//check if account is verified
			$accVer		= $result['acc_verified'];

			if($accVer == 'Y'){

				if($password == $x_password){

					$_SESSION[USR_SESS] = $login;

					$_SESSION['name']   					= $result['fname']." ".$result['lname'];
					$_SESSION['welcome_name']   			= $result['fname'];
					$_SESSION['userid'] 					= $result['customer_id'];
					// $_SESSION['usertypeid'] 				= $result['designation'];
					$_SESSION['usertypeid'] 				= $result['profession'];
					$_SESSION['customer_type'] 				= $result['customer_type'];


					//update customer info
					$update = "UPDATE 	customer_info 
							   SET 		last_logon = now(), no_logon = no_logon + 1 
							   WHERE 	customer_id = '".$_SESSION['userid']."'";

					

					//execute query	   
					$this->conn->query($update);
					$session_id	= session_id();

					//determine where to forward user after login
					if(isset($_SESSION['goto'])){

						 $goto	= $_SESSION['goto'];
						 $url 	= $goto.".php";

						 //remove session go to
						 $this->delSession('goto');
						 header("Location: ".$url);

					}elseif($_SESSION['customer_type'] == 1){

						header("Location: seller/dashboard.php");

					}elseif($_SESSION['customer_type'] == 2){

						header("Location: user/app.client.php");

					}else{

					   //exit(header("Location: /employee_account.php"));
						header("Location: ".$frdUrl);

					}

				}else{

					header("Location: "."index.php"."?action=login&msg=Invalid username or password&typeM=ERROR");

				}

			}else{

				//account verified
				header("Location: "."index.php"."?action=login&msg=Your account is waiting for verification&typeM=ERROR");

			}

		}else{
			//no user
			header("Location: "."index.php"."?action=login&msg=Invalid username or password&typeM=ERROR");

		}

	}//eof





	function validatePackLogin($login, $password, $bdLogin, $dbPass, $table, $frdUrl){



		$select     = "SELECT * FROM ".$table." WHERE ".$bdLogin." = '$login'";

		$query      = $this->conn->query($select);

		$result 	= $query->fetch_array();



		//echo $select." ".mysql_num_rows($query);echo $select ;echo "DB Pass = ".$x_password.", Encrypted pass = ".$dbpass;exit;

		//echo $select.mysql_error();exit;



		if($query->num_rows > 0)

		{

		//get the password

		$dbpass	    = $result[$dbPass];

		$x_password = md5_decrypt($dbpass,USER_PASS);

		//	echo $x_password;exit;

		//check if account is verified

		$accVer		= $result['acc_verified'];



		if($accVer == 'Y'){

			if($password == $x_password){



			//	$_SESSION[USR_SESS] = $login;



			$_SESSION['name']   					= $result['fname']." ".$result['lname'];

			$_SESSION['welcome_name']   			= $result['fname'];

			$_SESSION['userid'] 					= $result['customer_id'];

			//	$_SESSION['usertypeid'] 				= $result['designation'];

			$_SESSION['customer_type'] 				= $result['customer_type'];



			//update customer info

			$update = "UPDATE 	customer_info

					SET 		last_logon = now(), no_logon = no_logon + 1

					WHERE 	customer_id = '".$_SESSION['userid']."'";



			//execute query

			$this->conn->query($update);



			$session_id	= session_id();



			//determine where to forward user after login

				if(isset($_SESSION['goto'])){

					$goto	= $_SESSION['goto'];

					$url 	= $goto.".php";



					//remove session go to

					$this->delSession('goto');

					echo "Goto";

					//header("Location: ".$url);

					}elseif($_SESSION['customer_type'] == 2){

						//	header("Location: /app.client.php");

						echo "Customer-type";

					}else{

						//exit(header("Location: /employee_account.php"));

						//	header("Location: ".$frdUrl);

						//echo "success";

						$success = "success";

						$currentId = $_SESSION['userid'];

						echo $success.",".$currentId;

					}

				}else{

					//	header("Location: "."index.php"."?action=login&msg=Invalid username or password&typeM=ERROR");

					echo "Invalid";

				}

			}else{

				//account verified

				//	header("Location: "."index.php"."?action=login&msg=Your account is waiting for verification&typeM=ERROR");

				echo "Pending For Varification";

			}



		}else{

			//no user

			//	header("Location: "."index.php"."?action=login&msg=Invalid username or password&typeM=ERROR");

		}



	}//eof

	

}//eoc

?>