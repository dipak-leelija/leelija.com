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
$pCusId			= $utility->returnGetVar('pCusId','0');


if(isset($_POST['btnDeleteProd']))
{		

	//delete the product
	$product->delProdToCust($pCusId);

	
	//forward
	$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUPROD003, 'SUCCESS');
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Delete Product </title>
<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<div class="popup-form">
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
		$pCusDtl	= $product->showProdToCust($pCusId);
        $prodDetail = $product->showProduct($pCusDtl[0]);
    ?>

	  <h3>Delete Product :: <?php echo $prodDetail[1]; ?></h3>

      <form action="<?php $_SERVER['PHP_SELF']?>?pCusId=<?php echo $pCusId; ?>" method="post">
            <div class="marT25 padL10 padR10 padB20">
            Are you sure	that	you	want	to delete the product named 
            <strong><?php echo $prodDetail[1]; ?></strong> from this customer
            
            </div>
            
            <input name="btnDeleteProd" type="submit" class="button-add" id="btnDeleteProd" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />


      </form>

    <?php 
    }//if
    ?>
</div>
