<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/subscriber.inc.php");
require_once("../includes/email.inc.php");

 
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
$email_id	= $utility->returnGetVar('email_id',0);


//edit customer
if(isset($_POST['btnEditCus']))
{
	//GET THE POST DATA
	$txtEmail		= 	trim($_POST['txtEmail']);
	$txtFname		= 	$_POST['txtFname'];
	$txtSurname		= 	$_POST['txtSurname'];
	$selCat			= 	(int)$_POST['selCat'];
	$txtPhone		= 	$_POST['txtPhone'];
	$txtCompany		= 	$_POST['txtCompany'];
	
	//defining error variables
	$action		= 'edit_email';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $email_id;
	$id_var		= 'email_id';
	$anchor		= 'editEmail';
	$typeM		= 'ERROR';
	
	//check for duplicacy
	$duplicateId 	= $error->duplicateEntry($txtEmail, 'email', 'email_subscriber', 'YES', $email_id, 'subscriber_id'); 
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	
	//CHECK FIELD VALIDATION 
	if(ereg('^ER',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE002, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicateId))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE001, $typeM, $anchor);
	}
	elseif($txtFname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERU108, $typeM, $anchor);
	}
	elseif($txtSurname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERU109, $typeM, $anchor);
	}
	else
	{
		//update user information
		$subscribe->editSubscriber($_GET['email_id'], $txtEmail,$txtFname,$txtSurname, $selCat, 
								   $txtCompany, $txtPhone);
								   
		//forward
		$uMesg->showSuccessT('success', $email_id, 'email_id', $_SERVER['PHP_SELF'], SUSUBSC002, 'SUCCESS');
	}//end of elseexit;		

}
?>

<title><?php echo COMPANY_S; ?> - Edit  Subscription</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</LINK>
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
    if(isset($_GET['action']) && ($_GET['action'] == 'edit_email'))
    {
            $cusDetail = $subscribe->getSubsDtl($email_id);
    ?>
    <h3>Edit Member - <?php echo $cusDetail[2]; ?></h3>
      <div title="regsitration">
        <form action="<?php echo $_SERVER['PHP_SELF']."?email_id=".$email_id;?>" method="post" 
        name="formRegister" id="formRegister">
         
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">Email <span class="orangeLetter">*</span></div>
            <div class="fl">
            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" size="25" title="email"
             value="<?php echo $cusDetail[2]; ?>" /> 
            </div>
            <div class="cl"></div>
        </div>
        
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">First Name <span class="orangeLetter">*</span></div>
            <div class="fl">
            <input name="txtFname" type="text" class="text_box_large" 
            id="txtFname" size="25" title="First Name"
            value="<?php echo $cusDetail[3];?>">
            </div>
            <div class="cl"></div>
        </div>
        
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">Last Name <span class="orangeLetter">*</span></div>
            <div class="fl">
            <input name="txtSurname" type="text" class="text_box_large"
             id="txtSurname" size="25" title="Last Name"
             value="<?php echo $cusDetail[4];?>">
            </div>
            <div class="cl"></div>
        </div>
        
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">Group</div>
            <div class="fl">
            <select name="selCat" id="selCat" class="blackLarge">
            <?php
            $utility->populateDropDown($cusDetail[1], 'cat_id', 
                                            'title', 'email_categories');
            ?>
            </select>
            </div>
            <div class="cl"></div>
        </div>
        
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">Company Name</div>
            <div class="fl">
            <input name="txtCompany" type="text" class="text_box_large"
             id="txtCompany" size="25" title="Company Name"
             value="<?php echo $cusDetail[5];?>">
            </div>
            <div class="cl"></div>
        </div>
        
        <div class="w100P pad2 h25 padT10">
            <div class="menuText w100 fl padT3">Phone Number</div>
            <div class="fl">
            <input name="txtPhone" type="text" class="text_box_large"
             id="txtPhone" size="25" title="Phone Number"
             value="<?php echo $cusDetail[6];?>">
            </div>
            <div class="cl"></div>
        </div>
        
        <!-- ADDRESS AND CONTACT INFORMATION -->
        <div class="pad2 padT5">
          <div class="fl w100">&nbsp;</div>
          <div class="fl">
            <input name="btnEditCus" type="submit" class="button-add" id="btnEditCus" value="edit" />
          </div>
          <div class="fl">&nbsp;</div>
          <div class="fl">
            <input name="btnCancel" type="button" class="button-add" id="btnCancel" onclick="self.close()" value="cancel" />
          </div>
          <div class="cl"></div>
        </div>
    </form>
    
    </div>			  

    <?php 
    }//test for check action type
    ?>
</div>