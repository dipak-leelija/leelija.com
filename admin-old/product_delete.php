<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/product.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/product.class.php"); 
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/tax.class.php");


require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$product		= new Product();
$search_obj		= new Search();
$page			= new Pagination();
$tax			= new Tax();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
$pid			= $utility->returnGetVar('pid','0');


if(isset($_POST['btnDeleteProd']))
{	

	//delete the images
	$utility->deleteFile($pid, 'product_id' ,'../images/product/large/', 'product_image', 'products');
	$utility->deleteFile($pid, 'product_id' ,'../images/product/thumb/', 'thumb_image', 'products');
	
	//delete the product
	$product->delProd($pid);
	
	//forward
	$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUPROD003, 'SUCCESS');
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Delete Product </title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="100%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
    
	<?php 
    //delete form
    if( (isset($_GET['action'])) && ($_GET['action'] == 'del_prod') )
    {
        $prodDetail = $product->showProduct($pid);
    ?>
    <tr class=''>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Product :: <?php echo $prodDetail[0]; ?></h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?pid=<?php echo $pid; ?>" method="post">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" align="left" class=" blackLarge">
            <div class="marT25 padL10 padR10 padB20">
            Are you sure	that	you	want	to delete the product named 
            <strong><?php echo $prodDetail[0]; ?></strong> from category
            
                <div class="marT10 marB20">
                    <?php $parentPath = "Category Home ". ">";
                    echo "<span class=\"orangeLetter fl\">".$parentPath.$category->categoryPath($prodDetail[13],'no', 'categories')."<span>";?>	
                </div>
            </div>            </td>
          </tr>
          <tr>
            <td height="25" colspan="2" class="menuText padL10">
            
            <input name="btnDeleteProd" type="submit" class="buttonYellow" id="btnDeleteProd" value="delete" />
            <input name="btnCancel" type="button" class="buttonYellow" id="btnCancel" onClick="self.close()" value="cancel" /></td>
            </tr>
          <tr>
            <td width="105">&nbsp;</td>
            <td width="72%">&nbsp;</td>
          </tr>
        </table>

      </form>
      </td>
    </tr>
    
    <?php 
    }//if
    ?>
</table>
