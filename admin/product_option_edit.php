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
$opt_id		= $utility->returnGetVar('opt_id','');


if(isset($_POST['btnEditOpt']))
{
	//get the var
	$txtOptName 	= $_POST['txtOptName'];
	
	
	//defining error variables
	$action		= 'edit_opt';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $opt_id;
	$id_var		= 'opt_id';
	$anchor		= 'editOpt';
	$typeM		= 'ERROR';
		
	//check for duplicate val
	$duplicate = $error->duplicateEntry($txtOptName, "product_option_name", "products_options", "YES", $opt_id, "product_option_id");
	
	//check error
	if($txtOptName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR002, $typeM, $anchor);
	}
	elseif(preg_match("/^ER/",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR003, $typeM, $anchor);
	}
	else
	{
		//edit option
		$optId = $prodAttr->updateOption($opt_id, $txtOptName);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPRODATTR002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Edit Option</title>
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
    if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_opt')  )
    {
        //get option detail
		$optDetail 	= $prodAttr->getOptionData($opt_id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Option </h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?opt_id=<?php echo $opt_id; ?>" method="post" enctype="multipart/form-data">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      
          <tr>
            <td width="271" align="left" class="menuText padT5">Option Name <span class="orangeLetter">*</span></td>
            <td width="765" height="20" align="left" class="pad5">
            <input name="txtOptName" type="text" id="txtOptName" size="25" 
			value="<?php echo $optDetail[0]; ?>" />           
            </td>
          </tr>
          <tr>
            <td  class="padT5">&nbsp;</td>
            <td height="25" align="left"  class="pad5">&nbsp;</td>
          </tr>
          <tr>
            <td width="271"  class="padT5">&nbsp;</td>
            <td height="25" align="left"  class="pad5">
            <input name="btnEditOpt" type="submit" class="button-add" id="btnEditOpt" value="update" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />  
            </td>
          </tr>
          <tr>
            <td width="271">&nbsp;</td>
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