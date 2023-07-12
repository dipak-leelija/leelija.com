<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/static_landing.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/static_landing.class.php");
 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");  
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$staticLanding	= new StaticLanding(); 

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

####################################################################################

$typeM		= $utility->returnGetVar('typeM','');

if(isset($_GET['id']))
{
	$id = $_GET['id'];
}


if(isset($_POST['btnEditStatLnd']))
{
	$txtTitle 			= trim($_POST['txtTitle']);
	$txtTitleImageAlt 	= trim($_POST['txtTitleImageAlt']);
	$txtBlock1 			= trim($_POST['txtBlock1']);
	$txtBlock2 			= trim($_POST['txtBlock2']);
	$txtBlock3 			= trim($_POST['txtBlock3']);
	$txtBlock4 			= trim($_POST['txtBlock4']);
	$txtBlock5 			= trim($_POST['txtBlock5']);
	$txtBlock6 			= trim($_POST['txtBlock6']);
	$txtHighlight1 		= trim($_POST['txtHighlight1']);
	$txtHighlight2 		= trim($_POST['txtHighlight2']);
	$txtHighlight3		= trim($_POST['txtHighlight3']);
	$txtAuthorName		= trim($_POST['txtAuthorName']);
	$txtPs_Pps			= trim($_POST['txtPs_Pps']);
	$txtMetaKeywords	= trim($_POST['txtMetaKeywords']);
	$txtMetaDescription	= trim($_POST['txtMetaDescription']);
	
	//$file  			= $_FILES['fileCatImg'];
	
	//defining error variables
	$action		= 'editSat_landing';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$typeM		= 'ERROR'; 
	$anchor		= '';
	
	
	if($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTLND002, $typeM, $aname);
	}
	else
	{
		//edit staticLanding
		$landingId = $staticLanding->updateStaticLanding($id, $txtTitle, $txtTitleImageAlt, 
		                                                 $txtBlock1, $txtBlock2, $txtBlock3, $txtBlock4, $txtBlock5, $txtBlock6, 
														 $txtHighlight1, $txtHighlight2,  $txtHighlight3, 
														 $txtAuthorName, $txtPs_Pps, $txtMetaKeywords,  $txtMetaDescription);						 
		
		/*if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($id, 'categories_id' ,'../images/staticLanding/', 'categories_image', 'static_categories');
								
		}*/
		
		
		
		if($_FILES['fileTitleImage']['name'] != '')
		{
			$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/','title_image', 'static_landing');
								
			$newName = $utility->getNewName4($_FILES['fileTitleImage'], '', $id);
				
			$uImg->imgUpdResize($_FILES['fileTitleImage'], 'STATLND', $newName, 
								'../images/static/landing/image/', 900, 200, $id,
					 			'title_image', 'static_landing_id', 'static_landing');	  
							   
		}
		
		if($_FILES['fileAuthorSign']['name'] != '')
		{
			$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/', 'author_sign', 'static_landing');
								
			$newName = $utility->getNewName4($_FILES['fileAuthorSign'], 'SIGNATURE', $id);
				
			$uImg->imgUpdResize($_FILES['fileAuthorSign'], 'SIGNATURE', $newName, 
								'../images/static/landing/image/', 300, 100, $id,
					 			'author_sign', 'static_landing_id', 'static_landing');  
							   
		}
		
		if($_FILES['fileAuthorImage']['name'] != '')
		{
			$utility->deleteFile($id,'static_landing_id','../images/static/landing/image/','author_image', 'static_landing');
								
			$newName = $utility->getNewName4($_FILES['fileAuthorImage'], 'AUTHOR', $id);
				
			$uImg->imgUpdResize($_FILES['fileAuthorImage'], 'AUTHOR', $newName, 
								'../images/static/landing/image/', 200, 200, $id,
					 			'author_image', 'static_landing_id', 'static_landing');	 
							   
		}
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $_SERVER['PHP_SELF'], SUSTLND102, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Edit Static Landing</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/staticLanding.js"></script>
<!-- eof JS Libraries --> 
<table class="tblBrd" align="center" width="98%">
	<?php 
	//show message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	
	<?php 
	//CREATING NEW USER FORM
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'editSat_landing')
		{
			
			$statLndDetail = $staticLanding->getStaticLandingData($id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE">
		<h3>Edit Landing Page </h3>
	  </td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" 
	  method="post" enctype="multipart/form-data">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="22%" align="left" class="menuText"> Title <span class="orangeLetter">*</span></td>
			<td height="20" colspan="2" align="left" class="pad5">
		    <input name="txtTitle" type="text" class="text_box_large" id="txtTitle" 
			value="<?php echo $statLndDetail[0];?>" size="45" /></td>
		  </tr>
		  <tr>
		    <td align="left" class="menuText">Title Image</td>
		    <td height="20" colspan="2" align="left" class="pad5"><span class=" blackLarge pad5">
		      <input name="fileTitleImage" type="file" class="text_box_large" id="fileTitleImage" />
		    </span></td>
	      </tr>
		  <tr>
		    <td align="left" class="menuText">Title Image Alt</td>
		    <td height="20" colspan="2" align="left" class="pad5">
	        <input name="txtTitleImageAlt" type="text" class="text_box_large" id="txtTitleImageAlt"
			value="<?php echo $statLndDetail[2]; ?>" size="45" />            </td>
	      </tr>
		  <tr>
		    <td align="left" class="menuText">Block 1</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock1" cols="60" rows="10" class="textAr" id="txtBlock1">
			<?php echo stripslashes(trim($statLndDetail[3])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock1');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Block 2</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock2" cols="60" rows="10" class="textAr" id="txtBlock2">
			<?php echo stripslashes(trim($statLndDetail[4])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock2');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Block 3</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock3" cols="60" rows="10" class="textAr" id="txtBlock3">
			<?php echo stripslashes(trim($statLndDetail[5])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock3');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Block 4</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock4" cols="60" rows="10" class="textAr" id="txtBlock4">
				<?php echo stripslashes(trim($statLndDetail[6])); ?>
			  </textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock4');
			 </script>			
             </td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Block 5</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock5" cols="60" rows="10" class="textAr" id="txtBlock5">
				<?php echo stripslashes(trim($statLndDetail[7])); ?>
			  </textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock5');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Block 6</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtBlock6" cols="60" rows="10" class="textAr" id="txtBlock6">
				<?php echo stripslashes(trim($statLndDetail[8])); ?>
			  </textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtBlock6');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Highlight 1</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtHighlight1" cols="60" rows="10" class="textAr" id="txtHighlight1">
			<?php echo stripslashes(trim($statLndDetail[9])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtHighlight1');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Highlight 2</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtHighlight2" cols="60" rows="10" class="textAr" id="txtHighlight2">
			<?php echo stripslashes(trim($statLndDetail[10])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtHighlight2');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Highlight 3</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtHighlight3" cols="60" rows="10" class="textAr" id="txtHighlight3">
			<?php echo stripslashes(trim($statLndDetail[11])); ?>
			</textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtHighlight3');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Author Name</td>
            <td height="20" colspan="2" align="left" class="pad5">
            <input name="txtAuthorName" type="text" class="text_box_large" id="txtAuthorName"
			value="<?php echo $statLndDetail[12]; ?>" size="25" />
            </td>
          </tr>
          <tr>
            <td align="left" class="menuText">Author  Sign</td>
            <td height="20" colspan="2" align="left" class="pad5"><span class=" blackLarge pad5">
              <input name="fileAuthorSign" type="file" class="text_box_large" id="fileAuthorSign" />
            </span></td>
          </tr>
          <tr>
            <td align="left" class="menuText">Author  Image </td>
            <td height="20" colspan="2" align="left" class="pad5"><span class=" blackLarge pad5">
              <input name="fileAuthorImage" type="file" class="text_box_large" id="fileAuthorImage" />
            </span></td>
          </tr>
          <tr>
            <td align="left" class="menuText">PS PPS</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtPs_Pps" cols="60" rows="10" class="textAr" id="txtPs_Pps">
				<?php echo stripslashes(trim($statLndDetail[15])); ?>
			  </textarea>
		     <script language="JavaScript">
			  generate_wysiwyg('txtPs_Pps');
			</script>			</td>
		  </tr>
          <tr>
            <td align="left" class="menuText">Meta Keywords</td>
            <td height="20" colspan="2" align="left" class="pad5 blackLarge">
            <input name="txtMetaKeywords" type="text" class="text_box_large" id="txtMetaKeywords"
			value="<?php echo $statLndDetail[16]; ?>" size="60" /> 
            ( Separated by comma and space. )</td>
          </tr>
          <tr>
            <td align="left" class="menuText">Meta Description</td>
			<td height="20" colspan="2" align="left" class="pad5">
			  <textarea name="txtMetaDescription" cols="60" rows="5" class="textAr" id="txtMetaDescription">
			<?php echo stripslashes(trim($statLndDetail[17])); ?>
			</textarea>
		    </td>
		  </tr>
		  <?php /*?><tr>
			<td align="left" class="menuText">&nbsp;</td>
			<td width="611" height="20" align="left" class="blackLarge"><?php 
			if($statLndDetail[1] != '')
			{
				echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\" /> 
					 Delete this image";	 
			}//
			?>			</td>
			<td width="278" rowspan="4" align="center" valign="top">
		    <?php 
				if(($statLndDetail[1] != '') || ($statLndDetail[1] != NULL) && 
				(file_exists("../images/staticLanding/".$statLndDetail[1])))
				{
				  echo "&nbsp;
				  <img src='../images/staticLanding/".$statLndDetail[1]."' height='100' width='100' />";
				}
			?>			</td>
		  </tr><?php */?>
		 
		  <tr>
			<td width="22%" class="menuText">&nbsp;</td>
			<td height="25" align="left" class="pad5">
			<input name="btnEditStatLnd" type="submit" class="buttonYellow" id="btnEditStatLnd" value="edit" /> 
			<input name="btnCancel" type="button" class="buttonYellow" id="btnCancel" onClick="self.close()" value="cancel" />            
            </td>
		  </tr>
		  <tr>
			<td width="22%">&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>

	  </form>
	  </td>
	</tr>
	<?php }
	}
	?>
</table>