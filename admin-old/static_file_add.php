<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();


###############################################################################################

//declare vars
$static_id		= $utility->returnGetVar('static_id','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);
$title			= $_POST['txtTitle'];
$intSort		= $_POST['intSort'];
if(isset($_POST['radioPagePosition']))
{
	$pagePos		= $_POST['radioPagePosition'];
}
else
{
	$pagePos		= 'bottom';
}
if(isset($_POST['radioStatus']))
{
	$status		= $_POST['radioStatus'];
}
else
{
	$status		= 'a';
}
if(isset($_POST['radioLinkAlignment']))
{
	$link		= $_POST['radioLinkAlignment'];
}
else
{
	$link		= 'left';
}
$static_id		= $_POST['static_id'];
if($title == '')
{
	echo "Title is empty";
}
else
{
	$downId		= $stat->addDownloadContent($static_id, $title, $pagePos, $link, $status, $intSort);
	
	//uploading the file
	//uploading file
	if($_FILES['txtUploadFile']['name'] != '')
	{		
		//generate new name
		$newName = $utility->getNewName4($_FILES['txtUploadFile'], '', $downId);
		
		//upload and save file
		$utility->fileUpload2($_FILES['txtUploadFile'], '', $newName, '../images/static/download/', 
							$downId,'download_file', 'static_download_id', 'static_download');		
	}
	echo "File uploaded sucessfully";
}
?>