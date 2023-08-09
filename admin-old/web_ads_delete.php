<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/web_ads.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/web_ads.class.php"); 

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$webAds			= new WebAds();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$wAdsId		= $utility->returnGetVar('wAdsId','');


if(isset($_POST['btnDelWebAds']))
{	
	
		$utility->deleteFile($wAdsId, 'web_ads_id' ,'../images/ads/banner/', 'image', 'web_ads');
								
								
		$webAds->deleteWebAds($wAdsId);
		//exit;
		//forward
		//header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=web ads is deleted");
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUWEBAD003, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?> - Web Ads Delete</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="100%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_web_ads') )
	{
		$webAdsDtl = $webAds->getWebAdsData($wAdsId);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Web Ads</h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?wAdsId=<?php echo $wAdsId; ?>" method="post">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="20" colspan="2" align="left" class="menuText padT20 padB20">
				Are you sure that you want to delete <span class="bld"><?php echo $webAdsDtl[4]; ?></span> web ads?
			</td>
		  </tr>
		  <tr>
			<td width="105" class="menuText">&nbsp;</td>
			<td width="72%" height="25" align="left">
			<input name="" type="hidden" value="">
			<input name="btnDelWebAds" type="submit" class="button-add" 
			id="btnDelWebAds" value="delete" />
			<input name="btnCancel" type="button" class="button-add" 
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
