<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/subscriber.inc.php");

 
require_once("../classes/adminLogin.class.php"); 
include_once("../classes/countries.class.php"); 
include_once("../classes/subscriber.class.php"); 

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$country		= new Countries();
$subscribe		= new EmailSubscriber();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');

//delete cat
if(isset($_POST['btnDeleteCat']))
{	
	$numSubs	= $subscribe->getSubsByCat($id);
	
	//page forward variables
	$action		= 'delete_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'delCat';
	$typeM		= 'ERROR';
	
	if(count($numSubs) > 0)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC104, $typeM, $anchor);	
	}
	else
	{
		//delete the category
		$utility->deleteRecord($id, 'cat_id', 'email_categories');
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $url , SUSUBSC103, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Delete Email Group</title>
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
    if((isset($_GET['action'])) && ($_GET['action'] == 'delete_cat'))
    {
        $catDetail 	= $subscribe->getCategoryData($id);
    ?>
      <h3>Delete Category</h3>

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            Are you sure	that	you	want	to delete the category named 
            <strong><?php echo $catDetail[0];?>	</strong>

            <input name="btnDeleteCat" type="submit" class="button-add" 
            id="btnDeleteCat" value="delete">
            <input name="btnCancel" type="button" class="button-add" id="btnCancel" 
            onClick="self.close()" value="cancel">


      </form>

    <?php 
    }//END OF  IF
    ?>
</div>
