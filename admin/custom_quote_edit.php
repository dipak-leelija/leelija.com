<?php 
session_start();
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/quote.inc.php");


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/custom_quote.class.php");
require_once("../classes/customer.class.php");
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$custom_quote	= new CustomQuote();
$customer		= new Customer();
$search_obj		= new Search();
$page			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();



/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$quote_id	= $utility->returnGetVar('id','');

$quoteDtl = $custom_quote->getCustomQuoteData($quote_id);


if(isset($_POST['btnEditQuote']))
{
	//hold the post data
	
	$selProdId 				= $_POST['selProdId'];
	$selMaterialId 			= $_POST['selMaterialId'];
	$txtColor 				= $_POST['txtColor'];
	$intQuant 				= $_POST['intQuant'];
	$txtSizeA 				= $_POST['txtSizeA'];
	$txtSizeB 				= $_POST['txtSizeB'];
	$txtSizeC 				= $_POST['txtSizeC'];
	$txtSizeD 				= $_POST['txtSizeD'];
	$selEmbroideryId 		= $_POST['selEmbroideryId'];
	$txtDesc 				= $_POST['txtDesc'];
	
	
	//defining error variables
	$action		= 'edit_custom_quote';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $quote_id;
	$id_var		= 'id';
	$anchor		= 'editQuote';
	$typeM		= 'ERROR';
	
	
	
	if($selProdId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE001, $typeM, $anchor);
	}
	elseif($selMaterialId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE003, $typeM, $anchor);
	}
	elseif($txtColor == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE004, $typeM, $anchor);
	}
	elseif($intQuant == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE005, $typeM, $anchor);
	}
	elseif($txtSizeA == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE006, $typeM, $anchor);
	}
	elseif($txtSizeB == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE007, $typeM, $anchor);
	}
	elseif($txtSizeC == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE008, $typeM, $anchor);
	}
	elseif($txtSizeD == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE009, $typeM, $anchor);
	}
	else
	{
		
			$custom_quote->updateCustomQuote($quote_id, $selProdId, $selMaterialId, $txtColor, $intQuant, $txtSizeA,
											 $txtSizeB, $txtSizeC, $txtSizeD, $selEmbroideryId, $txtDesc); 
		
		
		//delete image if selected	
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($quote_id, 'custom_quote_id' ,'../images/custom_quote/', 
								 'image', 'custom_quote');
		}				   
		
		//update image
		if($_FILES['fileImage']['name'] != '')
		{
			//delete file
			$utility->deleteFile($quote_id, 'custom_quote_id' ,'../images/custom_quote/', 
								'image', 'custom_quote');
			
			//renaming the file
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$quote_id);
			
			//upload in the server
			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName, 
								   '../images/custom_quote/', 604, 453, 
						           $quote_id,'image', 'custom_quote_id', 'custom_quote');
		}
		
		//forward
		$uMesg->showSuccessT('success', $quote_id, 'id', $_SERVER['PHP_SELF'], SUQUOTE002, 'SUCCESS');

	}
}
?> 

<title><?php echo COMPANY_S; ?> - Edit  Custom Quote</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_custom_quote') )
	{
		$quoteDtl = $custom_quote->getCustomQuoteData($quote_id);
	?>
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Custom Quote</h3></td>
	</tr>
	<tr>
	  <td>
	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $quote_id; ?>" method="post" 
	  enctype="multipart/form-data">
	  
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		
		  <tr>
			<td width="97" height="25" align="left" class="menuText">
			Model<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
			<select name="selProdId" class=" textBoxA" id="selProdId">
            <option value="">-- Select --</option>
                <?php
                $utility->populateDropDown($quoteDtl[1], 'product_id', 'product_name', 'product_description');
               
                ?>
            </select>			
            </td>
			<td width="170" rowspan="21" align="center" valign="top">
			
			<?php 
			if( ($quoteDtl[13] != '') && (file_exists("../images/custom_quote/".$quoteDtl[13])) )
			{
				echo '<div align="center">';
				echo $utility->imageDisplay2('../images/custom_quote/', $quoteDtl[13], 100, 100, 0,
											 'greyBorder', 'Image'); 
				echo '</div>';
			}
			?>
			</div>			</td>
		  </tr>
		  
		  <tr>
            <td width="97" height="25" align="left" class="menuText">
			Material<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <select name="selMaterialId" class=" textBoxA" id="selMaterialId">
            <option value="">-- Select --</option>
                <?php
                $utility->populateDropDown($quoteDtl[2], 'material_id', 'title', 'material');
               
                ?>
            </select>            </td>
          </tr>
          <tr>
           <td width="97" height="25" align="left" class="menuText">
			Color<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="txtColor" type="text" id="txtColor" class="text_box_large"
              value="<?php echo $quoteDtl[3]; ?>" />             </td>
          </tr>
         
                        
           <tr>             
           <td width="97" height="25" align="left" class="menuText">
			Quantity<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="intQuant" type="text" id="intQuant" class="text_box_large"
              value="<?php echo $quoteDtl[4]; ?>" />             </td>
          </tr>
          <tr>
          <td width="97" height="25" align="left" class="menuText">
			Size A<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="txtSizeA" type="text" id="txtSizeA" class="text_box_large"
              value="<?php echo $quoteDtl[5]; ?>" />             </td>
          </tr>
          
          <tr>
          <td width="97" height="25" align="left" class="menuText">
			Size B<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="txtSizeB" type="text" id="txtSizeB" class="text_box_large"
              value="<?php echo $quoteDtl[6]; ?>" />             </td>
          </tr>
          
          <tr>
          <td width="97" height="25" align="left" class="menuText">
			Size C<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="txtSizeC" type="text" id="txtSizeC" class="text_box_large"
              value="<?php echo $quoteDtl[7]; ?>" />             </td>
          </tr>
          
          <td width="97" height="25" align="left" class="menuText">
			Size D<span class="orangeLetter">*</span>			</td>
			<td width="225" height="20" align="left" class="bodyText">
            <input name="txtSizeD" type="text" id="txtSizeD" class="text_box_large"
              value="<?php echo $quoteDtl[8]; ?>" />             </td>
          </tr>
          
          
          <tr>
          <td width="97" height="25" align="left" class="menuText">
			Embroidery</td>
			<td width="225" height="20" align="left" class="bodyText">
            <select name="selEmbroideryId" class=" textBoxA" id="selEmbroideryId">
            <option value="0">-- Select --</option>
            <?php
            
                $utility->populateDropDown($quoteDtl[9], 'embroidery_id', 'title', 'embroidery');
                        ?>
            </select>             </td>
          </tr> 
          
                    
		  <tr>
			<td height="25" align="left" class="menuText">
			Additional Comment	</td>
			<td height="20" align="left" class="bodyText">
			<textarea name="txtDesc"  id="txtDesc" cols="30" rows="4">
			<?php echo $quoteDtl[10]; ?></textarea>
			<script language="JavaScript">
              WYSIWYG.attach('txtDesc', full);
            </script>			</td>
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
			if( ($quoteDtl[2] != '' ) && (file_exists("../images/custom_quote/".$quoteDtl[2])) )
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
			<input name="btnEditQuote" type="submit" class="buttonYellow" id="btnEditQuote" 
			value="edit" />
			<input name="btnCancel" type="button" class="buttonYellow" id="btnCancel" 
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
