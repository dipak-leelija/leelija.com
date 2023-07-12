<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/location.class.php");
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$lc		 		= new Location();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


if((isset($_GET['txtCatName'])) && (isset($_GET['txtParentId'])))
{
	//get the category name
	$txtCatName 	= $_GET['txtCatName'];
	$txtParentId 	= $_GET['txtParentId'];
	
	if((strlen($txtCatName) > 0) && ((int)($_GET['txtParentId']) >= 0))
	{
		//convert it into seo friendly url
		$txtCatName		= $utility->createSEOURL($txtCatName, $txtParentId,'categories_id','url','static_categories' );
		
		echo $txtCatName;		
	}	
}
?>