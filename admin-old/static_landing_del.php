<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/static_landing.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
 
require_once("../classes/error.class.php"); 
require_once("../classes/static_landing.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$staticLanding  = new StaticLanding();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

#############################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


if(isset($_POST['btnDelete']))
{	
	//delete the file
	$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/','title_image', 'static_landing');
	$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/','author_sign', 'static_landing');
	$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/','author_image', 'static_landing');

	//delete from region
	$delStatLnd = $staticLanding->deleteStaticLanding($id);

	//forward
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTLND103, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?> - Static Landing Delete</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">

<table class="tblBrd" align="center" width="100%">
	<?php 
	//show message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'delete'))
	{
		
		$statLndDetail = $staticLanding->getStaticLandingData($id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Static Landing </h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="20" colspan="2" align="left" class="menuText padT20">
			Are you sure that you want to delete the Rating of 
			<span class="orangeLetter">"<?php echo $statLndDetail[0]; ?>"</span><br />
			</td>
		  </tr>
		  <tr>
			<td width="105" class="menuText">&nbsp;</td>
			<td width="72%" height="25" align="left" class="padT20">
			<input name="btnDelete" type="submit" class="buttonYellow" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="buttonYellow" id="btnCancel"
			onClick="self.close()" value="cancel" />
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