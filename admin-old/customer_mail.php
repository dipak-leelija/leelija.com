<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php"); 


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/search.class.php");
include_once("../classes/email.class.php");

require_once("../classes/error.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer	    = new Customer();
$search_obj		= new Search();
$emailObj   	= new Email();

$dateUtil      	= new DateUtil();
$error 			= new MyError();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');



if(isset($_POST['btnSendMail']))
{
	$toName   		= addslashes($_POST['toName']);
	$toEmail  		= addslashes($_POST['toEmail']);
	$txtSubject     = addslashes($_POST['txtSubject']);
	$txtMessage    	= $_POST['txtMessage'];
	
	$invalidEmail 	= $error->invalidEmail($toEmail);
	
	//defining error variables
	$action		= 'send_email';
	$url		= $_SERVER['PHP_SELF'];
	$arr_id		= array($toName, $toEmail);
	$id_var		= array('toName','toEmail');
	$linkName	= 'sendMail';
	$typeM		= 'ERROR';
	
	
	if(($toEmail == '')||(mb_ereg("^ER",$invalidEmail)))
	{
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERE002, $typeM, $linkName);
	}
	elseif($toName == '')
	{
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERE004, $typeM, $linkName);
	}
	else
	{
		//send email
		$emailObj->cusEmail($toEmail,$toName,$txtSubject,$txtMessage);
		
		//forward
		$uMesg->showSuccessArrT('success', $arr_id, $arr_var, $_SERVER['PHP_SELF'], SUEML001, 'SUCCESS');
		
	}
}


?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="image/png;">
<title>InsidesInteriors - Send Mail</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script>


<link rel="stylesheet" href="js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112"
    media="screen">
</link>

<script type="text/javascript" src="js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>




<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="formCustomerMail">
    <table class="tblBrd" align="center" width="98%">
        <?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
        <tr>
            <td height="25" align='left' colspan="2" bgcolor="#EEEEEE">
                <h3>Send Email</h3>
            </td>
        </tr>

        <?php 
	if(!(isset($_GET['action'])) || ($_GET['action'] != 'success'))
	{
	
	?>
        <tr>
            <td width="150" height="22" class="blackLarge">Name <span class="maroonErrorLarge">*</span></td>
            <td style="padding: 2px; ">
                <input name="toName" type="text" class="text_box_large" id="toName" size="40" maxlength="96"
                    <?php if(isset($_GET['toName'])){?> value="<?php echo $_GET['toName']; ?>" <?php }?> />
            </td>

        </tr>
        <tr>
            <td width="150" height="22" class="blackLarge">Email <span class="maroonErrorLarge">*</span> </td>
            <td style="padding: 2px; ">
                <input name="toEmail" type="text" class="text_box_large" id="toEmail" size="40" maxlength="96"
                    <?php if(isset($_GET['toEmail'])){?> value="<?php echo $_GET['toEmail']; ?>" <?php }?> />
            </td>
        </tr>
        <tr>
            <td width="150" height="22" class="blackLarge">Subject</td>
            <td style="padding: 2px; ">
                <input name="txtSubject" type="text" class="text_box_large" id="txtSubject" size="40" maxlength="96" />

            </td>
        </tr>
        <tr>
            <td width="150" height="22" class="blackLarge">Message<span class="maroonErrorLarge">*</span></td>
            <td style="padding: 2px; ">
                <textarea name="txtMessage" id="txtMessage" wrap="physical"><?php if(isset($_GET['toName'])){echo "Dear ".$_GET['toName'].",<br />";} else {echo "Dear User,<br />";}?></textarea>
                <script language="JavaScript">
                WYSIWYG.attach('txtMessage', full);
                </script>
            </td>
        </tr>
        <tr>
            <td height="22" class="blackLarge">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td width="150">&nbsp;</td>
            <td>
                <input name="btnSendMail" type="submit" class="buttonYellow" id="btnSendMail" value="send mail" />
                <input name="btnCancel" type="button" class="buttonYellow" id="btnCancel" onClick="self.close()"
                    value="cancel" />
            </td>
        </tr>
        <?php }?>
    </table>
</form>