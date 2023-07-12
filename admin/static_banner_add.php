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
require_once("../classes/front_photo.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$frPhoto		= new FrontPhoto();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();

##############################################################################################################

//declare vars
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);
$txtName		= $_POST['txtName'];
$txtDesc 		= $_POST['txtDesc'];
$selNum			= $_POST['selNum'];
$id				= $_POST['banner_static_id'];

//status
if(isset($_POST['radioStatus']))
{
	$radioStatus		= 	$_POST['radioStatus'];
}
else
{
	$radioStatus		= 	'd';
}
	

if($txtName == '')
{
	echo "Banner heading is empty";
}
elseif($_FILES['txtUploadBanner']['name'] == '')
{
	echo "Please select a banner";
}
else
{
	//adding the file information
		$bannerId = $stat->createStaticBanner($id, $txtName, $txtDesc, '','Same Window', $radioStatus, 0);
		
		//uploading
		if($_FILES['txtUploadBanner']['name'] != '')
		{
			//image update
			$newName  = $utility->getNewName4($_FILES['txtUploadBanner'], '', $bannerId);
			
			//upload image					
			$uImg->imgUpdResize($_FILES['txtUploadBanner'],'',$newName,
								   '../images/static/banner/', 1000, 300, 
					  			   $bannerId, 'photo', 'static_banner_id', 'static_banner');
		}
		//
		//add the additional 			
		for($i=0; $i < $selNum; $i++)
		{
			if( ($_POST['txtSubTitle'][$i] != '') || ($_FILES['fileSubImg']['name'][$i] != '') )
			{
				
			
				//add static detail
				$staticAdditionBannerId	= $stat->createStaticBanner($id,  $_POST['txtSubTitle'][$i], $_POST['txtSubDesc'][$i],
									                		'','Same Window',  $_POST['selSubStatus'][$i],  0);
													
					
				//uploading images
				if($_FILES['fileSubImg']['name'][$i] != '')
				{ 
					
					//rename the file
					$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'],'',
														   $staticAdditionBannerId);
					
					//upload in the server
					$uImg->imgUpdResizeArr2($i, $_FILES['fileSubImg'], '', $newSubName, 
										   '../images/static/banner/', 1000, 300, 
										   $staticAdditionBannerId,'photo', 'static_banner_id', 'static_banner');
					
				}//upload
				
			}//if
		}//for
	echo "Banner uploaded sucessfully";
}
?>