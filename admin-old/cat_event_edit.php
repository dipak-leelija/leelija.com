<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");  
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

####################################################################################

$typeM		= $utility->returnGetVar('typeM','');
$cat_id		= $utility->returnGetVar('id','');


if(isset($_SESSION['parent_id']))
{
  $_SESSION['parent_id'] = '';
}

if(isset($_POST['btnEditCat']))
{
	$parent_id 		= $_POST['txtParentId'];
	$cat_name 		= $_POST['txtCatName'];
	$txtURL			= $_POST['txtURL'];
	$txtBrief 		= $_POST['txtBrief'];
	$txtPageTitle 	= $_POST['txtPageTitle'];
	$txtDesc 		= $_POST['txtDesc'];
	$file  			= $_FILES['fileCatImg'];
	
	//defining error variables
	$action		= 'edit_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cat_id;
	$id_var		= 'id';
	$typeM		= 'ERROR'; 
	$anchor		= '';
	
	
	$duplicate = $error->duplicateCat($parent_id, $cat_name, $cat_id,'event_categories');
	
	if($cat_name == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT202, $typeM, $aname);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT201, $typeM, $aname);
	}
	else
	{
		
		//edit category
		$catId = $category->editCategory($parent_id, $cat_name, $txtURL, $txtBrief, $txtPageTitle, $txtDesc, 10, $cat_id,'event_categories');
									
									 
		
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($cat_id, 'categories_id' ,'../images/category/', 'categories_image', 'event_categories');
								
		}
		
		if($_FILES['fileCatImg']['name'] != '')
		{
			$utility->deleteFile($cat_id,'categories_id','../images/category/','categories_image', 
								'event_categories');
								
			$newName = $utility->getNewName2($_FILES['fileCatImg'], 'STATCAT',$cat_id,$cat_name);
				
			$uImg->imgUpdResize($_FILES['fileCatImg'],'STATCAT',$newName,'../images/category/', 
					 200, 200, $cat_id,'categories_image', 'categories_id', 'event_categories');
							   
		}
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $_SERVER['PHP_SELF'], SUCAT204, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Edit Category</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<!-- Javascript Libraries -->
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 


<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/category.js"></script>

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

<!-- eof JS Libraries --> 

<div class="popup-form">
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
		if($_GET['action'] == 'edit_cat')
		{
			
			$catDetail = $category->categoryData($cat_id, 'event_categories');
	?>

	<h3>Edit Category </h3>

    <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $cat_id; ?>" 
    method="post" enctype="multipart/form-data">
    	<label>Parent Cat</label>
        <select name="txtParentId" class=" textBoxA" id="txtParentId">
          <option value="0">Top Level</option>
          <?php
            $category->categoryDropDown(0, 0 ,$catDetail[2],'edit',0,'event_categories');
          ?>
        </select>
        <div class="cl"></div>
        
        <label>Name <span class=" orangeLetter">*</span></label>
        <input name="txtCatName" type="text" class="text_box_large" id="txtCatName" 
        value="<?php echo $catDetail[0];?>" size="25" />
        <div class="cl"></div>
        

        <label>Link or URL</label>
        <input name="txtURL" type="text" class="text_box_large" id="txtURL"
        value="<?php echo $catDetail[8]; ?>" size="25" />
        <div class="cl"></div>
        
        <label>Tagline or Brief</label>
        <input name="txtBrief" type="text" class="text_box_large" id="txtBrief"
        value="<?php echo $catDetail[7]; ?>" size="25" />
        <div class="cl"></div>
        
        <label>Page Title</label>
        <input name="txtPageTitle" type="text" class="text_box_large" id="txtPageTitle"
        value="<?php echo $catDetail[9]; ?>" size="25" />
        <div class="cl"></div>
        
        <label>Description</label>
        <textarea name="txtDesc" cols="60" rows="10" class="textAr" id="txtDesc">
        <?php echo stripslashes(trim(str_replace('<br />','',$catDetail[6]))); ?>
        </textarea>
        <div class="cl"></div>

        <label>Image </label>
        <input name="fileCatImg" type="file" class="text_box_large" id="fileCatImg" />
        (200 pixels &times; 200 pixels in width by height)             

        <?php 
            if(($catDetail[5] != '') || ($catDetail[5] != NULL) && (file_exists("../images/category/".$catDetail[5])))
            {
              echo "&nbsp;
              <img src='../images/category/".$catDetail[5]."' height='100' width='100' />";
            }
        ?>
        <div class="cl"></div>
        <?php 
        if($catDetail[5] != '')
        {
            echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\" /> 
                 Delete this image";	 
        }//
        ?>
        <input name="btnEditCat" type="submit" class="button-add" id="btnEditCat" value="edit" /> 
        
        <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />            

    
    </form>

	<?php }
	}
	?>
</div>