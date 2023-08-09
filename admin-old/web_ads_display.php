<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/order.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();

####################################################################################################################

//get all email
$allCusIds	= $utility->getAllId('customer_id', 'orders');

if((isset($_GET['selCusId'])) && (in_array($_GET['selCusId'], $allCusIds)) )
{
	$populateArr	= array('added_on');
	
	//declare var
	$populateArr	= $utility->genDropDownMulColByFK('', 'orders_id', $populateArr, 'orders_code', 'added_on', 
	                                                  'customer_id', $_GET['selCusId'],  'orders', 
								   					  'Date', '', 'OTHERS', 'OTHERS');
													  
						       /* genDropDownMulColByFK($selected, $id, $populateArr, $mainColumn, $ordByColumn, $fkName, $fkValue,  $table, 
								   $addStr, $dispPos, $addStrTo, $toHighlight)*/
}
else
{
	echo "<option value=''>-- None Found --</label>";
}

?>