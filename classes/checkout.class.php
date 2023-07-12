<?php 
/**
*	Usable for checkout process
*
*	UPDATE October 05, 2010
*	Added generate order id section
*
*	@author		Himadri Shekhar Roy
*	@date		July 03, 2006
*	@version	1.0
*	@copyright	Analyze System
*	@url		http://www.ansysoft.com
*	@email		himadri.s.roy@ansysoft.com
* 
*/
//include_once("product.class.php");
//extends Product
class Checkout extends DatabaseConnection
{
	
	/**
	*	Add item to order while checking out
	*
	*	@return int
	*/
	function checkout_pay($ccName, $ccNumber, $conRate, $curr)
	{
		if(isset($_SESSION['userid']))
		{
			$userid	= $_SESSION['userid'];
			//echo $userid ; exit;
		}
		else
		{
			$userid	= 0;
		}
		
		//generatiing unique order number
		$timestamp 	= date("YmdHis");
		
		$order_code	= $this->generateOrderCode('ORDER');
		
				
		if((isset($_SESSION['txtShippingFirstName'])) || (isset($_SESSION['txtShippingLastName'])))
		{
			$delivery_name	= $_SESSION['txtShippingFirstName']." ".$_SESSION['txtShippingLastName'];
		}
		else
		{
			$delivery_name = '';
		}
		if((isset($_SESSION['txtPaymentFirstName'])) || (isset($_SESSION['txtPaymentLastName'])))
		{
			$billing_name	= $_SESSION['txtPaymentFirstName']." ".$_SESSION['txtPaymentLastName'];
		}
		else
		{
			$billing_name = '';
		}
		
		//echo $userid;exit;
		if(isset($_SESSION['txtShippingAddress1'])){$txtShippingAddress1	= $_SESSION['txtShippingAddress1'];} else {$txtShippingAddress1 = '';}
		if(isset($_SESSION['txtShippingAddress2'])){$txtShippingAddress2	= $_SESSION['txtShippingAddress2'];} else {$txtShippingAddress2 = '';}
		if(isset($_SESSION['txtShippingCity']))    {$txtShippingCity	= $_SESSION['txtShippingCity'];}else {$txtShippingCity = '';}
		if(isset($_SESSION['txtShippingPostalCode'])){$txtShippingPostalCode	= $_SESSION['txtShippingPostalCode'];}else {$txtShippingPostalCode = '';}
		if(isset($_SESSION['txtShippingPhone'])){$txtShippingPhone	= $_SESSION['txtShippingPhone'];}else {$txtShippingPhone = '';}
		if(isset($_SESSION['txtShippingState'])){$txtShippingState	= $_SESSION['txtShippingState'];}else {$txtShippingState = '';}
		if(isset($_SESSION['txtShippingCountryId'])){$txtShippingCountryId	= $_SESSION['txtShippingCountryId'];}else {$txtShippingCountryId = '';}
		
		if(isset($_SESSION['txtPaymentAddress1'])){$txtPaymentAddress1	= $_SESSION['txtPaymentAddress1'];}else {$txtPaymentAddress1 = '';}
		if(isset($_SESSION['txtPaymentAddress2'])){$txtPaymentAddress2	= $_SESSION['txtPaymentAddress2'];}else {$txtPaymentAddress2 = '';}
		if(isset($_SESSION['txtPaymentCity'])){$txtPaymentCity	= $_SESSION['txtPaymentCity'];}else {$txtPaymentCity = '';}
		if(isset($_SESSION['txtPaymentPostalCode'])){$txtPaymentPostalCode	= $_SESSION['txtPaymentPostalCode'];}else {$txtPaymentPostalCode = '';}
		if(isset($_SESSION['txtPaymentPhone'])){$txtPaymentPhone	= $_SESSION['txtPaymentPhone'];}else {$txtPaymentPhone = '';}
		if(isset($_SESSION['txtPaymentState'])){$txtPaymentState	= $_SESSION['txtPaymentState'];}else {$txtPaymentState = '';}
		if(isset($_SESSION['txtPaymentCountryId'])){$txtPaymentCountryId	= $_SESSION['txtPaymentCountryId'];}else {$txtPaymentCountryId = '';}
		
		//Shipping Detail
		/*if(isset($_SESSION['shippingCostId'])){$shippingCostId	= $_SESSION['shippingCostId'];}
		else
		{
			//this part is because of any one directly try to insert data without selecting any shipping method
			$selectRand = "SELECT * FROM shipping LIMIT 1";
			$queryRand	= mysql_query($selectRand);
			$resultRand = mysql_fetch_array($queryRand);
			$shippingCostId = $resultRand['shipping_id'];
		}*/
		$shippingCostId = 1;
		$shippingDtl	= $this->shippingInfo($shippingCostId);
		$shippingId		= $shippingCostId;
		$shippingCost   = $shippingDtl[0];
		$shippingMethod	= $shippingDtl[1];
		$orders_amount  = $_SESSION['ordTotal'];
		
		//INSERT INTO ORDER TABLE
		$insert1 = "INSERT INTO orders
		(customer_id, orders_amount,orders_code, delivery_name, delivery_address1, 
		delivery_address2, delivery_city, delivery_postcode, 
		delivery_phone,delivery_state, delivery_country, 
		billing_name,  billing_address1, billing_address2,
		 billing_city, billing_postcode,billing_phone ,
		billing_state, billing_country, last_modified, date_purchased,
		shipping_id, shipping_cost, shipping_method, 
		orders_status_id, orders_date_finished, payment_method_id, cc_name, cc_number, currency_conversion_rate, currency_code)
		VALUES
		('$userid', '$orders_amount','$order_code', '$delivery_name','$txtShippingAddress1', 
		'$txtShippingAddress2', '$txtShippingCity', '$txtShippingPostalCode', 
		'$txtShippingPhone','$txtShippingState', 223, 
		'$billing_name',  '$txtPaymentAddress1','$txtPaymentPhone', 
		'$txtPaymentCity', '$txtPaymentPostalCode', '$txtPaymentPhone' ,
		'$txtPaymentState', 223, now(), now(),
		'$shippingId','$shippingCost','$shippingMethod',
		 1, now(), '', '$ccName', '$ccNumber', '$conRate', '$curr')";
		
		$query1 = mysql_query($insert1);
		//echo $insert1.mysql_error();exit;
		$order_id  			= mysql_insert_id();
		//echo $order_id;exit;
		$_SESSION['ordId']	= $order_id ;
		//insert into orders_products, select the products from the customer basket, and insert them into orders product
		$select = "SELECT * FROM customer_basket WHERE customer_id = '$userid'";
		
		//execute query
		$query	= mysql_query($select);
		
		while($result = mysql_fetch_array($query))
		{
			$basket_id 	 = $result['basket_id'];
			$quant		 = (int)$result['quantity'];
			$pId		 = $result['product_id'];
			$price_f	 = $result['final_price'];
			$quantity	 = $result['quantity'];
			
			//get product detail
			$pDtl	= $this->showProduct($pId);
			$pName	= $pDtl[0];
			
			//product  price by user type
			$prodPrice		= $price_f;
/*			$prodPriceArr	= $this->getPriceByUser($pId, $_SESSION['usertypeid']);
			if((int)$prodPriceArr[1] != 0)
			{
				$prodPrice	= $prodPriceArr[1];
			}
			else
			{
				$prodPrice	= $prodPriceArr[0];
			}
			*/
			//get the tax rate
			$taxRate	= $this->getTaxRate();
			
			//calculate total tax of products
			$taxTotal	= ($price_f * ($taxRate/100));
			
			//add to order product and get the key value
			$ord_prod_id = $this->addOrdProd($order_id, $pId, '', $pName, $prodPrice, $price_f, $taxTotal, $quantity);
			
			//get the customer basket attribute to add attribute orderder prodcut
			$bAttrIds		= $this->getBasketAttIdByBasketId($basket_id);
			
			if(count($bAttrIds) > 0)
			{
				foreach($bAttrIds as $b)
				{
					//basket attribute detail
					$basketAttDtl = $this->getCusBasketAttDetail($b);
					
					//get the other columns
					$baid	= $basketAttDtl[0];
					$cus_id	= $basketAttDtl[1];
					$pid	= $basketAttDtl[2];
					$poid	= $basketAttDtl[3];
					$povid	= $basketAttDtl[4];
					
					//get option name and option value name respectively
					$prod_opt = $this->getOption($poid);
					$op_value = $this->getOptionVal($povid);
					
					//insert the option name
					$this->addOrdProdAtt($order_id,  $ord_prod_id,  $prod_opt,  $op_value, '0.0', '+');
					
				}//foreach
				
			}//eof adding attribute
			
			//delete from customer basket attribute
			$this->deleteBasket($basket_id);
			
			//delete from customer basket
			$this->deleteBasketAtt($basket_id);
			
			//update stock
			//statement
/*			$update =  "UPDATE products SET 
						product_quantity =  product_quantity - $quant,
						product_ordered  =  product_ordered + $quant
						WHERE product_id = '$pid'";
						
			//excute query
			mysql_query($update);*/
			
		
		}
		
		//return order id
		return $order_id;
		
	}//end of function
	
	/**
	*	Return the shipping information detail
	*
	*	@return array
	*/
	function shippingInfo($shipping_id)
	{
		$select		= "SELECT * FROM shipping WHERE shipping_id='$shipping_id'";
		$query		= mysql_query($select);
		$data		= array();
		if(mysql_num_rows($query) > 0)
		{
			while($result	= 	mysql_fetch_array($query))
			{
				$data	=	array(
								  $result['shipping_cost'],//0
								  $result['shipping_method']//1
								);
			}
		}	
		return $data;	
	}
	
	
	/*
		ADD VALUES TO CUSTOMER BASKET ATTRIBUTE
	*/
	function addCustBasketAttribute($basket_id, $customer_id, $product_id, $product_option_id, $product_option_value_id)
	{
		/*
			CHECK WHETHER THE BASKET ID IS ALREADY IN THE DATABASE OR NOT , IF THERE IS NO ENTRY FOUND THEN SIMPLY ADD IT,
			IF FOUND THEN UPDATE IT
		*/
		$select = "SELECT * FROM customer_basket_attributes WHERE basket_id='$basket_id'";
		$query	= mysql_query($select);
		if(mysql_num_rows($query) > 0)
		{
			$update = "UPDATE customer_basket_attributes
					  SET
					  customer_id = '$customer_id',
					  product_id  = '$product_id',
					  product_option_id = '$product_option_id',
					  product_option_value_id = '$product_option_value_id'
					  WHERE 
					  basket_id = '$basket_id'
					  ";
			$query	= mysql_query($update);
		}
		else
		{
			$insert = "INSERT INTO customer_basket_attributes
						(basket_id, customer_id, product_id, product_option_id,product_option_value_id)
						VALUES
						('$basket_id','$customer_id','$product_id','$product_option_id','$product_option_value_id')";
			$query	= mysql_query($insert);
		}
	}//END OF ADDING 
	
	
	
	/*
		RETURN THE PRODUCT OPTION FROM IT'S ID
		VARIABLE:
		OPID		:	OPTION ID
	*/
	function getOption($opid)
	{
		$select	= "SELECT product_option_name FROM products_options WHERE product_option_id='$opid'";
		$query	= mysql_query($select);
		$result = mysql_fetch_array($query);
		$data	= $result['product_option_name'];
		return $data;
	}//END OF GET OPTION
	
	/*
		RETURN THE PRODUCT OPTION VALUE IT'S ID
		VARIABLE:
		VAL_ID		:	OPTION VALUE ID
	*/
	function getOptionVal($val_id)
	{
		$select	= "SELECT product_option_value_name FROM product_option_value WHERE product_option_value_id='$val_id'";
		$query	= mysql_query($select);
		$result = mysql_fetch_array($query);
		$data	= $result['product_option_value_name'];
		return $data;
	}//END OF GET OPTION VALUE
	
	/*
	*	Deprecated
	*
		RETURN THE CUSTOMER BASKET ATTRIBUTE DETAIL FROM THE BASKET ID
		VARIABLE:
		BID		:	BASKET ID
	*/
	function getBasketAttDetail($opid)
	{
		$select	= "SELECT * FROM customer_basket_attributes CBA, product_option_value  POV
				   WHERE 
				   CBA.product_option_value_id = POV.product_option_value_id
				   AND CBA.basket_id='$opid'";
		$query	= mysql_query($select);
		$result = mysql_fetch_array($query);
		$data	= array(
						$result['basket_attribute_id'],		//0
						$result['customer_id'],				//1
						$result['product_id'],				//2
						$result['product_option_id'],		//3
						$result['product_option_value_id'],	//4
						$result['product_option_value_name']	//5
						);
		return $data;
	}//eof
	
	/*
		RETURN THE CUSTOMER BASKET ATTRIBUTE DETAIL DESCRIPTION FROM THE BASKET ID
		VARIABLE:
		BID		:	BASKET ID
	*/
	function getBasketAttDesc($opid)
	{
		$select	= "SELECT * FROM customer_basket_attributes CBA, product_option_value  POV
				   WHERE 
				   CBA.product_option_value_id = POV.product_option_value_id
				   AND basket_id='$opid'";
		$query	= mysql_query($select);
		$result = mysql_fetch_array($query);
		$data	= array(
						$result['basket_attribute_id'],		//0
						$result['customer_id'],				//1
						$result['product_id'],				//2
						$result['product_option_id'],		//3
						$result['product_option_value_id']	//4
						);
		return $data;
	}//END OF GETTING BASKET ATTRIBUTE DETAIL
	
	/*
		DELETE CUSTOMER BASKET
		variable:
		bid		:	BASKET ID
	*/
	function deleteBasket($bid)
	{
		$delete = "DELETE FROM customer_basket WHERE basket_id= '$bid'";
		$query  = mysql_query($delete);
	}// END OF DELETE CUSTOMER BASKET
	
	/**
	*	delete customer basket attribute
	*	variable:
	*	bid		:	BASKET ID
	*/
	function deleteBasketAtt($bid)
	{
		$delete = "DELETE FROM customer_basket_attributes WHERE basket_id= '$bid'";
		$query  = mysql_query($delete);
	}//eof
	
	
	/**
	*	Insert values in orders products
	*
	*	@param
	*			$orders_id			Order id
	*			$product_id			Products id
	*			$product_type		Product Type
	*			$model				Product model
	*			$name				Product name or title
	*			$price				Product price
	*			$final				Final price
	*			$tax				Tax on product
	*			$quantity			Product quantity
	*
	*	@return int
	*/
	function addOrdProd($orders_id, $product_type, $product_id, $model, $name, $price, $final, $tax, $quantity)
	{
		//declare vars
		$ord_prod_id	= 0;
		
		//statement
		$insert = "INSERT INTO orders_products 
				  (orders_id, product_type, product_id, product_model, product_name, 
				   product_price, final_price, products_tax, product_quantity)
				   VALUES
				  ('$orders_id', '$product_type', '$product_id', '$model', '$name', 
				   '$price', '$final', '$tax', '$quantity')";
		
		//execute statement
		$query	= $this->conn->query($insert);
		//echo $insert.mysql_error();exit;
		//get the id
		$ord_prod_id = $this->conn->insert_id;
		
		//return the value
		return $ord_prod_id;
		
	}//eof
	
	
	/*
	*	Insert order product attribute
	*
	*	@date	October 05, 2010
	*
	*	@param
	*			$orders_id			Customer order id
	*			$ord_p_id			Order product id
	*			$po_id				Product option id
	*			$pov_id				Product option values id
	*			$ovp				Option values price
	*			$ppf				Price prefix, + or -
	*			$po_name			Product option name (If name changes later)
	*			$pov_name			Product option value name (if product option value name changes later on)
	*
	*	@return array
	*/
	function addOrdProdAtt($orders_id, $ord_p_id, $prd_opt, $prd_opt_val, $ovp, $ppf)
	{
		//declare var
		$id		= 0;
		
		//statement
		$insert = "INSERT INTO orders_products_attributes 
				  (orders_id, orders_products_id, product_options, product_options_values, options_values_price, price_prefix)
				   VALUES
				  ('$orders_id', '$ord_p_id', '$prd_opt', '$prd_opt_val', '$ovp', '$ppf')";
		
		//execute query
		$query	= mysql_query($insert);
		//echo $insert.mysql_error(); exit;
		
		//get the key
		$id 	= mysql_insert_id();
		
		//return the key
		return $id;
		
	}//eof
	
	
	
	
	/*
	*	This funcion will return all the basket attribute id based on a basket id
	*
	*	@date	October 05, 2010
	*
	*	@param
	*			$basket_id			Customer basket id
	*
	*	@return array
	*/
	function getBasketAttIdByBasketId($basket_id)
	{
		//declare var
		$data	= array();
		
		//statement
		$select	= "SELECT 	basket_attribute_id 
				   FROM 	customer_basket_attributes
				   WHERE 	basket_id = $basket_id
				   ORDER BY basket_attribute_id ASC";
				   
		//execute query
		$query	= mysql_query($select);
		
		//fetch and hold the data
		while($result	= mysql_fetch_object($query))
		{
			$data[]	= $result->basket_attribute_id;
		}
		
		
		//return the data
		return $data;
		
	}//eof
	
	/**
	*	Get customer basket attribute detail
	*
	*	@date	October 05, 2010
	*
	*	@param
	*			$basket_attr_id			Customer basket attribute id
	*
	*	@return array
	*/
	function getCusBasketAttDetail($basket_attr_id)
	{
		//declare vars
		$data	= array();
		
		//statement
		$select	= "SELECT 	* 
				   FROM 	customer_basket_attributes CBA
				   WHERE 	CBA.basket_attribute_id='$basket_attr_id'";
				   
		//execute query
		$query	= mysql_query($select);
		
		//get teh result set
		$result = mysql_fetch_object($query);
		
		if(mysql_num_rows($query) > 0)
		{
			//check and fetch
			$data	= array(
							$result->basket_id,					//0
							$result->customer_id,				//1
							$result->product_id,				//2
							$result->product_option_id,			//3
							$result->product_option_value_id	//4
							);
		}
		
		//return the array
		return $data;
		
	}//eof
	
	
	
	
	
	################################################################################################################
	#
	#										For Orders
	#
	################################################################################################################
	
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
	
	
	/**
	*	Generate unique order code
	*	
	*	@param
	*			$prefix			Prefix to add before the code
	*
	*	@return string
	*/
	function generateOrderCode($prefix)
	{
		//declare vars
		$ordCode		= '';
		
		//get 5 char order key
		$ordKey	= $this->orderKeys(5);
		
		//get the date and time
		$dateStr	= date("dmY");
		
		//user id
		if(isset($_SESSION['userid']))
		{
			$userId	= $_SESSION['userid'];
		}
		else
		{
			$userId	= 0;
		}
		//formatted id
		$userId	= 10000 + $userId;
		
		//get the previously stored number of order
		$numOrder = $this->getLatestOrderId();
		
		//num order
		$reOrder = 1001 + $numOrder;
		
		//generate the code
		$ordCode		= $prefix.'-'.$userId.'-'.$dateStr.$ordKey.'-'.$reOrder;
		
		//return code
		return	$ordCode;
		
	}//eof
	
	
	
	
	/**
	*	Get the latest id of order
	*/
	function getLatestOrderId()
	{
		//declare vars
		$id		= 0;
		
		//statement
		$sql	= "SELECT MAX(orders_id) AS MOID FROM orders";
		
		//query
		$query	= mysql_query($sql);
		
		//get the result
		$result	= mysql_fetch_object($query);
		
		//assign the value
		$id		= $result->MOID;
		
		//return the result
		return $id;
		
	}//eof
	
	
	/**
	*	Get the tax rate
	*
	*	@return double
	*/
	function getTaxRate()
	{
		//declare var
		$taxRate	= 0.00;
		
		//statement
		$sql	= "SELECT tax_rate FROM tax_rates WHERE tax_rates_id = 1";
		
		//query
		$query	= mysql_query($sql);
		
		$result = mysql_fetch_object($query);
		
		//get the rate
		$taxRate = $result->tax_rate;
		
		//return the value
		return $taxRate;
		
	}//eof
	
	
}//eoc
?>