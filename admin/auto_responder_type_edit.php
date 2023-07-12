<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/category.inc.php");
require_once("../includes/front_content.inc.php");
require_once("../includes/email.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php");
require_once("../classes/email.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$email			= new Email();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM				= $utility->returnGetVar('typeM','');
$type_id			= $utility->returnGetVar('id','');


if(isset($_POST['btnEditAutoResType']))
{
	//vars
	$txtTitle		= $_POST['txtTitle'];
	$txtConsType 	= $_POST['txtConsType'];
	$txtDesc		= $_POST['txtDesc'];
	
	
	//defining error variables
	$action		= 'edit_auto_responder_type';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $email_id;
	$id_var		= 'id';
	$anchor		= 'autoResponderType';
	$typeM		= 'ERROR';
	
	//check for errors
	//$duplicate	= $error->duplicateEntry( 'static_id', 'static_id', 'exit_splash', 'YES', 'static_id', $selStaticId);
	
	if($txtTitle == '' )
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREXITSP002, $typeM, $anchor);
	}
	elseif($txtConsType == '' )
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREXITSP002, $typeM, $anchor);
	}

	elseif($txtDesc == '' )
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREXITSP006, $typeM, $anchor);
	}
	else
	{
		//edit
		//$email->updateAutoRespoder($email_id, 'All', $txtEmailSub, $txtDesc,'immediately', date("Y-m-d H:i:s"));
		
		//edit autoresponder type
		$email->updateAutoRespoderType($type_id, $txtTitle, $txtConsType,  $txtDesc, 'deactive');
		

		//forward the web page
		$uMesg->showSuccessT('success', $email_id, 'id', $url, SUAUTORES002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Edit Auto Responder Type</title>

<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/package.js"></script>

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


	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
			
	<?php 
    //edit faq
    if( (isset($_GET['action'])) &&  ($_GET['action'] == 'edit_auto_responder_type') )
    {
		//get autoresponder type detail
        $autoResTypeDtl = $email->getAutoResponderTypeData($type_id);
		
    ?>
    <h3>Edit Auto Responder </h3>

    <form action="<?php $_SERVER['PHP_SELF']?>?action=edit_auto_responder_type&id=<?php echo $type_id; ?>" method="post">
       
		<label>Title</label>
        <input type="text" name="txtTitle" id="txtTitle" class="text_box_large" 
        value="<?php echo $autoResTypeDtl[0];?>" />
        <div class="cl"></div>

        <label>Constant Type</label>
        <input type="text" name="txtConsType" id="txtConsType" class="text_box_large" 
        value="<?php echo $autoResTypeDtl[1];?>" />
        <div class="cl"></div>

        <label>Description</label>
        <textarea  name="txtDesc" id="txtDesc" >
        <?php echo $autoResTypeDtl[2];?>
        </textarea>
        <div class="cl"></div>

        <input name="btnEditAutoResType" type="submit" class="button-add" id="btnEditAutoResType" value="edit" />
        <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />

    <?php 
    }
    ?>
