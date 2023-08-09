<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/testimonial.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/rating.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$rating			= new Rating();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility(); 
$utility		= new Utility();

#####################################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


if(isset($_POST['btnEdit']))
{
	$txtName		=  $_POST['txtName'];
	$txtEmail		=  $_POST['txtEmail'];
	$txtAdd			=  $_POST['txtAdd'];
	$txtDesc		=  $_POST['txtDesc'];
	$intSort		=  $_POST['intSort'];
	$radioStatus	=  $_POST['radioStatus'];
	
	//added on July 21, 2010
	$txtDesg		= $_POST['txtDesg'];
	
	//added on June 20, 2011
	$intIPO			= $_POST['intIPO'];

	//get the dropdown values
	$listBox 		= $rating->genListBoxName();
	
	//defining error variables
	$action		= 'edit';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'editTestimonial';
	$typeM		= 'ERROR';

	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTESTM002, $typeM, $anchor);
	}
	else if( ($txtDesc == '') || (strlen($txtDesc) < 8) )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTESTM003, $typeM, $anchor);
	}
	else
	{
		//update the guest field
		$rating->updateGuestRate($id, $txtName, $txtDesg, $txtEmail, $txtAdd, $txtDesc, $radioStatus, $intSort, $intIPO);

		//edit guest rating section
		if(count($listBox) > 0)
		{
			foreach($listBox as $k)
			{
				if(isset($_POST[$k]))
				{
					$listVal	= $_POST[$k];
					$rating_id	= strrev(substr(strrev($k),1));

					//edit rating
					$rating->updateGuestRateDtl($id, $rating_id, $listVal);
				}
			}
		}

		//guest image
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			//delete the guest image
			$utility->deleteFile($id, 'guest_id' ,'../images/upload/rating/', 'person_img', 'guest');
		}

		if($_FILES['fileImage']['name'] != '')
		{
			//delete the guest image
			$utility->deleteFile($id, 'guest_id' ,'../images/upload/rating/', 'person_img', 'guest');
			//image update
			$newName  = $utility->getNewName4($_FILES['fileImage'], '', $id);

			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName,'../images/upload/rating/', 
					  			   200, 200, $id, 'person_img', 'guest_id', 'guest');
		}//person image

		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUTESTM002, 'SUCCESS');
	}

}
?>

<title><?php echo COMPANY_S; ?> - Guest  Rating Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

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


<div class="popup-form">
	<?php 
	//show message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
	{
		$ratingDtl = $rating->getGuestData($id);
	?>
		<h3>Edit Rating </h3>

        <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post" 
        enctype="multipart/form-data">
			
            <label>Person Name <span class="orangeLetter">*</span></label>
              <input name="txtName" type="text" class="text_box_large" id="txtName" 
                value="<?php echo $ratingDtl[0]; ?>" />
            <div class="cl"></div>
            
            <label>Designation</label>
            <input name="txtDesg" type="text" class="text_box_large" id="txtDesg" 
            value="<?php echo $ratingDtl[9]; ?>" />
            <div class="cl"></div>	
        
            <label>Email</label>
            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" 
            value="<?php echo $ratingDtl[1]; ?>" />
            <div class="cl"></div>	
            
            <label>Address</label>
            <input name="txtAdd" type="text" class="text_box_large" id="txtAdd" 
            value="<?php echo $ratingDtl[2]; ?>" />
            <div class="cl"></div>
            
            <label>Intra Page Order </label>
            <input name="intIPO" type="text" class="text_box_large" id="intIPO" 
            value="<?php echo $ratingDtl[10]; ?>" />
            <div class="cl"></div>
            
            <label>Sort Order </label>
            <input name="intSort" type="text" class="text_box_large" id="intSort" 
            value="<?php echo $ratingDtl[6]; ?>" />
            <div class="cl"></div>
            
            <label>Status</label>
                  <input name="radioStatus" type="radio" value="a" 
                  <?php echo $utility->checkString($ratingDtl[5],'a');?> />
                  Active
                  <input name="radioStatus" type="radio" value="d"  
                  <?php echo $utility->checkString($ratingDtl[5],'d');?> /> 
                  Inactive
            <div class="cl"></div>	      
        
          <?php /*?><tr>
            <td align="left" class="menuText">Rating</td>
            <td height="20" colspan="2" align="left" class="pad5">
                <?php $rating->dispRateSysEdit($id); ?>			</td>
          </tr><?php */?>

            <label>Comments<span class="orangeLetter">*</span></label>
            <textarea name="txtDesc" cols="35" rows="5" id="txtDesc">
            <?php echo stripslashes($ratingDtl[3]); ?>
            </textarea>				 
            <div class="cl"></div>	

            <label>Person Photo </label>
            <input type="file" name="fileImage" />
            
              <?php 
                    $utility->imgDisplay('../images/upload/rating/', $ratingDtl[4], 
                                    100, 100, 0, 'greyBorder', $ratingDtl[0], "No Image ");
                ?>
            <div class="cl"></div>	
  
            <?php 
            if($ratingDtl[4] != '')
            {
                echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\"> Delete this image";
            }//
        
            ?>
            <div class="cl"></div>	

            <input name="btnEdit" type="submit" class="button-add" id="btnEdit" value="edit" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />			</td>

        </form>
	  <!-- End Form -->

	<?php 
	}//eof
	?>
</div>