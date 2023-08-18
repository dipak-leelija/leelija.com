<?php

session_start();
require_once 'includes/constant.inc.php';
require_once("_config/dbconnect.php");

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





//empty cart by distroying current session

if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)

{

	session_destroy();

	header('Location: domains.php');

}



//update items of shopping cart

if(isset($_GET["update_qid"]) && ($_GET["qty"]) && isset($_SESSION["product"]))

{

	$product_id 	= $_GET["update_qid"]; //get the product code to update

	$qty 	= $_GET["qty"]; //get quantity

	//$catDtl=$category->categoryData($categories_id, 'categories');

	echo $qty;

	exit;

	foreach ($_SESSION["product"] as $cart_itm) //loop through session array var

	{

		if($cart_itm["qty"]!=$qty){ //item does,t exist in the list

			$product1 = array(array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"],'qty'=>$cart_itm['qty'], 'price'=>$cart_itm["price"]));

		}

		

		//create a new product list for cart

		$_SESSION["product"] = $product1;

	}

	

	//redirect back to original page

		header('Location: viewcart.php');



	//header('Location: product_categories.php?seo_url='.$catDtl[10]);

}





if(isset($_GET["removep"]) && isset($_SESSION["domain"]))

{

	$id 	= $_GET["removep"]; //get the product code to remove

	foreach ($_SESSION["domain"] as $cart_itm) //loop through session array var

	{

		if($cart_itm["code"]!=$id){ //item does,t exist in the list

			

			$product1[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"],'qty'=>$cart_itm['qty'], 'price'=>$cart_itm["price"]);

			

		}

		//create a new product list for cart

		$_SESSION["domain"] = $product1;

	}

	//redirect back to original page

	header('Location: viewcart.php');

}









?>