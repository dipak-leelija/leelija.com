<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php");

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


if((isset($_GET['txtName'])) && (isset($_GET['txtParentId'])))
{
	$txtName 	= $_GET['txtName'];
	$txtParentId	= $_GET['txtParentId'];
	if((strlen($txtName) > 0) && ((int)($_GET['txtParentId']) >= 0))
	{
		$duplicateId	= $error->duplicateCat($txtParentId, $txtName, 0, 'album');
		if(ereg("^ER",$duplicateId))
		{
			echo "<label class='orangeLetter'>".ERIMG104."</label>";
		}
		else
		{
			echo "<label class='greenLetter'>".SUIMG105."</label>";
		}
	}
	else if((strlen($txtName) == 0) && ((int)($_GET['txtParentId']) > 0))
	{
		echo "<label class='orangeLetter'>".ERIMG102."</label>";
	}
	else if((strlen($txtName) == 0) && ((int)($_GET['txtParentId']) == 0))
	{
		echo "<label class='orangeLetter'>".ERIMG102."</label>";
	}
	
}
else
{
	echo "<label class='orangeLetter'>".ERCAT206."</label>";
}

?>