<?php

session_start();

//include_once('checkSession.php');

// require_once("_config/connect.php"); 

require_once "_config/dbconnect.php";




require_once("includes/constant.inc.php");

require_once("classes/date.class.php");  

require_once("classes/error.class.php"); 

require_once("classes/search.class.php");	

require_once("classes/customer.class.php"); 

require_once("classes/login.class.php"); 



require_once("classes/products.class.php"); 

require_once("classes/blog_mst.class.php"); 

require_once("classes/domain.class.php"); 

require_once("classes/utility.class.php"); 

require_once("classes/utilityMesg.class.php"); 

require_once("classes/utilityImage.class.php");

require_once("classes/utilityNum.class.php");



/* INSTANTIATING CLASSES */

$dateUtil      	= new DateUtil();

$error 			= new Error();

$search_obj		= new Search();

$customer		= new Customer();

$logIn			= new Login();



$product		= new Products();

$blogMst		= new BlogMst();

$domain			= new Domain();

$utility		= new Utility();

$uMesg 			= new MesgUtility();

$uImg 			= new ImageUtility();

$uNum 			= new NumUtility();

######################################################################################################################



//declare vars

$typeM			= $utility->returnGetVar('typeM','');

//$seo_url		= $utility->returnGetVar('seo_url','');



//$shipDtl		= $shipping->showShipDisplay();



$id		 		= $_GET["id"]; //product code

//echo $id;exit;

$product_qty 	= 1; //product code

// Domain Details			

$domainDtl		= $domain->showDomainsById($id);



	if ($domainDtl) { //we have the personal meeting info

		//prepare array for the session variable

		$new_domain = array(array('name'=>$domainDtl[0], 'code'=>$id, 'qty'=>$product_qty, 'price'=>$domainDtl[17]));

		

		if(isset($_SESSION["domain"])) //if we have the session

		{

			$found = false; //set found item to false

			

			foreach ($_SESSION["domain"] as $cart_itm) //loop through session array

			{

				if($cart_itm["code"] == $id){ //the item exist in array

					//echo $cart_itm['price'];

					//exit;

					

					$product1[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty,'price'=>$cart_itm["price"]);



					$found = true;

				}else{

					//echo $cart_itm['price'];

					//exit;

					//item doesn't exist in the list, just retrive old info and prepare array for session var

					

					$product1[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty,'price'=>$cart_itm["price"]);



				}

			}

			

				if($found == false) //we didn't find item in array

				{

					//add new user item in array

					$_SESSION["domain"] = array_merge($product1, $new_domain);

	

				}

				else

					{

					//found user item in array list, and increased the quantity

					$_SESSION["domain"] = $product1;

	

					}

			

		}else{

			//create a new session var if does not exist

			$_SESSION["domain"] = $new_domain;



			

			}

		

	}

	

//forward the web page

$uMesg->showSuccessT('cart', 0, '', 'viewcart.php', "Your Shoppping cart", 'CART');	

	

?>



