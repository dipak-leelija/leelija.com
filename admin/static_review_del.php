<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/yoga_package.inc.php");
require_once("../includes/content.inc.php"); 
require_once("../includes/review.inc.php");
require_once("../includes/user.inc.php");


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/client.class.php");
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php");
require_once("../classes/yoga_package.class.php"); 

require_once("../classes/static.class.php");
require_once("../classes/review.class.php");


require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$client			= new Client();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$yogaPackage	= new YogaPackage();

$static      	= new StaticContent();
$review 		= new Review();

$utility		= new Utility();

$uMesg 			= new MesgUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$revIds 	= $review->getAllReviewId('static_review');

if(isset($_GET['id']))
{
	$review_id = $_GET['id'];
}


if(isset($_POST['btnDeleteReview']))
{	
	////delete the main image
//	$utility->deleteFile($pack_id, 'yoga_package_id' ,'../images/packages/', 'image', 'yoga_package');
//	
//	//delete the button image
//	$utility->deleteFile($pack_id, 'yoga_package_id' ,'../images/packages/', 'image_button', 'yoga_package');
//	
	//delete from table
	$review->deleteStaticReview($review_id);
	
	//forward
	header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=Review is deleted");
	
}
?> 

<title> - Page Review Delete</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="100%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
		
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'delete') )
	{
		$reviewDtl = $review->getReviewData($review_id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Page Review</h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="20" colspan="2" align="left" class="menuText padT20 padB20">
				Are you sure that you want to delete the review<span class="bld"><?php echo $reviewDtl[4]; ?></span>?
			</td>
		  </tr>
		  <tr>
			<td width="105" class="menuText">&nbsp;</td>
			<td width="72%" height="25" align="left">
			<input name="" type="hidden" value="">
			<input name="btnDeleteReview" type="submit" class="button-add" 
			id="btnDeleteReview" value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" 
			id="btnCancel" onClick="self.close()" value="cancel" />
</td>
			</tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>

	  </form>
	  </td>
	</tr>
	<?php 
	}//eof
	?>
</table>
