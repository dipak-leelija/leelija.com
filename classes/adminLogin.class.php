<?php 
/**
*	Use this class to work with admin login. Create new admin user, delete user, disable user
*	edit user and edit password funtionalities are icluded in this class.
*
*	In the latest update on December 06, 2009, we have deleted the created on field. Added administrator
*	image, added_on and modified on field.	
*
*	@author     	Himadri Shekhar Roy
*	@date   	 	October 17, 2006
*	@update			December 06, 2009
*	@version 		1.1
*	@copyright 		Analyze System
*	@email			himadri.s.roy@ansysoft.com
*/


require_once('encrypt.inc.php'); 
require_once('utility.class.php'); 

class adminLogin extends Utility
{
	use DBConnection;

	/**
	*	Validate the admin user against its login and password.
	*
	*	@param	
	*			$login 		user input for login name
	*			$password 	user input for password
	*			$dbLogin    database login column name
	*			$dbPass     database password column name
	*			$table      table name to query
	*
	*	@return NULL
	*/
	function validate($login, $password, $bdLogin, $dbPass, $table)
	{
		// echo $login.'<br>'.$password.'<br>'.$bdLogin.'<br>'.$dbPass.'<br>'.$table;exit;

		$select     = "SELECT * FROM ".$table." WHERE ".$bdLogin." = '$login'";
		// echo $select.$this->conn->error;
		$query      = $this->conn->query($select);
		// print_r($query); 
		
		foreach($query as $rowquery){
			$rowquery[$dbPass];
			// echo $rowquery[$dbPass].'<br>';
		}
		
		$rows 		= $query->num_rows;
		//if user found
		if($rows > 0)
		{
			$dbpass	    = $rowquery[$dbPass];
			$x_password = md5_decrypt($dbpass,ADMIN_PASS);
			// echo $x_password;exit;
			
			
			//if password match
			if($password == $x_password)
			{
				//user session
				$_SESSION[ADM_SESS]      = $login;
				
				//name session
				$_SESSION['adminuser']  = $rowquery['fname']." ".$rowquery['lname'];
				
				//email session
				$_SESSION['adminemail'] = $rowquery['email'];
				
				//statement to update login detail
				$update = "UPDATE admin_users SET last_logon = now(), no_logon = no_logon + 1
						   WHERE username = '$login'";
				
				//execute query
				// mysql_query($update);
				$query   = $this->conn->query($update);

				
				$session_id	= md5(session_id());
				
				//get the page name
				if(isset($_SESSION['goToAdm']))
				{
					$pageName	= $_SESSION['goToAdm'];
					$id_var		= $_SESSION['id_var'];
					$id_var_val	= $_SESSION['id_var_val'];
				}
				else
				{
					$pageName	= 'admin';
					$id_var		= '';
					$id_var_val	= 0;
				}
				
				//forward page
				$forwardPage	= $this->buildForwardPage($pageName, 'php');
				
				//url
				$url	= $forwardPage.'?session_id='.$session_id."&".$id_var."=".$id_var_val;
				
				//forwarding 
				header("Location: ".$url);
				
			}
			else
			{
				header("Location: ".$_SERVER['PHP_SELF']."?msg=invalid username or password");
			}
		}
		else
		{
			header("Location: ".$_SERVER['PHP_SELF']."?msg=invalid username or password");
		} 
		
	}//eof
	
	/**
	*	Create a new login
	*
	*	@param
	*			$username		User name using as primary key
	*			$password		Text password before encryption
	*			$fname			First name of the of the user
	*			$lname			Last name of the user
	*			$address		Address of the administrator
	*			$email			Email of the administrator
	*		
	*	@return NULL
	*/
	function createUser($username, $password, $fname, $lname, $address,$usertype, $email)
	{
		//added security
		$fname		= addslashes(trim($fname));
		$lname		= addslashes(trim($lname));
		$address	= addslashes(trim($address));
		$usertype	= addslashes(trim($usertype));
		
		//encrypt password
		$x_password = md5_encrypt($password,ADMIN_PASS);
		
		//statement
		$sql	 =  "INSERT INTO admin_users
					(username, password, fname, lname, address,usertype, email, added_on)
					VALUES
					('$username','$x_password', '$fname','$lname', '$address','$usertype', '$email', now())
					";
			
		//execute query			
		$query   = mysql_query($sql);
		
	}//eof
	
	
	/**
	*	Update user information excluding password 
	*	
	*	@param	
	*			$id			User unique identity
	*			$fname  	User first name
	*			$lname  	User last name
	*			$address    Address associated with the user
	*			$email		Administrator email
	*/
	function updateAdmin($id, $fname, $lname, $address, $email)
	{
		//statement
		$sql	 = "UPDATE admin_users 
					SET 
					fname    	= '$fname' ,
					lname    	= '$lname' ,
					address  	= '$address' ,	
					email    	= '$email',
					modified_on	= now()				
					WHERE username='$id'";
			
		//execute query		
		$query  = mysql_query($sql);
		
	}//eof
	
	
	/**
	*	Change the user password. As changing password is done by administrator, so he doesn't 
	*	need to enter old password
	*	
	*	@param	
	*			$id			User unique identity
	*			$password	User New Password
	*/
	function changePassword($id, $password)
	{
		$x_password = md5_encrypt($password,ADMIN_PASS);
		$update = "UPDATE admin_users SET password= '$x_password' WHERE username='$id'";
		$query  = mysql_query($update);
	}//eof
	
	
	
	/**
	* 	Delete user. This is a generic function, which can be used in other cases as well.
	*
	*	@param	
	*			$userId		User identity
	* 			$fieldName	Column name of user identity
	*			$tableName	Table which holds user information
	*/
	function deleteUser($userId, $fieldName, $tableName)
	{
		$delete = "DELETE FROM ".$tableName." WHERE ".$fieldName." = '$userId'";
		$query  = mysql_query($delete);
		if(!$query)
		{
			return mysql_error();
		}
	}//eof
	
	/**
	*	Fetch all the user id and store in an array
	*	@return NULL
	*/
	function getAllUserId()
	{
		$select     = "SELECT username FROM admin_users";
		$query      = mysql_query($select);
		$data   	= array();
		while($result = mysql_fetch_array($query))
		{
			$data[] = $result['username'];
		}
		
		return $data;
	}//eof
	
	
	 public function ShowAdminData(){
     $temp_arr = array();
     $res = mysql_query("SELECT * FROM admin_users order by fname desc") or die(mysql_error());        
     $count=mysql_num_rows($res);
    while($row = mysql_fetch_array($res)) {
         $temp_arr[] =$row;
		 
     }
     return $temp_arr;  
     }
	
	
	/**
	*	Get user information corresponding to a user and holds information in an array
	*	@return array
	*/
	function getUserDetail($id)
	{
		//declare var
		$data		= array();
		
		//statement
		$select     = "SELECT * FROM admin_users WHERE username='$id'";
		//echo $select;
		//execute query
		$query      = $this->conn->query($select);
		$rows 		= $query->num_rows;
		if($rows > 0)
		{
			//get the result set
			$result 	= $query->fetch_object();
			
			//hold the data in array
			$data   	= array(
								  $result->fname,			//0
								  $result->lname,			//1
								  $result->address,			//2
								  $result->usertype,		//3
								  $result->email,			//4
								  $result->image,			//5
								  $result->last_logon,		//6 
								  $result->no_logon,		//7 
								  $result->added_on,		//8 
								  $result->modified_on,		//9 
								  $result->username		//10 
							   );
		}
		
		//return the data
		return $data;
		
	}//eof
	
	////////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	*	This function generate the form
	*/
	function genVerifyForm($web_id, $user_id)
	{	
		
		echo 
		"<div class='orangeLetter'>
		Enter your Admin Pass to view user password:<br />
		<input name='pass' type='password' size='20' maxlength='64' id='pass'>
		<input name='web_check_id' type='hidden' value='".$web_id."' id='web_check_id'>
		<input name='user_check_id' type='hidden' value='".$user_id."' id='user_check_id'>
		<input name='btnCheck' type='button' onClick='checkPass()' value='OK' class='black'>
		</div>
		";
	}//eof
	
	/**
	*	Authorize user and returns values
	*/
	function authAdmin($web_id, $userPass, $userId)
	{
		if(!isset($_SESSION[ADM_SESS]))
		{
			echo "<label class='orangeLetter'>Error: You are not authorized to view</label>";
		}
		else
		{
			$select     = "SELECT * FROM admin_users WHERE username = '".$_SESSION[ADM_SESS]."'";
			$query      = mysql_query($select);
			$result 	= mysql_fetch_array($query);
			
			if(mysql_num_rows($query) > 0)
			{
				$dbpass	    = $result['password'];
				$x_password = md5_decrypt($dbpass,ADMIN_PASS);
				
				
				if($userPass == $x_password)
				{
					//get user password
					$sql 	= "SELECT user_password FROM webpage WHERE user_name='$userId'";
					$query	= mysql_query($sql);
					
					if(mysql_num_rows($query) > 0)
					{
						$res	= mysql_fetch_array($query);
						$data	= $res['user_password'];
						$decrp	= md5_decrypt($data,USER_PASS);
						echo "<label class='greenLetter'>".$decrp."</label> &nbsp;&nbsp;&nbsp;&nbsp;
						<input name='btnClose' type='button' id='btnClose' onClick='goBack(".$web_id.", \"".$userId."\")' value='ok'
						class='button-cancel'>
						";
					}
					else
					{
						echo "<label class='orangeLetter'>Error: You are not authorized to view</label>";
					}
				}//if
				else
				{
					echo "<label class='orangeLetter'>Error: You are not authorized to view</label>";
				}
			}
			else
			{
				echo "<label class='orangeLetter'>Error: You are not authorized to view</label>";
			}
		}//else
		
	}//eof
	
}
?>