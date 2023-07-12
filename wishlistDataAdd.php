<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";


require_once("includes/constant.inc.php");
// require_once("classes/date.class.php");
// require_once("classes/error.class.php");
// require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/blog_mst.class.php");

require_once("classes/utility.class.php");
require_once "classes/wishList.class.php";
/* INSTANTIATING CLASSES */
// $dateUtil      	= new DateUtil();
// $error 			= new Error();
// $search_obj		= new Search();
$customer		= new Customer();
$utility		= new Utility();
$BlogMst		= new BlogMst();
$WishList		= new WishList();

######################################################################################################################

$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);


?>

<?php

	$blogId 	= $_GET["BlogId"]; //get the Blog id to add
	


		$exists = $WishList->checkWish($cusId, $blogId);
		if ($exists == false) {
			
			// Add Blog on wishlist
			$wishListed = $WishList->newWish($cusId,$blogId);
			if ($wishListed == true) {
				echo "Success!<br>";
				echo "The Blog Has Been Added To Wishlist.";
			}else {
				echo "Failed to add Wishlist.";
			}
			
		}else {
			echo "Sorry!<br>";
			echo "The Blog is already exists on your Wishlist.";
		}

	
	
	// //Display blog details
	// $blogDtl =$BlogMst->showBlog($blogId);
	// // print_r($blogDtl);
	
	// if ($blogDtl) { //we have the personal meeting info
		
	// 	//prepare array for the session variable
	// 	$New_FavList = array(array('blog_id'=>$blogId,'domain'=>$blogDtl[0], 'da'=>$blogDtl[1],'tf'=>$blogDtl[4], 'follow'=>$blogDtl[7],
	// 	'cost'=>$blogDtl[9], 
	// 	'niche'=>$blogDtl[23]));
		
	// 	if(isset($_SESSION["PersonalList"])){ //if we have the session
		
	// 		$found = false; //set found item to false
			
	// 		foreach ($_SESSION["PersonalList"] as $Add_Fav){ //loop through session array
			
	// 			// print_r($_SESSION["PersonalList"]);
	// 			if($Add_Fav["blog_id"] == $blogId){ //the item exist in array
	// 				//echo $cart_itm['price'];
	// 				//exit;
	// 				$FavList[] = array('blog_id'=>$Add_Fav['blog_id'],'domain'=>$Add_Fav['domain'], 'da'=>$Add_Fav['da'],
	// 				'tf'=>$Add_Fav['tf'], 
	// 				'follow'=>$Add_Fav['follow'],'cost'=>$Add_Fav['cost'],'niche'=>$Add_Fav['niche']);
					
	// 				$found = true;
	// 			}else{
	// 				//echo $cart_itm['price'];
	// 				//exit;
	// 				//item doesn't exist in the list, just retrive old info and prepare array for session var
	// 				$FavList[] = array('blog_id'=>$Add_Fav['blog_id'],'domain'=>$Add_Fav['domain'], 'da'=>$Add_Fav['da'],
	// 				'tf'=>$Add_Fav['tf'], 
	// 				'follow'=>$Add_Fav['follow'],'cost'=>$Add_Fav['cost'],'niche'=>$Add_Fav['niche']);
				
	// 			}
	// 		}
			
	// 		if($found == false) //we didn't find item in array
	// 		{
	// 			//add new user item in array
	// 			$_SESSION["PersonalList"] = array_merge($FavList, $New_FavList);
				
	// 		}else{
	// 			//found user item in array list, and increased the quantity
	// 			$_SESSION["PersonalList"] = $FavList;
				
	// 		}
			
	// 	}else{
	// 		//create a new session var if does not exist
	// 		$_SESSION["PersonalList"] = $New_FavList;
			
	// 	}
		
	// }
	
	
	
              
?>