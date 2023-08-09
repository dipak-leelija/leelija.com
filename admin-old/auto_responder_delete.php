<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/category.inc.php");
require_once("../includes/email.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/email.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$email			= new Email();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM				= $utility->returnGetVar('typeM','');
$auto_res_id		= $utility->returnGetVar('id','');



if(isset($_POST['btnDelAutoRes']))
{	
	$email->deleteAutoResponder($auto_res_id);
	
	//forward the web page
	$uMesg->showSuccessT('success', $auto_res_id, 'id', $_SERVER['PHP_SELF'], SUAUTORES003, 'SUCCESS');
	
}
?> 

<title><?php echo COMPANY_S; ?>- Delete Auto Responder</title>

<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<!-- eof Style -->


<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_auto_responder')  )
    {
        $autoResDtl = $email->getAutoResponderData($auto_res_id);
    ?>

      <h3>Delete Auto Responder</h3>

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">

            Are you sure that you want to delete this subject <strong><?php echo $autoResDtl[1];?></strong> from Auto Responder
            <br />

            <input name="btnDelAutoRes" type="submit" class="button-add" id="btnDelAutoRes" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />

      </form>

    <?php 
    }//if
    ?>
</div>