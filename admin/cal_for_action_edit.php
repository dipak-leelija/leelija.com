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


if(isset($_GET['id']))
{
	$id = $_GET['id'];
}

if(isset($_POST['btnEdit']))
{
	$txtName	= $_POST['txtName'];
	$txtDesc 	= $_POST['txtDesc'];
	$txtURL		= $_POST['txtURL'];
	
	//defining error variables
	$action		= 'edit';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addLogo';
	$typeM		= 'ERROR';
		
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERLOGOCFA002, $typeM, $anchor);
	}
	else
	{
		//update logo
		$calFAct->updateCallForAction($id, $txtName, $txtDesc, $txtURL);
		
		
		//update the logo
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($id, 'call_for_action_id' ,'../images/static/call-to-action/', 'cal_for_action', 'call_for_action');
		}
		
		if($_FILES['fileImage']['name'] != '')
		{
			$utility->deleteFile($id, 'call_for_action_id' ,'../images/static/call-to-action/', 'cal_for_action', 'call_for_action');
			
								
			//rename the image
			$newName  = $utility->getNewName4($_FILES['fileImg'], '',  $id);
								
			//crop and resize
			$utility-> fileUpload2($_FILES['fileImg'], '' , $newName, '../images/static/call-to-action/', $id, 'cal_for_action', 'call_for_action_id', 'call_for_action');
		}
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SULOGOCFA002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?>- Logo or Call for Action Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    //CREATING NEW USER FORM
    if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
    {
        $logoDtl 		= $calFAct->getCallForActionData($id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Call for Action</h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post" 
      enctype="multipart/form-data">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" class="menuText padT5">Title <span class="orangeLetter">*</span></td>
            <td height="20" colspan="2" align="left" class="pad5">
            <input name="txtName" type="text" id="txtName" class="text_box_large"
            value="<?php echo stripslashes($logoDtl[0]); ?>" />
            </td>
          </tr>
        
          <tr>
            <td width="96" align="left" class="menuText padT5">Description</td>
            <td height="20" colspan="2" align="left" class="pad5">
            <textarea name="txtDesc" cols="60" rows="9" id="txtDesc" class="textAr">
            <?php echo str_replace("<br />","",stripslashes(stripslashes($logoDtl[1])));?>
            </textarea>	
            </td>
          </tr>
          <tr>
            <td align="left" class="menuText padT5">URL <span class="orangeLetter">*</span></td>
            <td height="20" align="left" class="pad5">
              <input name="txtURL" type="text" id="txtURL" class="text_box_large"
              value="<?php echo $logoDtl[2]; ?>" />
            </td>
            <td width="230" rowspan="6" align="center"><span class="menuText">
               <?php 
                $utility->imgDisplay('../images/static/call-to-action/', $logoDtl[3], 
                          150, 60, 0, 'greyBorder', $logoDtl[0], " ");
                ?>
                  
            </span></td>
          </tr>
          <tr>
            <td width="96" align="left" class="menuText padT5">Call for Action Image</td>
            <td width="266" height="20" align="left" class="pad5">
                <input type="file" name="fileImage" id="fileImage" class="text_box_large" />					
            </td>
          </tr>
         
          <tr>
            <td align="left" class="menuText"></td>
            <td align="left" class="blackLarge">
            					
            </td>
          </tr>
          <tr>
            <td align="left" class="menuText">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          
          
            <tr>
              <td colspan="2" align="left" class="orangeLetter">
                
             </td>
            </tr>
            <tr>
              <td colspan="2" align="left" class="menuText">					  </td>
              </tr>
            <tr>
              <td align="left" class="menuText">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
          <tr>
            <td width="96" class="menuText">&nbsp;</td>
            <td height="25" align="left">
            <input name="btnEdit" type="submit" class="button-add" id="btnEdit" value="edit" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />
            </td>
          </tr>
          <tr>
            <td width="96">&nbsp;</td>
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