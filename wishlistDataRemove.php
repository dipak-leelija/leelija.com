<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
// require_once("_config/db_connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
// require_once("classes/date.class.php");
// require_once("classes/error.class.php");
// require_once("classes/search.class.php");
require_once("classes/customer.class.php");
// require_once("classes/login.class.php");
// require_once("classes/blog_mst.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once "classes/wishList.class.php";
require_once("classes/utility.class.php");
// require_once("classes/utilityMesg.class.php");
// require_once("classes/utilityImage.class.php");
// require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
// $dateUtil      	= new DateUtil();
// $error 			= new Error();
// $search_obj		= new Search();
$customer		= new Customer();
// $logIn			= new Login();
// $blogMst		= new BlogMst();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$WishList		= new WishList();
$utility		= new Utility();
// $uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);


?>

<?php

	$blog_id 	= $_GET["BlogId"]; //get the Blog id to add
	
	// $deleted = $blogMst->delBlogFavList($cusId, $blog_id);

	// echo $cusId.'-'.$blog_id;
	$removeWish = $WishList->removeWish($cusId, $blog_id);
	// removeWish($user,$blog)
	

	// foreach ($_SESSION["PersonalList"] as $Add_Fav) //loop through session array var
	// {
	// 	if($Add_Fav["blog_id"]!=$blog_id){ //item does,t exist in the list
	// 		$FavList[] = array('blog_id'=>$Add_Fav['blog_id'],'domain'=>$Add_Fav['domain'], 'da'=>$Add_Fav['da'],
	// 				'tf'=>$Add_Fav['tf'], 
	// 				'follow'=>$Add_Fav['follow'],'cost'=>$Add_Fav['cost'],'niche'=>$Add_Fav['niche']);
	// 	}
		
	// 	//create a new product list for cart
	// 	$_SESSION["PersonalList"] = $FavList;
		
	// }
	// echo var_dump($removeWish);
	if ($removeWish == true) {
		echo "Success";echo '<br>';
		echo "The Blog Has Been Removed From Wishlist.";	
	}else {
		echo "Failed";echo '<br>';
		echo "Failed to remove the Blog from Wishlist.";	
	}
	
              
?>