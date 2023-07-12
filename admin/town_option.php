<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
//require_once("../classes/service.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/location.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
//$service 		= new Service();
$lc		 		= new Location();
$utility		= new Utility(); 


if((isset($_GET['txtCountyId'])))
{
	$c_Id = $_GET['txtCountyId'];
	//$p_Id = $_GET['txtProvinceId'];
	$lc->genTownList($c_Id);
}
else
{
	echo "<div class='maroonError'>No option has selected</div>";
}


?>