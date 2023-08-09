<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/web_ads.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/web_ads.class.php");
require_once("../classes/category.class.php"); 


require_once("../classes/error.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityAuth.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$webAds			= new WebAds();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum			= new NumUtility();
$uAuth 			= new AuthUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM			= $utility->returnGetVar('typeM','');
$web_ads_id		= $utility->returnGetVar('id','');


$webAdsDtls = $webAds->getWebAdsData($web_ads_id);


if(isset($_POST['btnEditWebAds']))
{
	//hold the post data
	$selCusId 			= $_POST['selCusId'];
	//$selOrdId 			= $_POST['selOrdId'];
	//$selPackId	 		= $_POST['selPackId'];
	$txtEmail 			= $_POST['txtEmail'];
	$txtTitle 			= $_POST['txtTitle'];
	$txtUrl 			= $_POST['txtUrl'];
	$txtUrlText 		= $_POST['txtUrlText'];
	$txtDesc 			= $_POST['txtDesc'];
	$txtAdvertiserName	= $_POST['txtAdvertiserName'];
	$txtContPer 		= $_POST['txtContPer'];
	$txtPhone 			= $_POST['txtPhone'];
	$txtAdsTag 			= $_POST['txtAdsTag'];
	$selAdsStatusId 	= $_POST['selAdsStatusId'];
	//$intSortOrder 		= $_POST['intSortOrder'];
	$selFeatured 		= $_POST['selFeatured'];
	$selStartDate 		= $_POST['selStartDate'];
	$selEndDate 		= $_POST['selEndDate'];
	
	//$file  				= $_FILES['fileImg'];
	

	
	//defining error variables
	$action		= 'edit_web_ads';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $web_ads_id;
	$id_var		= 'id';
	$anchor		= 'editWebAds';
	$typeM		= 'ERROR';
	
	
	$email_id   = $error->invalidEmail($txtEmail);
	
	
	if( ($selCusId == '')  )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD003, $typeM, $anchor);
	}
	/*elseif( ($txtEmail == '') || (ereg("^ER",$email_id)) )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD002, $typeM, $anchor);
	}*/
	elseif($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD001, $typeM, $anchor);
	}
	else
	{
		
		//update webAds info	 $intSortOrder,
		$webAds->updateWebAds($web_ads_id, $selCusId, '1', '1', $txtEmail, $txtTitle, $txtUrl, $txtUrlText, $txtDesc,
								$txtAdvertiserName, $txtContPer, $txtPhone, $txtAdsTag, $selAdsStatusId,
								$selFeatured, $selStartDate, $selEndDate);
								
		
		//delete image if selected	
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($web_ads_id, 'web_ads_id' ,'../images/ads/banner/', 
								 'image', 'web_ads');
		}				   
		
		//update image
		if($_FILES['fileImage']['name'] != '')
		{
			//delete file
			$utility->deleteFile($web_ads_id, 'web_ads_id' ,'../images/ads/banner/', 
								'image', 'web_ads');
			
			//renaming the file
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$web_ads_id);
			
			//upload in the server
			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName, 
								   '../images/ads/banner/', 604, 453, 
						           $web_ads_id,'image', 'web_ads_id', 'web_ads');
		}
		
		//forward
		$uMesg->showSuccessT('success', $web_ads_id, 'id', $_SERVER['PHP_SELF'], SUWEBAD002, 'SUCCESS');

	}
}
?> 

<title><?php echo COMPANY_S; ?> - Edit  Web Site Ads</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin.css" rel="stylesheet" type="text/css">

<!--CSS Jquery Calender-->
<link rel="stylesheet" href="../style/jquery-ui.css" type="text/css" media="all" />
<!--CSS Jquery Calender-->

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/order.js"></script>

<!--Jquery Calender-->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
 <!--Jquery Calender-->
 

<!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "image,fontsizeselect,forecolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,bullist,numlist,|,outdent,indent",
		theme_advanced_buttons2 :
"undo,redo,|,emotions,|,pasteword,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->



<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_web_ads') )
	{
		$webAdsDtls = $webAds->getWebAdsData($web_ads_id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Web Ads</h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $web_ads_id; ?>" method="post" 
	  enctype="multipart/form-data" name="WebAdsForm" id="WebAdsForm">
	  
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		
		  <tr>
			<td width="97" height="25" align="left" class="menuText">
			Select Customer<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
			            
            <?php $populateArr	= array('fname','lname'); ?>
                        
             <select name="selCusId" id="selCusId" class="textBoxA" onchange="getEmailByCusId();" >
              <option value="">-- Select One --</option>
                  <?php 
                   
                         $utility->genDropDownMulCol($webAdsDtls[0],'customer_id', $populateArr, 'email', 'sort_order', 
                                                    'customer'); 
                  ?>
             </select>
            				
            </td>
			
		  </tr>
          
		  <tr>
		    <td height="25" align="left" class="menuText">Email Id<span class="orangeLetter">*</span>	</td>
		    <td height="20" align="left" class="bodyText">
            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" 
			value="<?php echo $webAdsDtls[3];?>" size="25" />
            </td>
	      </tr>
		  <tr>
		    <td height="25" align="left" class="menuText">Title<span class="orangeLetter">*</span></td>
		    <td height="20" align="left" class="bodyText">
			<input name="txtTitle" type="text" class="text_box_large" id="txtTitle" 
			value="<?php echo $webAdsDtls[4];?>" size="25" />			</td>
	      </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">
			URL 		</td>
			<td height="20" align="left" class="bodyText">
			<input name="txtUrl" type="text" class="text_box_large" id="txtUrl" 
			value="<?php echo $webAdsDtls[5];?>" size="25" />			</td>
		  </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">URL Text</td>
			<td height="20" align="left" class="bodyText">
			<input name="txtUrlText" type="text" class="text_box_large" id="txtUrlText" 
			value="<?php echo $webAdsDtls[6];?>" size="25" />			</td>
		  </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">Description</td>
			<td height="20" align="left" class="bodyText">
            <textarea name="txtDesc" type="text" class="text_box_large" id="txtDesc" size="25">
			<?php echo $webAdsDtls[7];?>
            </textarea>
            </td>
		  </tr>
		  <tr>
		    <td height="25" align="left" class="menuText">Advertiser Name</td>
		    <td height="20" align="left" class="bodyText">
			<input name="txtAdvertiserName" type="text" class="text_box_large" id="txtAdvertiserName" 
			value="<?php echo $webAdsDtls[8];?>" size="25" />			</td>
	      </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">Contact Person</td>
			<td height="20" align="left" class="bodyText">
			<input name="txtContPer" type="text" class="text_box_large" id="txtContPer" 
			value="<?php echo $webAdsDtls[9];?>" size="25" />			</td>
		  </tr>
		  <tr>
		    <td height="25" align="left" class="menuText">Phone</td>
		    <td height="20" align="left" class="bodyText">
			<input name="txtPhone" type="text" class="text_box_large" id="txtPhone" 
			value="<?php echo $webAdsDtls[10];?>" size="25" />			</td>
	      </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">Ads Tag </td>
			<td height="20" align="left" class="bodyText">
			<input name="txtAdsTag" type="text" class="text_box_large" id="txtAdsTag" 
			value="<?php echo $webAdsDtls[11];?>" size="25" />			</td>
		  </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">Ads Status</td>
			<td height="20" align="left" class="bodyText">
			<select name="selAdsStatusId" class=" textBoxA" id="selAdsStatusId">
            <option value="">-- Select --</option>
            <?php
            $utility->populateDropDown($webAdsDtls[12], 'ads_status_id',
                                           'ads_status_name', 'ads_status');
            
            ?>
            </select>	
            </td>
		  </tr>
		  
		  <tr>
			<td height="25" align="left" class="menuText">Featured</td>
			<td height="20" align="left" class="bodyText">
			 <?php 
			 $arr_value = array('Y','N');
			 $arr_label = array('Yes','No');
			 ?>
			 <select name="selFeatured" id="selFeatured" class="textBoxA">
			 <option value="">-- Select One --</option>
			 <?php 
				
					$utility->genDropDown($webAdsDtls[15], $arr_value, $arr_label); 
				
			 ?>
			 </select>		</td>
		  </tr>
		  
          
          <script>
			$(function() {
				$( "#selStartDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
				$( "#selEndDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
			});
		 </script>
         
		  <tr>
			<td height="25" align="left" class="menuText">Start Date</td>
			<td height="20" align="left" class="bodyText">
			<input name="selStartDate" type="text" class="text_box_large" id="selStartDate" 
            value="<?php echo $dateUtil->printDate($webAdsDtls[16]);?>" />
            </td>
		  </tr>
          
		  <tr>
		    <td height="25" align="left" class="menuText">End Date</td>
		    <td height="20" align="left" class="bodyText">
			<input name="selEndDate" type="text" class="text_box_large" id="selEndDate" 
            value="<?php echo $dateUtil->printDate($webAdsDtls[17]);?>" />
            </td>
	      </tr>
		  
		  
		  
		  <tr>
			<td height="25" align="left" class="menuText">Image</td>
			<td height="20" align="left">
			<input name="fileImage" type="file" class="text_box_large" id="fileImage">
			<span class="orangeLetter">* ( 200 pixels &times; 200 pixels) </span>			</td>
		  </tr>
		  
		  <tr>
			<td width="97" align="left" class="menuText">&nbsp;</td>
			<td height="20" align="left">
			<?php 
			if( ($webAdsDtls[2] != '' ) && (file_exists("../images/ads/banner/".$webAdsDtls[2])) )
			{
				echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\"> 
				<span class='blackLarge'>Delete this image</span>"; 
			}
			?></td>
		  </tr>
		  
		  <tr>
		    <td align="left" class="menuText">&nbsp;</td>
		    <td height="20" align="left">&nbsp;</td>
	      </tr>
		  
		  <tr>
			<td width="97" class="menuText">&nbsp;</td>
			<td height="25" align="left">
			<input name="btnEditWebAds" type="submit" class="button-add" id="btnEditWebAds" 
			value="edit" />
			<input name="btnCancel" type="button" class="button-add" id="btnCancel" 
			onClick="self.close()" value="cancel" />			</td>
		  </tr>
		  
		  <tr>
			<td width="97">&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		</table>

	  </form>
	  </td>
	</tr>
	<?php 
	}//eof
	?>
</table>
