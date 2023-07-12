<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php");

require_once("../classes/adminLogin.class.php"); 
include_once('../classes/image.class.php');


require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$album			= new Album();
$photo  		= new Photo();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();

if(!isset($_GET['image_id']))
{
	echo "<span class='maroonError'>No images found</span>";
}
else
{
	$imgDtl = $photo->showImage($_GET['image_id']);


?>
<title><?php echo COMPANY_S; ?> - <?php echo $imgDtl[1]; ?></title>

<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td class="blackLarge padT5 padR10 padL10 padB5"><span class="indexHead"><?php echo $imgDtl[1]; ?></span></td>
  </tr>
  <tr>
    <td align="center" valign="middle" class="padB10">
		<?php echo $utility->imageDisplay2('../images/gallery/gallery/', $imgDtl[3], 252, 550, 0, '', $imgDtl[1]); ?>
	</td>
  </tr>
  <tr>
  <td align="center" class="pad10 mar10">
   <form name="form1" method="post">
  	<input name="Button" type="button" class="button-cancel" onClick="self.close()" value="Close">
   </form>
  </td>
  </tr>
   <tr>
  <td align="center" height="10">

  </td>
  </tr>
</table> 	
<?php 
}
?>