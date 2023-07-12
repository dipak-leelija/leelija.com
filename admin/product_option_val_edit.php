<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php");
require_once("../includes/category.inc.php");
require_once("../includes/product.inc.php");
require_once("../includes/product_attribute.inc.php");
 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/tax.class.php"); 
require_once("../classes/product.class.php");
require_once("../classes/product_attribute.class.php");


require_once("../classes/utility.class.php");   
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$prodAttr		= new Cat();
$product		= new Product();
$prodAttr		= new ProductAttribute();
$tax			= new Tax();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

#######################################################################################

$typeM		= $utility->returnGetVar('typeM','');
$opt_val_id		= $utility->returnGetVar('opt_val_id','');


if(isset($_POST['btnEditOpt']))
{
	//get the var
	$txtOptValName 		= $_POST['txtOptValName'];
	$txtOptToValId 		= $_POST['txtOptToValId'];
	$oldOptId	 		= $_POST['oldOptId'];
	$newOptId	 		= $_POST['newOptId'];
	
	
	//defining error variables
	$action		= 'edit_opt_val';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $opt_val_id;
	$id_var		= 'opt_val_id';
	$anchor		= 'editOptVal';
	$typeM		= 'ERROR';
		
	//check for duplicate val
	$duplicate = $error->duplicateEntry($txtOptValName, "product_option_value_name", "product_option_value", 
									    "YES", $opt_val_id, "product_option_value_id");
	
	//check error
	if($txtOptValName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR102, $typeM, $anchor);
	}
	elseif(preg_match("/^ER/",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR103, $typeM, $anchor);
	}
	else
	{
		//edit option
		$prodAttr->updateOptionVal($opt_val_id, $txtOptValName);
		
		//update option to value table
		$prodAttr->updateOptionToVal($txtOptToValId, $opt_val_id, $newOptId);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPRODATTR102, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Edit Option Value</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="450">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_opt_val')  )
    {
        //get option detail
		$optValDetail 	= $prodAttr->getOptionValData($opt_val_id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Option Value</h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?opt_val_id=<?php echo $opt_val_id; ?>" method="post" enctype="multipart/form-data">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      
          <tr>
            <td align="left" class="menuText padT5">Option Value</td>
            <td height="20" align="left" class="pad5">
                <select name="newOptId" id="newOptId" class="textBoxA">
					<?php 
                         $utility->populateDropDown($optValDetail[4],'product_option_id','product_option_name','products_options');
                    ?>
                </select>
            
            </td>
          </tr>
          <tr>
            <td width="125" align="left" class="menuText padT5">Option Value Name <span class="orangeLetter">*</span></td>
            <td width="317" height="20" align="left" class="pad5">
            <input name="txtOptValName" type="text" id="txtOptValName" size="25" 
			value="<?php echo $optValDetail[0]; ?>" />            </td>
          </tr>
          <tr>
            <td  class="padT5">&nbsp;</td>
            <td height="25" align="left"  class="pad5">
            <input name="txtOptToValId" type="hidden" value="<?php echo $optValDetail[5]; ?>" />
            <input name="oldOptId" type="hidden" value="<?php echo $optValDetail[4]; ?>" />
            </td>
          </tr>
          <tr>
            <td width="125"  class="padT5">&nbsp;</td>
            <td height="25" align="left"  class="pad5">
            <input name="btnEditOpt" type="submit" class="buttonYellow" id="btnEditOpt" value="edit" />
            <input name="btnCancel" type="button" class="buttonYellow" id="btnCancel" onClick="self.close()" value="cancel" />            </td>
          </tr>
          <tr>
            <td width="125">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>

      </form>
      </td>
    </tr>
    <?php 
    }
    ?>
</table>