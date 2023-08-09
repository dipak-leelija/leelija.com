<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);
$id				= $_POST['more_static_id'];
//hold the post vars
$selNum			= $_POST['selNum'];

//add the additional paragraphs
for($i=0; $i < $selNum; $i++)
{
	if( ($_POST['txtSubTitle'][$i] != '') && ($_POST['txtSubDesc'][$i] != '') )
	{
		//add static detail
		$staticDtlId	= $stat->addStaticDtl($id, $_POST['txtSubTitle'][$i], 
											  '', $_POST['txtSubDesc'][$i], $_POST['txtSubImgTitle'][$i], $_POST['selSubImgPos'][$i],
											  $_POST['intSubImgW'][$i], $_POST['intSubImgH'][$i]);
											  
			
		//uploading images
		if($_FILES['fileSubImg']['name'][$i] != '')
		{
			
			//rename the file
			$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'], '',
												   $staticDtlId);
			
			//upload in the server
			$uImg->imgUpdResizeArr2($i, $_FILES['fileSubImg'], '', $newSubName, 
								   '../images/static/', 500, 500, 
								   $staticDtlId,'image', 'static_detail_id', 'static_detail');
			
		}//upload
		
	}//if
	
	else
	{
		echo "Empty title or description";exit;
	}
}//for
echo "Static content added sucessfully";
?>