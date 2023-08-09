<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/subscriber.inc.php");

 
require_once("../classes/adminLogin.class.php"); 
include_once("../classes/countries.class.php"); 
include_once("../classes/subscriber.class.php"); 

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$country		= new Countries();
$subscribe		= new EmailSubscriber();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


//edit cat
if(isset($_POST['btnEditCat']))
{
	$cat_name	= $_POST['cat_name'];
	$txtCatDesc = $_POST['txtCatDesc'];
	
	
	//page forward variables
	$action		= 'edit_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'editCat';
	$typeM		= 'ERROR';
	
	//check error
	$duplicate = $error->duplicateEntry($cat_name, 'title', 'email_categories', 'YES', $_GET['id'], 'cat_id');
	
	
	if($cat_name == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC102, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC103, $typeM, $anchor);
	}
	else
	{
		//update category
		$subscribe->updateCategory($id, $cat_name, $txtCatDesc);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $url , SUSUBSC102, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Email Group Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>

<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<SCRIPT type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script> 

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
    if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_cat') )
    {
        $catDetail 	= $subscribe->getCategoryData($id);
    ?>
    	<h3>Edit Group </h3>

        <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" 
        method="post" enctype="multipart/form-data">

            <label>Group Name </label>
            <input name="cat_name" type="text" class="text_box_large" id="cat_name" 
            value="<?php echo $catDetail[0];?>" size="25">
            <div class="cl"></div>
            
            <label>Description</label>
            <textarea  name="txtCatDesc" id="txtCatDesc" >
            <?php echo $catDetail[1];?>
            </textarea>
            <div class="cl"></div>
            
            <?php /*?><textarea name="txtCatDesc"  cols="35" rows="5" class="textAr" id="txtCatDesc">
            <?php echo $catDetail[1];?>
            </textarea>
            <script language="JavaScript">
              generate_wysiwyg('txtCatDesc');
            </script><?php */?>					

            <input name="btnEditCat" type="submit" class="button-add" id="btnEditCat" value="edit" />
            <input name="btnCancel" type="button" class="button-add" id="btnCancel" 
            onClick="self.close()" value="cancel" />

        </form>

    <?php 
    }
    ?>
</div>