<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/service.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/location.class.php");
require_once("../classes/directory.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$service 		= new Service();
$lc		 		= new Location();
$utility		= new Utility();
$dir			= new Dir();

$msg = '';
//check fields
if(isset($_GET['txtAdd1']))
{
	if($_GET['txtAdd1'] == '')
	{
		$msg =  "<label class='orangeLetter'>Error: empty address 1</label>";	
	}
	else
	{
		$msg =  "<label class='greenLetter'>Success !!!</label>";
	}
}//address1
else if(isset($_GET['txtTelephone']))
{
	if(($_GET['txtTelephone'] == '') || (strlen($_GET['txtTelephone']) <= 0))
	{
		$msg =  "<label class='orangeLetter'>Error: empty telephone 1</label>";	
	}
	else
	{
		$msg =  "<label class='greenLetter'>Success !!!</label>";
	}
}//phone1

echo $msg;

?>