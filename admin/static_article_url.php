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


if((isset($_GET['txtTitle'])))
{
	//get the category name 
	$txtTitle 		= $_GET['txtTitle'];
	
	if(strlen($txtTitle) > 0)
	{
		//convert it into seo friendly url
		$txtTitle		= $utility->createArticleSEOURL($txtTitle, 'seo_url', 'article');
		
		echo $txtTitle;		
	}	
}
?>