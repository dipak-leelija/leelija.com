<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php");
require_once("../includes/email_account.inc.php");
require_once("../includes/subscriber.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
require_once("../classes/search.class.php");
require_once("../classes/email.class.php");
require_once("../classes/subscriber.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/pagination.class.php");
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer	    = new Customer();
$country		= new Countries();
$search_obj		= new Search();
$email_obj		= new Email();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$subscribe		= new EmailSubscriber();
$page			= new Pagination();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

###############################################################################################

//Total no of subscriber
$noOfCus	= $subscribe->getAllId('', '', 0, '');

//random number
$randKey	= $utility->randomkeys(5);

//generate File Name
$Code				= COMPANY_S."-".$randKey."-".date('dmY');
$fileNameCode		= $Code.".xls";	


if(count($noOfCus) > 0)
{
	//Export Data from data base to excel file
	$filename = $fileNameCode;
	
	$csv_output = '';
	
	$csv_output .=   'Sl No'. "\t"; 
	$csv_output .=  'Name'."\t";
	$csv_output .=   'E_mail Id'. "\t";
	$csv_output .=  'Date'. "\t". "\n";
	
	$i = 1;
	foreach($noOfCus as $k)
	{
		
		$cusDetail 	= $subscribe->getSubsDtl($k);
		
		
		$csv_output .=   $i++ . "\t"; 
		$csv_output .=  $cusDetail[3]." ".$cusDetail[4]."\t";
		$csv_output .=   $cusDetail[2]. "\t";
		$csv_output .=  $dateUtil->printDate($cusDetail[7]). "\t". "\n";
		
	
	}
	
	header("Content-type: application/x-msexcel");
	header("Content-disposition: attachment; filename=".$filename);
	header("Pragma: no-cache");
	header("Expires: 0");
	
	print $csv_output;
	exit; 
}
else
{
	
header("Location: email.php?msg=Sory, there is No subscriber in database.");

}

?>