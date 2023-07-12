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
$cat			= new Cat();
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


if(isset($_POST['btnDeleteOpt']))
{	
	//get the number of opt val
	$numOptVal	 = $utility->getNoOfEntry($opt_id, 'product_option_id', 'product_option_value');
	
	
	//defining error variables
	$action		= 'delete_opt';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $opt_id;
	$id_var		= 'opt_id';
	$anchor		= 'delOpt';
	$typeM		= 'ERROR';
	
	if($numOptVal > 0)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR004, $typeM, $aname);		
	}
	else
	{
		//delete
		$prodAttr->deleteOption($opt_id);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPRODATTR003, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Delete Option</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_opt')  )
    {
        //get option detail
		$optDetail 	= $prodAttr->getOptionData($opt_id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Option</h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" colspan="2" align="left" class="menuText padT10 padB10">
            Are you sure	that	you	want	to delete the option
            <span class="bld"><?php echo $optDetail[0];?> </span>
            </td>
          </tr>
          <tr>
            <td width="105" class="menuText">&nbsp;</td>
            <td width="72%" height="25" align="left">
            <input name="btnDeleteOpt" type="submit" class="button-add" id="btnDeleteOpt" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />
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
    }//END OF  IF
    ?>
</table>
