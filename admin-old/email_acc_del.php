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
$email_id	= $utility->returnGetVar('email_id',0);


if(isset($_POST['btnDeleteUser']))
{
	//delete the subscribe
	$utility->deleteRecord($email_id, 'subscriber_id', 'email_subscriber');
	
	//forward
	$uMesg->showSuccessT('success', $email_id, 'email_id', $_SERVER['PHP_SELF'], SUSUBSC002, 'SUCCESS');
	
}
?>

<title><?php echo COMPANY_S; ?> - Delete Email Member</title>
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
    if((isset($_GET['action'])) && ($_GET['action'] == 'delete_email'))
    {
        $cusDetail = $subscribe->getSubsDtl($email_id);
    ?>

      <h3>Delete Member</h3>

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            Are you sure	that	you	want	to delete the customer named 
            <strong><?php echo $cusDetail[2]." - ".$cusDetail[3]." ".$cusDetail[4]; ?></strong><br><br>

            <input name="btnDeleteUser" type="submit" class="button-add" id="btnDeleteUser" value="delete" />
            <input name="btnCancel" type="button" class="button-add" id="btnCancel" 
            onClick="self.close()" value="cancel" />


      </form>

    <?php 
    }
    ?>
</div>
