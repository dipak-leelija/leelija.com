<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/registration.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/customer.class.php"); 
require_once("../classes/contact.class.php");
require_once("../classes/checkout.class.php");

 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");
require_once("../classes/utilityAuth.class.php");
require_once("../classes/utilityStr.class.php");
require_once("../classes/error.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$customer		= new Customer();
$cont2			= new Contact();
$chkOut			= new Checkout();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uAuth 			= new AuthUtility();
$uStr 			= new StrUtility();
$error 			= new Error();

////////////////////////////////////////////////////////////////////////////////////////

$typeM			= $utility->returnGetVar('typeM','');
$cus_id			= $utility->returnGetVar('cus_id','');

//customer detail
//$customerDtl	= $customer->getCustomerData($cus_id);

if(isset($_GET['chkAcc']) ) 
{
	
	if( $_GET['chkAcc'] == 'Y')
	{
		
		 //$verificationNo = $chkOut->generateOrderCode('VER');
		 $verificationNo = $customer->generateVerificationCode('VER');
		 echo $verificationNo;
	}
	else
	{
		$verificationNo ='';	
	}
	
}
/*else
{
	echo "<label class='orangeLetter'>Account is not verified</label>";
}*/

?>