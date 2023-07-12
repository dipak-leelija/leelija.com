<!--
Author: Safikul Islam
Author URL: http://webtechhelp.org
-->
<?php 
session_start();
//include_once('checkSession.php');
require_once("_config/connect.php"); 
require_once("includes/constant.inc.php");
require_once("classes/date.class.php");  
require_once("classes/error.class.php"); 
require_once("classes/search.class.php");	
require_once("classes/customer.class.php"); 
require_once("classes/login.class.php"); 

require_once("classes/products.class.php"); 
require_once("classes/blog_mst.class.php"); 
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
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

//$seo_url	= $utility->returnGetVar('seo_url','');
	
  
	if(isset($_GET['seo_url']))
		{
		 $seo_url			  		= $_GET['seo_url'];
		 //$return_url			  		= $_GET['return_url'];
		 header("location:product/".php_slug($seo_url)."");
		 //echo $seo_url;exit;
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
		}
		
$productDtl		= $product->showProducts($productId);	
$prodTypeDtls 	= $product->getProdTypeDetail($productDtl[0]);
$prodFeatured	= $product->ShowProdFtrdDtls($productDtl[26]);
?>
