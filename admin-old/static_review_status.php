<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/review.inc.php");
require_once("../includes/user.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/client.class.php");
require_once("../classes/error.class.php");  
require_once("../classes/date.class.php");

require_once("../classes/static.class.php");
require_once("../classes/review.class.php");


require_once("../classes/utility.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityAuth.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$client			= new Client();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$static      	= new StaticContent();
$review 		= new Review();

$utility		= new Utility();
$uNum			= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uAuth 			= new AuthUtility();

###############################################################################################

//declare type 
$typeM		= $utility->returnGetVar('typeM','');
$review_id	= $utility->returnGetVar('review_id', 0);

//get all post
$revIds 	= $review->getReviewId(0, '');

//check page access
$uAuth->checkPageAccessByVar('GET', 'review_id', $revIds, 'review.php');

//get the review detail
$revDetail	= $review->getReviewData($review_id);

if(isset($_POST['btnStat']))
{
	//get the var
	$selectStatus 	= $_POST['selectStatus'];
	
	//update album status
	$utility->updStatus($review_id, 'static_review_id', $selectStatus, 'status', 'static_review');
	
	
	//forward
	$uMesg->showSuccessT('success', $review_id, 'review_id', $_SERVER['PHP_SELF'], SUSTREV005, 'SUCCESS');
		

}
?>

<title><?php echo COMPANY_S; ?> - Edit Review Status</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 


	
<!-- Editing -->
<table class="tblBrd" cellpadding="0" cellspacing="0" border="0" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'change_status'))
	{
	
	?>
	<tr>
	<td>
	<form action="<?php echo $_SERVER['PHP_SELF']."?review_id=".$_GET['review_id'] ;?>" 
	method="post" name="formAlbumStat" id="formAlbumStat">
	<table width="100%" border="0" cellpadding="2" cellspacing="2">
	<tr>
	  <td height="25" colspan="2" align='left' bgcolor="#EEEEEE">
	  	<h3><a name="editStatus">Update Review Status</a> </h3>	
      </td>
    </tr>
	<tr align="left">
	 <td colspan="2" class="blackLarge padR10">
	 Are you sure that you want to change the status of Review posted by - 
	 <?php echo $revDetail[4]; ?>	
     </td>
	</tr>
	<tr>
	  <td width="21%" align="right" class="prodDescLarge" style="padding-right:10px; ">&nbsp;</td>
	  <td width="79%">&nbsp;</td>
	</tr>
	<tr>
	  <td align="right" class="blackLarge" style="padding-right:10px; ">Status : </td>
	  <td>
	<select name="selectStatus" class="textBoxA">
	  <option value="a" <?php echo $utility->selectString($revDetail[8],'a')?>>Active</option>
	  <option value="d" <?php echo $utility->selectString($revDetail[8],'d')?>>Inactive</option>
	</select>	  </td>
	</tr>
	
	<tr>
	  <td colspan="2" align="left" class="padT10">
	  </td>
	</tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr align="left">
	  <td></td>
	  <td>
		  <input name="btnStat" type="submit" id="btnStat" value="change" 
		  class="button-add" />
		  <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
		  onClick="self.close()" value="cancel" />	  
      </td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	</table>
	  </form>
	  </td></tr>
	  <?php  }?>
  </table>	