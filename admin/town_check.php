<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/location.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$lc		 		= new Location();
$utility		= new Utility();


if((isset($_GET['txtAltTown'])) &&(strlen($_GET['txtAltTown']) > 0))
{
	if((isset($_GET['txtProvinceId'])) &&(((int)$_GET['txtProvinceId']) > 0))
	{
		echo $lc->duplicateLoc(trim($_GET['txtProvinceId']), 'province_id', trim($_GET['txtAltTown']), 'town_name', 'town', 'town');
	}
}
else if((isset($_GET['txtAltTown'])) &&(strlen($_GET['txtAltTown']) == 0))
{
	if((isset($_GET['txtProvinceId'])) &&(((int)$_GET['txtProvinceId']) > 0))
	{
		echo "<label class='orangeLetter' for='Error'>Error: empty town. either select a town from the list
		     or enter your own town name.</label>";
	}
}

?>