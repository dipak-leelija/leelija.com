<?php 
// include_once "_config/dbconnect.trait.php";

/**
*	Register a new user, edit or update registration information.
*
*	UPDATE	Dec 10, 2017
*	Customer type has been added to the system.
*
*	UPDATE	Dec 10, 2017
*	Customer verification has been added.
*/

include_once 'encrypt.inc.php'; 
include_once 'utility.class.php';


class Customer extends Utility{

	use DBConnection;
	/**
	*	Register a new Customer.
	*	
	*	@update	September 10, 2010
	*
	*	@param
	*			$user_name			User Name
	*			$email				Customers Email
	*			$password			Access password, require later
	*			$fname				First name of the client
	*			$lname				last name of the client
	*			$gender				Gender of the client
	*			$dob				Date of birth of the client
	*			$status				Status of the login which determine whether a clinets account is active or inactive
	*			$brief				Brief introducttion of the client
	*			$description		Description of the client
	*			$organization		Organization associated with the client
	*			$featured			Whether featured client or not
	*			$sort_order			Sorting order
	*			$profession			Profession of the customer or client 
	*			$cus_type			Type of customer e.g. vendor 
	*			$discount_offered	Discount offered to this client
	*
	*	@return int  $dob, 
	*/
	function addPackCustomer($cus_type, $member_id, $user_name, $email, $password, $fname, $lname, $gender,$dob, $status,
	$brief, $description, $organization, $featured, $profession, $sort_order, $verification_no,
	$acc_verified, $discount_offered){
		//declare var
		// $id	= 0;

		//get the values
		$email 				= trim($email);
		$password 			= trim($password);
		$fname 				= addslashes(trim($fname));
		$lname 				= addslashes(trim($lname));
		$user_name			= trim($user_name);
		$brief 				= addslashes(trim($brief));
		$description		= addslashes(trim($description));
		$organization		= addslashes(trim($organization));
		$sort_order			= (int)$sort_order;
		$profession			= addslashes(trim($profession));
		$cus_type			= (int)$cus_type;
		$discount_offered	= doubleval($discount_offered);
		$verified_by		= ''	;
		$verification_no	= addslashes(trim($verification_no));

		//Inserting in customer table
		$x_password = md5_encrypt($password,USER_PASS);

		//get all email id to check if it is registered or not
		$select = "SELECT * FROM customer WHERE email = '$email'";

		//execute query
		$query	= $this->conn->query($select);

		if($query->num_rows > 0){
		echo "duplicate";
		}else{
		//statement	dob, '$dob',
		$sql	 = 	 "INSERT INTO customer
			(customer_type, member_id, user_name, email, password, fname, lname, gender,dob,  status,
			brief, description, organization, featured, profession, sort_order, verification_no,
			acc_verified, verified_by, verified_on, discount_offered)
			VALUES
			('$cus_type','$member_id', '$user_name', '$email', '$x_password', '$fname', '$lname', '$gender','$dob', '$status',
			'$brief', '$description', '$organization', '$featured', '$profession','$sort_order', '$verification_no',
			'$acc_verified', '$verified_by', now(), '$discount_offered')";

		//execute query
		$query	= 	$this->conn->query($sql);

		//get the primary key
		$id		= 	$this->conn->insert_id;
		//echo $sql.mysql_error();exit;

		// inserting into customer info table
		$sql2	=   "INSERT INTO customer_info
			(last_logon, no_logon, added_on, customer_id)
			VALUES
			(now(), 1, now(), '$id')";
		$query2	= $this->conn->query($sql2);

		$sql3 = "INSERT INTO `customer_address`(`customer_id`) VALUES ('$id')";

		$query3 = $this->conn->query($sql3);

		}

		//return id
		if($id){
			echo "insert";
		}else {
			echo "Error";;
		}


	}//eof

	function addCustomer($cus_type, $member_id, $user_name, $email, $password, $fname, $lname, $gender,$dob, $status, 
					     $brief, $description, $organization, $featured, $profession, $sort_order, $verification_no, 
						 $acc_verified, $discount_offered){
		//declare var
		$id	= 0;
		
		//get the values
		$email 				= trim($email);
		$password 			= trim($password);
		$fname 				= addslashes(trim($fname));
		$lname 				= addslashes(trim($lname));
		$user_name			= trim($user_name);
		$brief 				= addslashes(trim($brief));
		$description		= addslashes(trim($description));
		$organization		= addslashes(trim($organization));
		$sort_order			= (int)$sort_order;
		$profession			= addslashes(trim($profession));
		$cus_type			= (int)$cus_type;
		$discount_offered	= doubleval($discount_offered);
		// $verified_by		= $_SESSION['DreamOF_sess_Tibet_ADM_2012'];
		$verified_by		= '';
		$verification_no	= addslashes(trim($verification_no));
		
		//Inserting in customer table
		$x_password = md5_encrypt($password,USER_PASS);
		
		//get all email id to check if it is registered or not
		$select = "SELECT * FROM customer WHERE email = '$email'";
		
		//execute query
		$query	= $this->conn->query($select);
		$rows 	= $query->num_rows;
			
		if($rows > 0){
			return 'Email Already Exists!';
		}else{
			//statement	dob, '$dob',
			$sql	 = 	 "INSERT INTO customer 
						 (customer_type, member_id, user_name, email, password, fname, lname, gender,dob,  status, 
						 brief, description, organization, featured, profession, sort_order, verification_no, 
						 acc_verified, verified_by, verified_on, discount_offered)
						 VALUES
						 ('$cus_type','$member_id', '$user_name', '$email', '$x_password', '$fname', '$lname', '$gender','$dob', '$status', 
						 '$brief', '$description', '$organization', '$featured', '$profession','$sort_order', '$verification_no', 
						 '$acc_verified', '$verified_by', now(), '$discount_offered')";
						 
			//execute query
			$query	= $this->conn->query($sql);

			
			//get the primary key
			$id		= 	$this->conn->insert_id;
			// echo $id;	
			//inserting into customer info table
			$sql2	=   "INSERT INTO customer_info 
						 (last_logon, no_logon, added_on, customer_id)
						 VALUES
						 (now(), 1, now(), '$id')";
			$this->conn->query($sql2);
		
		}
		
		//return id
		return $id;
		
	}//eof
	
	
	
		
###########################################################################################################################
#
#									Customer Address
#
###########################################################################################################################	
	
	
	
	/**
	*	Add a customer address
	*	
	*	@param
	*			$address1			Advertiser id
	*			$address2			Address 1
	*			$address3			Address 2
	*			$town				Address 3
	*			$province			Town id
	*			$postal_code		Province id
	*			$countries_id		Postal Code
	*			$phone1				Phone 1
	*			$phone2				Phone 2
	*			$fax        		Fax
	*			$mobile				Mobile phone number
	*
	*	@return string
	*/
	function addCusAddress($customer_id, $address1, $address2, $address3, $town, $province, $postal_code, $countries_id, 
							$phone1, $phone2, $fax, $mobile){

		$customer_id	= addslashes(trim($customer_id)); 
		$address1		= addslashes(trim($address1));  
		$town			= addslashes(trim($town)); 
		$province		= addslashes(trim($province)); 
		$postal_code	= addslashes(trim($postal_code));
		$phone1			= addslashes(trim($phone1)); 
		$fax			= addslashes(trim($fax)); 
		
		$sql 	= "INSERT INTO customer_address
				  (customer_id, address1, address2, address3, town, province, postal_code, countries_id, phone1, phone2, fax, mobile)
				  VALUES
				  ($customer_id, '$address1','$address2', '$address3', '$town', '$province', '$postal_code', '$countries_id', '$phone1', 
				  '$phone2', '$fax', '$mobile')";
		
		//echo $sql.mysql_error();exit;
		//execute query		  
		$query	= $this->conn->query($sql);
		
		
		$result = '';
		if(!$query){
			$result = 'ER101';
		}else{
			$result = 'SU101';
		}
		return $result;
	}//eof
	
	
	
/**
	*	This function edit customer address table
	*
	*	@update November 22, 2011
	*
	*	@param
	*			$id						Primary key associated with the particular customer
	*			$address1				1st address of the customer
	*			$address2			 	2nd Address of the customer
	*			$address3				3rd Address of the customer
	*			$town					Town of the customer	
	*			$province			 	Province of the customer
	*			$lname			 		lname  of the customer
	*			$postal_code			Postal Code of the customer
	*			$countries_id			Countries id of the customer
	*			$phone1					1st ph no. of the customer
	*			$phone2			        2nd phone no. of the customer
	*			$fax					Fax no of the customer	
	*			$mobile			 		Mobile no. of the customer
	*
	*	@return null
	*/
	
	function updateCusAddress($cusid, $address1, $address2, $address3, $city, $state, $postal_code, $countries_id, $phone1, $phone2, $fax, $mobile){
		//add security
		$address1				= addslashes(trim($address1)); 
		$address2				= addslashes(trim($address2));
		$address3				= addslashes(trim($address3));
		$city					= addslashes(trim($city));
		$state					= addslashes(trim($state)); 
		$postal_code			= addslashes(trim($postal_code));
		$phone1					= addslashes(trim($phone1));
		$phone2					= addslashes(trim($phone2));
		$fax					= addslashes(trim($fax));
		$mobile					= addslashes(trim($mobile));
		//$countries_id			= int($countries_id);
		
		//statement
		$sql	= " UPDATE customer_address 		
					SET
					address1				 =  '$address1',															
        			address2				 =	'$address2',																
					address3				 =	'$address3',
					town	            	 =	'$city',
					province				 =	'$state',					
					postal_code	        	 =	'$postal_code',					
					countries_id		     =  '$countries_id',
					phone1					 =  '$phone1',														
        			phone2					 =	'$phone2',
					fax				         =	'$fax',
					mobile					 =	'$mobile'														
					WHERE
			    	customer_id				 =  $cusid
					";
				 
				// echo $sql.mysql_error();exit;
			
		//execute query
		$query	= $this->conn->query($sql);
	
	}//eof
	
	/**
	*	Edit registration information
	*	
	*	@param
	*			$user_id			Customer id or primary key
	*			$email				Email address
	*			$fname				First name of the client
	*			$lname				last name of the client
	*			$brief				Brief introducttion of the client
	*			$description		Description of the client
	*			$organization		Organization associated with the client
	*			$member_id			Unique member id
	*			$cus_type			Type of customer e.g. vendor 
	*			$ver_no				Verification no
	*
	*	@return	null
	*/
	function editCustomer($user_id, $fname, $lname, $gender, 
						 $brief, $description, $organization, $featured, 
					    $profession, $sort_order, $acc_verified, $discount_offered)
	{
		//get the vars
		
		$fname 			= addslashes(trim($fname));
		$lname 			= addslashes(trim($lname));
		$brief 			= addslashes(trim($brief));
		$description	= addslashes(trim($description));
		$organization	= addslashes(trim($organization));
		$sort_order		= addslashes(trim($sort_order));
		$profession		= addslashes(trim($profession));
		$discount_offered	= doubleval($discount_offered);
		//statement
		
		$sql	 = 		"UPDATE customer 
						SET
						fname 				= '$fname',
						lname 				= '$lname',
						gender 				= '$gender',
						brief 				= '$brief',
						description			= '$description',
						organization		= '$organization',
						featured			= '$featured',
						profession			= '$profession',
						sort_order			= '$sort_order',
						acc_verified		= '$acc_verified',
						discount_offered	= '$discount_offered'
						WHERE 
						customer_id 		= $user_id
						";
			
		//execute query			
		$query	= $this->conn->query($sql);
		// echo $sql.$this->conn->error;exit;
		return $query;
		
	}//eof

	function updateAddrDuringPackOrd($cusid, $fname, $lname, $city, $pincode, $state, $country, $mobile){

		$fname		= addslashes(trim($fname));
		$lname		= addslashes(trim($lname));
		$city		= addslashes(trim($city));
		$pincode	= addslashes(trim($pincode));
		$state		= addslashes(trim($state));
		$country	= addslashes(trim($country));
		$mobile		= addslashes(trim($mobile));

		$cusSql = "UPDATE customer 
				SET
				fname 				= '$fname',
				lname 				= '$lname'
				WHERE
				customer_id 		= $cusid
				";
		
		$query1	= $this->conn->query($cusSql);

		$addrSql = "UPDATE customer_address 
				SET
				town			= '$city',
				province		= '$state',
				postal_code		= '$pincode',
				countries_id	= '$country',
				mobile			= '$mobile'
				WHERE
				customer_id 	= $cusid
				";
		$query2	= $this->conn->query($addrSql);
		
		$res = '';
		if ($query1 == 1) {
			if ($query2 == 1) {
				$res = 'SUU010';
				return $res;
			}else {
				$res = 'ERU300';
				return $res;
			}
		}else {
			$res = 'ERU007';
			return $res;
		}
		
		
	}
	

	/**
	*	Edit registration information by one
	*	@param
	*	$user_id			Customer id or primary key
	*	@return	null
	*/
	function editCustomerSingleData($user_id, $col, $val, $db){
		//get the vars
		$val 			= addslashes(trim($val));

		//statement
		$sql	 = 		"UPDATE $db 
						SET
						$col 				= '$val'
						WHERE 
						customer_id 		= $user_id
						";
						
		$query	= $this->conn->query($sql);
		return $query;
		
	}//eof
	
	/**
	*	Edit Customer information
	*	
	*	@param
	*			$user_id			Customer id or primary key
	*			$email				Email address
	*			$billing_name		Billing Name
	*
	*	@return	null
	*/
	function editCustomerDtls($user_id, $billing_name)
	{
		//get the vars
		//$email 					= addslashes(trim($email));
		$billing_name 			= addslashes(trim($billing_name));
		//statement
		$sql	 = 		"UPDATE customer 
						SET
						billing_name 		= '$billing_name'
						WHERE 
						customer_id 		= $user_id
						";
		//execute query			
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		
	}//eof




	/**
	*	UPDATE customer mobile number as phone 2 
	*	
	*	@param
	*			$user_id			Customer id or primary key
	*			$phoneNo			phone2
	*
	*	@return	null
	*/
	function updateBillingNumber($user_id, $phoneNo){
		
		$phoneNo 					= addslashes(trim($phoneNo));
		//statement
		$sql	 = 		"UPDATE customer_address 
						SET
						phone2 		= '$phoneNo'
						WHERE 
						customer_id = $user_id
						";
		//execute query			
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		
	}//eof



	/**
	*	UPDATE customer mobile number as phone 2 
	*	
	*	@param
	*			$user_id			Customer id or primary key
	*			$state				province/state
	*
	*	@return	null
	*/
	function updateBillingState($user_id, $state){
		
		$phoneNo 					= addslashes(trim($state));
		//statement
		$sql	 = 		"UPDATE customer_address 
						SET
						province 	= '$state'
						WHERE 
						customer_id = $user_id
						";
		//execute query			
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		
	}//eof


	
	/**
	*	Update the date time, whenever the any data is updated.
	*	@param
	*	$cus_id		Customer id
	*	@return string
	*/
	function updateDate($cus_id){
		//declare var
		$result = '';
		
		//statement
		$sql	= "UPDATE 	customer_info 
				  SET 		modified_on  = now()
				  WHERE 	customer_id  = '$cus_id'";
				  
		//execute query		  
		$query	= $this->conn->query($sql);
		
		//make the query
		if(!$query){
			$result = "ER102";
		}else{
			$result = "SU102";
		}
		
		//return the result
		return $result;
		
	}//eof
	

	
	/**
	*	Change the user password. As changing password is done by User, so he doesn't 
	*	need to enter old password
	*	
	*	@param	
	*			$id			User unique identity
	*			$password	User New Password
	*/
	function changeUserPassword($userId, $currentPassword, $newPassword){

		$msg = '';

		$cPass = $this->getUserPass($userId);
		if ($cPass == $currentPassword) {

			$x_password = md5_encrypt($newPassword,USER_PASS);
			$update = "UPDATE customer SET password= '$x_password' WHERE customer_id ='$userId'";
			$query  = $this->conn->query($update);
			if ($query) {
				$msg = 'Password Updated'; 
			}
		}else {
			$msg = 'Current Password is Wrong';
		}

		return $msg;
	}//eof
	

	/**
	*	Delete a client from the database
	*
	*	@param 
	*			$id				Customer's id
	*			$path			Path to the images
	*
	*	@return string
	*/
	function deleteCustomer($id, $path){
		//delete the image first
		$this->deleteFile($id, 'customer_id' , $path, 'image', 'customer');
		
		//delete from customer or client's information
		$sql	= "DELETE FROM customer_info WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		//delete from client's address
		$sql	= "DELETE FROM customer_address WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		
		//delete from client
		$sql	= "DELETE FROM customer WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		$result = '';
		if(!$query){
			$result = "ER103";
		}else{
			$result = "SU103";
		}
		
		//return the result
		return $result;
		
	}//eof
	
	
	/*/**
	*	Retrieve all customer id 
	*
	*	@return array
	*/
	// function getAllCustomerId()
	// {
	// 	//Declare array
	// 	$data	= array();
		
	// 	//
	// 	$sql	= "SELECT 		C.customer_id 
	// 			   FROM 		customer C, customer_info CI
	// 			   WHERE		C.customer_id = CI.customer_id
	// 			   ORDER BY 	CI.added_on 
	// 			   DESC";
		
	// 	//execute query
	// 	$query	= mysql_query($sql);
		
	// 	//fetch the data
	// 	if(mysql_num_rows($query) > 0)
	// 	{
	// 		while($result = mysql_fetch_object($query))
	// 		{
	// 			$data[] = $result->customer_id;
	// 		}
	// 	}
		
	// 	//return data
	// 	return $data;
		
	// }//eof
	
	
	/**
	*	Returns the list of client
	*
	*	@param
	*			$num		Number of client to find. If it is set to ALL, it will search for
	*						all the registered client
	*			$ordBy		Order by clause
	*			$ordType	Order by type, either ascending or descending
	*
	*	@return array
	*/
	
	function getAllCustomer($num, $ordBy, $ordType){
		//declare vars
		$data		= array();
	
		//generate the statement
		if($num == 'ALL'){
			$select		= "SELECT 	CI.customer_id AS CUSID 
						   FROM 	customer_info CI, customer C, customer_address CA 
						   WHERE 	CI.customer_id = C.customer_id
						   AND		CI.customer_id = CA.customer_id
						   ORDER BY ".$ordBy." ".$ordType;
		}else if($num > 0){

			$select		= "SELECT CI.customer_id AS CUSID FROM customer_info CI ORDER BY ".$ordBy." ".$ordType." LIMIT $num";
		
		}else{
			$select		= "SELECT CI.customer_id AS CUSID  FROM customer_info CI ORDER BY ".$ordBy." ".$ordType;
		}
		
		
		//execute query
		$query		= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		
		//fetch the values
		while($result	= 	$query->fetch_object())
		{
			$data[]		= $result->CUSID;
		}
		
		//return the data
		return $data;
		
	}//eof
	
	
	/**
	*	Show registration data
	*
	*	@param
	*	$customer_id		Customer identity
	*
	*	@return array
	*/
	function getCustomerData($customer_id){	
		
		//create the statement
		$select		=   "SELECT * 
						 FROM 	customer C, customer_info CI, customer_address CD
						 WHERE 	C.customer_id = CI.customer_id
						 AND	C.customer_id = CD.customer_id 
						 AND 	C.customer_id = '$customer_id'";
		

		// echo $select.$this->conn->error;exit;
		//execute query
		$query = $this->conn->query($select);
		$rows = $query->num_rows;
		// echo $rows;exit;

		if ($rows > 0) {
			while($result = $query->fetch_object()){
					$data[]	=	array(
								  $result->customer_type,		//0			CUSTOMER/USER
								  $result->member_id,			//1
								  $result->user_name,			//2
								  $result->email,				//3
								  $result->password,			//4
								  $result->fname,				//5
								  $result->lname,				//6
								  $result->gender,				//7
								  $result->status,				//8
								  $result->image,				//9
								  $result->brief ,			    //10
								  $result->description ,		//11
								  $result->organization,		//12
								  $result->featured,			//13
								  $result->profession,			//14
								  $result->sort_order,			//15
								  $result->verification_no,		//16
								  $result->verified_by,			//17
								  $result->verified_on,			//18
								  $result->discount_offered,	//19

								  $result->no_logon,			//20		CUST INFO
								  $result->last_logon,			//21
								  $result->added_on,			//22
								  $result->modified_on,			//23


								  $result->address1,			//24		ADDRESS
								  $result->address2,			//25
								  $result->address3,			//26
								  $result->town,				//27
								  $result->province,			//28
								  $result->postal_code,			//29
								  $result->countries_id,		//30
								  $result->phone1,				//31
								  $result->phone2,				//32
								  $result->fax,					//33
								  $result->mobile,				//34

								  $result->acc_verified,		//35
								  $result->dob,					//36
								  $result->billing_name			//37

								);
					// $data[] = $result;
			}//while
			return $data;
		}//if

	}//	eof

	/**
	*	Show registration data
	*
	*	@param
	*	$customer_id		Customer identity
	*
	*	@return array
	*/
	function getCustomerAvatar($customer_id){	
		
		$select		=   "SELECT image FROM	customer WHERE customer_id = '$customer_id'";
	
		// echo $select.$this->conn->error;exit;
		$query = $this->conn->query($select);

		if ($query->num_rows > 0) {
			while($result = $query->fetch_assoc()){
					$data	=	$result['image'];
			}
			return $data;
		}//if

	}//	eof


	/**
	*	Show registration data
	*
	*	@param
	*	$verificationNo		Customer verification code
	*
	*	@return array
	*/
	function getCustomerDataByVerCode($verificationNo){	
		
		//create the statement
		$select		=   "SELECT * 
						 FROM 	customer
						 WHERE 	verification_no = '$verificationNo'";
		

		// echo $select.$this->conn->error;exit;
		//execute query
		$query = $this->conn->query($select);
		$rows = $query->num_rows;
		// echo $rows;exit;

		if ($rows > 0) {
			while($result = $query->fetch_assoc()){
					$data	=	$result;
			}//while
			return $data;
		}//if

	}//	eof


 

	function getCustomerByemail($email){	
		try {
		//create the statement
		$sql = "SELECT * FROM customer C, customer_info CI, customer_address CD
						WHERE C.customer_id = CI.customer_id
							AND	C.customer_id = CD.customer_id
							AND C.email = '$email'";

		$query = $this->conn->query($sql);
		$rows = $query->num_rows;
		// echo $rows;exit;

		//fetch the rows
		if ($rows > 0) {
			while($result = $query->fetch_assoc()){
					$data	=	$result;
			}
			return $data;
		}else {
			//create the statement
			$sql2 = "SELECT * FROM customer C, customer_info CI, customer_address CD
			WHERE C.customer_id = CI.customer_id
				AND	C.customer_id = CD.customer_id
				AND C.user_name = '$email'";

			$query2 = $this->conn->query($sql2);
			$rows2 = $query->num_rows;
			// echo $rows;exit;

			//fetch the rows
			if ($rows2 > 0) {
				while($result2 = $query2->fetch_assoc()){
						$data2	=	$result2;
				}
				return $data2;
			}
		}
		
		} catch (Exception $e) {
			echo '<b>Error on:</b> '.__FILE__.', <b>On Line:</b>'.__LINE__.'<br>';
			echo '<b>Error:</b> '.$e->getMessage();
			exit;
		}

	}//	eof




	
	//Show Customer Details
	function getAllCust(){
		$temp_arr = array();
     	$sql = "SELECT * FROM customer order by customer_id desc";
	 	$res = $this->conn->query($sql);
	 	if ($res->num_rows > 0) {
			while($row = $res->fetch_array()) {
				$temp_arr[] =$row;
			}
	 	}        
     return $temp_arr;  
     }
	
	
	
	/**
	*	Edit the password, depending upon who is editing. Administrator doesn't require to 
	*	verify password again. For a normal user he needs to verify his old password.
	*	
	*	@param
	*			$user_type	Role of the user, administrator or normal
	*			$old_pass	Old password
	*			$new_pass	New password
	*			$cnf_pass	Confirm password
	*			$user_id	User id
	*	
	*	@return NULL
	*/
	function editPassword($old_pass, $new_pass, $cnf_pass, $user_id, $user_type=''){
		
		// echo $new_pass.'<br>';

		//CHECK THE LENGTH OF THE NEW PASSWORD
		if(strlen($new_pass) < 6) {

			$msg = "Password is too short";
			header("Location: ".$_SERVER['PHP_SELF']."?typeM=ERROR&msg=".$msg);
		
		}else if($new_pass != $cnf_pass){

			$msg = "Password does not match with the confirm password";
			header("Location: ".$_SERVER['PHP_SELF']."?typeM=ERROR&msg=".$msg);
		
		}else{
			
			$select		= "SELECT password FROM customer WHERE customer_id='$user_id'";
			$query      = $this->conn->query($select);
			$result 	= $query->fetch_array();
			$x_password = '';
			$new_pass	= md5_encrypt($new_pass, USER_PASS);
			
			if($query->num_rows > 0){

				$dbpass	    = $result['password'];
				$x_password = md5_decrypt($dbpass, USER_PASS);
				
			}else{

				$msg = "No such user exist";
				header("Location: ".$_SERVER['PHP_SELF']."?typeM=ERROR&msg=".$msg);
			
			}
			
			if($user_type == ADM_SESS){

				if(!isset($_SESSION[ADM_SESS])){

					header("Location: index.php");
				}else{
					$update	= "UPDATE customer SET password = '$new_pass' WHERE customer_id='$user_id'";
					$query	= $this->conn->query($update);
					$msg = "Password has changed successfully";
					header("Location: ".$_SERVER['PHP_SELF']."?typeM=SUCCESS&msg=".$msg);
					
				}//else
				
			}else{
				// echo "else ".$x_password." ".$old_pass;exit;
				if($x_password != $old_pass){
					//echo $x_password." ".$old_pass;exit;
					$msg = "Current Password Not Matched!";
					header("Location: ".$_SERVER['PHP_SELF']."?typeM=ERROR&msg=".$msg);
					
					//else check old password
				}elseif(!isset($_SESSION[USR_SESS])){

					$msg = "Logon before change your password";
					header("Location: ".$_SERVER['PHP_SELF']."?typeM=ERROR&msg=".$msg);
					
					//whether the user is logged on or not
				}else{
					$update	= "UPDATE customer SET password = '$new_pass' WHERE customer_id='$user_id'";
					$query	= $this->conn->query($update);

					$msg 	= " Password has been changed successfully";
					header("Location: user_account.php?typeM=SUCCESS&msg=".$msg);
					
				}
				
			}//normal user

			
		}//else

	}//eof
	
	
	###############################################################################################################
	#
	#										Customer Verification
	#
	###############################################################################################################
	
	
	
	/**
	*	Work with verification status separately
	*
	*	@param
	*			$user_id	Primary key associated with the user
	*			$accV		Account verification
	*			$user		Admin user or the user itself whoever has verified the account
	*			
	*	@return  NULL
	*/
	function updateVerStatus($user_id, $accV, $user){
		//statement
		$sql	= "UPDATE customer C SET
				   C.acc_verified		= '$accV',
				   C.verified_by		= '$user',
				   C.verified_on		= now()	
				   WHERE
				   C.customer_id = '$user_id'
				   ";
				   
		//execute query
		$query	= $this->conn->query($sql);
		
		
	}//eof
	

	/**
	*	Work with verification status separately
	*			$accV		Account verification
	*			$user		Admin user or the user itself whoever has verified the account
	*			
	*	@return  NULL
	*/
	function updateVerStatusByCode($verification_no, $status, $verifiedBy){
		//statement
		$sql	= "UPDATE customer C SET
				   C.acc_verified		= '$status',
				   C.verified_by		= '$verifiedBy',
				   C.verified_on		= now()	
				   WHERE
				   C.verification_no = '$verification_no'
				   ";
				   
		//execute query
		$query	= $this->conn->query($sql);
		return $query;
		
	}//eof
	
	/**
	*	Work with verification numbers separately
	*
	*	@param
	*			$user_id		Primary key associated with the customer
	*			$ver_no			Verification number
	*			
	*	@return  NULL
	*/
	function updateVerNo($user_id, $ver_no)
	{
		//statement
		$sql	= "UPDATE customer SET
				   verification_no	= '$ver_no'
				   WHERE
				   customer_id = '$user_id'
				   ";
				   
		//execute query
		$query	= $this->conn->query($sql);
		
	}//eof
	
	
	
	/**
	*	Render account verification, to display if an account is fully verified.
	*
	*	@param
	*			$user_id		Primary key associated with the customer
	*			$erTxt			Error text message
	*			$suTxt			Success text message
	*
	*	@return	 string
	*/
	function renderVerifyStr($user_id, $erTxt, $suTxt)
	{
		//declare var
		$conStr	= '';
		
		//get the customer detail
		$cusDtl	= $this->getCustomerData($user_id);
	
		if( ($cusDtl[0][15] == '') || ($cusDtl[0][35] == 'N') ){
			$conStr	=  "<span class='orangeLetter'>".$erTxt."</span>";
		}else{
			$conStr	=  "<span class='blackLarge padT5'>".$suTxt."</span>";
		}
		
		//return the string
		return $conStr;
		
	}//eof
	
	
	/**
	*	Get the list of customer waiting for verification during a time span
	*
	*	@param
	*			$startDate		Start date when registration began
	*			$endDate		End date when registration ends
	*
	*	@return	string
	*/
	// function getListOfUnverifiedcustomer($startDate, $endDate)
	// {
	// 	//declare vars
	// 	$cIds		= array();
	// 	$contList	= '';
		
	// 	//list of customer 
	// 	$cIds		= $this->getcustomerBySEDate($startDate, $endDate);
		
	// 	if(count($cIds) > 0)
	// 	{
	// 		//start listing
	// 		$contList  .= "<ul>";
			
	// 		foreach($cIds as $z)
	// 		{
	// 			//get the contrator detail
	// 			$cusDtl	= $this->showRegInfo($z);
				
	// 			$contList  .= "<li>".$cusDtl[0]." ".$cusDtl[1]."</li>";
	// 		}
			
	// 		//end listing
	// 		$contList  .= "</ul>";
			
	// 	}//if
		
		
	// 	//return the string
	// 	return $contList;
		
	// }//eof
	
	
	
	/**
	* 	Password retrive by the email id
	*
	*	@param
	*			$email		Customer email 
	*
	*	@return string
	*/
	function getUserPass($cusId){

		//declare vars
		$data  = null;
		
		//statement
		$sql = "SELECT password FROM customer WHERE customer_id ='$cusId'";
		
		//execute query
		$query = $this->conn->query($sql);
		
		//check and fetch data
		if($query->num_rows > 0){
			//result
			$result = $query->fetch_array();
			
			//hold in array
			$data   = $result['password'];
			$password = md5_decrypt($data,USER_PASS);
			
		}
		
		//return data
		return $password;
		
	}//end of getting password
	
	
	
	/**
	*	Get referral detail
	*
	*	@param
	*			$parent_id			Parent id or referral id
	*
	*	@return string
	*/
	function getReferralDetail($parent_id)
	{
		//declare var
		$refStr	= '';
		$cusDtl	= array();
		
		//get the name
		if( (int)$parent_id <= 0)
		{
			$refStr	= 'Administrator';
		}
		else
		{
			//get customer detail
			$cusDtl	= $this->getCustomerData($parent_id);
			
			//get the email
			$refStr	= $cusDtl[1];
			
		}
		
		//return the string
		return $refStr;
		
	}//eof
	
	
	
	
	
	
	/**
    *    Generate unique verification code
    *   
    *    @param
    *            $prefix            Prefix to add before the code
    *
    *    @return string
    */
    function generateVerificationCode($prefix)
    {
        //declare vars
        $ordCode        = '';
       
        //get 5 char order key
        $ordKey    = $this->genCusKeys(5);
       
        //get the date and time
        $dateStr    = date("dmY");
       
        //user id
        if(isset($_SESSION['userid']))
        {
            $userId    = $_SESSION['userid'];
        }
        else
        {
            $userId    = 0;
        }
        //formatted id
        $userId    = 10000 + $userId;
       
        //get the previously stored number of order
        $numOrder = $this->getLatestOrderId();
       
        //num order
        $reOrder = 1001 + $numOrder;
       
	   
	   //For verification No
		$ordCode        = $prefix.$dateStr.'-'.$reOrder;
       
        //return code
        return    $ordCode;
       
    }//eof
   
   
   
	
		
	/**
	*	to generate verification number if account is verified
	*
	*	@param
	*			$acc_verified			Whether account is verified or not that will be denoted by Yes as 'Y' and No as 'N'
	*			
	*	@return string
	*/
	function genCusVerificationNum($acc_verified)
	{
		if($acc_verified=='Y')
		{
			//get verification no
			$verificationNo	= $this->generateVerificationCode('V');
		}
		else
		{
			$verificationNo='';
		}
		return $verificationNo;
	}//eof
	
	
	/**
    *    Generate unique verification code for billing profile id
    *   
    *    @param
    *            $prefix            Prefix to add before the code
    *
    *    @return string
    */
    function generateVerificationCodeForBillinPRof($prefix)
    {
        //declare vars
        $ordCode        = '';
       
        //get 5 char order key
        $ordKey    = $this->genCusKeys(5);
       
        //get the date and time
        $dateStr    = date("dmY");
       
        //user id
        if(isset($_GET['cus_id']))
        {
            $cus_id    = $_GET['cus_id'];
        }
        else
        {
            $cus_id    = 0;
        }
        //formatted id
        $cus_id    = 10000 + $cus_id;
       
        //get the previously stored number of order
        $numOrder = $this->getLatestOrderId();
       
        //num order
        $reOrder = 1001 + $numOrder;
       
	   //For verification No
		$ordCode        = $prefix.$dateStr.'-'. $cus_id.$reOrder;
       
        //return code
        return    $ordCode;
       
    }//eof
   
	
	 /**
	 *	Generate order key
	 *	
	 *	@param
	 *			$length		Length of the key
	 */
	 function genCusKeys($length)
     {
		 $key = '';
		 $pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		 for($i=0;$i<$length;$i++)
		 {
		    $key .= $pattern[rand(0,35)];
		 }
     	 return $key;
    }//eof
	
	
	
	############################################################################################################
	#
	#												Customer Billing
	#
	############################################################################################################
	
	
	
	/**
	
	*	Add to the customer_billing table
	*	@update Nov 21, 2011
	*
	*	@param
	*			$customer_id			 			customer_id of the customer table
	*			$billing_name			 			Billing name  of the customer_billing table
	*			$billing_email						Billing email of the customer_billing table
	*			$billing_address					Billing address of the customer_billing table
	*			$billing_city			 			Billing city of the customer_billing table
	*			$billing_province			 		Billing province  of the customer_billing table
	*			$billing_postal_code				Billing postal code of the customer_billing table
	*			$billing_phone						Billing phone of the customer_billing table  
	*			$billing_fax						Billing fax of the customer_billing table
	*	@return int
	*/
	function addCustomerBilling($customer_id, $billing_profile_id,  $default_billing_profile, $billing_name, $billing_email, 
								$billing_address, $billing_city, $billing_province, $billing_country_id, $billing_postal_code,  
								$billing_phone, $billing_mobile, $billing_fax)
	{
	
	   //declare var
		$id = 0;
		
		//add security
		$customer_id			= trim($customer_id); 
		$billing_name			= addslashes(trim($billing_name));
		$billing_email			= addslashes(trim($billing_email)); 
		$billing_address		= addslashes(trim($billing_address));
		$billing_city			= addslashes(trim($billing_city)); 
		$billing_province		= addslashes(trim($billing_province));
		$billing_postal_code	= addslashes(trim($billing_postal_code)); 
		$billing_phone			= addslashes(trim($billing_phone));
		$billing_mobile			= addslashes(trim($billing_mobile));
		$billing_fax			= addslashes(trim($billing_fax));
		$billing_profile_id		= addslashes(trim($billing_profile_id));
		
		//statement
		$sql	= "INSERT INTO customer_billing 
				   (customer_id, billing_profile_id, default_billing_profile, billing_name, billing_email, billing_address, billing_city, 
				    billing_province, billing_country_id, billing_postal_code, billing_phone, billing_mobile, billing_fax, added_on)
				   VALUES
				   ($customer_id, '$billing_profile_id', '$default_billing_profile', '$billing_name', '$billing_email', '$billing_address',
				    '$billing_city', '$billing_province','$billing_country_id', '$billing_postal_code', '$billing_phone', '$billing_mobile',
					'$billing_fax', now())";
				
		//execute query
		$query	= mysql_query($sql); 
		
		
	
		//get the primary key
		if($query)
		{
			$id	= mysql_insert_id();
		}
		
		//return primary key
		return $id;
		
	}//eof
	
	
	
	
	/**
	*	This function edit customer_billing
	*
	*	@update Nov 21, 2011
	*	
	*	@param
	*			$id									Primary key associated with the particular customer billing
	*			$customer_id			 			customer_id of the customer table
	*			$billing_name			 			Billing name  of the customer_billing table
	*			$billing_email						Billing email of the customer_billing table
	*			$billing_address					Billing address of the customer_billing table
	*			$billing_city			 			Billing city of the customer_billing table
	*			$billing_province			 		Billing province  of the customer_billing table
	*			$billing_postal_code				Billing postal code of the customer_billing table
	*			$billing_phone						Billing phone of the customer_billing table  
	*			$billing_fax						Billing fax of the customer_billing table	
	*	@return null
	*/
	
	function updateCustomerBilling($id, $customer_id, $billing_name, $billing_email, $billing_address, $billing_city, $billing_province, $billing_postal_code, $billing_phone, $billing_fax){
	
		//declare var
		$data			= '';
	
		//add security
		$customer_id			= trim($customer_id); 
		$billing_name			= addslashes(trim($billing_name));
		$billing_email			= addslashes(trim($billing_email)); 
		$billing_address		= addslashes(trim($billing_address));
		$billing_city			= addslashes(trim($billing_city)); 
		$billing_province		= addslashes(trim($billing_province));
		$billing_postal_code	= addslashes(trim($billing_postal_code)); 
		$billing_phone			= addslashes(trim($billing_phone));
		$billing_fax			= addslashes(trim($billing_fax));
		
	
		//statement
		$sql	= "UPDATE customer_billing SET
				customer_id						    		 =  '$customer_id',			
				billing_name				            	 =	'$billing_name',	
				billing_email						    	 =  '$billing_email',			
				billing_address				            	 =	'$billing_address',	
				billing_city						    	 =  '$billing_city',			
				billing_province				             =	'$billing_province',	
				billing_postal_code						     =  '$billing_postal_code',			
				billing_phone				            	 =	'$billing_phone',	
				billing_fax						    		 =  '$billing_fax',							
				modified_on							 		 =   now()					
				WHERE
			    customer_billing_id			      			 =  '$id'
				";
				 
				 
			
		//execute query
		$query	= mysql_query($sql);
		
		//test if it is running well
		if($query)
		{
			$data	= 'SU';
		}
		else
		{
			$data	= 'ER'.mysql_error();
		}
		
		
		//return data
		return $data;
		
	}//eof
	
	
	
	
	/**
	*	Delete from the customer_billing table
	*
	*	@param
	*			$id			customer_billing Id	
	
	*	 		@return string
	*/
	
	function deleteCustomerBilling($id)
	{
		//declare var
		$result	= '';
	
		//statement
		$sql	= "DELETE FROM customer_billing WHERE customer_billing_id = $id ";
				   
		//execute query
		$query	= mysql_query($sql);
		
		//test if it is running well
		if(!$query)
		{
			$result	= 'ER'.mysql_error();
		}
		else
		{
			$result	= 'SU'; 
		}
		
		//return data
		return $result;
		
	}//eof
	
	
	/**
	*	Retrieve all customer billing id 
	*
	*	@return array
	*/
	function getAllCustomerBillingId()
	{
		//Declare array
		$data	= array();
		
		//
		$sql	= "SELECT 		customer_billing_id 
				   FROM 		customer_billing 
				   ORDER BY 	added_on 
				   DESC";
		
		//execute query
		$query	= mysql_query($sql);
		
		//fetch the data
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->customer_billing_id;
			}
		}
		
		//return data
		return $data;
		
	}//eof
	
	
	
	/**
	*	Retrive  from the customer billing table
	*
	*	@param
	*			$id			customer billing id or primary key
	*			
	*	@return array
	*/
	function getCustomerBillingData($id)
	{
		//declare
		$data	= array();
		
		//statement
		$sql	= "SELECT 	*
				   FROM 	customer_billing
				   WHERE 	customer_billing_id= '$id'";
				   
		//execute query
		$query	= mysql_query($sql);
		//echo $sql.mysql_error();exit;
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
						 $result->customer_id,			  	//0
						 $result->billing_profile_id,		//1
						 $result->default_billing_profile,	//2
						 $result->billing_name,				//3
						 $result->billing_email,			//4
						 $result->billing_address,			//5
						 $result->billing_city,			  	//6
						 $result->billing_province,			//7
						 $result->billing_postal_code,		//8
						 $result->billing_phone,			//9
						 $result->billing_fax,				//10
						 $result->added_on,					//11
						 $result->modified_on        		//12
						 );
		
		}
		
	  	//return the data
	  	return $data;
	}//eof	
	
	
	/**
	*	Delete a client from the database
	*
	*	@param 
	*			$id				Customer's id
	*			$path			Path to the images
	*
	*	@return string
	*/
	function deleteCustomerAllTab($id, $path)
	{
		//delete the image first
		$this->deleteFile($id, 'customer_id' , $path, 'image', 'customer');
		
		//delete from customer or client's information
		$sql	= "DELETE FROM customer_info WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		//delete from client's address
		$sql	= "DELETE FROM customer_address WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		
		//delete from client
		$sql	= "DELETE FROM customer WHERE customer_id='$id'";
		$query	= $this->conn->query($sql);
		
		$result = '';
		if(!$query)
		{
			$result = "ER103";
		}
		else
		{
			$result = "SU103";
		}
		
		//return the result
		return $result;
		
	}//eof
	
	
	
	/**
	*	Add client's address
	*	
	*	@param
	*			$cus_id			Customer's id
	*			$add1			Address 1
	*			$add2			Address 2
	*			$add3			Address 3 
	*			$t_id			Town id
	*			$p_id			Province id
	*			$p_code			Postal Code
	*			$ph1			Phone 1
	*			$ph2			Phone 2
	*			$fax			Fax
	*			$mobile			Mobile phone number
	*			$country		Countries Id
	*
	*			Date 19th November , 2012 .
	*			@author Mousumi Dey
	*
	*	@return string
	*/
	function addCusAdd($cus_id, $add1, $add2, $add3, $t_id, $p_id, $p_code, $ph1, 
						$ph2, $fax, $mobile,$country)
	{
		//declare var
		$result = '';
		
		//get the values
		$add1		= addslashes(trim($add1));
		$add2		= addslashes(trim($add2)); 
		$add3		= addslashes(trim($add3)); 
		$t_id		= addslashes(trim($t_id)); 
		$p_id		= addslashes(trim($p_id)); 
		$p_code		= addslashes(trim($p_code)); 
		$ph1		= addslashes(trim($ph1)); 
		$ph2		= addslashes(trim($ph2)); 
		$fax		= addslashes(trim($fax)); 
		$mobile		= addslashes(trim($mobile));
		$country	= (int)$country;
		
		//statement
		$sql 	= "INSERT INTO customer_address
				  (customer_id, address1, address2, address3, town, 
				  province, postal_code, phone1, phone2, 
				  fax, mobile, countries_id)
				  VALUES
				  ($cus_id, '$add1','$add2','$add3','$t_id',
				  '$p_id','$p_code','$ph1','$ph2',
				  '$fax','$mobile', '$country')";
		
		//execute query
		$query	= mysql_query($sql);
		
		
		//echo $query.mysql_error();
		if(!$query)
		{
			$result = 'ER101';
		}
		else
		{
			$result = 'SU101';
		}
		return $result;
		
	}//eof
	
	
	/**
	*	Register a new Customer.
	*	
	*	@update	September 10, 2010
	*
	*
	*	@param
	*			$user_name			User Name
	*			$email				Customers Email
	*			$password			Access password, require later
	*			$fname				First name of the client
	*			$lname				last name of the client
	*			$gender				Gender of the client
	*			$dob				Date of birth of the client
	*			$status				Status of the login which determine whether a clinets account is active or inactive
	*			$brief				Brief introducttion of the client
	*			$description		Description of the client
	*			$organization		Organization associated with the client
	*			$featured			Whether featured client or not
	*			$sort_order			Sorting order
	*			$profession			Profession of the customer or client 
	*			$cus_type			Type of customer e.g. vendor 
	*			$discount_offered	Discount offered to this client
	*
	*	@return int
	*/
	function addRegisterCustomer($member_id, $user_name, $email, $password, $fname, $lname, $gender,  $status, 
					     $brief, $description, $organization, $featured, $profession, $sort_order, $cus_type, $discount_offered)		  
	{
		//echo "here";exit;
		//declare var
		$id	= 0;
		
		//get the values
		$email 			= trim($email);
		$password 		= trim($password);
		$fname 			= addslashes(trim($fname));
		$lname 			= addslashes(trim($lname));
		$user_name		= trim($user_name);
		$brief 			= addslashes(trim($brief));
		$description	= addslashes(trim($description));
		$organization	= addslashes(trim($organization));
		$sort_order		= (int)$sort_order;
		$profession		= addslashes(trim($profession));
		$cus_type		= (int)$cus_type;
		$discount_offered	= doubleval($discount_offered);
		
		//Inserting in customer table
		$x_password = md5_encrypt($password,USER_PASS);
		
		//get all email id to check if it is registered or not
		$select = "SELECT * FROM customer WHERE email = '$email'";
		
		//execute query
		$query	= mysql_query($select);
		
		if(mysql_num_rows($query) > 0)
		{
			header("Location: ".$_SERVER['PHP_SELF']."?action=add_client&message=Email already exists&typeM=ERROR#addCustomer");
		}
		else
		{
			//statement
			$sql	 = 	 "INSERT INTO customer 
						 (member_id, user_name, email, password, fname, lname, gender,  status, 
						 brief, description, organization, featured, profession, sort_order, customer_type, discount_offered)
						 VALUES
						 ('$member_id', '$user_name', '$email', '$x_password', '$fname', '$lname', '$gender',  '$status', 
						 '$brief', '$description', '$organization', '$featured', '$profession','$sort_order', '$cus_type', '$discount_offered')";
						 
			//execute query
			$query	= 	mysql_query($sql);
			
			//echo $sql.mysql_error();exit;
			
			//get the primary key
			$id		= 	mysql_insert_id();
			
			
			//inserting into customer info table
			$sql2	=   "INSERT INTO customer_info 
							(last_logon, no_logon, added_on, customer_id)
							VALUES
							(now(), 1, now(), '$id')";
			$query2		= mysql_query($sql2);
		
		}
		
		
		//return id
		return $id;
		
	}//eof
	
	
	
	
	
	
	/**
	*	Add a product as a wish list
	*
	*	@param
	*			$pid		Product Id
	*			$uid		user id 
	*			November 21 , 2012
	*
	*			Mousumi Dey
	*
	*	@return	null
	*/
	function addWishList($uid, $pid)
	{
		$insert1	= "INSERT INTO customer_basket
						(customer_id , wish_list)
						VALUES
						('$uid','$pid')
						";
		$query1		= mysql_query($insert1);
		//echo $insert1.mysql_error();exit;
	}//eof
	
	
	/**
	*	This function will return all the product according to wishlist
	*
	*	@param
	*	$cusId			User Id
	*
	*	@return array
	*	
	*	@date  22nd November , 2012
	*	@author  Mousumi Dey
	*/
	function getAllProductInWishList($cusId)
	{
		//declare vars
		$data	= array();
		
		//statement
		$select = "SELECT basket_id FROM customer_basket WHERE customer_id='$cusId' AND wish_list!=0 ORDER BY basket_id ";
		
		//execute statement
		$query  = mysql_query($select);
		
		//echo $select.mysql_error();exit;
		
		while($result = mysql_fetch_array($query))
		{
			//hold the data
			$data[]	= $result['basket_id'];
			
		}
		
		//return the data
		return $data;
		
	}//eof
	


	#########################################################################################################################
	#																														#
	#												Customer Type Actions													#
	#																														#
	#########################################################################################################################


	/**
	*	Retrieve all customer type id
	*	@param	$parent_id		parent_id
	*	@param	$txtCusType		cus_type
	*	@param	$txtDesc		remarks
	*	@param	$txtCode		cus_type_code
	*	@return array
	*/
	function addCustomerType($parent_id, $txtCusType, $txtCode, $txtDesc){

		$parent_id 	= addslashes(trim($parent_id));
		$txtCusType = addslashes(trim($txtCusType));
		$txtCode 	= addslashes(trim($txtCode));
		$txtDesc 	= addslashes(trim($txtDesc));

		$sql = "INSERT INTO customer_type 
				(parent_id, cus_type, cus_type_code, remarks, added_on)
				VALUES
				('$parent_id', '$txtCusType', '$txtCode', '$txtDesc', now())";
				// echo $sql;

		$query	= $this->conn->query($sql);

		$id		= 	$this->conn->insert_id;

		return $id;

	}


	/**
	*	Retrieve all customer type id
	*	@param	$id				customer_type_id
	*	@param	$parent_id		parent_id
	*	@param	$txtCusType		cus_type
	*	@param	$txtCode		cus_type_code
	*	@param	$txtDesc		remarks
	*	@return boolean
	*/
	function editCustomerType($id, $parent_id, $txtCusType, $txtCode, $txtDesc){
		$sql = "UPDATE customer_type 
			   SET
			   parent_id		= '$parent_id',
			   cus_type			= '$txtCusType',
			   cus_type_code	= '$txtCode',
			   remarks			= '$txtDesc',
			   modified_on		= NOW()
			   WHERE customer_type_id = '$id'";
		// echo $sql;
		$query	= $this->conn->query($sql);
		return $query;		
	}

	/**
	*	Retrieve all customer type id
	*/
	function getAllCustomerTypeId(){

		$sql	= "SELECT customer_type_id FROM customer_type";
		//execute the query
		$query	= $this->conn->query($sql);
		
		$data	= array();
		
		if($query->num_rows > 0)
		{
			while($result = $query->fetch_object())
			{
				$data[] = $result->customer_type_id;
			}
		}
		return $data;
	}//eof
	


	function getCustomerByTypeId($type_id){
		try {
			$data 	= array();
			$sql	= "SELECT * FROM customer_type WHERE customer_type_id = '$type_id'";
			$query	= $this->conn->query($sql);
			
			if($query->num_rows > 0){
				while($result = $query->fetch_assoc()){
					$data = $result;
				}
			}
			return $data;
		
		} catch (Exception $e) {
			echo '<b>Error on:</b> '.__FILE__.', <b>On Line:</b>'.__LINE__.'<br>';
			echo '<b>Error:</b> '.$e->getMessage();
			exit;
		}
	}



	
	/**
	*	Retrieve all customer type id
	*	@param	$id		customer type id
	*	@return array
	*/
	function getAllParentCustomerTypeId()
	{
		$sql	= "SELECT customer_type_id FROM customer_type WHERE parent_id = 0";
		//execute the query
		$query	= $this->conn->query($sql);
		
		$data	= array();
		
		if($query->num_rows > 0)
		{
			while($result = $query->fetch_object())
			{
				$data[] = $result->customer_type_id;
			}
		}
		return $data;
	}//eof
	
	/**
	*	Get CustomerType data associated with its key.
	*
	*	@return array
	*/
	function getCustomerTypeData($cus_type_id)
	{
		$data	= array();
		
		$select = "SELECT * FROM customer_type WHERE customer_type_id='$cus_type_id'";
		$query  = $this->conn->query($select);
		
		//echo $select.mysql_error(); exit;
		if($query->num_rows > 0)
		{
			$result = $query->fetch_object();
			
			$data = array(
					$result->parent_id,				//0
					$result->cus_type,				//1
					$result->cus_type_code,			//2
					$result->remarks,				//3
					$result->added_on,				//4
					$result->modified_on,			//5
					$result->images					//6
					);
		}
		
		//return the value
		return $data;
	}//eof
	
	/**
	*	Retrieve all customer type id
	*	@param	$id		customer type id
	*	@return array
	*/
	function getChildCustomerTypeId($parent_id){
		$sql	= "SELECT customer_type_id FROM customer_type WHERE parent_id = '$parent_id'";
		// echo $sql;
		//execute the query
		$query	= $this->conn->query($sql);
		
		$data	= array();
		
		if($query->num_rows > 0)
		{
			while($result = $query->fetch_object())
			{
				$data[] = $result->customer_type_id;
			}
		}
		return $data;
	}//eof
	
	


	// 0,0,$_GET['txtParentId'],'ADD',0,'customer_type'

	function customerTypeDropDown($select, $match, $value, $table){

		$data	= array();
		if ($match != '' &&  $value != '') {
			$sql	= "SELECT $select FROM $table WHERE $match = '$value'";
		}else {
			$sql	= "SELECT $select FROM $table";
		}

		//execute the query
		$query	= $this->conn->query($sql);
		
		if($query->num_rows > 0){
			while($result = $query->fetch_array()){

				$data[] = $result;
			}
		}
		// print_r($data);
		if ($value != '') {
			foreach ($data as $row) {
				echo '<option value="'.$row["customer_type_id"].'"';
				if ($value == $row["customer_type_id"]) {
					echo 'selected';
				}
				echo '>'.$row["cus_type"].'</option>';
			}
		}else {
			foreach ($data as $row) {
				echo '<option value="'.$row["customer_type_id"].'">'.$row["cus_type"].'</option>';
			}
		}

	}// eof




	function duplicateCustomerType($parentId, $cusType, $table){

		if ($parentId != null && $cusType != null) {
			$sql	= "SELECT * FROM $table WHERE parent_id = '$parentId' AND cus_type = '$cusType'";
		}

		$query  = $this->conn->query($sql);
		$rows   =  $query->num_rows;
		
		$msg = '';

		if($rows > 0 ){
			$msg = 'ER001';
		}
	
		return $msg;



	}





	function deleteCustomerType($type_id){
		$sql = "DELETE FROM customer_type WHERE customer_type_id = '$type_id'";
		$res =  $this->conn->query($sql);

	}// eof deleteCustomerType


// ==============================================================================================================================
// ==============================================================================================================================
// ==============================================================================================================================
// ==============================================================================================================================









	/**
	*	Show registration data
	*
	*	@param
	*			$customer_id		Customer identity
	*
	*	@return array
	*/
	function getCustomerBasketData($basket)
	{
		//declare var
		$data		= array();
		
		//create the statement
		$select		=   "SELECT * 
						 FROM 	customer_basket
						 WHERE 	basket_id = '$basket'";
		
		//execute query
		$query		= mysql_query($select);
		//echo $select.mysql_error();exit;
		//fetch the rows
		if(mysql_num_rows($query) > 0)
		{
			while($result	= 	mysql_fetch_object($query))
			{
				$data	=	array(
								  $result->customer_id,		//0			CUSTOMER/USER
								  $result->product_id,		//1
								  $result->quantity,		//2
								  $result->basket_added,	//3
								  $result->final_price,		//4
								  $result->address_id,		//5
								  $result->giftbox,			//6
								  $result->wish_list		//7
								);
			}//while
		}//if
		
		//return the data
		return $data;	
		
	}//	eof
	
	#############################################################################################################################
	#																															#
	#												Club Member																	#
	#																															#
	#############################################################################################################################

	function updateLastLogin($customer_id){

		//update customer info
		$update = "UPDATE customer_info 
					SET last_logon = now(), no_logon = no_logon + 1
					WHERE 	customer_id = '$customer_id'";

		$res =  $this->conn->query($update);
		
	}
	
	
	############################################################################################################
	#
	#												Customer Image Upload
	#
	############################################################################################################
	
	
	
	/**
	*	Get the image associated with a customer
	*
	*   @update Sep 18, 2013
	*
	*	@param
	*			$cid		Customer id
	*
	*	@return array				
	*/
	
	function UploadCustomerImage($cid)
	{
		//declare vars
		$data = array();
		
		//statement
		$select = "SELECT image FROM customer
				   WHERE customer_id = '$cid'";
				   
		//execute query
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		//holds the data
		//check image exit or not
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data  = array(
						$result->image				//0
						
						);
			}
			
			//return the data
			return $data;
		}
		else
		{
			return 0;
		}
		
	}//eof 
	

	/** 
	*	Returns the list of client by type id
	*
	*	@param
	*			$month		 month of joining
	*			$year		 year of joining
	*
	*	@return array
	*/
	
	function getCustomerByMonthYear($month, $year)
	{
		//declare vars
		$data		= array();
	
		//generate the statement
		$select		= "SELECT customer_id 
					   FROM customer_info 
					   WHERE MONTH(added_on) = '$month' 
					   AND YEAR(added_on) = '$year'";
		
		
		//execute query
		$query		= $this->conn->query($select);
		
		//fetch the values
		while($result	= 	$query->fetch_object())
		{
			$data[]		= $result->customer_id;
		}
		
		//return the data
		return $data;
		
	}//eof
	
}//eoc
	
?>