<?php
include_once("customer.class.php"); 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
USABLE FOR DISPLAY, EDIT, DELETE ORDER FROM THE ADMIN CONTROL PANEL.
AUTHOR 		: SAFIKUL
DATE   		: APR 15, 2019
VERSION		: 1.0
COPYRIGHT	: LeeLija
EMAIL		: safikulislamwb@gmail.com
*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////

class Order extends Customer{
	
	
	function addOrder($customer_id, $billing_name, $orders_amount, $delivery_name, $delivery_address1, $delivery_address2, $delivery_city, $delivery_postcode, $delivery_phone, $delivery_state, $delivery_country, $email, $description) {
		
		//declare var
		$id = 0;
		
		//add security
		$customer_id 			= addslashes(trim($customer_id));
		$billing_name			= addslashes(trim($billing_name));
		$orders_amount			= addslashes(trim($orders_amount));
		$delivery_name 			= addslashes(trim($delivery_name));
		$delivery_address1 		= addslashes(trim($delivery_address1));
		$delivery_address2 		= addslashes(trim($delivery_address2));
		$delivery_city			= addslashes(trim($delivery_city));
		$delivery_postcode 		= addslashes(trim($delivery_postcode));
		$delivery_phone 		= addslashes(trim($delivery_phone));
		$delivery_state 		= addslashes(trim($delivery_state));
		$delivery_country		= addslashes(trim($delivery_country));
		$email					= addslashes(trim($email));
		$description			= addslashes(trim($description));
		
		////statement
		$sql = 			"INSERT INTO orders 
						(customer_id, billing_name, orders_amount, delivery_name, delivery_address1, delivery_address2, delivery_city, delivery_postcode, delivery_phone, delivery_state, delivery_country, email, billing_address1, billing_address2, billing_city, billing_postcode, billing_phone, billing_state, billing_country, description, last_modified)
						 VALUES
						('$customer_id', '$billing_name', '$orders_amount', '$delivery_name', '$delivery_address1', '$delivery_address2', '$delivery_city', '$delivery_postcode', '$delivery_phone', '$delivery_state', '$delivery_country', '$email', '$delivery_address1', '$delivery_address2', '$delivery_city', '$delivery_postcode', '$delivery_phone', '$delivery_state', '$delivery_country', '$description', now())";
		
		//echo $sql.mysql_error();exit;
		
		//execute query
		$query	= $this->conn->query($sql); 
		//echo $query.mysql_error();exit;
		
		//get the primary key
		if($query){
			$id	= $this->conn->insert_id;
			// echo $id.$this->conn->error;
		}
		
		//return primary key
		return $id;
	}
	
	
	/**
	*	Generate unique order code
	*	
	*	@param
	*			$prefix			Prefix to add before the code
	*			$keyVal			Current order key value
	*
	*	@return string
	*/
	function generateOrderCode($prefix, $keyVal){
		//declare vars
		$ordCode		= '';
		
		//get 5 char order key
		$ordKey	= $this->orderKeys(5);
		
		//get the date and time
		$dateStr	= date("dmY");
		
		//get the previously stored number of order
		$numOrder = $keyVal;
		
		//num order
		$reOrder = 1001 + $numOrder;
		
		//generate the code
		$ordCode		= $prefix.'-'.$dateStr.$ordKey.'-'.$reOrder;//'-'.$userId.
		
		//return code
		return	$ordCode;
		
	}//eof
	
	
	
	/**
	*	Update the order table
	*
	*	@param
	*			$ordId			Order's id
	*			$ordCode		Order's code or unique value
	*			$ordAmt			Order's amount
	*
	*/
	function updateOrderCode($ordId, $ordCode, $ordAmt) 
	{
		//statement
		$update = "UPDATE orders 
				   SET 		
				  			orders_code 			= '$ordCode',
							orders_amount 			= '$ordAmt',
							date_purchased 			= now()
				   WHERE 	
				  			orders_id 				= $ordId";
		
		//execute query
		$query	= $this->conn->query($update);
		
	}//eof
	
	

	function updatePaymentStatus($paymentStatus, $ordId){

		$update = "UPDATE orders 
				   SET
				    payment_status 			= '$paymentStatus',
				    last_modified 			= now()
				   WHERE 	
				  	orders_id 				= $ordId";
		
		$query	= $this->conn->query($update);
		
	}//eof

	
	/**
	*	Update order status and make it active
	*
	*	@param
	*			$orders_id			Orders id
	*			$delivery_type		Type of product delivery
	*	@return NULL
	*/
	function acceptedOrderStatus($orders_id, $delivery_type){
		//statement
		$update = "UPDATE orders 
					SET
					delivery_type 		= '$delivery_type'
					WHERE
					orders_id 			= '$orders_id'";
		
		//execute query
		$query	= $this->conn->query($update);

		return $query;
		
	}//eof



		/**
	*	Update order status and make it active
	*
	*	@param
	*			$orders_id			Orders id
	*			$newStat			New status
	*
	*	@return NULL
	*/
	function updateOrderStatus($orders_id, $newStat){
		//statement
		$update = "UPDATE orders 
					SET
					orders_status_id 	= '$newStat'
					WHERE
					orders_id 			= '$orders_id'";
		
		//execute query
		$query	= $this->conn->query($update);

		return $query;
		
	}//eof
	
	
		
	// /**
	// *	Update transaction id
	// *
	// *	@param
	// *			$orders_id			Orders id
	// *			$trxn_id			Transaction id from PayPal
	// *
	// *	@return NULL
	// */
	// function updateOrderTrxnId($orders_id, $trxn_id)
	// {
	// 	//statement
	// 	$update = "UPDATE order
	// 			   SET 
	// 			   			trxn_id = '$trxn_id' 
	// 			   WHERE 
	// 						orders_id = $orders_id";
		
	// 	//execute query
	// 	$query	= $this->conn->query($update);
		
	// }//eof
	
	
	/**
	*	Retrive  from the order landing table
	*
	*	@param
	*			$id			order landing id or primary key
	*			
	*	@return array
	*/
	function getOrderLandingData($id)
	{
		//declare
		$data	= array();
		
		$select		= "SELECT 	* 
					   FROM 	orders 
					   WHERE 	orders_id = $id";
		
		//execute query
		$query		= $this->conn->query($select);
		
		if($query->num_rows > 0)
		{
			//fetch data
			$result = $query->fetch_object();
			// print_r($result); exit;
			//hold the data in array
			$data = array(
								  $result->customer_id,						//0
								  $result->orders_amount,					//1
								  $result->orders_code,						//2
								  $result->delivery_name,					//3
								  $result->delivery_address1,				//4
								  $result->delivery_address2,				//5
								  $result->delivery_city,					//6
								  $result->delivery_postcode,				//7
								  $result->delivery_phone,					//8
								  $result->delivery_state,					//9			
								  
								  $result->delivery_country,				//10	
								  
								  $result->date_purchased,					//11	
								  $result->last_modified,					//12	
								  $result->orders_status_id,				//13	
								  $result->orders_date_finished,			//14
								  $result->email,							//15
								  $result->description,						//16
								  $result->company_name,					//17
								  $result->trxn_id							//18		
						 );
		
		}
		
	  	//return the data
	  	return $data;
		
	}//eof	
	
	
	
	
	
	
	/**
	*	Generate random seed for order
	*	
	*	@param
	*			$length			Length of the key
	*			
	*	@return string
	*/
	function orderKeys($length)
    {
		$key = '';
		$pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i=0;$i<$length;$i++)
		{
		   $key .= $pattern[rand(0,35)];
		}
    
		//return key
		return $key;
   
    }//eof
	
	/*
		DISPLAY ORDER CODE, DEPENDING ON THE USER, AND STATUS OF THE ORDER
		VARIABLE:
		USERID			:	USER IDENTITY
		STATUS			:	STATUS CODE FOR THE ORDER
	*/
	function getOrderCode($user_id, $status){
		if(($user_id == 'all') &&($status == 'all')){

			$sql	= "SELECT * FROM orders";

		}elseif(($user_id == 'all') &&((int)$status > 0)){

			$sql	= "SELECT * FROM orders WHERE orders_status_id = '$status'";

		}elseif(((int)$user_id > 0) &&((int)$status > 0)){

			$sql	= "SELECT * FROM orders WHERE orders_status_id = '$status' AND customer_id='$user_id'";

		}elseif(((int)$user_id > 0) &&($status == 'all')){

			$sql	= "SELECT * FROM orders WHERE customer_id='$user_id'";

		}else{

			$sql	= "SELECT * FROM orders";

		}
		
		$query	= $this->conn->query($sql);
		$data	= array();
		
		while($result = $query->fetch_array())
		{
			$data[]	= $result['orders_code'];
		}
		return $data;
		
	}//GET ORDER CODE
	


	/*
		GET DETAILS OF ALL ORDER
	*/
	function getAllOrderDetails(){

		$sql = "SELECT * FROM orders, orders_products WHERE orders.orders_id = orders_products.orders_id";
		$query	= $this->conn->query($sql);
		$rows	= $query->num_rows;
		if($rows > 0){
			while ($result = $query->fetch_assoc()) {
				$data[] = $result;
			}
			return $data;
		}else{
			return array();
		}


	}//end of function getAllOrderDetails



		/*
		GET DETAILS OF ALL ORDER
	*/
	function getFullOrderDetailsById($ordId){

		$sql	= "SELECT * FROM orders, orders_products 
					WHERE orders.orders_id = orders_products.orders_id AND orders.orders_id = $ordId;
					";

	$query	= $this->conn->query($sql);
	$rows	= $query->num_rows;
	if($rows > 0){
		while ($result = $query->fetch_array()) {
			$data[] = $result;
		}
		return $data[0];
	}else{
		return 0;
	}


}//end of function getAllOrderDetails
 

	// function allSoldProducts(){

	// 	$sql	= "SELECT * FROM orders, orders_products 
	// 				WHERE orders.orders_id = orders_products.orders_id
	// 				";
	// 	// echo $res.$this->conn->error;exit;

	// 	$query	= $this->conn->query($sql);
	// 	$rows	= $query->num_rows;
	// 	if($rows > 0){
	// 		while ($result = $query->fetch_array()) {
	// 			$data[] = $result;
	// 		}
	// 		return $data;
	// 	}else{
	// 		return 0;
	// 	}

	// }//end of function getAllOrderDetails



	/*
		GET DETAIL OF AN ORDER, DEPENDING EITHER UPON IT'S ID OR CODE
		VARIABLE:
		CODE		:	IF IT'S THE CODE OF THE TRANSACTION
		ID			:	PRIMARY KEY OF THE TRANSACTION
		
		NOTE: 	USER NEEDS TO PASS EITHER OF THIS VARIABLE, IF THE CODE IS PASSED THEN PUT ID AS ZERO (0) OTHERWISE PUT
				CODE VALUE
	*/
	function getOrderDetail($code, $id){

		if($code != '' && $id == 0){
			$sql	= "SELECT * FROM orders, orders_status 
						WHERE  orders_code = '$code' 
						AND orders.orders_status_id = orders_status.orders_status_id
						";
		}elseif($code == '' && $id > 0){

			$sql	= "SELECT * FROM orders, orders_status 
					   WHERE  orders_id = '$id'
					   AND orders.orders_status_id = orders_status.orders_status_id
					   ";
		}else{

			$sql	= "SELECT * FROM orders, orders_status 
						WHERE  orders_code = '$code' 
						AND orders.orders_status_id = orders_status.orders_status_id
						";
		}
		// echo $sql.$this->conn->error;exit;
		$query	= $this->conn->query($sql);
		$rows	= $query->num_rows;
		if($rows > 0)
		{
			$result = $query->fetch_array();
			
			$data	= array(
						$result['orders_id'],					//0
						$result['customer_id'],					//1
						$result['orders_code'],					//2
						$result['delivery_name'],				//3
						$result['delivery_address1'],			//4
						$result['delivery_address2'],			//5
						$result['delivery_city'],				//6
						$result['delivery_postcode'],			//7
						$result['delivery_phone'],				//8
						$result['delivery_state'],				//9
						$result['delivery_country'],			//10
						$result['billing_name'],				//11
						$result['billing_address1'],			//12
						$result['billing_address2'],			//13
						$result['billing_city'],				//14
						$result['billing_postcode'],			//15
						$result['billing_phone'],				//16
						$result['billing_state'],				//17
						$result['billing_country'],				//18
						$result['last_modified'],				//19
						$result['date_purchased'],				//20
						$result['orders_status_id'],			//21
						$result['orders_date_finished'],		//22
						$result['orders_status_name'],			//23
						$result['shipping_id'],					//24
						$result['shipping_cost'],				//25
						$result['shipping_method'],				//26
						$result['orders_amount'],				//27
						
						$result['email'],						//28		Added On - August 09, 2010
						$result['description'],					//29
						$result['orders_amount'],				//30
						$result['date_purchased'],				//31

						$result['delivery_type']				//32
						
						);//END OF ARRAY
			
			return $data;
		}
	}//end of function get order detail
	
	/*
		RETURN THE ORDER PRODUCT ID, ASSOCIATED WITH AN ORDER, EITHER DEPENDING ON ORDER CODE OR ID
		TYPE		:	TYPE DETERMINE WHETHER ITS A ORDER_CODE OR ORDER_ID
		VALUE		:	VALUE ASSOCIATED WITH THE KEY OR ID
	*/
	function getOrdProdId($type, $value)
	{
		if($type == 'order_code')
		{
			$ordDetail	= $this->getOrderDetail($value, 0);
			$id			= $ordDetail[0];
			
		}
		else
		{
			$id			= $value;
		}
		$select = "SELECT orders_products_id FROM orders_products WHERE orders_id = $id";
		$query	= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		$data	= array();
		
		while($result = $query->fetch_array())
		{
			$data[]	= $result['orders_products_id'];
		}
		
		return $data;
		
	}//end of fumction egtting ord product
	
	
	
	
	
	/*
	*	Get  orders_products_attributes_id from orders_products_attributes
	*
	*/
	function getOrdProdAtrbId($rpId){
		
		$select = "SELECT orders_products_attributes_id FROM orders_products_attributes WHERE orders_products_id = $rpId";
		$query	= $this->conn->query($select);
		//echo $select.mysql_error();exit;
		$data	= array();
		
		while($result = $this->conn->fetch_array($query)){
			$data[]	= $result['orders_products_attributes_id'];
		}
		
		return $data;
		
	}//end of fumction egtting ord product
	
	
	
	/*
	*	Get  all product id from orders_products_attributes
	*
	*/
	// function getOrdProdIdByOrdId($ordId)
	// {
		
	// 	$select = "SELECT products_id FROM orders_products WHERE orders_id = $ordId";
	// 	$query	= $this->conn->query($select);
	// 	//echo $select.mysql_error();exit;
	// 	$data	= array();
		
	// 	while($result = $this->conn->fetch_array($query))
	// 	{
	// 		$data[]	= $result['products_id'];
	// 	}
		
	// 	return $data;
		
	// }//end of fumction egtting ord product
	
	function getOrdProdIdByOrdIdProdId($ordId, $prodId)
	{
		
		$select = "SELECT orders_products_id FROM orders_products WHERE orders_id = $ordId AND product_id = '$prodId'";
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		$data	= array();
		
		while($result = mysql_fetch_array($query))
		{
			$data[]	= $result['orders_products_id'];
		}
		
		return $data;
		
	}
	
	/*
	*	Get  all product id from orders_products_attributes
	*
	*/
	function getOrdProdIdByOrdId($ordId){
		
		$data	= array();
		$select = "SELECT orders_products_id FROM orders_products WHERE orders_id = $ordId";
		$query	= $this->conn->query($select);
		while($result = $query->fetch_array()){

			$data[]	= $result['orders_products_id'];

		}
		
		return $data;
		
	}
	
	
	// /*
	// 	RETURN THE ORDER PRODUCT DETAIL, ASSOCIATED WITH AN ORDER PRODUCT ID
	// */
	// // function getOrdProdDetail($id)
	// // {
	// // 	$sql	= "SELECT * FROM orders_products, orders_products_attributes
	// // 				WHERE  
	// // 				orders_products.orders_products_id = orders_products_attributes.orders_products_id
	// // 				AND orders_products.orders_products_id = '$id'";
	// // 	$query	= mysql_query($sql);
	// // 	//echo $sql.mysql_error();exit;
	// // 	$data	= array();
	// // 	$result = mysql_fetch_array($query);
		
	// // 	$data	= array(
	// // 				$result['orders_id'],					//0
	// // 				$result['product_id'],					//1
	// // 				$result['product_name'],				//2
	// // 				$result['final_price'],				    //3
	// // 				$result['product_quantity'],		    //4
	// // 				$result['product_options'], 		    //5
	// // 				$result['product_options_values']	    //6
	// // 				);//END OF ARRAY
		
	// // 	return $data;
	// // }//END OF ORD PROD DTL
	
	/*
		RETURN THE ORDER PRODUCT DETAIL, ASSOCIATED WITH AN ORDER PRODUCT ID
	*/
	function showOrdProdDetail($id){
		
		$data	= array();
		$sql	= "SELECT * FROM orders_products
					WHERE  
					orders_products_id = '$id'";
		$query	= $this->conn->query($sql);
		$result = $this->conn->fetch_array($query);
		
		$data	= array(
					$result['orders_id'],					//0
					$result['product_id'],					//1
					$result['product_name'],				//2
					$result['final_price'],				    //3
					$result['product_quantity'],		    //4
					//$result['product_options'], 		    //5
					//$result['product_options_values']	    //6
					);//END OF ARRAY
		
		return $data;
	}//END OF ORD PROD DTL
	
	
	/*
	*	RETURN THE ORDER PRODUCT DETAIL, ASSOCIATED WITH AN ORDER PRODUCT ID
	*/
	function getOrdProdDetail1($id)
	{
		$sql	= "SELECT * FROM orders_products
				   WHERE  
				   orders_products_id = '$id'";
		$query	= $this->conn->query($sql);
		//echo $sql.mysql_error();exit;
		$data	= array();
		
			$result = $query->fetch_array();
			$data	= array(
						$result['orders_products_id'],			//0
						$result['orders_id'],					//1
						$result['product_id'],					//2
						$result['product_model'],				//3
						$result['product_name'],				//4
						$result['product_price'],				//5
						$result['final_price'],				    //6
						$result['products_tax'],				//7
						$result['product_quantity']			    //8
						);//END OF ARRAY

		return $data;
	}//END OF
	
	



	function getOrdDtlsByOrdId($id){
		
		$data	= array();
		$select = "SELECT * FROM orders_products WHERE orders_id = $id";
		$query	= $this->conn->query($select);
		while($result = $query->fetch_array()){

			$data	= $result;
		
		}
		return $data;
		
	}//end of fumction egtting ord product




	
	/*
	*	RETURN THE ORDER PRODUCT ATTRIBUTE DETAIL, ASSOCIATED WITH AN ORDER PRODUCT ATTRIBUTE ID
	*	@date 20th December, 2012
	*	@author Mousumi Dey
	*/
	function getOrdProdAtributeDetail($id)
	{
		//statement
		$sql	= "SELECT * FROM  orders_products_attributes
					WHERE  
					orders_products_attributes_id = '$id'";
		//execute the query			
		$query	= mysql_query($sql);
		
		$data	= array();
		
		$result = mysql_fetch_array($query);
		
		$data	= array(
					$result['orders_id'],					//0
					$result['orders_products_id'],			//1
					$result['product_options'],				//2
					$result['product_options_values'],		//3
					$result['options_values_price'],		//4
					$result['price_prefix']					//5
					);//END OF ARRAY
		
		return $data;
	}//END OF ORD PROD DTL
	
	
	// /*
	// 	GET THE PRODUCT OPTION 
	// 	VARIABLE:
	// 	$orders_products_id		:	order product id
	// */
	// function getOption($orders_products_id)
	// {
	// 	$select = "SELECT product_options FROM orders_products_attributes WHERE orders_products_id='$orders_products_id'";
	// 	$query	= mysql_query($select);
	// 	$data 	= array();
	// 	while($result = mysql_fetch_array($query))
	// 	{
	// 		$data[]		= $result['product_options'];
	// 	}
	// 	return $data;
	// }//END OF 
	
	/*
		GET THE PRODUCT OPTION  VALUE
		VARIABLE:
		$prod_opt		:	product option
		
		$ord_prod_id	:   order product id
	*/
	// function getOptionValues($prod_opt, $ord_prod_id)
	// {
	// 	$select = "SELECT product_options_values FROM orders_products_attributes WHERE product_options='$prod_opt' AND orders_products_id='$ord_prod_id'";
	// 	$query	= mysql_query($select);
	// 	$data 	= array();
	// 	while($result = mysql_fetch_array($query))
	// 	{
	// 		$data[]		= $result['product_options_values'];
	// 	}
	// 	return $data;
	// }//END OF 
	
	
	/*
		GET THE PRODUCT OPTION  VALUE
		VARIABLE:
		$prod_opt		:	product option
		
		$ord_prod_id	:   order product id
	*/
	function getProductIdsByOrdId($orders_id)
	{
		//statement
		$select = "SELECT product_id FROM orders_products WHERE orders_id='$orders_id' ORDER BY product_quantity DESC";
		//execute the query
		$query	= mysql_query($select);
		//array
		$data 	= array();
		while($result = mysql_fetch_array($query))
		{
			$data[]		= $result['product_id'];
		}
		return $data;
	}//END OF 
	
	
	
	/*
		GET THE Order Id By Status
		VARIABLE:
		$statId		:	status id
		
		$limit		:   product limit
		@author 		Mousumi Dey
	*/
	// function getOrderIdsByStatusIdAndLimit($statId , $limit)
	// {
	// 	//statement
	// 	$select = "SELECT orders_id FROM orders WHERE orders_status_id='$statId' LIMIT ".$limit;
	// 	//execute the query
	// 	$query	= mysql_query($select);
	// 	//array
	// 	$data 	= array();
		
	// 	while($result = mysql_fetch_array($query))
	// 	{
	// 		$data[]		= $result['orders_id'];
	// 	}
	// 	//return data
	// 	return $data;
	// }//END OF 
	
	
	
	/*
		GET THE Order Id By Status
		VARIABLE:
		$statId		:	status id
		
		$limit		:   product limit
		@author 		Mousumi Dey
	*/
	// function getOrderIdsByStatusId($statId)
	// {
	// 	//statement
	// 	$select = "SELECT orders_id FROM orders WHERE orders_status_id='$statId'";
	// 	//execute the query
	// 	$query	= mysql_query($select);
	// 	//array
	// 	$data 	= array();
		
	// 	while($result = mysql_fetch_array($query))
	// 	{
	// 		$data[]		= $result['orders_id'];
	// 	}
	// 	//return data
	// 	return $data;
	// }//END OF 
	
	
	
	/**
	*	Get best seller product  
	*	
	*	@date 	17th December, 2012
	*
	*	@author Mousumi Dey
	*/
	// function getProductBySell($limit)
	// {
		
	// 	$data = array();
	// 	//statement
	// 	$select	= "SELECT 	OP.product_id AS OPRODID
	// 			   FROM   	orders_products OP, orders O
	// 			   WHERE  	OP.orders_id = O.orders_id
	// 			   AND    	O.orders_status_id = 6 
				   
	// 			   GROUP BY OPRODID
	// 			   ORDER BY COUNT(OPRODID) DESC
	// 			   LIMIT	$limit
	// 			  ";
	// 	//echo $select;
	
	// 	//execute the query
	// 	$query	= mysql_query($select);
		
	// 	//echo $select.mysql_error(); exit;
		
	// 	while($result	= mysql_fetch_array($query))
	// 	{
	// 		$data[]	= $result['OPRODID'];
	// 	}
	// 	//print_r($data);exit;
	// 	//return data
	// 	return $data;
		
	// }//eof
	
	/*
	*	Get order id  by customer id
	*	Variable:
	*
	*	$cus_id:	Id of the customer
	*
	*/
	
	function getOrdersIdsByCusId($cus_id)
	{
		$data = array();
		//statement
		$select = "SELECT orders_id from orders WHERE customer_id='$cus_id'";
		
		//execute the query
		$query	= mysql_query($select);
		//echo $select.mysql_error();exit;
		
		while($result = mysql_fetch_array($query))
		{
			$data[]		= $result['orders_id'];
		}
		//return data
		return $data;
	}//eof





	function getOrdersByCusId($cus_id){
		$data = array();
		$select = "SELECT * from orders WHERE customer_id='$cus_id'";
		$query	= $this->conn->query($select);
		while($result = $query->fetch_array()){

			$data[]		= $result;

		}
		return $data;
	}//eof

	
	
	
	
	
	/*
	*	Get best seller product  Quantity 
	*	
	*	@date 	19th December, 2012
	*
	*	@author Mousumi Dey
	*/
	// function getQtyByProdId($prdId)
	// {
		
	// 	$data = '';
		
	// 	//statement
	// 	$select1	= "SELECT SUM(product_quantity) as PQ FROM orders_products as p WHERE p.product_id = '$prdId' AND
	// 				   p.orders_id IN (SELECT r.orders_id FROM orders as r WHERE orders_status_id = 6)";
		
	// 	//execute the query
	// 	$query	= mysql_query($select1);
		
	// 	//result
	// 	$result = mysql_fetch_object($query);
		
	// 	//echo $select1.mysql_error(); exit;
	// 	//hold the value
	// 	$data	= $result->PQ;
		
	// 	//return data
	// 	return $data;
		
	// }//eof
	
	
	
	
	
	
	
	
	
	/*
		GET THE CUSTOMER NOTIFICATIONS ID
		VARIABLE		:
		ORDERID			:	ORDER ID
	*/
	// function getNotifyId($order_id)
	// {
	// 	$select = "SELECT * FROM orders_comments WHERE orders_id='$order_id'";
	// 	$query	= $this->conn->query($select);
	// 	$data 	= array();
	// 	while($result = $query->fetch_array())
	// 	{
	// 		$data[]		= $result['orders_comments_id'];
	// 	}
	// 	return $data;
	// }//END OF GETTING NOTIFY DATA
	
	/*	
		RETURN NOTIFY DETAIL
		VARIBALE:
		ID			:	NOTIFY ID
	*/
	// function getNotifyDetail($id)
	// {
	// 	$select = "SELECT * FROM orders_comments, orders_status
	// 			  WHERE
	// 			  orders_comments.orders_status_id = orders_status.orders_status_id
	// 			  AND orders_comments_id='$id'";
	// 	$query	= mysql_query($select);
		
	// 	$data 	= array();
	// 	$result = mysql_fetch_array($query);
	// 	$data	= array(
	// 					$result['customer_notify'],			//0
	// 					$result['orders_status_id'],		//1
	// 					$result['date_commented'],			//2
	// 					$result['comments'],				//3
	// 					$result['orders_status_name']		//4
	// 					);
	// 	return $data;
	// }//END OF GETTING DATA
	
	/*
		INSERT INTO NOTIFY TABLE
		VARIABLE:
		
	*/
	// function insertNotify($orders_id, $customer_notify, $orders_status_id, $comments)
	// {
	// 	//update order table
	// 	$update	= "UPDATE orders SET orders_status_id='$orders_status_id' WHERE orders_id='$orders_id'";
	// 	mysql_query($update);
		
	// 	$insert ="INSERT INTO orders_comments
	// 			(orders_id, customer_notify,orders_status_id,date_commented,comments) 
	// 			 VALUES
	// 			('$orders_id','$customer_notify','$orders_status_id',now(),'$comments')";
	// 	$query =mysql_query($insert);
	// }
	
	/*
		DELETE THE ORDER, ALONG WITH THE ALL OTHER ASSOCIATED ENTRY IN THE DATABASE WILL BE DELETING
		VARIABLE:
		ORDERID			:	ORDER ID
	*/
	// function deleteOrder($orderId)
	// {
	// 	$deleteOrderProdAtt	= "DELETE FROM orders_products_attributes WHERE orders_id = '$orderId'";
	// 	mysql_query($deleteOrderProdAtt);
		
	// 	$deleteOrderProd	= "DELETE FROM orders_products WHERE orders_id = '$orderId'";
	// 	mysql_query($deleteOrderProd);
		
	// 	//DELETE FROM COMMENTS TABLE
	// 	$deleteComments	= "DELETE FROM orders_comments WHERE orders_id = '$orderId'";
	// 	mysql_query($deleteComments);
		
	// 	$delCusOrder = "DELETE FROM orders WHERE orders_id = '$orderId'";
	// 	mysql_query($delCusOrder);
		
	// }//END OF DELETING ORDER
	
	
	// function getAllOrderId()
	// {
	// 	$select = "SELECT orders_id 
	// 			   FROM orders 
	// 			   ORDER BY orders_id DESC";
	// 	$query	= mysql_query($select);
	// 	//echo $select.mysql_error();exit;
	// 	$data	= array();
		
	// 	while($result = mysql_fetch_array($query))
	// 	{
	// 		$data[]	= $result['orders_id'];
	// 	}
		
	// 	return $data;
		
	// }


################################################################################################################################
#																															   #
#													order_products_delivery													   #
#																															   #
################################################################################################################################


function allDeliveryType(){

	$data = array();
	$sql = "SELECT * FROM delivery_type";
	$query = $this->conn->query($sql);
	if ($query->num_rows > 0) {
		while ($result = $query->fetch_array()) {
			$data[] = $result;
		}
	}
	return $data;

}



	
function addSelfIntegration($orders_id, $order_status_id, $domain_provider, $domain_email, $updated_by) {
		
	//add security
	$orders_id 			= addslashes(trim($orders_id));
	$order_status_id	= addslashes(trim($order_status_id));
	$domain_provider 	= addslashes(trim($domain_provider));
	$domain_email 		= addslashes(trim($domain_email));
	$updated_by 		= addslashes(trim($updated_by));

	
	$sql = 			"INSERT INTO order_products_delivery 
					(orders_id, order_status_id, domain_provider, domain_email, updated_by, updated_on)
					 VALUES
					('$orders_id', '$order_status_id', '$domain_provider', '$domain_email', '$updated_by', now())";
	
	//echo $sql.mysql_error();exit;
	
	$query	= $this->conn->query($sql); 
	
	//return primary key
	return $query;
}



	
function updateSelfIntegration($orders_id, $order_status_id, $domain_provider, $domain_email, $updated_by) {
		
	//add security
	$orders_id 			= addslashes(trim($orders_id));
	$order_status_id	= addslashes(trim($order_status_id));
	$domain_provider 	= addslashes(trim($domain_provider));
	$domain_email 		= addslashes(trim($domain_email));
	$updated_by 		= addslashes(trim($updated_by));

	
	$sql = 			"UPDATE order_products_delivery 
					SET
					order_status_id		= '$order_status_id',
					domain_provider		= '$domain_provider',
					domain_email		= '$domain_email',
					updated_by			= '$updated_by',
					updated_on			= now()
					WHERE
					orders_id			= '$orders_id'";
	
	//echo $sql.mysql_error();exit;
	
	$query	= $this->conn->query($sql); 
	
	//return primary key
	return $query;
}





function updateData($orders_id, $domainCode, $fileLink, $dbLink, $dbName, $dbUser, $dbPass, $waitingTime, $updated_by) {
		
	//add security
	$domainCode 	= addslashes(trim($domainCode));
	$fileLink 		= addslashes(trim($fileLink));
	$dbLink 		= addslashes(trim($dbLink));

	$dbName = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $dbName)));
	$dbUser = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $dbUser)));
	$dbPass = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $dbPass)));

	
	$sql = 			"UPDATE order_products_delivery 
					SET
					`domain_authorizatrion_code` = '$domainCode',
					`website_file_link`			 = '$fileLink',
					`db_drive_link`				 = '$dbLink',
					`db_name`					 = '$dbName',
					`db_user`					 = '$dbUser',
					`db_pass`					 = '$dbPass',
					`waiting_time`				 = '$waitingTime',
					`updated_by`				 = '$updated_by',
					`updated_on`				 = now()
					WHERE
					`orders_id`		= '$orders_id'";
	
	//echo $sql.mysql_error();exit;
	
	$query	= $this->conn->query($sql); 
	
	//return primary key
	return $query;
}//eof







function updateSingleData($orders_id, $col, $data, $updated_by) {
		
	//add security
	$data 			= addslashes(trim($data));
	$updated_by 	= addslashes(trim($updated_by));

	$sql = 			"UPDATE order_products_delivery 
					SET
					$col			= '$data',
					updated_by		= '$updated_by',
					updated_on		= now()
					WHERE
					orders_id		= '$orders_id'";
	
	//echo $sql.mysql_error();exit;
	
	$query	= $this->conn->query($sql); 
	
	//return primary key
	return $query;
}//eof




function deliveryDtlsByOrdId($order_id){

	$data = array();
	$sql = "SELECT * FROM order_products_delivery WHERE orders_id = '$order_id'";
	$query = $this->conn->query($sql);
	if ($query->num_rows > 0) {
		while ($result = $query->fetch_object()) {
			$data = (array)$result;
		}
	}
	return $data;

}




	
}
?>