<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/rating.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();

$rating			= new Rating();

if(isset($_GET['id'])) 
{
	$id = $_GET['id'];
}

?>

<title><?php echo COMPANY_S; ?> - Testimonial View</title>

<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<table class="tblBrd" align="center" width="600">

	<?php 
	if(isset($_GET['msg']))
	{
		echo "<tr class='maroonError'><td align='left' height='25'>".stripslashes($_GET['msg'])."</td></tr>";
	}

	//close button
	echo $utility->showCloseButton();
	?>

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
	{
		$ratingDtl = $rating->getGuestData($id);
	?>

	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>View Testimonial </h3></td>
	</tr>

	<tr>
	  <td>

		<table width="100%"  border="0" cellspacing="0" cellpadding="0">

		  <tr>
			<td width="115" align="left" class="menuText">Person Name </td>
			<td width="311" height="20" align="left" class="blackLarge pad5">
			  <?php echo $ratingDtl[0]; ?></td>
			<td width="166" rowspan="3" align="center">
			<span class="menuText">
			  <?php 
					$utility->imgDisplay('../images/upload/rating/', $ratingDtl[4], 
									     75, 75, 0, '', $ratingDtl[0], "No Image ");
				?>
			</span>
			</td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Email</td>
			<td height="20" align="left" class="blackLarge pad5"><?php echo $ratingDtl[1]; ?></td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Address</td>
			<td height="20" align="left" class="blackLarge pad5"><?php echo $ratingDtl[2]; ?></td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Rating</td>
			<td height="20" colspan="2" align="left" class="blackLarge pad5">
			<?php $rating->showRating($id, "box.png", "box_grey.png", "../images/icon/", 15, 15);	 ?>
			</td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Comments</td>
			<td height="20" colspan="2" align="left" class="pad5 blackLarge">
			<?php echo $ratingDtl[3]; ?>
			</td>
		  </tr>

		  <tr>
			<td width="115" align="left" class="menuText">&nbsp;</td>
			<td height="20" colspan="2" align="left">&nbsp;</td>
		  </tr>

		  <tr>
			<td colspan="3" align="left" class="menuText"></td>
		  </tr>

		
		  <tr>
			  <td colspan="3" align="left" class="orangeLetter"></td>
		  </tr>

		 <tr>
			  <td colspan="2" align="left" class="menuText"></td>
		 </tr>

		<tr>
			  <td align="left" class="menuText">&nbsp;</td>
			  <td align="left">&nbsp;</td>
		</tr>

		<tr>
			<td width="115" class="menuText">&nbsp;</td>
			<td height="25" align="left">
			<input name="btnCancel" type="button" class="button-add" id="btnCancel" 
			onClick="self.close()" value="close">
			</td>
		</tr>

	    <tr>
			<td width="115">&nbsp;</td>
			<td>&nbsp;</td>
	    </tr>
		</table>

	  </td>
	</tr>

	<?php 
	}//eof
	?>
</table>