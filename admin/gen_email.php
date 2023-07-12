<?php 
session_start();
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 


require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php");

/* INSTANTIATING CLASSES */

$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();



//get all email
$allCusIds	= $utility->getAllId('customer_id', 'customer');

if((isset($_GET['selCusId'])) && (in_array($_GET['selCusId'], $allCusIds)) )
{
	$selCusId		= $_GET['selCusId'];
	
	//display email
	$txtEmail	= $utility->getValueByKey( $selCusId,'customer_id','email', 'customer');
	
	echo $txtEmail;

}

?>