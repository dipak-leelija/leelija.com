<?php 
/**
*	Manage event calendar ads. Personalize the events
*
*	@author		Himadri Shekhar Roy
*	@date		November 26, 2006
*	@version	2.0
*	@copyright	Analyze System
*	@url		http://www.ansysoft.com
*	@email		himadri.s.roy@ansysoft.com
* 
*/

include_once("utility.class.php");
include_once("date.class.php");

class Event extends DateUtil
{
	/**
	*	Add an event with default status 4 as pending
	*	@return NULL
	*/
	function addEvent($event_start_date, $event_end_date, $event_time, $event_type, $event_duration, $event_priority, 
					  $event_access, $event_title, $event_description, $event_status_id, $type_id, $categories_id, $fees, 
					  $currencies_id, $meta_title, $meta_tags, $meta_description, $seo_url, $added_by, $email, $web_address, 
					  $organizer, $contact_person, $order_id, $customer_id  )
	{
		//Add security
		$event_title				= mysql_real_escape_string(trim($event_title));
		$event_description			= mysql_real_escape_string(trim(addslashes($event_description)) );
		$meta_title					= mysql_real_escape_string(trim($meta_title));
		$meta_tags					= mysql_real_escape_string(trim($meta_tags));
		$meta_description			= mysql_real_escape_string(trim($meta_description));
		$web_address				= mysql_real_escape_string(trim($web_address));
		$organizer					= mysql_real_escape_string(trim($organizer));
		$contact_person				= mysql_real_escape_string(trim($contact_person));
		
		
		$event_date = substr($event_start_date,0,10);
		
		//	Insert data in the table	insert into//values
		$sql = "INSERT INTO event_entry 
				(event_start_date, event_end_date, added_on, event_date, event_time, event_type, event_duration, 
				 event_priority, event_access, event_title, event_description, event_status_id, type_id, categories_id, 
				 fees, currencies_id, meta_title, meta_tags, meta_description, seo_url, added_by, email, web_address, 
				 organizer, contact_person, order_id, customer_id )
				VALUES
				('$event_start_date', '$event_end_date', now(), '$event_date', '$event_time', '$event_type', '$event_duration', 
				 '$event_priority', '$event_access', '$event_title', '$event_description', '$event_status_id','$type_id', 
				 '$categories_id', '$fees', '$currencies_id', '$meta_title', '$meta_tags', '$meta_description', '$seo_url', 
				 '$added_by', '$email', '$web_address', '$organizer', '$contact_person', '$order_id', '$customer_id' )";
				 
		//execute query
		$query = mysql_query($sql);
		
	//echo $sql.mysql_error(); exit;
		$id		= mysql_insert_id();
		 
		//return primary key
		return $id;
	
		
	}//End of function add event
	
	
	/**
	*	Add event information
	*	
	*	@param
	*			$event_id		Event id
	*			$added		Added on
	*			$start		Start date
	*			$end		End date
	*			$clicks		Number of clicks
	*
	*	@return string
	*/
	function addEventInfo($event_id, $start, $end, $clicks)
	{
		$sql 	= "INSERT INTO event_info
				  (event_id, added_on, start_date, end_date,no_clicks)
				  VALUES
				  ('$event_id', now(),'$start','$end','$clicks')";
				  
		$query	= mysql_query($sql);

		$result = '';
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
	*	Add a event address
	*	
	*	@param
	*			$event_id	Event id
	*			$add1		Address 1
	*			$add2		Address 2
	*			$add3		Address 3
	*			$t_id		Town id
	*			$c_id		County id
	*			$p_id		Province id
	*			$p_code		Postal Code
	*			$ph1		Phone 1
	*			$ph2		Phone 2
	*			$fax		Fax
	*			$toll		Tollfree number
	*
	*	@return string
	*/
	function addEventAdd($event_id, $add1, $add2, $add3, $p_code, $ph1, $ph2, $fax,  $toll,$countries_id, $province_id, $town_id)
						
	{
		$sql 	= "INSERT INTO event_address
				  (event_id, address1, address2, address3, postal_code, phone1, phone2, 
				  fax, tollfree_number, countries_id, province_id, town_id )
				  VALUES
				  ('$event_id', '$add1','$add2','$add3','$p_code','$ph1','$ph2',
				  '$fax', '$toll', '$countries_id', '$province_id', '$town_id')";
		
		//execute query
		$query = mysql_query($sql);

		//get the primary key
		$id		= mysql_insert_id();
		
		//return the id
		return $id;

	}//eof
	
	/**
	*	Edit an event
	*	@return NULL
	*/
	function editEvent($event_id, $event_start_date, $event_end_date, $event_time, $event_type, $event_duration, $event_priority, 
						$event_access, $event_title, $event_description, $event_status_id, $type_id, $categories_id, $fees, 
						$currencies_id, $meta_title, $meta_tags, $meta_description, $seo_url, $added_by, $email, $web_address, 
						$organizer, $contact_person,$order_id, $customer_id)
	{
		//Add security
		$event_title				= mysql_real_escape_string(trim($event_title));
		$event_description			= mysql_real_escape_string(trim($event_description));
		$meta_title					= mysql_real_escape_string(trim($meta_title));
		$meta_tags					= mysql_real_escape_string(trim($meta_tags));
		$meta_description			= mysql_real_escape_string(trim($meta_description));
		$web_address				= mysql_real_escape_string(trim($web_address));
		$organizer					= mysql_real_escape_string(trim($organizer));
		$contact_person				= mysql_real_escape_string(trim($contact_person));
		
		//$event_date = substr($event_start_date,0,10);
		
		$update	=   "UPDATE event_entry
					SET
					event_start_date 	=  '$event_start_date',
					event_end_date 	 	=  '$event_end_date',
					event_time 			=  '$event_time',
					event_type 			=  '$event_type',
					modified_on 		=   now(),
					event_duration 		=  '$event_duration',
					event_priority 		=  '$event_priority',
					event_access 		=  '$event_access',
					event_title 		=  '$event_title',
					event_description 	=  '$event_description', 
					event_status_id 	=  '$event_status_id',
					type_id			 	=  '$type_id',
					categories_id		=  '$categories_id',
					fees			 	=  '$fees',
					currencies_id		=  '$currencies_id',
					meta_title			=  '$meta_title', 
					meta_tags			=  '$meta_tags',
					meta_description	=  '$meta_description',
					seo_url			 	=  '$seo_url',
					added_by			=  '$added_by',
					email			 	=  '$email',
					web_address 		=  '$web_address',
					organizer		 	=  '$organizer',
					contact_person 		=  '$contact_person',
					order_id		 	=  '$order_id',
					customer_id 		=  '$customer_id'
					WHERE
					event_id = '$event_id'
					";

	
		$query	= mysql_query($update);
//echo $update.mysql_error(); exit;
	 
	}//End of edit event
	
	/**
	*	Update a event address
	*	
	*	@param
	*			$event_id	Event id
	*			$add1		Address 1
	*			$add2		Address 2
	*			$add3		Address 3
	*			$t_id		Town id
	*			$c_id		County id
	*			$p_id		Province id
	*			$p_code		Postal Code
	*			$ph1		Phone 1
	*			$ph2		Phone 2
	*			$ph3		Phone 3
	*			$fax		Fax
	*			$toll		Tollfree number
	*
	*	@return string
	*/
	
	function updateEventAdd($event_id, $add1, $add2, $add3, $p_code, $ph1, $ph2, $fax,  $toll, $countries_id, $province_id, $town_id)
	{
		//update event address
		$sql	= "UPDATE event_address SET
				  address1 			='$add1',
				  address2 			='$add2',
				  address3 			='$add3',
				  postal_code 		='$p_code',
				  phone1 			='$ph1',
				  phone2 			='$ph2',
				  fax 				='$fax',
				 
				  tollfree_number 	='$toll',
				  
				  countries_id		='$countries_id',
				  province_id 		='$province_id',
				  town_id 			='$town_id'
				  WHERE 
				  event_id = '$event_id'
				  ";
		$query	= mysql_query($sql);
	
		
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	
	
	
	/**
	*	Delete event
	*
	*	@param
	*			$event_id			Primary key associated with the event
	*
	*	@return NULL
	*/
	function deleteEvent($event_id, $path)
	{
		//get the event detail first
		$eveDtl	= $this->getEventDetailById($event_id);
		
		//image
		$img	= $eveDtl[23];
		
		//delete the image 
		if(($img != '') &&  (file_exists($path.$img)))
		{
			@unlink($path.$img);
		}
		
		//get all image id
		$imgId	= $this->getEventImageId($event_id);
		//delete image from event image also
		foreach($imgId as $ev)
		{
			$this->deleteEventImage($ev, $path);
		}
		//delete from event address
		$delete	= "DELETE FROM event_address WHERE event_id = '$event_id'";
		mysql_query($delete);
		
	
		//delete from event entry
		$delete	= "DELETE FROM event_entry WHERE event_id = '$event_id'";
		mysql_query($delete);
		
		//delete from event entry
		$delete	= "DELETE FROM event_info WHERE event_id = '$event_id'";
		mysql_query($delete);
		
		//delete from event entry
		$delete	= "DELETE FROM event_review WHERE event_id = '$event_id'";
		mysql_query($delete);


	}//eof
	
	
	
	
	
	/**
	*	Change the status of an event
	*	@return NULL
	*/
	function changeEventStat($event_id,$event_status_id)
	{
		$update = "UPDATE event_entry
					SET
					event_status_id = '$event_status_id'
					WHERE
					event_id = '$event_id'
					";
		mysql_query($update);
	}//end of changing status 
	
	
	
	/**
	*	Close all active or payment pending events if date expires
	*/
	function closeExpiredEvent()
	{
		$update = "UPDATE ";
	}
	
	/**
	*	Search customer by location name
	*
	*	@param
	*			$loc_name	Location name
	*
	*	@return array
	*/
	function getEveByLoc($loc_name)
	{
		$loc_name = mysql_escape_string($loc_name);
		
		$sql	= 	"SELECT DISTINCT event_id 
					FROM event_address EA, town T, county C, province P
					WHERE 
					EA.town_id = T.town_id
					AND ( T.town_name LIKE '%$loc_name%' ) 
					OR ( C.county_name LIKE '%$loc_name%' ) 
					OR ( P.province_name LIKE '%$loc_name%' ) 
					";
		 $query = mysql_query($sql);
		 
		 $data = array();
		
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 } 
		 if(!$query)
		 {
			return mysql_error();
		 }
		 else
		 {
			return $data;
		 }
	}//eof
	
	
	/**
	*	Get only non empty events
	*
	*
	*	@return array
	*/
	function getNonEmptyEve()
	{		
		$sql	= 	"SELECT  event_id 
					FROM event_entry EE
					WHERE 
					EE.event_title != ''
					";
		 $query = mysql_query($sql);
		 
		 $data = array();
	
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 } 
		 if(!$query)
		 {
			return mysql_error();
		 }
		 else
		 {
			return $data;
		 }
	}//eof
	
	/**
	*	Retrieve event id by event type, date type(month or a particular day)
	*	
	*	@return array
	*/
	function getEventId($event_type,$event_status, $date_type, $date, $user_type,$user_id)
	{
		// Date formatting
		$date_only = substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2) ;
		
		$year = (int)substr($date,0,4);
		$month =(int) substr($date,4,2);
		$day = (int)substr($date,6,2);
		$date = $year."-".$month."-".$day ;
		
		
		$date_string = mktime(0,0,0,$month,1,$year);
		$start_date = date("Y-m-d",$date_string);
		
	 	$total_days_in_month = date("t",$date_string);
		$end_date_string = mktime(0,0,0,$month,$total_days_in_month,$year);
		$end_date = date("Y-m-d",$end_date_string);
		
		if(($user_type == 'admin') || ($user_type == 'guest'))
		{
			if(($event_type == 'ALL') && ($date_type == 'day'))
			{
				$select	= "SELECT * FROM event_entry WHERE event_date='$date_only'  
							ORDER BY added_on DESC";
			}
			elseif(($event_type != 'ALL') && ($date_type == 'day'))
			{
				$select	= "SELECT * FROM event_entry 
							WHERE 
							event_date='$date_only' 
							AND event_status_id='$event_status'  
							ORDER BY added_on DESC";
							
			}
			elseif(($event_type != 'ALL') && ($date_type == 'month'))
			{
				$select	= "SELECT * FROM event_entry WHERE 
							event_date >='$start_date'
							AND  event_date <='$end_date'
							AND event_status_id='$event_status' 
							ORDER BY added_on DESC";
			}
			elseif(($event_type == 'ALL') && ($date_type == 'month'))
			{
				$select	= "SELECT * FROM event_entry WHERE 
							event_date >='$start_date'
							AND  event_date <='$end_date'
							ORDER BY added_on DESC";
			}
			elseif(($event_type == 'ALL') && ($date_type == 'ALL'))
			{
				$select	= "SELECT * FROM event_entry 
							ORDER BY added_on DESC";
			}
			elseif(($event_type != 'ALL') && ($date_type == 'ALL'))
			{
				$select	=   "SELECT * FROM event_entry 
							WHERE event_status_id='$event_status'
							ORDER BY added_on DESC";
			}
		}//end of if user type admin
		else
		{
			if(($event_type == 'ALL') && ($date_type == 'day'))
			{
				$select	= "SELECT * FROM event_entry 
							WHERE 
							event_date='$date_only' 
							AND customer_id='$user_id'
							ORDER BY added_on DESC";
			}
			elseif(($event_type != 'ALL') && ($date_type == 'day'))
			{
				$select	= "SELECT * FROM event_entry 
							WHERE 
							event_date='$date_only' 
							AND event_status_id='$event_status' 
							AND customer_id='$user_id'
							ORDER BY added_on DESC";
			}
			elseif(($event_type != 'ALL') && ($date_type == 'month'))
			{
				$select	= "SELECT * FROM event_entry WHERE 
							event_date >='$start_date'
							AND  event_date <='$end_date'
							AND event_status_id='$event_status' 
							AND customer_id='$user_id'
							ORDER BY added_on DESC";
			}
			elseif(($event_type == 'ALL') && ($date_type == 'month'))
			{
				$select	= "SELECT * FROM event_entry WHERE 
							event_date >='$start_date'
							AND  event_date <='$end_date'
							AND customer_id='$user_id'
							 ORDER BY added_on DESC";
			}
			elseif(($event_type == 'ALL') && ($date_type == 'ALL'))
			{
				$select	= "SELECT * FROM event_entry WHERE 
							customer_id='$user_id'
				 			ORDER BY added_on DESC";
			}
		}//end of if user type admin
	
		$query	= mysql_query($select);
		
		
		$data = array();
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['event_id'];
			}
		}
		return $data;
	}//end of getting event id
	
	/**
	*	Retrieve all event id based upon criteria. Like package, customer, service, location
	*	
	*	@param
	*			$id		Identity of a particular type associated with the event.
	*					No nothing is specified it will search for the entire event listing.
	*			$type	Type of the identity. Type coud be any of the following:
	*					PACKAGE 	: Event associated with  a package
	*					SERVICE 	: Event associated with  a service
	*					CUSTOMER 	: Number of event subscribed by a customer.
	*					CATEGORY 	: Event which falls under a category or subcategory 
	*								  of that category, (Treat separate)
	*					TOWN 		: Event associated with  a Town
	*					COUNTY 		: Event associated with  a County
	*					PROVINCE	: Event associated with  a Province
	*
	*	@return array
	*/
	function getEveId($id, $type)
	{
		
		//Building the statement
		if($type == 'TYPEID')
		{
			$sql	= "SELECT event_id FROM event_entry WHERE type_id='$id'
					   ORDER BY event_start_date";
		}
		else
		{
			$sql	= "SELECT event_id FROM event_entry ORDER BY added_on DESC";
		}
			
		
		$query	= mysql_query($sql);
	
		
		$data	= array();
	
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['event_id'];
			}
		}
		return $data;
	}//eof
	
	/**
	*	Retrieve all event id based upon criteria. Like package, customer, service, location
	*	
	*	@param
	*			$id		Identity of a particular type associated with the event.
	*					No nothing is specified it will search for the entire event listing.
	*			$type	Type of the identity. Type coud be any of the following:
	*					PACKAGE 	: Event associated with  a package
	*					SERVICE 	: Event associated with  a service
	*					CUSTOMER 	: Number of event subscribed by a customer.
	*					CATEGORY 	: Event which falls under a category or subcategory 
	*								  of that category, (Treat separate)
	*					TOWN 		: Event associated with  a Town
	*					COUNTY 		: Event associated with  a County
	*					PROVINCE	: Event associated with  a Province
	*
	*	@return array
	*/
	function getEveIdByCond($num)
	{
		
		//Building the statement
		
		$sql	= "SELECT event_id FROM event_entry ORDER BY event_start_date ASC LIMIT ".$num;
		
		
		$query	= mysql_query($sql);
		
		$data	= array();

		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['event_id'];
			}
		}
		return $data;
	}//eof
	
	
	
	function getEveIdByMemberAndTypeId($cusId, $typeId)
	{
		//declare vars
		$data	= array();
		
		//Building the statement
		$sql	= "SELECT 		ECE.event_customer_entry_id 
				   FROM 		event_customer_entry ECE, event_entry EE
				   WHERE		ECE.customer_id	= $cusId
				   AND			EE.type_id		= $typeId
				   AND			ECE.event_id	= EE.event_id
				   ORDER BY 	ECE.added_on DESC";
					
		//execute query
		$query	= mysql_query($sql);
		
		//check if rows exists
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->event_customer_entry_id;
			}
		}
		
		//return the array
		return $data;
		
	}//eof
	
	
	
	
	
	/**
	*	Retrieve all event id based upon criteria. Like package, customer, service, location and status. This is an upgraded version 
	*	of the previous function. This will be displaying in front of the visitor.
	*	
	*	@param
	*			$id		Identity of a particular type associated with the event.
	*					No nothing is specified it will search for the entire event listing.
	*			$type	Type of the identity. Type coud be any of the following:
	*					PACKAGE 	: Event associated with  a package
	*					SERVICE 	: Event associated with  a service
	*					CUSTOMER 	: Number of event subscribed by a customer.
	*					CATEGORY 	: Event which falls under a category or subcategory 
	*								  of that category, (Treat separate)
	*					TOWN 		: Event associated with  a Town
	*					COUNTY 		: Event associated with  a County
	*					PROVINCE	: Event associated with  a Province
	*
	*	@return array
	*/
	function getActiveEveId($id, $type, $status)
	{
		
		//Building the statement
		if($type == 'TYPEID')
		{
			$sql	= "SELECT 		event_id 
					   FROM   		event_entry 
					   WHERE  		type_id='$id'
					   AND			event_status_id = $status
					   ORDER  BY 	event_start_date";
		}
		else
		{
			$sql	= "SELECT 		event_id 
					   FROM 		event_entry 
					   WHERE 		event_status_id = $status
					   ORDER BY 	type_id DESC";
		}
			
		
		$query	= mysql_query($sql);
		$data	= array();
		//echo $sql;
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['event_id'];
			}
		}
		return $data;
	}//eof
	
	
	
	
	
	
	
	/** 
	*	Retrieve  event detail by event id
	*
	*	@param
	*			$eventId		Primary key to identify the event
	*
	*	@return array
	*/
	function getEventDetailById($eventId)
	{
		$select   = "SELECT * FROM 
					event_entry EE, event_status ES, event_address EA, event_static EST
					WHERE EE.event_id ='$eventId' 
					AND EA.event_id = EE.event_id
					AND EST.event_id = EE.event_id
					AND ES.event_status_id = EE.event_status_id
					";
		$query    = mysql_query($select);
		
		$data	  = array();
		
		//echo $select;
		if(mysql_num_rows($query) > 0)
		{
			$result   = mysql_fetch_array($query);
			
			$data = array(
				$result['event_start_date'],	//0 Event entry
				$result['event_end_date'],		//1
				$result['added_on'],			//2
				$result['event_date'],			//3
				$result['event_time'],			//4
				$result['event_type'],			//5
				$result['modified_on'],			//6
				$result['event_duration'],		//7
				$result['event_priority'],		//8
				$result['event_access'],		//9
				$result['event_title'],			//10
				$result['event_description'],	//11
				
				$result['event_status_id'],		//12 Event Status
				$result['event_status'],		//13
				
				$result['address1'],			//14, Event Address
				$result['address2'],			//15
				$result['address3'],			//16
				$result['postal_code'],			//17
				$result['phone1'],				//18
				$result['phone2'],				//19
				$result['fax'],					//20
				$result['tollfree_number'],		//21
				
				 
			    $result['type_id'],				//22, SORT
			    $result['image'],				//23
				$result['fees'],				//24  03 Feb 2012( Event entry)
				$result['currencies_id'],		//25
				$result['meta_title'],			//26
				$result['meta_tags'],			//27
				$result['meta_description'],	//28
				$result['email'],				//29  Event address
				$result['web_address'],			//30
				$result['organizer'],			//31  
				$result['contact_person'],		//32
				$result['seo_url'],				//33  
				$result['categories_id'],		//34
				
				$result['countries_id'],		//35  Event address
				$result['province_id'],			//36 
				$result['town_id'],				//37
				$result['added_by'],			//38
				
				$result['order_id'],			//39
				$result['customer_id'],			//40
				$result['image'],				//41
				
				$result['static_id']			//42  Event static, Added On July 15, 2013
				
			);
		}//if
		
		return $data;
	}//eof
	
	
	
	/** 
	*	Retrieve  event detail by event id
	*
	*	@param
	*			$eventId		Primary key to identify the event
	*
	*	@return array
	*/
	function getEventInfoData($eventId)
	{
		$select   = "SELECT * FROM 
					event_info 
					WHERE event_id ='$eventId' 
					
					";
		$query    = mysql_query($select);
		
		
		$data	  = array();
		//echo $select;
		if(mysql_num_rows($query) > 0)
		{
			$result   = mysql_fetch_array($query);
			
			$data = array(
				$result['added_on'],			//0 Event info
				$result['modified_on'],			//1
				$result['start_date'],			//2
				$result['end_date'],			//3
				$result['no_clicks'],			//4
				$result['url_clicks']			//5
			
				
			);
		}//if
		
		return $data;
	}//eof
	
	
	/**
	*	Return event id depending the time slot of a day, and the user
	*	@return array
	*/
	function getEventBySlot($date,$time_slot,$user_type, $user_id)
	{
	
		$year       = substr($date,0,4);
		$month      = substr($date,4,2);
		$day        = substr($date,6,2);
		$date       = $year."-".$month."-".$day ;
		
		$start_hour = $time_slot.":00:00";
		$end_hour   = $time_slot + 1 .":00:00";
		
		if($user_type == 'user')
		{
			$select = "SELECT * FROM event_entry EE 
					WHERE 
					EE.customer_id = '$user_id'
					AND EE.event_date = '$date'
					AND EE.event_time >= '$start_hour'
					AND EE.event_time < '$end_hour' ";
		}
		elseif($user_type == 'guest')
		{
			$select = "SELECT * FROM event_entry EE 
					WHERE
					EE.event_status_id = '1'
					AND EE.event_date = '$date'
					AND EE.event_time >= '$start_hour'
					AND EE.event_time < '$end_hour' ";
		}
		elseif($user_type == 'admin')
		{
			$select = "SELECT * FROM event_entry EE 
					WHERE
					AND EE.event_date = '$date'
					AND EE.event_time >= '$start_hour'
					AND EE.event_time < '$end_hour' ";
		}
		else
		{
			$select = "SELECT * FROM event_entry EE 
					WHERE
					EE.event_status_id = '1'
					AND EE.event_date = '$date'
					AND EE.event_time >= '$start_hour'
					AND EE.event_time < '$end_hour' ";
		}
		
		$query = mysql_query($select);
		
		$data = array();
		
		while($result = mysql_fetch_array($query))
		{
			$data[] = $result['event_id'];
		}
		return $data;		
	}
	
	/**
	*	Check the mail functionality for event notification, whether the user is the authorized user and the 
	*	event is still active
	*	@return string
	*/
	function checkEventRole($userId, $eventId)
	{
		$sql = "SELECT * FROM event_entry WHERE customer_id='$userId' AND event_id='$eventId' AND event_status_id='1'";
		$query = mysql_query($sql);
		
		$data = '';
		if(mysql_num_rows($query) == 1)
		{
			$data 	= 'FOUND';
		}
		else
		{
			$data 	= 'NOT_FOUND';
		}
		return $data;
	}
	
	
	/**
	*	Update event information
	*	
	*	@param
	*			$eve_id		Event id
	*			$modified	Modified on
	*			$start		Start date
	*			$end		End date
	*
	*	@return string
	*/
	
	function updateEveInfo($eve_id, $start, $end)
	{
		//update event info
		$sql	= "UPDATE event_entry SET
				  modified_on 	= now(),
				  start_date 	= '$start',
				  end_date 		= '$end'
				  WHERE 
				  event_id = '$dir_id'
				  ";
		$query	= mysql_query($sql);
		
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	
	////////////////////////////////////////////////////////////////////////////////////////
	//
	//							Event Type
	//
	/////////////////////////////////////////////////////////////////////////////////////////
	
	/**
	*	Get event type detail
	*/
	function getEveTypeDtl($id)
	{
		$sql	= "SELECT * FROM event_type WHERE type_id='$id'";
		
		$query    = mysql_query($sql);
		$data	  = array();
		
		if(mysql_num_rows($query) > 0)
		{
			$result   = mysql_fetch_array($query);
			
			$data = array(
				$result['title'],		//0 Event entry
				$result['added_on'],	//1
				$result['modified_on']	//2
			);
		}//if
		
		return $data;
	}//eof
	
	
	/**
	*	Get events by type
	*
	*	@return array
	*/
	function getTypeEve($typeId)
	{
		 //declare vars
		 $data = array();
		 $typeId	= (int)$typeId;
		 
		 //create statement
		 if($typeId == 0)
		 {
		 	$sql =  "SELECT event_id FROM event_entry ORDER BY event_start_date DESC";
		 }
		 else
		 {
		 	$sql =  "SELECT event_id FROM event_entry WHERE type_id = '$typeId'
			         ORDER BY event_start_date DESC";
		 }
		 
		 $query = mysql_query($sql);
		 
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 } 
		 
		 //return the value
		 return $data;
		 
		 
	}//eof
	
	/**
	*	Get latest event by type
	*	
	*	@param
	*			$typeId		Type of Event
	*
	*	@return	 int
	*/
	function getLatestEvent($typeId)
	{
		//get all other ids
		$allIds 	= $this->getTypeEve($typeId);
		$latestId	= 0;
		
		if(count($allIds) > 0)
		{
			$latestId	= $allIds[0];
		}
		
		//return the id
		return $latestId;
	}//eof
	
	/**
	*	Get latest event by type
	*	
	*	@param
	*			$typeId		Type of Event
	*
	*	@return	 int
	*/
	function getOtherEvent($typeId, $eventId)
	{
		//get all other ids
		$sql =  "SELECT event_id FROM event_entry  WHERE type_id = '$typeId' AND event_id <> $eventId
				 ORDER BY event_start_date DESC";
		
		 $query = mysql_query($sql);
		 
		 $data = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 }
		  
		 if(!$query)
		 {
			return mysql_error();
		 }
		 else
		 {
			return $data;
		 }
	}//eof
	
	
	////////////////////////////////////////////////////////////////////////////////////////
	//
	//				*********			Event YEar Options		*********
	//
	/////////////////////////////////////////////////////////////////////////////////////////
	function getEveYearId()
	{
		$select = "SELECT id FROM eventcal_year_option";
				  
		$query = mysql_query($select);
		$data  = array();
		if(mysql_num_rows($query) > 0 )
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['id'];
			}
		}
		return $data;
	}//eof
	
	function getEveYearData($id)
	{
		//create the statement
		$sql	= "SELECT * FROM eventcal_year_option WHERE id= '$id'";
		
		$query	= mysql_query($sql);
		$data	= array();
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_array($query);
			$data = array(
						 $result['start_year'],		//0
						 $result['end_year']        //1
						 );
		}
		return $data;
	}
	
	function updEveYearData($id, $start, $end)
	{
		$sql	= "UPDATE eventcal_year_option 
				  SET
				  start_year	='$start',
				  end_year 		='$end'
				  WHERE 
				  id = '$id'
				  ";
		$query	= mysql_query($sql);
	
		$result = '';
		if(!$query)
		{
			$result = "ER102";
		}
		else
		{
			$result = "SU102";
		}
		
		//return the result
		return $result;
	}//eof
	
	
	
	
	/*  
		CHECK WHETHER USER CAN PERFORM CERTAIN TASK OR NOT. E.G. USER CAN'T EDIT, DELETE OTHER'S 
		EVENT, OR HE IS NOT AUTHORIZED TO REOPEN ANY CLOSED OR SUSPENDED EVENT
	*/
	function getUserRole($userId, $eventId)
	{
		$select = "SELECT * FROM
				   event_entry EE, customers C
				   WHERE 	
				   EE.event_id    = '$eventId'
				   AND EE.customer_id = '$userId'
				   AND C.customer_id = EE.customer_id 
				   ";
		   
		$query = mysql_query($select);
		
		$num   = mysql_num_rows($query);
		$msg   = '';
		if($num > 0)
		{
			$msg = 'YES';
		}
		else
		{
			$msg = 'NO';
		}
		return $msg;
		
	}//eof
	
	
	
	/**
	*	Get events by type 
	*
	*	@date	Septesmber 03, 2010
	*
	*	@param
	*			$dateType		Searching for newer or older
	*
	*	@return array
	*/
	function getEventByDate($dateType)
	{
		 //declare vars
		 $data	= array();
		 $sql	= '';
		 $date	= date("Y-m-d");
		 
		 if($dateType == 'OLDER')
		 {
		 	$sql =  "SELECT event_id 
					 FROM event_entry 
					 WHERE event_start_date < '$date'
					 ORDER BY event_start_date DESC";
		 }
		 else
		 {
		 	$sql =  "SELECT event_id 
					 FROM event_entry 
					 WHERE event_start_date >= $date
					 ORDER BY event_start_date DESC";
		 }
		
		 
		
		 //execute query
		 $query = mysql_query($sql);
		 
		 if(!$query)
		 {
		 	echo mysql_error();
		 }
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 } 
		 
		 //return data
		 return $data;
		 
		 
	}//eof
	
	
	
	/**
	*	Get events by type 
	*
	*	@date	Septesmber 03, 2010
	*
	*	@param
	*			$dateType		Searching for newer or older
	*
	*	@return array
	*/
	function getEveByTypeAndDate($id, $type, $dateType)
	{
		 //declare vars 
		 $data		= array();
		 $typeIds	= array();
		 $dateIds	= array();
		 
		 //get events by date type
		 $dateIds	= $this->getEventByDate($dateType);
		 
		 //get events by type
		 $typeIds	= $this->getEveId($id, $type);
		 
		 //intersect
		 $data		= array_intersect($dateIds, $typeIds);
		 
		 //return the data
		 return $data;
		 
	}//eof
	
	
	
	
	
	/**
	*	Get events by status 
	*
	*	@date	March 08, 2011
	*
	*	@param
	*			$status		Status of the event
	*
	*	@return array
	*/
	function getEventByStatus($status)
	{
		 //declare vars
		 $data	= array();
		 $sql	= '';
		 
		 
		 $sql 	=  "SELECT 	event_id 
				 	FROM 	event_entry 
				 	WHERE 	event_status_id = $status
				 	ORDER 	BY event_start_date DESC";
		 
		
		 //execute query
		 $query = mysql_query($sql);
		 
		 if(!$query)
		 {
		 	echo mysql_error();
		 }
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->event_id;
		 } 
		 
		 //return data
		 return $data;
		 
		 
	}//eof
	
	
	
	
	
	/**
	*	Get events by type 
	*
	*	@date	March 08, 2011
	*
	*	@param
	*			$dateType		Searching for newer or older
	*
	*	@return array
	*/
	function getEveByTypeDateStatus($id, $type, $dateType, $status)
	{
		 //declare vars 
		 $data		= array();
		 $typeIds	= array();
		 $dateIds	= array();
		 $statIds	= array();
		 
		 //get events by date type
		 $dateIds	= $this->getEventByDate($dateType);
		 
		 //get events by type
		 $typeIds	= $this->getEveId($id, $type);
		 
		 //get events by status
		 $statusIds	= $this->getEventByStatus($status);
		 
		 //intersect
		 $data		= array_intersect($dateIds, $typeIds, $statusIds);
		 
		 //return the data
		 return $data;
		 
	}//eof
	
	
	
	#################################################################################################

 ###                                Customer Event Entry type
                               
 ###
#################################################################################################


	/**
	*	Add  Customer To The 'event_customer_entry' Table
	*
	*	@param
	*			
	*
	*	
	*/
	function addCustomerEventEntry($event_id, $customer_id, $remarks)
	{
	       //declare variable
		   $id	= 0;
		
		   //statement
		   $sql  =  "INSERT INTO event_customer_entry 
			                (event_id, customer_id, remarks, added_on) 
			         VALUES 
			                ($event_id, $customer_id, '$remarks', now())";
							 
	       //query
		   $query  = mysql_query($sql);
		   
		   //get the primary key
		   if($query)
		   {
			  $id	= mysql_insert_id();
		   }
	 
	       //return the key
		   return $id;	
			
    } //eof
		
		
		/**
	*	Edit Registered Customers details of the event_customer_entry .
	*
	*	@param
	*			
	*   $cusId          is the Primary key associated with the event_customer_entry table.
	*	
	*/
	 
    function editCustomerEventEntry($cusId, $event_id, $customer_id, $remarks)
	{
	         //declare var
		     $data	= '';
	
	         //create statement
	         $sql = "UPDATE event_customer_entry
		             SET 
			         event_id 		                 = '$event_id',
			         customer_id 		             = '$customer_id',
				     remarks                         = '$remarks',
			         modified_on 	                 =  now()
			         WHERE 
			         event_customer_entry_id         =  $cusId
			   		";
		
		   //execute query
		   $query = mysql_query($sql);
		  
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
    *    Delete Registered Customer  from the database
    *    @param $id    primary key
    *    @return       string
    */
    function deleteCustomerEventEntry($id)
    {
          //delete from event_customer_entry table
          $sql          = "DELETE FROM 	event_customer_entry 
		  				   WHERE 		event_customer_entry_id = $id";
          $query        = mysql_query($sql);
       
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
	*	Retrieve all CustomerEventEntry id 
	*
	*	@return array
	*/
	function getAllCustomerEventEntryId()
	{
		//Declare array
		$data	= array();
		
		//fetch the data
		$sql	= "SELECT 		event_customer_entry_id 
				   FROM 		event_customer_entry 
				   ORDER BY 	added_on 
				   DESC";
		
		//execute query
		$query	= mysql_query($sql);
		
		//fetch the data
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->event_customer_entry_id;
			}
		}
		
		//return data
		return $data;
		
	}//eof
	
	
	
	/**
	*	Retrive  from the event_customer_entry table
	*
	*	@param
	*			$id			event_customer_entry_id or primary key
	*			
	*	@return array
	*/
	function getCustomerEventEntryData($id)
	{
		//declare
		$data	= array();
		
		//statement
		$sql	= "SELECT 	*
				   FROM 	event_customer_entry
				   WHERE 	event_customer_entry_id= '$id'";
				   
		//execute query
		$query	= mysql_query($sql);
		
		
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			$data = array(
						 $result->event_id,               //0
						 $result->customer_id,		      //1
						 $result->remarks,				 //2
						 $result->added_on,				 //3
						 $result->modified_on        	 //4
						 );
		
		}
		

	  	//return the data
	  	return $data;
	}//eof	
	
	
	
	/**
	*	Retrieve all Celebrity fan club id 
	*
	*	@return array
	*/
	function getParticipentsByEventId($id)
	{
		//Declare array
		$data	= array();
		
		//
		$sql	= "SELECT 		event_customer_entry_id 
				   FROM 		event_customer_entry 
				   WHERE		event_id = $id
				   ORDER BY 	added_on 
				   DESC";
		
		//execute query
		$query	= mysql_query($sql);
		
		//fetch the data
		if(mysql_num_rows($query)>0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->event_customer_entry_id;
			}
		}
		
		//return data
		return $data;
		
	}//eof
	
	


	/**
	*	display order code, depending on the user, and status of the order
	*	variable:
	*	userid			:	user identity
	*	status			:	status code for the order
	*/
	
	function getEveIdByCusId($user_id, $status)
	{
		if(($user_id == 'all') &&($status == 'all'))
		{
			$sql	= "SELECT * FROM event_entry";
		}
		elseif(($user_id == 'all') &&((int)$status > 0))
		{
			$sql	= "SELECT * FROM event_entry WHERE event_status_id = '$status'";
		}
		elseif(((int)$user_id > 0) &&((int)$status > 0))
		{
			$sql	= "SELECT * FROM event_entry WHERE event_status_id = '$status' AND customer_id='$user_id'";
		}
		elseif(((int)$user_id > 0) &&($status == 'all'))
		{
			$sql	= "SELECT * FROM event_entry WHERE customer_id='$user_id'";
		}
		else
		{
			$sql	= "SELECT * FROM event_entry";
		}
		
		$query	= mysql_query($sql);
		
		//$sql.mysql_error(); exit;
		
		$data	= array();
		
		while($result = mysql_fetch_array($query))
		{
			$data[]	= $result['event_id'];
		}
		return $data;
		
	}//eof
	
	
	/**
	*	Retrieve all orders status data
	*
	*	@param	
	*			$id		id of the enent status
	*
	*	@return array
	*/
	
	function getEventStatusData($id)
	{
		//declare variable
		$data	= array();
		
		//create the statement
		$sql	= " SELECT 	* 
					FROM 	event_status 
					WHERE 	event_status_id= $id
					";
					
		//execute query	
		$query	= mysql_query($sql);
		
		
		//get the orders data
		if(mysql_num_rows($query) == 1)
		{
			$result = mysql_fetch_object($query);
			
			$data = array(
							 $result->event_status		//0
							 
						 );
				 	
		} 
		
		//return data
		return $data;
		
	}//eof
	
/**
*	Add event information
	*	
	*	@param
	*			$eve_id		Event id
	*			$added		Added on
	*			$start		Start date
	*			$end		End date
	*			$clicks		Number of clicks
	*
	*	@return string
	*/
	function addEveInfo($eve_id, $start, $end, $clicks)
	{
		$sql 	= "INSERT INTO event_info
				  (event_id, added_on, start_date, end_date, no_clicks)
				  VALUES
				  ('$eve_id', now(), '$start', '$end', '$clicks')";
				  
		$query	= mysql_query($sql);
	
		$result = '';
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
	*	Returns all the ads ids belongs to a event in direct or indirect manner
	*
	*	@date October 29, 2010
	*
	*	@param
	*			$catId			Category id
	*			$type			Type defines whether the category will search recursively through all the childs, or only to that category.
	*							The constant 'all' refers to recursive call that search through the parent and childs as well; otherwise 
	*							the function will search for the event those directly belong to the category
	*
	*	@return array
	*/
	function getEventList($catId, $level, $type)
	{
		//declare vars
		$data	= array();
		$data1	= array();
		$data2	= array();
		
		if($type == 'all')
		{
			//statement
			$select = "SELECT * FROM classified_categories WHERE parent_id='$catId' ORDER BY categories_name ";
			
			//execute statement
			$query  = mysql_query($select);
			
			while($result = mysql_fetch_array($query))
			{
				//get the categories ids
				$data1[]	=  $result['categories_id'];
				$cat_id		=  $result['categories_id'];
				
				//staement to get classifieds
				$select2 = "SELECT 		CL.event_id AS CID FROM event_entry CL, classified_info CI 
						    WHERE 		CL.categories_id	='".$result['categories_id']."'
							AND 		CL.event_id 	= CI.event_id
						    ORDER BY 	CI.added_on DESC
						   ";
				
				//execute statement
				$query2  = mysql_query($select2);
				
				//get the results
				while($result2 = mysql_fetch_array($query2))
				{
					//get the event ids
					$classifiedId = $result2['CID'];
					
					//hold in array
					$data[] = $classifiedId;
				}
				
				//call the function again
				$this->getClassifiedList($result['categories_id'], $level+1,'all');
			}
		}
		else
		{
			//get the event ads
			$ads 	= $this->getCatEvent($catId);
			
			
			//get the values in variable 
			$data	  = $ads;
		}
		
		
		//return the values
		return $data;
		
	}//eof
	
	
	##############################################################################################################################
	#
	#												Miscellaneous Functions
	#
	##############################################################################################################################
	
	
	
	/**
	*	Returns the event ids belongs to a category
	*
	*	@param
	*			$catId		Category id
	*
	*	@return	array
	*/
	function getCatEvent($catId)
	{
		//initialize vars
		$data	= array();
		
		//statement
		$select = "SELECT * FROM event_entry WHERE categories_id='$catId' ORDER BY event_id DESC";
		
		//execute statement
		$query  = mysql_query($select);
		
		//check if classifieds are there
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_array($query))
			{
				$data[] = $result['event_id'];
			}
		}
		
		//return the data
		return $data;
	}//eof
	
	
	
	
	########################################################################################################################
	#
	#											Event Additional Image Section
	#
	########################################################################################################################
	
	/**
	*	Add event images
	*	Author	Nafia Hassan Halder
	*	@param
	*			$event_id		Event id
	*			$title			Image title or name
	*
	*	@return int
	*/
	function addEventImage($event_id, $title)
	{
		//declare var
		$id = '';
		
		//statement
		$sql 	= "INSERT INTO event_image
				  (event_id, title, added_on)
				  VALUES
				  ('$event_id','$title', now())
				  ";
		
		//query
		$query	= mysql_query($sql);
		
		//get the id
		$id = mysql_insert_id();
		
		//return result
		return $id;
	}//eof
	
	
	
	/**
	*	Update event images
	*	
	*	@param
	*			$img_id			Image id	
	*			$title			Image Name
	*	@return int
	*/
	function updateEventImage($img_id, $title)
	{
		$sql 	= "UPDATE event_image
				  SET
				  title 			= '$title',
				  modified_on		= now()
				  WHERE
				  event_image_id = '$img_id'
				  ";
		$query	= mysql_query($sql);
		
		$result = '';
		if(!$query)
		{
			$result = 'ER101';
		}
		else
		{
			$result = mysql_insert_id();
		}
		return $result;
		
	}//eof
	
	
	/**
	*	Delete image.
	*
	*	@param 
	*			$id			Image id id
	*			$path		Path to the image
	*
	*	@return string
	*/
	function deleteEventImage($id, $path)
	{	
		//get the image detail
		$imgDetail	= $this->getEventImgData($id);
		
		//image
		$image		= $imgDetail[2];
	
		//delete the image first
		if( ($image != '')  && (file_exists($path.$image)) )
		{
			@unlink($path.$image);
		}
		
		//delete from event image
		$sql	= "DELETE FROM event_image WHERE event_image_id='$id'";
		$query	= mysql_query($sql);
		
		
	}//eof
	
	
	
	/**
	*	Retrieve all image id associated with a event id
	*	
	*	@param
	*			$id		Event id.
	*
	*	@return array
	*/
	function getEventImageId($id)
	{
		//declare vars
		$data	= array();
		
		//Building the statement
		$sql	= "SELECT event_image_id FROM event_image 
				   WHERE event_id = '$id'
				   ORDER BY event_image_id ASC ";
		
		//query
		$query	= mysql_query($sql);
		
		
		//fetch the data
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->event_image_id;
			}
		}
		
		//return the data
		return $data;
		
	}//eof
	
	
	/**
	* 	This function return exactly how many images exists
	*
	*	@param
	*			$id		Event id.
	*			$path	Path to the images.
	*
	*	@return array
	*/
	function getNumEventImg($id, $path)
	{
		//actual image
		$realImgId	= array();
		
		$imgIds = $this->getEventImageId($id);
		
		
		if(count($imgIds) > 0)
		{
			
			foreach($imgIds as $k)
			{
				$imgData	= $this->getEventImgData($k);
				
				if(($imgData[2] != '') && (file_exists($path . $imgData[2])))
				{
					$realImgId[] = $k;
				}
			}
		}
		return $realImgId;
		
	}//eof
	
	
	
	/**
	*	Get first image id if there is any image exist in the listing
	*
	*	@param
	*			$id		Event id.
	*			$path	Path to the images.
	*
	*	@return int
	*/
	function getSingleImg($id, $path)
	{
		$firstId	= 0;
		$realImgIds	= $this->getNumEventImg($id, $path);
		if(count($realImgIds) > 0)
		{
			$firstId = $realImgIds[0];
		}
		return $firstId;
	}//
	
	
	
	/**
	*	Retrieve image data
	*	
	*	@param	
	*			$id		Id of the image
	*
	*	@return array
	*/
	function getEventImgData($id)
	{
		//declare var
		$data	= array();
		
		//create the statement
		$sql	= "SELECT * FROM event_image
				   WHERE event_image_id = $id
				   ";
		
		$query	= mysql_query($sql);
		
		
		if(mysql_num_rows($query) > 0)
		{
			$result = mysql_fetch_object($query);
			$data = array(
						 $result->event_id,				//0
						 $result->title,				//1
						 $result->image,				//2
						 $result->added_on,				//3
						 $result->modified_on			//4
						 );
		}
		
		//return data
		return $data;
		
	}//eof
	
	
	/**
	*	Hold the sub-sections in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return array
	*/
	function regSubInSess($num)
	{
		//declare variables
		$data	= array();
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				

				//image title
				if(isset($_POST['txtSubImgTitle'][$m]))
				{
					$_SESSION['txtSubImgTitle'][$m]	= $_POST['txtSubImgTitle'][$m];
				}
				else
				{
					$_SESSION['txtSubImgTitle'][$m]	= '';
				}
				
				
				$data[]	= $_SESSION['txtSubImgTitle'][$m];
			}//for
		}//if
		
		
		//return data
		return $data;
		
	}//eof
	
	
	
	/**
	*	Delete the sub-sections variables registered in session array
	*
	*	@param
	*			$num	Number of sub-section or additional pragraphs
	*
	*	@return null
	*/
	function delSubInSess($num)
	{
		//declare variables
		$num	= (int)$num;
		
		if($num >= 1)
		{
			for($m = 0; $m < $num; $m++)
			{
				//title
				if( isset($_SESSION['txtSubImgTitle'][$m]) )
				{
					$_SESSION['txtSubImgTitle'][$m] = '';
					unset($_SESSION['txtSubImgTitle'][$m]);
				}
				
			}//for
		}//if
				
	}//eof
	
	
	
	/**
	*	Generate number of sub section fields
	*
	*	@param
	*			$num		Number of sub section or description
	*
	*	@return string
	*/
	function genDesc($num)
	{
		//declare variables
		$data	= '';
		$num	= (int)$num;
		
		if($num >= 1)
		{
			$data	= '<table width="100%">';
			//loop
			for($k = 0; $k < $num; $k++)
			{
				$j = $k+1;
				
				
				//hold description in session
				if(isset($_SESSION['txtSubImgTitle'][$k]))
				{
					$txtSubImgTitle[$k]	= $_SESSION['txtSubImgTitle'][$k];
				}
				else
				{
					$txtSubImgTitle[$k]	= '';
				}
				
				$data	.= '
						   <tr>
							 <td colspan="2" class=" padT10 padB10"><h4>Image/Photo['.$j.']</h4></td>
						   </tr>	
						   <tr>
							 <td width="22%" align="left" class="menuText padL10">Image Title </td>
							 <td align="left" class="bodyText pad5">
								<input name="txtSubImgTitle[]" type="text" class="text_box_large" 
								id="txtSubImgTitle[]" value="'.$txtSubImgTitle[$k].'" size="50" />
							 </td>
						   </tr>
						   <tr>
							 <td width="22%" align="left" class="menuText padl10">Image </td>
							 <td align="left" class="bodyText pad5">
								<input name="fileSubImg[]" type="file" class="text_box_large"
								 id="fileSubImg[]"> (800 X 800 pixels in width by height) 
							 </td>
						   </tr>
						   ';
			}
			
			//concate
			$data	.= '</table>';
		}
		
		//return the value
		return $data;
		
	}//eof
	
	
	#####################################################################################################################################
	#
	#											Generating Event By page - July 15, 2013
	#
	#####################################################################################################################################
	
	/**
	*	The system will keep track of event that has to publish by page. This is an add on to the system. The user has the flexibility 
	*	either to select or not select the option.
	*	
	*	@param
	*			$eventId		Unique event id
	*			$staticId		Static page or content page id
	*	
	*	@return int
	*/
	function addToContent($eventId, $staticId)
	{
		//declare var
		$esId	= 0;
		
		//create statement
		$sql 	= "INSERT INTO event_static
				  (event_id, static_id)
				  VALUES
				  ('$eventId', '$staticId')";
		
		//execute query		  
		$query	= mysql_query($sql);

		//get the primary key
		$esId	= mysql_insert_id();
		
		//return the key
		return $esId;
		
		
	}//eof
	
	
	
	
	/**
	*	The user would be able to edit the page associated with an event.
	*	
	*	@param
	*			$eventId		Unique event id
	*			$staticId		Static page or content page id that needs to update
	*	
	*	@return string
	*/
	function editContentPage($eventId, $staticId)
	{
		//declare var
		$isEdited	= "ER";
		
		//create statement
		$sql 	= "UPDATE 	event_static
				   SET		static_id	= $staticId
				   WHERE	event_id	= '$eventId'
				  ";
		
		//execute query		  
		$query	= mysql_query($sql);
		
		if($query)
		{
			$isEdited	= "SU";
		}
		else
		{
			$isEdited	= "ER";
		}
		
		//return the key
		return $isEdited;
		
		
	}//eof
	
	
	/**
	*	Delete event from static event table. As this part solely for Gurkha's Restaurant, we won't use it for other websites.
	*
	*	@date	July 29, 2013
	*
	*	@param
	*			$eveId			Primary key of an event that has to delete
	*	
	*	@return NULL
	*/
	function deleteEventFromStaticEvent($eveId) 
	{
		//delete from static event 
		$delete	= "DELETE FROM 		event_static 
				   WHERE 			event_id = '$event_id'";
		
		//execute query
		mysql_query($delete);
		
	}//eof
	
	
	/**
	*	Retrieve all event id by static id
	*
	*	@date	July 29, 2013	
	*			
	*	@param
	*			$staticId		Primary key associated with the static table
	*
	*	@return array
	*/
	function getEventIdByStaticId($staticId)
	{
		//Declare array
		$data	= array();
		
		//
		$sql	= "SELECT 		EE.event_id 
				   FROM 		event_entry EE, event_static ES
				   WHERE		EE.event_id = ES.event_id
				   AND			ES.static_id = $staticId
				   ORDER BY 	EE.added_on  DESC
				   ";
				  
		
		//execute query
		$query	= mysql_query($sql);
		
		//fetch the data
		if(mysql_num_rows($query)>0)
		{
			while($result = mysql_fetch_object($query))
			{
				$data[] = $result->event_id;
			}
		}
		
		//return data
		return $data;
		
	}//eof
	
	
	
	
}//eoc
	
?>