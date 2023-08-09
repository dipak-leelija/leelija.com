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


if((isset($_GET['txtProdName'])) && (isset($_GET['txtParentId'])))
{
	//get the category name 
	$txtProdName 		= $_GET['txtProdName'];
	$txtParentId 	= $_GET['txtParentId'];
	
	if((strlen($txtProdName) > 0) && ((int)($_GET['txtParentId']) >= 0))
	{
		//convert it into seo friendly url
		$txtProdName	= $utility->createContentSEOURL($txtProdName, $txtParentId,'categories_id','url','categories','seo_url','product_description');
														
		
		echo $txtProdName;		
	}	
}
?>