<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/product.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/product.class.php");


require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$product		= new Product();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uNum			= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();


###############################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


if(isset($_POST['btnDelete']))
{	
	
	//delete the file
	$utility->deleteFile($id, 'product_color_id', '../images/upload/product_color/', 'product_image', 'product_color');
	//$utility->deleteFile($id,'offer_id','../images/upload/offer/', 'image', 'offer');
	
	//delete from region
	$delOffer = $product->deleteProductColor($id);

	//forward
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPRCO003, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?> - Product Color Delete</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

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
		
		$proColorDetail = $product->getProductColorData($id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Product Color</h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td height="20" colspan="2" align="left" class="menuText padT20">
			Are you sure that you want to delete the product color
			<span class="orangeLetter">"<?php echo $proColorDetail[1]; ?>"</span><br />
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