<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/review.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 

require_once("../classes/review.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$review			= new Review();

$utility		= new Utility();
$uMesg 			= new MesgUtility();

############################################################################################

//get all the content id
$allContentIds	= $utility->getAllId('static_id', 'static');

if((isset($_GET['selContent'])) && (in_array($_GET['selContent'], $allContentIds)) )
{
	$contentId	 	= $_GET['selContent'];
	
	//display the dropdown list
	$allRevIds  = $review->getAllReviewIdByTypeAndFk('STAT_STATUS_A',$contentId);
	
	echo $review->showListOfReview($allRevIds);
	
}
else
{
	echo "<label class='orangeLetter'>".ERSTREV003."</label>";
}

?>