<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');

//parent ids
$pIds	= $category->getParentOnly('static_categories');

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
}

if(isset($_POST['btnAddStatic']))
{
	//hold the post vars
	$selNum			= $_POST['selNum'];
	
	//add the additional paragraphs
	for($i=0; $i < $selNum; $i++)
	{
		if( ($_POST['txtSubTitle'][$i] != '') || ($_POST['txtSubDesc'][$i] != '') )
		{
			
			//add static detail
			$staticDtlId	= $stat->addStaticDtl($id, $_POST['txtSubTitle'][$i], 
									 			  '', $_POST['txtSubDesc'][$i], $_POST['txtSubImgTitle'][$i], $_POST['selSubImgPos'][$i],
												  $_POST['intSubImgW'][$i], $_POST['intSubImgH'][$i]);
												  
				
			//uploading images
			if($_FILES['fileSubImg']['name'][$i] != '')
			{
				
				//rename the file
				$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'], '',
													   $staticDtlId);
				
				//upload in the server
				$uImg->imgUpdResizeArr($i, $_FILES['fileSubImg'], '', $newSubName, 
									   '../images/static/', 800, 800, 
									   $staticDtlId,'image', 'static_detail_id', 'static_detail');
				
			}//upload
			
		}//if
	}//for

	//deleting the sessions
	$stat->delSubInSess($selNum);			
	
	//forward
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON004, 'SUCCESS');
	
	
}
?>

<title><?php echo COMPANY_S; ?> - Static Content - Add Paragraph</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">


<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>

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
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	<?php 
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) && ($_GET['action'] == 'static_add') )
	{
		//static detail
		$staticDtl 	= $stat->getStaticData($id);
			
	?>
	  	<h2><a name="addSub">Add More Sub Section/Paragraph </a> </h2>
	  <form action="<?php echo $_SERVER['PHP_SELF']."?action=static_add&id=".$_GET['id'];?>"
	  method="post"  enctype="multipart/form-data" >
			<h4>Additional Sections</h4>
			<label>Select No. of Sub Desc.</label>
			<?php 
			//gen number array
			$arr_value	= range(1,3);
			$arr_label	= range(1,3);
			?>
            <select name="selNum" id="selNum" onchange="return getNumDesc(); "
            class="textBoxA">
            <option value="0">--Select--</option>
            <?php 
            if(isset($_SESSION['selNum']))
            {
                $utility->genDropDown($_SESSION['selNum'], $arr_value, $arr_label);
            }
            else if(isset($_GET['selNum']))
            {
                $utility->genDropDown($_GET['selNum'], $arr_value, $arr_label);
            }
            else
            {
                $utility->genDropDown(0, $arr_value, $arr_label);
            }
            ?>
            </select>
            <div class="cl"></div>
			<div id="showDescMsg">
			<?php 
			if(isset($_SESSION['selNum']))
			{
				echo $stat->genDesc($_SESSION['selNum']);
			}
			?>		
			</div>
			<input name="btnAddStatic" type="submit" class="button-add" value="add" />
			<input name="btnCancel" type="submit" class="button-cancel" value="cancel" 
			onClick="self.close()" />

	  </form>
	<?php 
	}//eof
	?>
</div>