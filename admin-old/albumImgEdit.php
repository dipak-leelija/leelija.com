<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php");
require_once("../includes/constant.inc.php");
require_once("../includes/image.inc.php");
 
require_once("../classes/adminLogin.class.php");  
require_once("../classes/category.class.php"); 
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");
 
require_once("../classes/error.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");
require_once("../classes/utilityImage.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
////////////////////////////////////////////////////////////////////////////////////////

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_GET['image_id']))
{
	$image_id = $_GET['image_id'];
}



if(isset($_GET['image_id']))
{
	$imgId  		= $_GET['image_id'];
	$imgDetail 		= $photo->showImage($imgId);
}

if(isset($_POST['btnEditAlbumImg']))
{
	$selectAlbum	=  addslashes($_POST['selectAlbum']);
	$txtName		=  addslashes($_POST['txtName']);
	$txtDesc		=  addslashes($_POST['txtDesc']);
	$userId			=  addslashes((int)$_POST['userId']);
	$img			=  $_FILES['fileImage']['name'];
	$intOrder		=  $_POST['intOrder'];
	$dateShotOn		=  $_POST['dateShotOn'];
	$selMediaType		=  $_POST['selMediaType'];
	
	//defining error variables
	$action		= 'editImg';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $image_id;
	$id_var		= 'image_id';
	$anchor		= 'editImg';
	$typeM		= 'ERROR';
	
	
	//check for error
	if($selectAlbum == 0)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG201, $typeM, $anchor);
	}
	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG202, $typeM, $anchor);
	}
	else
	{
		//update images
		$photo->editImage($image_id,$selectAlbum,$txtName,$txtDesc,$userId,	$dateShotOn, $intOrder,$selMediaType);
		
		if($_FILES['fileImage']['name'] != '')
		{
			//delete thumbnail image
			$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/thumbnail/', 'im_thumbnail', 'album_image');
			
			//delete gallery image
			$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/gallery/', 'im_image', 'album_image');
			
			//delete 800 image
			$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/800/', 'im_800', 'album_image');
			
			//delete main image
			$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/original/', 'im_original', 'album_image');
						
			
			
			//name of the image 
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$_GET['image_id']);
			
			
			//start uploading images
			//gallery image	
			/*$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/gallery/', 
								   550, 252, $image_id, 'im_image', 'im_id', 'album_image');*/
								   
			//thumbnail image	
			$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/thumbnail/', 
									 212, 157, $image_id, 'im_thumbnail', 'im_id', 'album_image');
			
			
			//gallery image	
			$uImg->imgUpdResize($_FILES['fileImage'],'',$newName,'../images/gallery/gallery/', 
								600, 600, $image_id, 'im_image', 'im_id', 'album_image');
							   
			
			//800 by 800 	
			$uImg->imgUpdResize($_FILES['fileImage'],'',$newName,'../images/gallery/800/', 
								   800, 800, $image_id, 'im_800', 'im_id', 'album_image');
			
			//original image	
			$utility->fileUpload2($_FILES['fileImage'], '', $newName , '../images/gallery/original/', 
								   $image_id, 'im_original', 'im_id', 'album_image');							   
						
			
		}
		
		//forward
	  	$uMesg->showSuccessT('success',$image_id,'image_id',$_SERVER['PHP_SELF'],SUIMG202,'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Edit Photograph</title>

<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
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
<script type="text/javascript" src="../js/activity.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<!-- eof JS Libraries -->

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
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'editImg') )
	{
		$imageDtl = $photo->showImage($image_id);
	?>
	<h4>Edit Image </h4>

	  <form action="<?php $_SERVER['PHP_SELF']?>?image_id=<?php echo $image_id; ?>" 
	  method="post" enctype="multipart/form-data" name="formEditImage" id="formEditImage">

            <label>Album</label>
            <select name="selectAlbum" class="textBoxA">
              <?php $utility->populateDropDown($imageDtl[0], 'categories_id', 'categories_name',
                                               'album'); 
              ?>
            </select>
            <div class="fr">
				<?php 
                if(($imageDtl[3] != '') || ($imageDtl[3] != NULL) && (file_exists("../images/gallery/gallery/".$imageDtl[3])))
                {
                    echo $utility->imageDisplay2('../images/gallery/gallery/', $imageDtl[3], 86, 140, 0, '', 
                                                 $imageDtl[1]);
                }
                ?>
            </div>
            <div class="cl"></div>
            
            <label>Media Type</label>
			<?php 
            $arr_value	= array('IMG', 'VIDEO', 'AUDIO'); 
            $arr_label  = array('Image', 'Video', 'Audio');
           ?>
            <select name="selMediaType" id="selMediaType" class="textBoxA">
            
            <?php 
         
                $utility->genDropDown($imageDtl[14], $arr_value, $arr_label);
           
            ?>
            </select>
            <div class="cl"></div>
          
		    <label>Name</label>
            <input name="txtName" type="text" id="txtName" value="<?php echo $imageDtl[1];?>"
               class="text_box_large" />
            <div class="cl"></div>

		    <label>Sort Order</label>
			<input name="intOrder" type="text" class="text_box_large" id="intOrder"
			 value="<?php $utility->printSess2('intOrder', $imageDtl[13]); ?>" maxlength="3"  
			 onKeyPress="return intOnly(this, event)"/>
			 (integer from 1 to 999)
            <div class="cl"></div>
             
		    <label>Photoshot/Work On</label>
			 <div class="fl">
			 <input name="dateShotOn" type="text" class="text_box_large" id="dateShotOn" readonly=""
			 value="<?php $utility->printSess2('dateShotOn', $imageDtl[12]); ?>" />
			 </div>
			 <div class="fl padT2 padL5">
			  <a title="Select Date from Calendar" style="cursor:pointer; "
			  onClick="displayCalendar(document.formEditImage.dateShotOn,'yyyy-mm-dd',this); return false;"> 
				<img src="../js/js_calendar/images/cal.gif" width="16" height="16" 
				class="curP" value="Cal" />			  
			  </a>			 
			 </div>
			 <div class="cl"></div>
		
		     <label>Description</label>
			 <textarea name="txtDesc" cols="50" rows="9" id="txtDesc" class="textAr">
			 <?php echo $imageDtl[2];?>
			 </textarea>
             <div class="cl"></div>

			 <label>Image</label>
             <input type="file" name="fileImage" id="fileImage" class="text_box_large" /> 
             <div class="cl"></div>

			<input name="userId" type="hidden" id="userId" value="<?php echo $imageDtl[7] ?>">
			<input name="btnEditAlbumImg" type="submit" class="button-add" id="btnEditAlbumImg" 
            value="edit" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />
	  </form>

	<?php 
	}//if
	?>
</div>