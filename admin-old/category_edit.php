<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php"); 
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$cat_id		= $utility->returnGetVar('cat_id','');

if(isset($_SESSION['parent_id'])){
  $_SESSION['parent_id'] = '';
}

if(isset($_POST['btnEditCat'])){
	$parent_id 	= $_POST['txtParentId'];
	$cat_name 	= $_POST['txtCatName'];
	$seo_url 	= $_POST['txtSeoUrl'];
	$file  		= $_FILES['fileCatImg'];
	$txtCatDesc = $_POST['txtCatDesc'];
	$intSort	= $_POST['intSort'];
	
	
	//defining error variables
	$action		= 'edit_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cat_id;
	$id_var		= 'cat_id';
	$anchor		= 'editCat';
	$typeM		= 'ERROR';
		
	$duplicate = $error->duplicateCat($parent_id, $cat_name, $cat_id, 'categories');
	
	if($cat_name == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT202, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT201, $typeM, $anchor);
	}
	else
	{
		//edit category
		$category->editCategory($parent_id, $cat_name, $seo_url, "", "", "", $txtCatDesc, $intSort, $cat_id, 'categories');
		
		//update static image field		
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($cat_id, 'categories_id' ,'../images/category/', 'categories_image', 'categories');
		}
		
		if($_FILES['fileCatImg']['name'] != '')
		{
			//delete the file
			$utility->deleteFile($cat_id, 'categories_id' ,'../images/category/', 'categories_image', 'categories');
			
			//rename the file
			$newName = $utility->getNewName4($_FILES['fileCatImg'], '',$cat_id);
			
			//upload and crop the file
			/*$uImg->imgCropResize($_FILES['fileCatImg'], '', $newName, 
								 '../images/category/', 140, 140, 
						         $cat_id,'categories_image', 'categories_id', 'categories');*/
			$uImg->imgUpdResize($_FILES['fileCatImg'], '', $newName, 
								 '../images/category/', 500, 255, 
						         $cat_id,'categories_image', 'categories_id', 'categories');
		}
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUCAT204, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> -  - Edit Category</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

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

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_cat')  )
    {
        $catDetail = $category->categoryData($cat_id, 'categories');
    ?>
    	<h3>Edit Category </h3>

        <form action="<?php $_SERVER['PHP_SELF']?>?cat_id=<?php echo $cat_id; ?>" method="post" enctype="multipart/form-data">
            <label>Parent Category</label>
            <select name="txtParentId" id="txtParentId">
              <option value="0">Top Level</option>
              <?php
							  if(isset($_GET['parent_id']))
							  {
								$category->categoryDropDown(0,0,$_GET['parent_id'],'ADD',0,'categories');
							  }
							  elseif(isset($_SESSION['parent_id']))
							  {
								$category->categoryDropDown(0,0,$_SESSION['parent_id'],'ADD',0,'categories');
							  }
							  else
							  {
								$category->categoryDropDown(0,0,$catDetail[2],'EDIT',0,'categories');
							  }
							  ?>
              <?php
                //$category->categoryDropDown(0,0,$catDetail[2],'edit',$cat_id);
              ?>
            </select>
            <div class="cl"></div>
    
            <label>Category Name <span class="orangeLetter">*</span></label>
            <input name="txtCatName" type="text" id="txtCatName" onBlur="makeCatSEOURL()" size="25" 
            value="<?php echo $catDetail[0];?>">            
    
            <?php 
                if( ($catDetail[1] != '') && (file_exists("../images/category/".$catDetail[1])) )
                {
                  echo "&nbsp;<img src='../images/category/".$catDetail[1]."' height='100' width='100'>";
                }
            ?> 
            <div class="cl"></div>
            
            <label>Seo Url<span class="orangeLetter">*</span></label>
            <input name="txtSeoUrl" type="text" id="txtSeoUrl" size="25" class="text_box_large" maxlength="3"
            value="<?php  echo $catDetail[10]; ?>" />
            <div class="cl"></div>
            
            <label>Sort Order</label>
            <input name="intSort" type="text" id="intSort" size="25" class="text_box_large" maxlength="3"
            value="<?php  echo $catDetail[3]; ?>" />
            <div class="cl"></div>
    
            <label>Description</label>
            <textarea name="txtCatDesc" cols="35" rows="5">
            <?php echo $catDetail[6];?>
            </textarea> 
            <div class="cl"></div> 
            
            <label>Category Image </label>
            <input name="fileCatImg" type="file" id="fileCatImg" />
            
            <?php 
            if( ($catDetail[1] != '' ) && (file_exists("../images/category/".$catDetail[1])) )
            {
                echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\"> 
                <span class='blackLarge'>Delete this image</span>"; 
            }
            ?>
            <div class="cl"></div>
    
            <input name="btnEditCat" type="submit" class="button-add" id="btnEditCat" value="edit" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" 
            value="cancel" />
        
        </form>

    <?php 
    }
    ?>
</div>