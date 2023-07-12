<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php");

require_once("../classes/adminLogin.class.php");
require_once("../classes/customer.class.php"); 
include_once('../classes/image.class.php');

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer	    = new Customer();
$photo  		= new Photo();
$album			= new Album();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


#########################################################################

//declare type 
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_GET['image_id']) && ((int)$_GET['image_id'] > 0))
{
	$image_id	= $_GET['image_id'];
	$imageDetail  = $photo->showImage($image_id);
}
else
{
	header("Location: error.php");
}

if(isset($_POST['btnStat']))
{
	//hold post variables
	$selectStatus 	= $_POST['selectStatus'];
		
	//update status
	$utility->updStatus($image_id, 'im_id', $selectStatus, 'status', 'album_image');
		
	//forward
	$uMesg->showSuccessT('success',$image_id,'image_id',$_SERVER['PHP_SELF'],SUIMG204,'SUCCESS');
}
?>

<title><?php echo COMPANY_S; ?> - Edit Image Status</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<SCRIPT type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="tblBrd">
    <?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
    
     <?php 
     if(isset($_GET['action']) && ($_GET['action'] == 'change_status'))
     {
    
     ?>
      <tr><td>
    <form action="<?php echo $_SERVER['PHP_SELF']."?image_id=".$_GET['image_id'] ;?>" method="post" 
    name="formAlbumStat" id="formAlbumStat">
    <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
	  <td height="25" colspan="2" align='left' bgcolor="#EEEEEE">
	  	<h3><a name="editStatus">Update Photograph Status</a> </h3>	
      </td>
    </tr>
    
    <tr align="left">
     <td colspan="2" class="blackLarge padR10">
     Are you sure that you want to change the status of image named - <?php echo $imageDetail[1]; ?>
     
    </td>
    </tr>
    <tr>
      <td width="21%" align="right" class="" style="padding-right:10px; ">&nbsp;</td>
      <td width="79%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="blackLarge" style="padding-right:10px; ">Status : </td>
      <td>
        <select name="selectStatus">
          <option value="a" <?php echo $utility->selectString($imageDetail[8],'a')?>>Active</option>
          <option value="d" <?php echo $utility->selectString($imageDetail[8],'d')?>>Deactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2" class="padL10">
      	<div class="orangeLetter bld">NOTE: </div>
        <div class="blackLarge">
        	<ol>
	      		<li>
      				An image (which is inside an album) would be available to the viewers, if the 
                    album is active and the image inside the album is also active.
               </li>
               
            </ol> 
       </div>
      </td>
    </tr>
    <tr>
      <td align="right" class="prodDescLarge" style="padding-right:10px; ">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr align="left">
      <td>&nbsp;					      </td>
      <td><input name="btnStat" type="submit" id="btnStat" value="change" class="button-add">
      <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    </table>
    </form>
    </td></tr>
    <?php  }?>
</table>