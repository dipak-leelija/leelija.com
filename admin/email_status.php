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


if(isset($_POST['btnEditStatus']))
{
	//get the variable
	$selectStatus 		= $_POST['selectStatus'];
	
	//update status
	$utility->updStatus($email_id, 'subscriber_id', $selectStatus, 'status', 'email_subscriber');
	
	
	//forward
	$uMesg->showSuccessT('success', $email_id, 'email_id', $_SERVER['PHP_SELF'], SUSUBSC005, 'SUCCESS');
}
?>

<title><?php echo COMPANY_S; ?> - Edit Subscriber Status</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<SCRIPT type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>

<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
    //edit faq
    if((isset($_GET['action'])) && ($_GET['action'] == 'edit_status'))
    {
        $cusDetail = $subscribe->getSubsDtl($email_id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE">
     	 <h3>Edit Subscriber Status </h3>
      </td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?email_id=<?php echo $email_id; ?>"
       method="post" name="formStatus" id="formStatus">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="padT20">
          <tr>
            <td align="left" class="menuText padT5">Email</td>
            <td height="20" align="left" class="pad5 blackLarge"><?php echo $cusDetail[2]; ?></td>
          </tr>
          <tr>
            <td align="left" class="menuText padT5">Status</td>
            <td width="78%" height="20" align="left" class="pad5">
                <select name="selectStatus" class="text_box_large">
                  <option value="a" <?php echo $utility->selectString($cusDetail[9],'a')?>>Active</option>
                  <option value="d" <?php echo $utility->selectString($cusDetail[9],'d')?>>Deactive</option>
              </select>					</td>
          </tr>
          <tr>
            <td align="left" class="menuText">&nbsp;</td>
            <td height="20" align="left">&nbsp;</td>
          </tr>
          
         
          <tr>
            <td width="22%" class="menuText">&nbsp;</td>
            <td height="25" align="left" class="pad5">
            <input name="btnEditStatus" type="submit" class="button-add" id="btnEditStatus" value="edit" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />            </td>
          </tr>
          <tr>
            <td width="22%">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>

      </form>
      </td>
    </tr>
    <?php
    }
    ?>
</table>