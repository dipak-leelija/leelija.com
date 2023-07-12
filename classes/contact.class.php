<?php
// require_once "_config/dbconnect.php";

/*
USABLE FOR DISPLAY, EDIT, DELETE CONTACT FROM THE ADMIN CONTROL PANEL.
AUTHOR 		: SAFIKUL
DATE   		: JULY 09, 2019
VERSION		: 1.0
COPYRIGHT	: LeeLija
EMAIL		: safikulislamwb@gmail.com
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

class Contact extends DatabaseConnection
{
	
	//Add contact data on contact table
	function addContact($contact_name, $contact_email, $contact_phone, $message) {
		//declare var
		$id = 0;
		
		$contact_name 			= addslashes(trim($contact_name));
		$contact_email			= addslashes(trim($contact_email));
		$contact_phone			= addslashes(trim($contact_phone));
		$message 				= addslashes(trim($message));
		
		////statement
		$sql = 			"INSERT INTO contact 
						(contact_name, contact_email, contact_phone, message, added_on)
						 VALUES
						('$contact_name', '$contact_email', '$contact_phone', '$message', now())";
		//execute query
		$query	= $this->conn->query($sql); 
		if ($query == TRUE) {
			return $query;
		}
	}
	
	
	
	/**
	*	Retrive  from the contact table
	*
	*	@param
	*			$id			contact id or primary key
	*			
	*	@return array
	*/
	function getContactData($id){
		//declare
		$data	= array();
		
		$select		= "SELECT 	* 
					   FROM 	contact 
					   WHERE 	id = $id";
		
		//execute query
		$query		= $this->conn->query($select);
		
		if($query->num_rows > 0){
			//fetch data
			$result = $query->fetch_object();
			
			//hold the data in array
			$data = array(
								  $result->id,					//0
								  $result->contact_name,		//1
								  $result->contact_email,		//2
								  $result->contact_phone,		//3
								  $result->message,				//4
								  $result->added_on				//5
						 );
		}
	  	//return the data
	  	return $data;
		
	}//eof	
	
	/**
	*	Returns the list of registered customer
	*/
	function getAllContact($num){
		$data		= array();

		if($num == 'ALL'){
			$select		= "SELECT * FROM contact ORDER BY added_on DESC";
		}else if($num > 0){
			$select		= "SELECT * FROM contact ORDER BY added_on DESC LIMIT $num";
		}else{
			$select		= "SELECT * FROM contact";
		}
		
		$query		= $this->conn->query($select);
		
		while($result	= 	$query->fetch_array()){
			$data[]		= $result['id'];
		}
		return $data;
	}//eof
	
	/**
	*	Show contact data
	*	@param
	*	
	*			$id		Contact identity
	*/
	function showContactInfo($id){
		$data		= array();
		$select		= "SELECT * FROM contact WHERE id ='$id'";
		$query		= $this->conn->query($select);
		if($query->num_rows > 0){
			while($result	= 	$query->fetch_array()){
				$data	=	array(
								  $result['id'],				//0
								  $result['contact_name'],		//1
								  $result['contact_email'],		//2
								  $result['contact_phone'],		//3
								  $result['message'],			//4
								  $result['added_on']			//5
								);
			}//while
		}//if
		
		return $data;	
		
	}//	eof
	
	
	
}
?>