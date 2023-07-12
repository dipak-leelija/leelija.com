<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/image.inc.php");  

require_once("../classes/adminLogin.class.php"); 


require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 

require_once("../classes/location.class.php");
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utility.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$lc		 		= new Location();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();


$dateUtil      	= new DateUtil();
$error 			= new Error();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$utility		= new Utility();

#############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


if(isset($_GET['album_id']))
{
	$album_id = $_GET['album_id'];
	
}

//get album location data
$albumId 	 = 0;

if(isset($_GET['album_id']))
{
	$albumId  		= $_GET['album_id'];
	$albumDetail 	= $album->showAlbum($albumId);
}

if(isset($_POST['btnEditAlbum']))
{
	//post vars
	$txtParentId	=  $_POST['txtParentId'];
	$txtName		=  $_POST['txtName'];
	$txtDesc		=  $_POST['txtDesc'];
	$userId			=  (int)$_POST['userId'];
	$img			=  $_FILES['fileImage']['name'];
	$intOrder		=  $_POST['intOrder'];
	$dateShotOn		=  $_POST['dateShotOn'];
	$album_id 		=  $_GET['album_id'];
	
	$selType		=  $_POST['selType'];
	$selTypeId		=  $_POST['selTypeId'];
	
	//defining error variables
	$action		= 'editAlbum';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $album_id;
	$id_var		= 'album_id';
	$anchor		= 'editAlbum';
	$typeM		= 'ERROR';
	
	//check for error
	$duplicate = $error->duplicateCat($parent_id, $cat_name, $cat_id,'album');
	
	//check conditions for error
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG103, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT201, $typeM, $aname);
	}
	else
	{
		//edit album	
		$alId = $album->editAlbum($album_id, $txtParentId, $txtName, $txtDesc, $userId,
					     	      $dateShotOn, $intOrder, $selType, $selTypeId);
		
		
		//upload image
		if($_FILES['fileImage']['name'] != '')
		{
			//delete the image
			$utility->deleteFile($album_id,'categories_id','../images/gallery/album/',
							     'categories_image', 'album');
			
			//rename the new image
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$albumId);
				
			//image update and resize
			$uImg->imgCropResize($_FILES['fileImage'],'',$newName, '../images/gallery/album/', 
								 800, 600, $album_id,'categories_image', 'categories_id', 'album');
		}
		
	  //forward
	  $uMesg->showSuccessT('success', $album_id, 'album_id',$_SERVER['PHP_SELF'], SUIMG102,'SUCCESS');
	  
	}
}
?>

<title><?php echo COMPANY_S; ?> - Album Edit</title>

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
<script type="text/javascript" src="../js/image.js"></script>
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
    if( (isset($_GET['action'])) && ($_GET['action'] == 'editAlbum') )
    {
        $albumDtl 	= $album->showAlbum($album_id);			
    ?>
    <h4>Edit Album </h4>
    <form name="formEditAlbum" id="formEditAlbum" method="post" enctype="multipart/form-data"
    action="<?php $_SERVER['PHP_SELF']?>?album_id=<?php echo $album_id; ?>" >
        <label>Select Album / Category <span class="orangeLetter">*</span></label>
        <select name="txtParentId" class="textBoxA" id="txtParentId">
          <option value="0">Top Level</option>
          <?php $category->getRootCatListEdit($album_id, $albumDtl[10], 'album');?>
        </select>
        <div class="fr">
            <?php 
            if(($albumDtl[2] != '') || ($albumDtl[2] != NULL) && 
            (file_exists("../images/gallery/album/".$albumDtl[2])))
            {
              echo "<img src='../images/gallery/album/".$albumDtl[2]."' 
              height='75' width='100' />";
            }
            ?>
        </div>	
        <div class="cl"></div>	  
    
        <label>Select Type</label>
        <select name="selType" id="selType" class="textBoxA"  onchange="getTypeIdList()">
        <option value="0">-- Select One --</option>
        <?php 
            $utility->populateDropDown($albumDtl[11],'constant_code','constant_code',
                                           'album_type');
           
        ?>
        </select>
        <div class="cl"></div>
      
    
        <?php 
            $album->genAlbumTypeIds($albumDtl[11], $albumDtl[12]);
        ?>
        <div class="cl"></div>
        
        <label>Album Name <span class="orangeLetter">*</span></label>
        <input name="txtName" type="text" class="text_box_large" id="txtName" 
        value="<?php echo $albumDtl[0];?>" />  
        <span id="resAltCat"></span>
        <div class="cl"></div>
        
        <label>Sort Order</label>
        <input name="intOrder" type="text" class="text_box_large" id="intOrder"
        value="<?php $utility->printSess2('intOrder', $albumDtl[9]); ?>" maxlength="3"  
        onKeyPress="return intOnly(this, event)"/>
        (integer from 1 to 999)
        <div class="cl"></div>
         
        <label>Photoshot/Work On</label>
        <div class="fl">
        <input name="dateShotOn" type="text" class="text_box_large" id="dateShotOn" readonly=""
        value="<?php $utility->printSess2('dateShotOn', $albumDtl[8]); ?>" />
        </div>
        <div class="fl padT2 padL5">
            <a title="Select Date from Calendar" style="cursor:pointer; "
            onClick="displayCalendar(document.formEditAlbum.dateShotOn,'yyyy-mm-dd',this); return false;"> 
            <img src="../js/js_calendar/images/cal.gif" width="16" height="16" 
            class="curP" value="Cal" />			  </a>			 
        </div>
        <div class="cl"></div>
            
        <label>Description</label>
        <textarea name="txtDesc" cols="55" rows="10" class="textAr" id="txtDesc">
        <?php echo str_replace("<br />",'',stripslashes($albumDtl[1]));?>
        </textarea>
        <div class="cl"></div>
        
        <label>Image</label>
        <input name="fileImage" type="file" class="text_box_large" />
        <div class="cl"></div>
        
        <input name="userId" type="hidden" id="userId" value="<?php echo $albumDtl[5] ?>" />
        <input name="btnEditAlbum" type="submit" class="button-add" id="btnEditCat" 
        value="edit" />
        <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
        onclick="self.close()" value="cancel" />		 
    
    </form>
    
    <?php 
    } //eof
    ?>
</div>