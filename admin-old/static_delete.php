<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

########################################################################################################


//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');

//parent ids
$pIds	= $category->getParentOnly('static_categories');



if(isset($_POST['btnDelete']))
{	
		
	//delete from region
	$delReg = $stat->deleteStatic($id, '../images/static/');
	
	//redirect
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON003, 'SUCCESS');
	
}
?> 

<title><?php echo COMPANY_S; ?> - Delete Static Contents</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<div class="popup-form">
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
		$staticDtl 		= $stat->getStaticData($id);
						
	?>

	  <h3>Delete Static Contents </h3>

	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">

			Are you sure that you want to delete the Static Contents <br>
			<span class="orangeLetter">"
				<?php echo $staticDtl[1]; ?>"	
			</span>
			<br>
			<input name="btnDelete" type="submit" class="button-add" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="self.close()" value="cancel" />


	  </form>

	<?php 
		
	}//eof
	?>
</div>