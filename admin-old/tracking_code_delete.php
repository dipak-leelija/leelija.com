<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
 
require_once("../includes/constant.inc.php");
require_once("../includes/navigation.inc.php");
require_once("../includes/tracking_code.inc.php");

require_once("../classes/adminLogin.class.php"); 

require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/tracking_code.class.php");
require_once("../classes/pagination.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();

$trackc			= new TrackingCode();
$page			= new Pagination();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();

########################################################################################################


//declare variables
$typeM		= $utility->returnGetVar('typeM','');
//$id			= $utility->returnGetVar('id','');

if(isset($_GET['id']))
{
	$track_id = $_GET['id'];
}


if(isset($_POST['btnDelete']))
{	
	
	//delete from table
	$trackc->deleteTrackingCode($track_id);
	
	//forward
	header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=Tracking code is deleted&typeM=SUCCESS");
	
}

?> 

<title><?php echo COMPANY_S; ?> - Delete Visitors Tracking </title>
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
	
	
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) &&   ($_GET['action'] == 'delete'))
	{
		$trackDtl 		= $trackc->getTrackingCodeData($track_id);
						
	?>
	<tr class=''>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Tracking Code </h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $track_id; ?>" method="post">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="20" colspan="2" align="left" class="menuText padT20">
			Are you sure that you want to delete the Tracking Code <br>
			<span class="orangeLetter">"
				<?php echo $trackDtl[0]; ?>"	
			</span>
			<br></td>
		  </tr>
		  <tr>
			<td width="105" class="menuText">&nbsp;</td>
			<td width="72%" height="25" align="left" class="padT20">
			<input name="btnDelete" type="submit" class="button-add" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-add" id="btnCancel" 
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