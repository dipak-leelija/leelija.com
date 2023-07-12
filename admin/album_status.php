<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
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

#########################################################################################

//declare type 
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_GET['album_id']) && ((int)$_GET['album_id'] > 0))
{
	$album_id	= $_GET['album_id'];
	$albumDetail  = $album->showAlbum($album_id);
}
else
{
	header("Location: error.php");
}

if(isset($_POST['btnStat']))
{
	$imgStat		= $_POST['imgStat'];
	$selectStatus 	= $_POST['selectStatus'];
	
	//update album status
	$utility->updStatus($album_id, 'categories_id', $selectStatus, 'status', 'album');
	
	//change image status
	if($imgStat == 'Y')
	{
		$utility->updStatus($album_id, 'categories_id', $selectStatus, 'status', 'album_image');
	}
	
	//forward
	$uMesg->showSuccessT('success',$album_id,'album_id',$_SERVER['PHP_SELF'],SUIMG104,'SUCCESS');
		

}
?>

<title><?php echo COMPANY_S; ?> - Edit Album Status</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 


	
<!-- Editing -->
<table class="tblBrd" cellpadding="0" cellspacing="0" border="0" width="98%">
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
	<tr>
	<td>
	<form action="<?php echo $_SERVER['PHP_SELF']."?album_id=".$_GET['album_id'] ;?>" 
	method="post" name="formAlbumStat" id="formAlbumStat">
	<table width="100%" border="0" cellpadding="2" cellspacing="2">
	<tr>
	  <td height="25" colspan="2" align='left' bgcolor="#EEEEEE">
	  	<h3><a name="editStatus">Update Album Status</a> </h3>	
      </td>
    </tr>
	<tr align="left">
	 <td colspan="2" class="blackLarge padR10">
	 Are you sure that you want to change the status of album named - 
	 <?php echo $albumDetail[0]; ?>	
     </td>
	</tr>
	<tr>
	  <td width="21%" align="right" class="prodDescLarge" style="padding-right:10px; ">&nbsp;</td>
	  <td width="79%">&nbsp;</td>
	</tr>
	<tr>
	  <td align="right" class="blackLarge" style="padding-right:10px; ">Status : </td>
	  <td>
	<select name="selectStatus" class="textBoxA">
	  <option value="a" <?php echo $utility->selectString($albumDetail[6],'a')?>>Active</option>
	  <option value="d" <?php echo $utility->selectString($albumDetail[6],'d')?>>Inactive</option>
	</select>	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="right" class="blackLarge bld">
	  	Do you want to change the status of the images also?</td>
	  </tr>
	<tr>
	  <td align="right" class="blackLarge" style="padding-right:10px; ">
		</td>
	  <td class="blackLarge"><input name="imgStat" type="radio" value="Y">
		Yes change the image status<br />
		<input name="imgStat" type="radio" value="N" checked>
		No I will change their status manually	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="left" class="padT10">
	  <div class="orangeLetter bld">NOTE: </div>	  <div class="blackLarge">
	    <ol>
	      <li>
	        If you select yes, the status of the images will be same as the status of 
	        the album.	        </li>
			  <li>
			    Whenever any user except admin will upload any images it would be  inactive by
			    default, administrator needs to make it active to make them available to the 
			    viewers of the website.			    </li>
			  <li>
			    An image (which is inside an album) would be available to the viewers, if the 
			    album is active and the image inside the album is active.			    </li>
			  <li>
			    For an image which is not included inside an album needs to be activated by 
			    the admin.			    </li>
		  </ol>
	    </div></td>
	  </tr>
	<tr>
	  <td align="right">&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr align="left">
	  <td></td>
	  <td>
		  <input name="btnStat" type="submit" id="btnStat" value="change" 
		  class="button-add" />
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
	  </td></tr>
	  <?php  }?>
  </table>	