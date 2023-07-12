<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
 
require_once("../includes/constant.inc.php"); 
require_once("../includes/contact.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/contact.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utility.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$cont			= new Contact();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$uMesg 			= new MesgUtility();
$utility		= new Utility();


#############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$cus_id		= $utility->returnGetVar('cus_id',0);


if(isset($_POST['btnDelete']))
{	
	
	//delete from region
	$delReg = $utility->deleteRecord($cus_id, 'contact_id', 'contact');
	
	//forward
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUCONTU003, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?> - Delete Contact</title>
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
	if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_contact') )
	{
		$cusDetail = $cont->showContactInfo($cus_id);
			
	?>

	  <h3>Delete Contact </h3>

	  <form action="<?php $_SERVER['PHP_SELF']?>?cus_id=<?php echo $cus_id; ?>" method="post">

			Are you sure that you want to delete the Contact detail of 
			<span class="orangeLetter">"<?php echo $cusDetail[0]; ?>"</span><br>

			<input name="btnDelete" type="submit" class="button-add" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="self.close()" value="cancel" />


	  </form>

	<?php 
	}//eof
	?>
</div>