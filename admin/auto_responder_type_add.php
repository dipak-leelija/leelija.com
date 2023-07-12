<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php"); 
require_once("../includes/front_content.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/email.class.php"); 

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");



//instantiate classes
$adminLogin 	= new adminLogin();
$email			= new Email();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


################################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_POST['btnAddAutoResType'])) 
{
	$txtTitle 		= $_POST['txtTitle'];
	$txtConsType 	= $_POST['txtConsType'];
	$txtDesc 		= $_POST['txtDesc'];
	
	
	//registering the post session variables 
	$sess_arr	= array('txtTitle', 'txtConsType','txtDesc' );
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_autoresponder_type';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addAutoresponderType';
	$typeM		= 'ERROR';
	
	//error check
	if($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERFRONT002, $typeM, $anchor);
	}
	elseif($txtConsType == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERFRONT003, $typeM, $anchor);
	}

	elseif($txtDesc == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERFRONT003, $typeM, $anchor);
	}
	else
	{
		//add autorespoder type
		
		$autoResType	= $email->addAutoRespoderType($txtTitle, $txtConsType, $txtDesc, 'deactive');
		
		
		//delete session array
		$utility->delSessArr($sess_arr);
		
		//forwarding
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUAUTORES001, 'SUCCESS');
	}
	
}//eof


//cancel action
if(isset($_POST['btnCancel']))
{
	//registering the post session variables
	$sess_arr	= array('txtTitle','txtConsType', 'txtDesc' );
	
	//delete session array
	$utility->delSessArr($sess_arr);
		
	//forward
	header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> -  Auto Responder</title>
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
//-->
</script>
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

<!-- eof JS Libraries -->
</head>

<body>
                 <!-- Form -->
                <div class="webform-area">
                        <!-- show message -->
                        <?php
						 $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
						 
						 //close button
						  echo $utility->showCloseButton();

						 ?>
                            
                        <!-- Add new image -->
                        <?php 
                        if(isset($_GET['action']) && ($_GET['action'] == 'add_autoresponder_type'))
                        {
                        ?>
                   
                    <h2><a name="addAutoresponder">Define Auto Responder Type</a></h2>
                    <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                      <form action="<?php $_SERVER['PHP_SELF']?>" method="post" 
                      enctype="multipart/form-data">
                            <label>Title<span class="orangeLetter">*</span></label>
                            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle" 
                            value="<?php $utility->printSess('txtTitle'); ?>" size="25" />
                            <div class="cl"></div>
                            
                            <label>Constant Type<span class="orangeLetter">*</span></label>
                            <input name="txtConsType" type="text" class="text_box_large" id="txtConsType" 
                            value="<?php $utility->printSess('txtConsType'); ?>" size="25" />
                            <div class="cl"></div>

                         
                            <label>Description</label><!--cols="50" rows="8" wrap="physical"-->
                            <textarea name="txtDesc"  class="textAr" 
                            id="txtDesc"><?php $utility->printSess('txtDesc'); ?></textarea>
                            <div class="cl"></div>
                                                      
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                            
                            <label>&nbsp;</label>
                            <input name="btnAddAutoResType" type="submit" class="button-add" 
                            id="btnAddAutoResType" value="create" />
                            <input name="btnCancel" type="submit" class="button-cancel" onClick="self.close()" value="cancel" />
							<div class="cl"></div>

                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            
                      </form>
                   
                    <?php 
					}
					?>
                    
                     
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
             

     

</body>
</html>
