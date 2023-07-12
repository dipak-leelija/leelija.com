<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();


$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$cat_id		= $utility->returnGetVar('cat_id','');

if(isset($_POST['btnDeleteCat']))
{	
	$product = $error->checkCatAds($cat_id, 'products_to_categories');
	$subcat  = $error->checkChild($cat_id, 'categories');
	
	//defining error variables
	$action		= 'delete_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cat_id;
	$id_var		= 'cat_id';
	$anchor		= 'delCat';
	$typeM		= 'ERROR';
	
	if(ereg("^ER",$product))
	{
		//echo "in if ";exit;
		header("Location:".$_SERVER['PHP_SELF']."?id=".$cat_id."&action=error&msg=Error: category has product(s), please delete the product(s) before deleting the category");
		
	}
	elseif(ereg("^ER",$subcat))
	{
		//echo "in elseif ";exit;
		header("Location:".$_SERVER['PHP_SELF']."?id=".$cat_id."&action=error&msg=Error: category has subcategory(ies), please delete the subcategory(ies) before deleting the category");
		
	}
	else
	{
		$utility->deleteFile($cat_id, 'categories_id' ,'../images/category/', 'categories_image', 'categories');
		$category->deleteCategory($cat_id, 'categories');
		header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=category is deleted");
	}
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Delete Category</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_cat')  )
    {
        $catDetail = $category->categoryData($cat_id, 'categories');
    ?>

      

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      		<h3>Delete Category :: <?php echo $catDetail[0]; ?></h3>
            Are you sure	that	you	want	to delete the category named 
            <?php $parentPath = "Category Home ". ">";
            echo "<span class=\"orangeLetter fl\">".$parentPath.$category->categoryPath($cat_id,'no', 'categories')."<span>";?>
            <div class="cl"></div>	

            <input name="btnDeleteCat" type="submit" class="button-add" id="btnDeleteCat" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" 
            value="cancel" />


      </form>

    <?php 
    }//END OF  IF
    ?>
</div>
