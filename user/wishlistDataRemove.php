<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/blog_mst.class.php";
require_once ROOT_DIR."classes/wishList.class.php";
require_once ROOT_DIR."classes/utility.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
$blogMst		= new BlogMst();
$WishList		= new WishList();
$utility		= new Utility();
######################################################################################################################

$typeM		= $utility->returnGetVar('typeM','');

//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);


$blog_id 	= $_GET["BlogId"]; //get the Blog id to add

// echo $cusId.'-'.$blog_id;
$removeWish = $WishList->removeWish($cusId, $blog_id);

if ($removeWish == true) {
	echo "Success";echo '<br>';
	echo "The Blog Has Been Removed From Wishlist.";	
}else {
	echo "Failed";echo '<br>';
	echo "Failed to remove the Blog from Wishlist.";	
}         

?>