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



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

########################################################################################################


//declare variables
$typeM				= $utility->returnGetVar('typeM','');
//static id 
//$id					= $utility->returnGetVar('id','');

//banner id
$ban_id				= $utility->returnGetVar('ban_id','');

if(!isset($_SESSION['ban_id']))
{
	$_SESSION['ban_id'] = $ban_id ;
}
else
{
	$ban_id	= $_SESSION['ban_id'];
}



if(isset($_POST['btnDelete']))
{	
	//delete from region
	$delBann = $stat->deleteStaticBanner($ban_id,'../images/static/banner/');
	
	//redirect
	$uMesg->showSuccessT('success', $id, 'id', 'static_banner_delete_success.php', SUSTCON003, 'SUCCESS');
	
}

?> 

<title><?php echo COMPANY_S; ?> - Delete Static Banner</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	<?php 
	
	
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) &&   ($_GET['action'] == 'delete_banner'))
	{
		
		$staticBannerDtl 		= $stat->getStaticBanner($ban_id);
		//print_r($staticBannerDtl);exit;				
	?>

	  <h3>Delete Static Banner </h3>

	  <form action="static_banner_delete.php?action=delete_banner&ban_id=<?php echo $ban_id ;?>" method="post">

			Are you sure that you want to delete the Static Banner <br>
			<span class="orangeLetter">"
				<?php echo $staticBannerDtl[0]; ?>"	
			</span>
			<br>
			<input name="btnDelete" type="submit" class="button-add" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="parent.$.colorbox.close()" value="cancel" />


	  </form>
	<?php 
		
	}//eof
	?>
</div>