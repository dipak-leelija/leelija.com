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


if((isset($_GET['txtEmail'])) &&(strlen($_GET['txtEmail']) > 6))
{
	$txtEmail 	= $_GET['txtEmail'];
	$cusId		= $_GET['cusId'];
	$duplicateId	= $error->duplicateEntry($txtEmail, 'email', 'advertiser', 'yes', $cusId, 'advertiser_id');
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	if(ereg("^ER",$duplicateId))
	{
		echo "<label class='orangeLetter'>Error: email is already taken</label>";
	}
	elseif(ereg("^ER",$invalidEmail))
	{
		echo "<label class='orangeLetter'>Error: invalid email</label>";
	}
	else
	{
		echo "<label class='greenLetter'>Success !!! you can use this email</label>";
	}
}
else
{
	echo "<label class='orangeLetter'>Error: invalid email</label>";
}


?>