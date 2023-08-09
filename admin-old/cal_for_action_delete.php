<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/logo.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/cal_for_action.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$calFAct		= new CallForAction();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


if(isset($_POST['btnDelete']))
{	
	//delete the logo
	$delLogo = $calFAct->deleteCallForAction('../images/upload/logo/', $id);
	
	//forward
	$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SULOGOCFA003, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?>-  Delete Logo or Call for Action</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    if(isset($_GET['action']) && ($_GET['action'] == 'delete'))
    {
        $logoDtl 		= $calFAct->getCallForActionData($id);
            
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Delete Call for Action</h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" colspan="2" align="left" class="menuText padT20">
            Are you sure that you want to delete the Call for Action
            <span class="orangeLetter">"
                <?php echo $logoDtl[0]." - ".$logoDtl[2]; ?>"	
            </span>
            <br></td>
          </tr>
          <tr>
            <td width="105" class="menuText">&nbsp;</td>
            <td width="72%" height="25" align="left" class="padT20">
            
            <input name="btnDelete" type="submit" class="button-add" id="btnDelete" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />
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
        
    }//if
    ?>
</table>