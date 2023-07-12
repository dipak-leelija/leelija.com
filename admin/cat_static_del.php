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


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

#############################################################################

$typeM		= $utility->returnGetVar('typeM','');
$cat_id		= $utility->returnGetVar('id','');


if(isset($_POST['btnDeleteCat']))
{	
	$ads 	 = $error->checkCatAds($cat_id, 'static');
	$subcat  = $error->checkChild($cat_id, 'static_categories');
	
	//defining error variables
	$action		= 'delete_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cat_id;
	$id_var		= 'id';
	$typeM		= 'ERROR'; 
	$aname		= '';
	
	if(ereg("^ER",$ads))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT301, $typeM, $aname);
	}
	elseif(ereg("^ER",$subcat))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT302, $typeM, $aname);
	}
	else
	{
		$utility->deleteFile($cat_id, 'categories_id' ,'../images/category/', 
							 'categories_image', 'static_categories');
							 
		$category->deleteCategory($cat_id, 'static_categories');
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUCAT203, 'SUCCESS');
	}
	
}
?> 

<title><?php echo COMPANY_S; ?> - Delete Category</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<div class="popup-form">
	<?php 
	//show message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	<?php 
	
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_cat') )
	{
		$catDetail = $category->categoryData($cat_id, 'static_categories');
	?>

	  	<h3>Delete Category - <?php echo $catDetail[0]; ?></h3>

	  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

			<p>Are you sure	that	you	want	to delete the category named <br/>
			<?php $parentPath = "Category Home ". ">";
			echo "<span style=\"float:left \" class=\"maroonError\">".$parentPath.$category->categoryPath($cat_id,'','static_categories')."<span>";?>	</p>


			<input name="" type="hidden" value="">
			<input name="btnDeleteCat" type="submit" class="button-add" id="btnDeleteCat" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="self.close()" value="cancel" />

	  </form>

	<?php 
	}//eof
	?>
	
</div>