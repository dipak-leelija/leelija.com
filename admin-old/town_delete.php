<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/location.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$lc		 		= new Location();
$utility		= new Utility();

if(isset($_GET['id']))
{
	$t_Id = $_GET['id'];
}


if(isset($_POST['btnDeleteTown']))
{		
	//delete the image first
	$utility->deleteFile($t_Id, 'town_id' ,'../images/location/', 'town_image', 'town');
	
	//delete data
	$res = $lc->deleteTown($t_Id);
	header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=town is deleted");
}
?> 

<title>Delete County</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin.css" rel="stylesheet" type="text/css">
<table style="border:1px solid #CC0000 " align="center" width="100%">
			<?php 
			if(isset($_GET['msg']))
			{
				echo "<tr class='maroonError'><td align='left' height='25'>".stripslashes($error->printError($_GET['msg']))."</td></tr>";
			}
			?>
			<?php 
			if(isset($_GET['action']))
			{
				if($_GET['action'] == 'success')
				{
				 ?>
				 <tr>
				  <td height="25" align='center' bgcolor="#EEEEEE">
				    <form name="form1" method="post" action="">
				      <input name="Button" type="button" class="button-add" onClick="opener.location.reload();self.close()" value="Close">
			        </form>
				  </td>
				</tr>
				 <?php
				}
			}
			?>
			<?php 
			//CHECKING WHETHER THE CATEGORY HAS ANY SUB CATEGORY AND/OR PRODUCTS OR NOT
			
			//CREATING NEW USER FORM
			if(isset($_GET['action']))
			{
				if($_GET['action'] == 'town_delete')
				{
					
					$tDetail = $lc->getTownData($t_Id);	
			?>
			<tr class='maroonError'>
			  <td height="25" align='left' bgcolor="#EEEEEE"><strong>Delete Town </strong></td>
			</tr>
            <tr>
              <td>
			  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			  	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="20" colspan="2" align="left" class="menuText">
					Are you sure that you want to delete the Town - <br />
					<span class="maroonError">"<?php echo $tDetail[0];?>"	</span>
				    <br /></td>
				  </tr>
				  <tr>
				    <td width="105" class="menuText">&nbsp;</td>
				    <td width="72%" height="25" align="left">
					<input name="" type="hidden" value="">
					<input name="btnDeleteTown" type="submit" class="button-add" id="btnDeleteTown" value="delete">
                    <input name="btnCancel" type="button" class="button-add" id="btnCancel" onClick="self.close()" value="cancel">
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
				}//END OF  IF
			}//END OF  IF
			?>
</table>