<?php 
/**
*	Search the database according to the criteria provided by the user.
*	Note: We are using full text search mixed with normal search. If any result is not returned
*	by the full text search, we will use normal search in such cases.
*
*	@author     	Himadri Shekhar Roy
*	@date   	 	December 21, 2006
*	@update			March 06, 2008
*	@version 		2.0
*	@copyright 		Analyze System
*	@email			himadri.s.roy@ansysoft.com
*/


class Search extends DatabaseConnection{
	/**
	*	Search by location. Which can be use in any other search.
	*	
	*	@param
	*			$pId		Province id
	*			$tId		Town id
	*			$id			Id to search
	*			$table		Table to perform search
	*
	*	@return array
	*/
	function getByLocation($pId, $tId, $id, $table)
	{
		$pId = mysql_escape_string((int)$pId);
		$tId = mysql_escape_string((int)$tId);
		
		if($tId > 0)
		{
			$sql	= "SELECT ".$id." FROM ".$table." WHERE town_id = '$tId'";
		}
		elseif($pId > 0)
		{
			$sql	= "SELECT ".$id." FROM ".$table." WHERE province_id = '$pId'";
		}
		else
		{
			$sql	= "SELECT ".$id." FROM ".$table."";
		}
		
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->$id;
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
	*	Search by country. Which can be use in any other search.
	*	
	*	@param
	*			$cId		Country id
	*			$id			Id to search
	*			$table		Table to perform search
	*
	*	@return array
	*/
	function getByCountry($cId, $id, $table)
	{
		$cId = mysql_escape_string((int)$cId);
				
		if($cId > 0)
		{
			$sql	= "SELECT ".$id." FROM ".$table." WHERE countries_id = '$cId'";
		}
		else
		{
			$sql	= "SELECT ".$id." FROM ".$table."";
		}
		
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->$id;
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
	
	
	

	##################################################################################################################
	#
	#      									Search Testimonial or Guest Rating
	#
	##################################################################################################################
	
	/**
	*	Search guest rating or customer testimonial. We need to perform full text search.
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getTestimonialByKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT guest_id FROM guest";
		}
		else
		{
			$sql =  "SELECT guest_id,
					MATCH(name, designation, email, address, comments, person_img)
  					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  guest
					WHERE 
					MATCH(name, designation, email, address, comments, person_img)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->guest_id;
			
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
	
	##############################################################################################
	#
	#      		******************** Province Search ***********************
	#
	##############################################################################################
	

	
	/**
	*	Search Province by keyword only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getProvinceKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT province_id FROM province";
		}
		else
		{
			$sql =  "SELECT province_id,
					MATCH( province_name)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  province
					WHERE 
					MATCH( province_name)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->province_id;
			
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
	
	
	
	
	
	
	##############################################################################################
	#
	#      		******************** Staff Search ***********************
	#
	##############################################################################################
	
	/**
	*	Search the Staff
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchStaff($keyword, $status)//  $cId,
	{
		$statRes	= $this->getStaffStatus($status);
		$keyRes		= $this->getStaffKeyword($keyword);
		
		
		
		$final  	= array_intersect($statRes, $keyRes);
		
		//$gender, $occ_id, 
		//echo count($statRes)."<br>".count($genRes)."<br>".count($occRes)."<br>".count($cntRes).
			 //"<br>".count($locRes)."<br>".count($keyRes)."<br>".count($final)."<br>";
		return $final;
	}//eof
	
	
	/**
	*	Search Staff by key word only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getStaffKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT staff_id FROM staff";
		}
		else
		{
			$sql =  "SELECT staff_id,
					MATCH( user_name, email, fname, lname, image, brief, description, organization)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  staff
					WHERE 
					MATCH( user_name, email, fname, lname, image, brief, description, organization)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->staff_id;
			
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
	*	Get Staff by status only
	*
	*	@return array
	*/
	function getStaffStatus($status)
	{
		 if($status != '')
		 {
		 	$sql =  "SELECT staff_id FROM staff WHERE status='$status'";
		 }
		 else
		 {
		 	$sql =  "SELECT staff_id FROM staff";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->staff_id;
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
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////
	//
	//      		************* Customer Search ***********************
	//
	/////////////////////////////////////////////////////////////////////////////////////////////
	
	
	/**
	*	Search the Customer
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchCus($keyword, $status,$loc)//  $cId,
	{
		$statRes	= $this->getCusStatus($status);
		$locRes		= $this->getCusLoc($loc);
		$keyRes		= $this->getCusKeyword($keyword);
		
		
		
		$final  	= array_intersect($statRes, $locRes, $keyRes);
		
		//$gender, $occ_id, 
		//echo count($statRes)."<br>".count($genRes)."<br>".count($occRes)."<br>".count($cntRes).
			 //"<br>".count($locRes)."<br>".count($keyRes)."<br>".count($final)."<br>";
		return $final;
	}//eof
	
	
	/**
	*	Search Customer by key word only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getCusKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT customer_id FROM customer";
		}
		else
		{
			$sql =  "SELECT customer_id,
					MATCH( member_id, user_name, email, fname, lname, image, brief, description, organization, profession,
						   verification_no,  verified_by )
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  customer
					WHERE 
					MATCH( member_id, user_name, email, fname, lname, image, brief, description, organization, profession,
						   verification_no,  verified_by)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->customer_id;
			
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
	*	Search Customer by location only
	*
	*	@param
	*			$loc	Location to search
	*
	*	@return array
	*/
	function getCusLoc($loc)
	{
		$loc 	= mysql_escape_string($loc);
		
		if($loc == '')
		{
			$sql =  "SELECT customer_id FROM customer_address";
		}
		else
		{
			$sql =  "SELECT customer_id,
					MATCH( address1, address2, address3, town, province, postal_code, phone1, phone2,
						   fax, mobile)
					AGAINST ('$loc' IN BOOLEAN MODE) AS score FROM  customer_address
					WHERE 
					MATCH(address1, address2, address3, town, province, postal_code, phone1, phone2,
						  fax, mobile)
					AGAINST ('$loc' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->customer_id;
			
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
	*	Get Customer by status only
	*
	*	@return array
	*/
	function getCusStatus($status)
	{
		 if($status != '')
		 {
		 	$sql =  "SELECT customer_id FROM customer WHERE status='$status'";
		 }
		 else
		 {
		 	$sql =  "SELECT customer_id FROM customer";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->customer_id;
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
	*	Get Customer by gender
	*
	*	@return array
	*/
	function getCusGender($gender)
	{
		 if($gender != '')
		 {
		 	$sql =  "SELECT customer_id FROM customer WHERE gender='$gender'";
		 }
		 else
		 {
		 	$sql =  "SELECT customer_id FROM customer";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->customer_id;
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
	*	Get Customer by occupation
	*
	*	@param
	*			$occ_id		Occupation Id
	*	@return array
	*/
	function getCusOcc($occ_id)
	{
		 if($occ_id > 0)
		 {
		 	$sql =  "SELECT customer_id FROM customer WHERE occ_id='$occ_id'";
		 }
		 else
		 {
		 	$sql =  "SELECT customer_id FROM customer";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->customer_id;
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
	
	
	##################################################################################################################
	#
	#      									Search Contact 
	#
	##################################################################################################################
	
	/**
	*	Search contact from the users.
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function searchContact($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT contact_id FROM contact";
		}
		else
		{
			$sql =  "SELECT contact_id,
					MATCH(name, designaton, company, address, postal_code, city,state, country, phone, fax, email, remarks)
  					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  contact
					WHERE 
					MATCH(name, designaton, company, address, postal_code, city,state, country, phone, fax, email, remarks)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->contact_id;
			
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
	
	##################################################################################################################
	#
	#      									Search Order
	#
	##################################################################################################################

	
	
	/*
		SEARCH PRODUCT
	*/
	function searchOrder($mode, $keyword, $type)
	{
		
		$keyword = $this->conn->escape_string($keyword);
		//echo "in search";
		switch ($type) {
		case 'name' :
			$sql =  "SELECT orders_code,
               		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
               		AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  orders
               		WHERE 
			   		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
				    AGAINST ('$keyword' IN BOOLEAN MODE) 
				    ORDER BY score DESC"; 
			break;	
		case 'product' :
			$sql =  "SELECT *
					FROM  orders, product_description , orders_products
               		WHERE 
					orders.orders_id = orders_products.orders_id
					AND  orders_products.product_id = product_description.product_id
					AND ((product_description.product_name like '%$keyword%') OR (product_description.product_description like '%$keyword%'))
				    ORDER BY product_description.product_name;"; 
			break;
			/*
			MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state,product_name,
   					product_description)
               		AGAINST ('$keyword' IN BOOLEAN MODE) AS score 
			MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state,product_name,
   					product_description)
				    AGAINST ('$keyword' IN BOOLEAN MODE)
			*/
		case 'customer' :
			$sql =  "SELECT orders_code,
               		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
               		AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  orders, customer
               		WHERE 
			   		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
				    AGAINST ('$keyword' IN BOOLEAN MODE)
					AND  orders.customer_id = customer.customer_id
				    ORDER BY score DESC"; 
			break;
		default :
			$sql =  "SELECT orders_code,
               		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
               		AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  orders
               		WHERE 
			   		MATCH(orders_code,delivery_name,delivery_address1,delivery_address2,delivery_city,
    				delivery_postcode,delivery_phone,delivery_state,billing_name,billing_address1,
   					billing_address2, billing_city,billing_postcode,billing_phone, billing_state)
				    AGAINST ('$keyword' IN BOOLEAN MODE) 
				    ORDER BY score DESC"; 
		}//end of switch		
		
		 $query = $this->conn->query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = $query->fetch_object()){
			$data[] = $result->orders_code;
		 } 
		 if(!$query){
			return $sql.$this->conn->error;
		 }else{
			return $data;
		 }
	}//END OF SEARCHING DATA BY ORDER
	
	
	
	/**
	*	Search orders from the orders.
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getOrderKeyword($keyword)
	{
		//declare vars
		 $data  = array();
		 
		//put security
		$keyword = mysql_escape_string($keyword);
		
		//create the statement
		if($keyword == '')
		{
			$sql =  "SELECT orders_id FROM orders";
		}
		else
		{
			$sql =  "SELECT orders_id,
					MATCH(orders_code,trxn_id,email,billing_name,billing_email, billing_address_1, billing_postal_code,billing_city,
					billing_province,billing_phone,shipping_name, shipping_email,shpping_address_1,shpping_city, shpping_province, shpping_phone)
  					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  orders
					WHERE 
					MATCH(orders_code,trxn_id,email,billing_name,billing_email, billing_address_1, billing_postal_code,billing_city,
					billing_province,billing_phone,shipping_name, shipping_email,shpping_address_1,shpping_city, shpping_province, shpping_phone)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		//execute query
		$query = mysql_query($sql);
		 
		 
		 //echo $sql;exit;
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->orders_id;
			
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
	*	Get Order by Payment Id
	*
	*	@param
	*			$pmId				Payment method id
	*
	*	@return array
	*/
	function getPaymentOrder($pmId)
	{
		//add security
		$pmId = mysql_escape_string($pmId);
		
		 if($pmId != '')
		 {
		 	$sql =  "SELECT orders_id FROM orders WHERE payment_method_id= '$pmId' ";
		 }
		 else
		 {
		 	$sql =  "SELECT orders_id FROM orders";
		 }
		
		 $query = mysql_query($sql);
		 $data = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->orders_id;
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
	*	Get Order by Payment Id
	*
	*	@return array
	*/
	function getCCName($creditCardType)
	{
		$sql =  "SELECT orders_id FROM orders";
		/* if($creditCardType != '')
		 {
		 	$sql =  "SELECT orders_id FROM orders WHERE cc_name='$creditCardType'";
		 }
		 else
		 {
		 	$sql =  "SELECT orders_id FROM orders";
		 }*/
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->orders_id;
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
	*	Get Order by Payment Id
	*
	*	@return array
	*/
	function getOrderByStatus($selOrderStatus)
	{
		 if($selOrderStatus != 0)
		 {
		 	$sql =  "SELECT orders_id FROM orders WHERE orders_status_id =$selOrderStatus";
		 }
		 else
		 {
		 	$sql =  "SELECT orders_id FROM orders";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->orders_id;
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

	
	###############################################################################################################
	#
	#						Search for Shipping Quotation
	#
	###############################################################################################################
	
	/**
	*	Search the Shipping Quotation
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchQuote($keyword, $status,$quotation_code)//  $cId,
	{
		$statRes		= $this->getQuoteStatus($status);
		$quoteRes		= $this->getQuoteCode($quotation_code);
		$keyRes			= $this->getQuotKeyword($keyword);
		
		
		
		$final  	= array_intersect($statRes, $quoteRes, $keyRes);
		
		//$gender, $occ_id, 
		//echo count($statRes)."<br>".count($genRes)."<br>".count($occRes)."<br>".count($cntRes).
			 //"<br>".count($locRes)."<br>".count($keyRes)."<br>".count($final)."<br>";
		return $final;
	}//eof
	
	
	/**
	*	Search the Shipping Quotation
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchQuoteCode($quotation_code)//  $cId,
	{
		$quoteRes		= $this->getQuoteCode($quotation_code);
		$final  	= array_intersect($quoteRes);
		return $final;
	}//eof
	
	
	/**
	*	Get Shipping Quotation by status only
	*
	*	@return array
	*/
	function getQuoteStatus($status)
	{
		 if($status != '')
		 {
		 	$sql =  "SELECT shipping_quotation_id FROM shipping_quotation WHERE status='$status'";
		 }
		 else
		 {
		 	$sql =  "SELECT shipping_quotation_id FROM shipping_quotation";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_quotation_id;
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
	*	Search Quotation by location only
	*
	*	@param
	*			$loc	Location to search
	*
	*	@return array
	*/
	function getQuoteLoc($loc)
	{
		$loc 	= mysql_escape_string($loc);
		
		if($loc == '')
		{
			$sql =  "SELECT shipping_quotation_address_id FROM shipping_quotation_address";
		}
		else
		{
			$sql =  "SELECT shipping_quotation_address_id,
					MATCH( origin_port, origin_addrress1, origin_addrress2, origin_addrress3, origin_town, origin_province, destination_port, destination_address1, destination_address2, destination_address3, destination_town, destination_province, destination_phone1, destination_mobile, origin_phone1, origin_mobile  )
					AGAINST ('$loc' IN BOOLEAN MODE) AS score FROM  shipping_quotation_address
					WHERE 
					MATCH(origin_port, origin_addrress1, origin_addrress2, origin_addrress3, origin_town, origin_province, destination_port, destination_address1, destination_address2, destination_address3, destination_town, destination_province, destination_phone1, destination_mobile, origin_phone1, origin_mobile)
					AGAINST ('$loc' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_quotation_address_id;
			
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
	*	Get Shipping by status only
	*
	*	@return array
	*/
	function getQuoteCode($quotation_code)
	{
		 if($quotation_code != '')
		 {
		 	$sql =  "SELECT shipping_quotation_id FROM shipping_quotation WHERE quotation_code='$quotation_code'";
		 }
		 else
		 {
		 	$sql =  "SELECT shipping_quotation_id FROM shipping_quotation";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_quotation_id;
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
	*	Search Customer by key word only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getQuotKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT shipping_quotation_id FROM shipping_quotation";
		}
		else
		{
			$sql =  "SELECT shipping_quotation_id,
					MATCH( categories_id, shipping_container_size_id, full_name, email, phone, enquiry_desc, 
					goods_type, pickup_require,quotation_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  shipping_quotation
					WHERE 
					MATCH( categories_id, shipping_container_size_id, full_name, email, phone, enquiry_desc, 
					goods_type, pickup_require,quotation_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_quotation_id;
			
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
	
	
	######################################################################################################################
	#
	#									Shipping Search
	#
	######################################################################################################################
	
	
	/**
	*	Search the Shipping
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchShipping($keyword, $shipping_code)
	{
		$codeRes	= $this->getShippingCode($shipping_code);
		//$locRes		= $this->getShippingLoc($loc);
		$keyRes		= $this->getShipKeyword($keyword);
		
		
		
		$final  	= array_intersect($codeRes, $keyRes);
		
		//$gender, $occ_id, 
		//echo count($statRes)."<br>".count($genRes)."<br>".count($occRes)."<br>".count($cntRes).
			 //"<br>".count($locRes)."<br>".count($keyRes)."<br>".count($final)."<br>";
		return $final;
	}//eof
	
	
	/**
	*	Get Shipping by status only
	*
	*	@return array
	*/
	function getShippingCode($shipping_code)
	{
		 if($shipping_code != '')
		 {
		 	$sql =  "SELECT shipping_id FROM shipping WHERE shipping_code='$shipping_code'";
		 }
		 else
		 {
		 	$sql =  "SELECT shipping_id FROM shipping";
		 }
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_id;
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
	*	Search by location only
	*
	*	@param
	*			$loc	Location to search
	*
	*	@return array
	*/
	function getShippingLoc($loc)
	{
		$loc 	= mysql_escape_string($loc);
		
		if($loc == '')
		{
			$sql =  "SELECT shipping_address_id FROM shipping_address";
		}
		else
		{
			$sql =  "SELECT shipping_address_id,
					MATCH( origin_port, origin_addrress1, origin_addrress2, origin_addrress3, origin_town, origin_province, destination_port, destination_address1, destination_address2, destination_address3, destination_town, destination_province, destination_phone1, destination_mobile, origin_phone1, origin_mobile , origin_postal_code, destination_postal_code )
					AGAINST ('$loc' IN BOOLEAN MODE) AS score FROM  shipping_address
					WHERE 
					MATCH(origin_port, origin_addrress1, origin_addrress2, origin_addrress3, origin_town, origin_province, destination_port, destination_address1, destination_address2, destination_address3, destination_town, destination_province, destination_phone1, destination_mobile, origin_phone1, origin_mobile, origin_postal_code, destination_postal_code)
					AGAINST ('$loc' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_address_id;
			
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
	*	Search shipping by key word only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getShipKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT shipping_id FROM shipping";
		}
		else
		{
			$sql =  "SELECT shipping_id,
					MATCH( categories_id, container, shipping_booking, bill_lading_number, full_name, email, phone, shipping_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  shipping
					WHERE 
					MATCH( categories_id, container, shipping_booking, bill_lading_number, full_name, email, phone, shipping_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_id;
			
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
	*	Search shipping by key word only
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getShippingKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT shipping_id FROM shipping";
		}
		else
		{
			$sql =  "SELECT shipping_id,
					MATCH(container, shipping_booking, bill_lading_number, full_name, email, phone, shipping_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  shipping
					WHERE 
					MATCH(container, shipping_booking, bill_lading_number, full_name, email, phone, shipping_code)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		
		 $query = mysql_query($sql);
		 //echo $sql.mysql_error();exit;
		 $data  = array();
		 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->shipping_id;
			
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
	*	Search the Shipping
	*
	*	@param
	*			$keyword	Keyword to search
	*			$loc		Location
	*			$status		Status
	*
	*	@return array
	*/
	function searchShippingByKey($keyword)
	{
		//$codeRes	= $this->getShippingCode($shipping_code);
		//$locRes		= $this->getShippingLoc($loc);
		$keyRes		= $this->getShippingKeyword($keyword);
		
		//$final  	= array_intersect($keyRes);
		
		//$gender, $occ_id, 
		//echo count($statRes)."<br>".count($genRes)."<br>".count($occRes)."<br>".count($cntRes).
			 //"<br>".count($locRes)."<br>".count($keyRes)."<br>".count($final)."<br>";
		return $keyRes;
	}//eof
	
	
	
	/**
	*	Search product keyword
	*
	*	@param
	*			$keyword	Keyword to search
	*
	*	@return array
	*/
	function getProductKeyword($keyword)
	{
		$keyword = mysql_escape_string($keyword);
		
		if($keyword == '')
		{
			$sql =  "SELECT product_id FROM product_description";
		}
		else
		{
			$sql =  "SELECT product_id,
					MATCH(product_name, product_code, product_description)
					AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  product_description
					WHERE 
					MATCH(product_name, product_code, product_description)
					AGAINST ('$keyword' IN BOOLEAN MODE) 
					ORDER BY score DESC"; 
		}
		 $query = mysql_query($sql);
		 $data = array();
		 //echo "<p>".$sql."</p>";echo "data";
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->product_id;
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
	
	
	
	
    /////////////////////////////////////////////////////////////////////////////////////////////
	//
	//      		************* Product Search ***********************
	//
	/////////////////////////////////////////////////////////////////////////////////////////////
	
	
	/**
	*	Search the Product
	*
	*	@param
	*			$keyword			Keyword to search
	*			$categories_id		Category id
	*			
	*
	*	@return array
	*/
	function searchProdByCatAndKey($keyword, $catId)
	{
		//declare var
		$final	= array();
		
		//get result by keyword
		$keyRes		= $this->searchProd($keyword);
		
		
		//get key result category
		$catRes		= $this->getAllProdIdByCat($catId);
	
		//print_r($catRes);exit;
		if( ($catId == 0) && ($keyword == '') )
		{
			$final	= array();
		}
		else if( ($catId != 0) && ($keyword == '') )
		{
			$final  = $catRes;
		}
		else if( ($catId == 0) && ($keyword != '') )
		{
			$final 	= $keyRes;
		}
		else
		{
			$final	= array_intersect($keyRes, $catRes);
		}
	
		//return the final result
		return $final;
	}//eof
	
	
		
	/**
	*	Search a product by keyword
	*
	*	@date September 1, 2010
	*
	*	@param
	*			$keyword		Search keyword
	*
	*	@return array
	*/
	function searchProd($keyword)
	{
		
		//declare var
		$data = array();
		$keyword = mysql_escape_string($keyword);
		
		//statement
		$sql =  "SELECT product_id,
				 MATCH(product_name, product_code, product_description, product_tags, meta_description)
				 AGAINST ('$keyword' IN BOOLEAN MODE) AS score FROM  product_description
				 WHERE 
				 MATCH(product_name, product_code, product_description, product_tags, meta_description)
				 AGAINST ('$keyword' IN BOOLEAN MODE) 
				 ORDER BY score DESC"; 
			
		
		
		//execute query
		$query = mysql_query($sql);
		
		if(mysql_num_rows($query) <= 0)
		{
			//write a new statement
			$sql =  "SELECT 	product_id
					 FROM 		product_description
					 WHERE		product_name LIKE '%$keyword%'
					 OR			product_code LIKE '%$keyword%'
					 OR			product_description LIKE '%$keyword%'
					 OR			product_tags LIKE '%$keyword%'
					 OR			meta_description LIKE '%$keyword%'
					 ";
			
			//query
			$query = mysql_query($sql);
			
		}
				 
		 while($result = mysql_fetch_object($query))
		 {
			$data[] = $result->product_id;
		 }
		 
		  //echo $sql;
		 if(!$query)
		 {
			return mysql_error();
		 }
		 else
		 {
			return $data;
		 }
		 
		 
	}//END OF SEARCHING DATA BY PRODUCT
	
	
	
		
	/**
	*	Search products id by category id
	*
	*	@param	
	*			$catId		Category id
	*
	*	@return array
	*/
	
/*	function getAllProdIdByCat($catId)
	{
		$catId = mysql_escape_string((int)$catId);
		$parentCat 	= array($catId);
		$childIds  	= $this->getProdChildCat(NULL, $catId, $recursive = true);
		$allCat	   	= array_merge($parentCat,$childIds );
		//echo "Cat Res = ";print_r($allCat);echo "<br /><br />";
		$data	   	= array();
		foreach ($allCat as $k)
		{
			$select = " SELECT 	DISTINCT P.product_id AS PID
						FROM 	products P, 
								products_to_categories PC,
								categories C
						WHERE 	PC.categories_id  = C.categories_id  
						AND 	C.categories_id ='$k'";
						
			$query  = mysql_query($select);
			
			if(mysql_num_rows($query) > 0)
			{
				while($result = mysql_fetch_array($query))
				{	
					$data[] = $result['PID'];
				}
			}
		}
		
		return $data;
	}*/
	
	
	
	/**
	*	Search products id by category id
	*
	*	@param	
	*			$catId		Category id
	*
	*	@return array
	*/
	
	function getAllProdIdByCat($catId)
	{
		$data = array();
		
		$select = " SELECT product_id
					FROM products_to_categories 
					WHERE categories_id	= '$catId'";
					
		$query  = mysql_query($select);
		if(mysql_num_rows($query) > 0)
		{
			while($result = mysql_fetch_object($query))
			{	
				$data[] = $result->product_id;
			}
		}
	
		return $data;
	}
	
	
	
	/**
	*	Get All category and sub category
	*/
	function getProdChildCat($categories, $id, $recursive = true)
	{
		if ($categories == NULL) {
			$categories = $this->getProdCategories();
		}
		$id_arr = array($id);
		$n     = count($categories);
		$child = array();
		for ($i = 0; $i < $n; $i++) {
			$catId    = $categories[$i]['categories_id'];
			$parentId = $categories[$i]['parent_id'];
			if ($parentId == $id) {
				$child[] = $catId;
				if ($recursive) {
					$child   = array_merge($child, $this->getProdChildCat($categories, $catId));
				}	
			}
		}
		
		return $child;
	}
	
	function getProdCategories()
	{
		$sql = "SELECT   categories_id, parent_id
				FROM     categories
				ORDER BY categories_id, parent_id ";
		$result = mysql_query($sql);
		
		$cat = array();
		while ($row = mysql_fetch_array($result)) {
			$cat[] = $row;
		}
		
		return $cat;
	}
	
	
}//eoc 
?>