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

$productColorId			= $utility->returnGetVar('id', 0);

//geting product color id by 
//$vendorProductId	= $client->getVendorProductIdByVendorId($vendor_id);

//geting customer product detail
$proColortDtl 		= $product->getProductColorData($productColorId); 




if(isset($_POST['btnEditProCol']))
{
	
	$txtColorHexCode				= $_POST['txtColorHexCode'];
	$txtColorName					= $_POST['txtColorName'];
	
	
	//defining error variables
	$action		= 'edit_proColor';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $productColorId;
	$id_var		= 'id';
	$anchor		= 'editProductColor';
	$typeM		= 'ERROR';
	

		
	if($txtColorName == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERPRCO002, $typeM, $anchor);
	}
	/*elseif(strlen($txtColorHexCode) > 7 || (strlen($txtColorHexCode) < 7 ))
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERPRCO003, $typeM, $anchor);
	}*/
	else
	{
		//update product color 
		$product->updateProductColor($productColorId, $proColortDtl[0],	 $txtColorName, $txtColorHexCode);
		
		if($_FILES['fileImage']['name'] != '')
		{	
		
			$utility->deleteFile($productColorId, 'product_color_id', '../images/upload/product_color/', 'product_image', 'product_color');
			 
			$newName2 = $utility->getNewName4($_FILES['fileImage'], 'IMAGE', $productColorId);
				
			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName2, 
								'../images/upload/product_color/', 800, 800, $productColorId,
					 			'product_image', 'product_color_id', 'product_color');	   
		}
		

		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPRCO002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Product Color Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<table class="tblBrd" align="center" width="650">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	<?php 
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_proColor') )
	{
		//mealplan detail
		//$carTypeDtl 	= $carType->getCarTypeData($id);
			
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE">
	  	<h3><a name="editProductColor">Edit Product Color</a></h3>
	</td>
    </tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="formChoice" 
			  enctype="multipart/form-data">
			  	<table width="100%"  border="0" cellspacing="0" cellpadding="0">

				  <tr>
				    <td height="25" align="left" class="menuText">Color Name  <span class="orangeLetter">*</span> </td>
				    <td height="20" align="left" class="bodyText pad5">
                    <input name="txtColorName" type="text" class="text_box_large" id="txtColorName"
					 value="<?php echo $proColortDtl[1]; ?>" size="30" />  
                     </td>
				    </tr>
				 <tr>
				    <td height="25" align="left" class="menuText">Color Hex Code </td>
			       <td height="20" align="left" class="bodyText pad5">
                    <input name="txtColorHexCode" type="text" class="text_box_large" id="txtColorHexCode"
					 value="<?php echo $proColortDtl[2]; ?>" size="30" /> 
                    (Must be 7 Characaters Long)
                     </td>
				    </tr>
				  <tr>
				    <td height="25" align="left" class="menuText">Color Image </td>
				    <td height="39" align="left"><span class="pad5">
				      <input name="fileImage" type="file" class="text_box_large" id="fileImage" />
				      <span class="bodyText pad5"> </span></span>
                     </td>
				    </tr>
                    
                    <tr>
				    <td height="25" align="left" class="menuText"> </td>
				    
				    </tr>
				 
				  <tr>
				    <td class="menuText">&nbsp;</td>
				    <td height="25" align="left">
					<input name="btnEditProCol" type="submit" class="buttonYellow" value="edit" />
					<input name="btnCancel" type="submit" class="buttonYellow" value="cancel" onclick="self.close()">					
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