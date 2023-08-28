<?php
session_start();
require_once "includes/constant.inc.php";

require_once "_config/dbconnect.php";
require_once "classes/date.class.php";  
require_once "classes/error.class.php"; 
require_once "classes/search.class.php";	
require_once "classes/customer.class.php"; 
require_once "classes/login.class.php"; 


require_once "classes/products.class.php"; 
require_once "classes/blog_mst.class.php"; 
require_once "classes/domain.class.php"; 
require_once "classes/utility.class.php"; 
require_once "classes/utilityMesg.class.php"; 
require_once "classes/utilityImage.class.php";
require_once "classes/utilityNum.class.php";



/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$customer		= new Customer();
$logIn			= new Login();
$product		= new Products();
$Domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################


//declare vars
$typeM			= $utility->returnGetVar('typeM','');

//user id
$cusId		= $utility->returnSess('userid', 0);

$cusDtl		= $customer->getCustomerData($cusId);

// print_r($_REQUEST);
// exit;
if($cusId == 0){

	echo 'LOGIN-ERR!';
	exit;
	// header("Location: index.php");

}

$id		 		= $_POST["itemId"]; //product code

$product_qty 	= 1; //product code

// Domain Details			
$domainDtl		= $Domain->showDomainsById($id);

	//we have the personal meeting info
	if ($domainDtl) {

		//prepare array for the session variable
		$new_domain = array(array('name'=>$domainDtl['domain'], 'code'=>$id, 'qty'=>$product_qty, 'price'=>$domainDtl['sprice']));

		//if we have the session
		if(isset($_SESSION["domain"])){

			$found = false; //set found item to false
 			
			//loop through session array
			foreach ($_SESSION["domain"] as $cart_itm){

				//the item exist in array
				if($cart_itm["code"] == $id){
					$product1[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty,'price'=>$cart_itm["price"]);
					$found = true;

				}else{

					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product1[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty,'price'=>$cart_itm["price"]);

				}

			}

			//we didn't find item in array
			if($found == false){
				//add new user item in array
				$_SESSION["domain"] = array_merge($product1, $new_domain);
				echo 'ADDED';

			}else{

				//found user item in array list, and increased the quantity
				$_SESSION["domain"] = $product1;
				echo 'ADDED';

			}

		}else{

			//create a new session var if does not exist
			$_SESSION["domain"] = $new_domain;
			echo 'ADDED';

		}

	}

//forward the web page
// $uMesg->showSuccessT('cart', 0, '', 'viewcart.php', "Your Shoppping cart", 'CART');	

	

?>



