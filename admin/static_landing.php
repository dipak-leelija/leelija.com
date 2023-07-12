<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/static_landing.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/static_landing.class.php"); 
require_once("../classes/utility.class.php");   
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 

require_once("../classes/location.class.php");     
require_once("../classes/search.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$staticLanding	= new StaticLanding();
$lc		 		= new Location();
$search_obj		= new Search();


$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

#######################################################################################

$typeM		= $utility->returnGetVar('typeM','');

$staticLandingIds 	= $staticLanding->getStaticLandingId();

if(isset($_POST['btnCreateStatLnd'])) 
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
	$txtMetaKeywords		= trim($_POST['txtMetaKeywords']);
	$txtMetaDescription		= trim($_POST['txtMetaDescription']);
	
	//$file  			= $_FILES['fileCatImg'];
	
	//register session
	$sess_arr	= array('txtTitle', 'txtTitleImageAlt', 'txtBlock1', 'txtBlock2', 'txtBlock3', 'txtBlock4', 'txtBlock5', 'txtBlock6', 'txtHighlight1', 'txtHighlight2', 'txtHighlight3', 'txtAuthorName', 'txtPs_Pps', 'txtMetaKeywords', 'txtMetaDescription');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_statLanding';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$typeM		= 'ERROR'; 
	$anchor		= 'addStatLanding';
	
	//$duplicate = $error->duplicateCat($parent_id, $cat_name,0, 'static_categories');
	
	if($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTLND002, $typeM, $aname);
	}
	
	else
	{
		//add the Static Landing
		$statLndId = $staticLanding->addStaticLanding($txtTitle, $txtTitleImageAlt, $txtBlock1, $txtBlock2, $txtBlock3, $txtBlock4, $txtBlock5, $txtBlock6, $txtHighlight1, $txtHighlight2,  $txtHighlight3, $txtAuthorName, $txtPs_Pps, $txtMetaKeywords,  $txtMetaDescription);
		
		if($_FILES['fileTitleImage']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileTitleImage'], '', $statLndId);
				
			$uImg->imgUpdResize($_FILES['fileTitleImage'], '', $newName, 
								'../images/static/landing/image/', 900, 200, $statLndId,
					 			'title_image', 'static_landing_id', 'static_landing');	   
		}
		
		if($_FILES['fileAuthorSign']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileAuthorSign'], 'SIGNATURE', $statLndId);
				
			$uImg->imgUpdResize($_FILES['fileAuthorSign'], 'SIGNATURE', $newName, 
								'../images/static/landing/image/', 400, 100, $statLndId,
					 			'author_sign', 'static_landing_id', 'static_landing');	   
		}
		
		if($_FILES['fileAuthorImage']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileAuthorImage'], 'AUTHOR', $statLndId);
				
			$uImg->imgUpdResize($_FILES['fileAuthorImage'], 'AUTHOR', $newName, 
								'../images/static/landing/image/', 200, 200, $statLndId,
					 			'author_image', 'static_landing_id', 'static_landing');	   
		}
		
		//delete session value
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $_SERVER['PHP_SELF'], SUSTLND101, 'SUCCESS');
		
	}
	
}//eof



//cancel
if(isset($_POST['btnCancel']))
{
	$sess_arr	= array('txtTitle', 'txtTitleImageAlt', 'txtBlock1', 'txtBlock2', 'txtBlock3', 'txtBlock4', 'txtBlock5', 'txtBlock6', 'txtHighlight1', 'txtHighlight2', 'txtHighlight3', 'txtAuthorName', 'txtPs_Pps', 'txtMetaKeywords', 'txtMetaDescription');
	$utility->delSessArr($sess_arr);
	header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Static Landing</title>

<!-- Style -->
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

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
<script type="text/javascript" src="../js/category.js"></script>
<!-- eof JS Libraries -->

</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="
 padding-left:15px; padding-right:15px; padding-top:5px;">
  <tr>
    <td><?php require_once('header.inc.php'); ?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" valign="top"><?php require_once('menu.inc.php'); ?></td>
        <td align="center" valign="top">
		  <table width="98%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left"  >
			   <div class="padB10">
			  	<div class="fl">
			  	  <h3> Landing Page Management</h3>
			  	</div>
				<div class="fr"><?php echo $utility->showBack2("../images/icon/", "back_arrow_red.gif"); ?></div>
				<div class="cl"></div>
			   </div>
			   <div class="menuText padB10">
			  <span>
				  <img src="images/arrows.gif">
				  <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_statLanding#addStatLanding"; ?>">
				  Add Landing	Page		  
				  </a>			 
			   </span>
			  </div>
			  <div class="padT10 marB10">
			  
			  </div>
			  
			  </td>
            </tr>
            <tr>
              <td>
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="tblBrd">
                
				<!-- SHOWING ALL CONTENT -->
				 <?php 
				 
				 //check number of rows
				 if(count($staticLandingIds) == 0)
				 {
				 ?>
				 <tr align="left">
                   <td height="20" colspan="6"> <?php echo ERSPAN.ERSTLND001.ENDSPAN;?> </td> 
                 </tr>
				<?php 
				}
				else
				{
				?>  
				 
                <tr align="left" class="tableHead">
                  <td width="7%" class="bld lbBack padL5  bdrB bdrR">ID</td>
                  <td width="16%" height="25" class="bld lbBack padL5  bdrB bdrR">Title</td>
                  <td width="17%" align="center" class="bld lbBack padL5  bdrB bdrR">Title Image</td>
                  <td width="17%" class="bld lbBack padL5  bdrB bdrR">Author Name</td>
                  <td width="15%" height="25" class="bld lbBack padL5  bdrB bdrR">Added </td>
                  <td width="28%" height="25" align="center" class="bld lbBack padL5  bdrB">Action</td>
                  </tr>
				<?php 
					$i= 1;
					
					foreach($staticLandingIds as $k)
					{
						$statLandingDetail 	= $staticLanding->getStaticLandingData($k);
						$bgColor 	= $utility->getRowColor($i);
				?>
					<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
					  <td class="pad5 bdrR bdrB"><?php echo $i++; ?></td>
					  <td class="pad5 bdrR bdrB"><?php echo $statLandingDetail[0]; ?></td>
					  <td class="pad5 bdrR bdrB">
                      <div align="center">
					  <?php 
						if(($statLandingDetail[1] != '') && ( file_exists("../images/static/landing/image/".$statLandingDetail[1])) )
						{
							echo $utility->imageDisplay2('../images/static/landing/image/', $statLandingDetail[1], 100, 100, 0, '', $statLandingDetail[0]);
										
						}
					  ?>  
					  </div>
                      
                      </td>
					  <td class="pad5 bdrR bdrB"><?php echo $statLandingDetail[12]; ?></td>
					  <td class="pad5 bdrR bdrB"><?php echo $dateUtil->printDate($statLandingDetail[18]); ?></td>
					  <td align="center" class="pad5 bdrB">
					 
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('static_landing_edit.php?action=editSat_landing&amp;id=<?php echo $k; ?>','StatLndEdit','scrollbars=yes,width=900,height=900')">
					  edit					  
					  </a> ]
					  
					  [ 
					  <a href="#" onClick="MM_openBrWindow('static_landing_del.php?action=delete&id=<?php echo $k; ?>','statLndDelete','scrollbars=yes,width=400,height=350')">
					  delete</a> 
					  ]
					  <br /><br />
					  <?php 
					  }	
					  
					}
					  ?></td>
				    </tr>
			  
              </table></td>
            </tr>


            <tr>
              <td>
              	<!-- show message -->
				<?php 
                    //show message
                    $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
                ?>              
              </td>
            </tr>
			
			<?php 
			//CREATING NEW CATEGORY FORM
			if(isset($_GET['action']) && ($_GET['action'] == 'add_statLanding'))
			{
			?>
			<tr>
				<td align='left'>
				<h4><a name="addStatLanding">Add   Landing</a> Page</h4>
				</td>
			</tr>
            <tr>
              <td>
			  <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
			  	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
				    <td width="22%" height="30" align="left" class="menuText">
				      Title <span class="orangeLetter">*</span>					</td>
				    <td width="78%" height="25" align="left" class=" blackLarge pad5">
				      <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
						onBlur="verifyAltCat()" 
						value="<?php $utility->printSess('txtTitle'); ?>" size="60" />
				      <span id="resAltCat"></span>					</td>
				    </tr>
				  <tr>
				    <td height="30" align="left" class="menuText">Title Image</td>
				    <td height="25" align="left" class=" blackLarge pad5"><span class="pad5">
				      <input name="fileTitleImage" type="file" class="text_box_large" id="fileTitleImage" />
				    </span></td>
				  </tr>
				  <tr>
				    <td height="30" align="left" class="menuText">Title Image Alt</td>
				    <td height="25" align="left" class=" blackLarge pad5">
                  	<input name="txtTitleImageAlt" type="text" class="text_box_large" id="txtTitleImageAlt"
					value="<?php $utility->printSess('txtTitleImageAlt'); ?>" size="60" />                    
                    </td>
				  </tr>
				  <tr>
				    <td height="30" align="left" class="menuText">Block 1</td>
				    <td height="25" align="left" class=" blackLarge pad5">
                  	<textarea name="txtBlock1" cols="70" rows="15" class="textAr" id="txtBlock1">
					<?php $utility->printSess('txtBlock1'); ?>
					</textarea> 
                     <script language="JavaScript">
					  generate_wysiwyg('txtBlock1');
					</script>                 
                    </td>
				  </tr>
				  <tr>
				    <td height="25" align="left" class="menuText">Block 2</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtBlock2" cols="70" rows="15" class="textAr" id="txtBlock2">
					<?php $utility->printSess('txtBlock2'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtBlock2');
					</script>					</td>
				  </tr> 
                  <tr>
				    <td height="25" align="left" class="menuText">Block 3</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtBlock3" cols="70" rows="15" class="textAr" id="txtBlock3">
					<?php $utility->printSess('txtBlock3'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtBlock3');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Block 4</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtBlock4" cols="70" rows="15" class="textAr" id="txtBlock4">
					<?php $utility->printSess('txtBlock4'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtBlock4');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Block 5</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtBlock5" cols="70" rows="15" class="textAr" id="txtBlock5">
					<?php $utility->printSess('txtBlock5'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtBlock5');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Block 6</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtBlock6" cols="70" rows="15" class="textAr" id="txtBlock6">
					<?php $utility->printSess('txtBlock6'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtBlock6');
					</script>					</td>
				  </tr>
                  
                  <tr>
				    <td height="25" align="left" class="menuText">Highlight 1</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtHighlight1" cols="70" rows="15" class="textAr" id="txtHighlight1">
					<?php $utility->printSess('txtHighlight1'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtHighlight1');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Highlight 2</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtHighlight2" cols="70" rows="15" class="textAr" id="txtHighlight2">
					<?php $utility->printSess('txtHighlight2'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtHighlight2');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Highlight 3</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtHighlight3" cols="70" rows="15" class="textAr" id="txtHighlight3">
					<?php $utility->printSess('txtHighlight3'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtHighlight3');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="30" align="left" class="menuText">Author Name</td>
				    <td height="25" align="left" class=" blackLarge pad5">
                  	<input name="txtAuthorName" type="text" class="text_box_large" id="txtAuthorName"
					value="<?php $utility->printSess('txtAuthorName'); ?>" size="25" />                    
                    </td>
				  </tr>
                  <tr>
					<td height="40" align="left" class="menuText">Author  Sign</td>
					<td height="40" align="left" class="pad5">
					<input name="fileAuthorSign" type="file" class="text_box_large" id="fileAuthorSign"></td>
				  </tr>
                  <tr>
					<td height="40" align="left" class="menuText">Author  Image </td>
					<td height="40" align="left" class="pad5">
					<input name="fileAuthorImage" type="file" class="text_box_large" id="fileAuthorImage">
	  				<span class="menuText">
						(image size: 200 pixel &times; 200 pixel in width and height)					</span>					</td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">PS PPS</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtPs_Pps" cols="70" rows="15" class="textAr" id="txtPs_Pps">
					<?php $utility->printSess('txtPs_Pps'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('txtPs_Pps');
					</script>					</td>
				  </tr>
                  <tr>
				    <td height="30" align="left" class="menuText">Meta Keywords</td>
				    <td height="25" align="left" class=" blackLarge pad5">
                  	<input name="txtMetaKeywords" type="text" class="text_box_large" id="txtMetaKeywords"
					value="<?php $utility->printSess('txtMetaKeywords'); ?>" size="60" /> 
                  	( Separated by comma and space.)                   
                    </td>
				  </tr>
                  <tr>
				    <td height="25" align="left" class="menuText">Meta Description</td>
				    <td height="20" align="left" class=" blackLarge pad5">
					<textarea name="txtMetaDescription" cols="70" rows="5" class="textAr" id="txtMetaDescription">
					<?php $utility->printSess('txtMetaDescription'); ?>
					</textarea>
					 <script language="JavaScript">
					  generate_wysiwyg('');
					</script>					</td>
				  </tr>
				  
				  <tr>
				    <td class="menuText">&nbsp;</td>
				    <td height="25" align="left" class="pad5">
					<input name="btnCreateStatLnd" type="submit" class="buttonYellow" value="create" />
					<input name="btnCancel" type="submit" class="buttonYellow" value="cancel" />                    </td>
				    </tr>
				  <tr>
				    <td height="78">&nbsp;</td>
				    <td>&nbsp;</td>
				    </tr>
				</table>

			  </form>
			  </td>
            </tr>
			<?php 
			}
			?>
			<!-- END OF ADDING NEW CATEGORY -->
			
          </table>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php require_once('footer.inc.php'); ?></td>
  </tr>
</table>
</body>
</html>