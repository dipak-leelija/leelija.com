<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");
require_once("../includes/email.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/email.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$email			= new Email();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');


if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
}

if(isset($_POST['btnEditAutoresSet']))
{
	
	$txtEmailForm			= $_POST['txtEmailForm'];
	$txtFooter				= $_POST['txtFooter'];
	$txtName				= $_POST['txtName'];
	
	//Status type
	if(isset($_POST['radioStatus']))
	{
		$radioStatus	= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus	= 	'';
	}

	//defining error variables
	$action		= 'edit_autores_set';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'editAutoresSetup';
	$typeM		= 'ERROR';
	
	$autoresSetDtl 	= $email->getAutoResponderSetupData($id);
		
	//check for error
	$duplicateId	= $error->duplicateEntry($txtEmailForm, 'email_from', 'email_autores_setup', 'YES',$id,'email_autores_setup_id');
	$invalidEmail 	= $error->invalidEmail($txtEmailForm);
	
	if(($autoresSetDtl[0] != $txtEmailForm) && (preg_match('/^ER/',$invalidEmail)))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE002, $typeM, $anchor);
	}
	elseif(($autoresSetDtl[0] != $txtEmailForm) && (preg_match("/^ER/",$duplicateId)))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE001, $typeM, $anchor);
	}
	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE004, $typeM, $anchor);
	}
	else
	{
		//update static
		$email->updateAutoResponderSetup($id, $txtName, $txtEmailForm, $txtFooter, $radioStatus);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUAUTOSET002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Email Autoresponder Setup Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 

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
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_autores_set') )
	{
		//static detail
		$autoresSetDtl 	= $email->getAutoResponderSetupData($id);
			
	?>
	  	<h3><a name="editAutoresSetup">Edit Email Autoresponder Setup</a> </h3>

	  <form action="<?php echo $_SERVER['PHP_SELF']."?action=edit_autores_set&id=".$_GET['id'];?>"
	  method="post"  enctype="multipart/form-data">

		<label>Name<span class="orangeLetter">*</span></label>
        <input name="txtName" type="text" class="text_box_large" id="txtName"
        value="<?php echo $autoresSetDtl[5]; ?>" size="50" />
        <div class="cl"></div>
             
        
		<label>Email from<span class="orangeLetter">*</span></label>
        <input name="txtEmailForm" type="text" class="text_box_large" id="txtEmailForm"
         value="<?php echo $autoresSetDtl[0]; ?>" size="50" />	
        <div class="cl"></div> 
             
        <label>Footer </label>
        <textarea name="txtFooter" class="textAr" id="txtFooter" rows="5" cols="35"/><?php echo $autoresSetDtl[1]; ?>
        </textarea>
        <div class="cl"></div>

        <label>Status</label>
        <input type="radio" name="radioStatus" id="radioStatus" value="a" title="Active"
         <?php echo $utility->checkString($autoresSetDtl[4],'a');?>/>
         <label for="radioStatus">Active</label>
             
         <input type="radio" name="radioStatus" id="radioStatus" value="d" title="Deactive" 
         <?php echo $utility->checkString($autoresSetDtl[4],'d');?> />
         <label for="radioStatus">Deactive</label>
		 <div class="cl"></div>

        <input name="btnEditAutoresSet" type="submit" class="button-add" value="edit" />
        <input name="btnCancel" type="submit" class="button-cancel" value="cancel" onClick="self.close()" />	
	  </form>

	<?php 
	}//eof
	?>
</div>