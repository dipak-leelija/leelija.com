<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
 
require_once("../includes/constant.inc.php");
require_once("../includes/navigation.inc.php");
require_once("../includes/tracking_code.inc.php");

require_once("../classes/adminLogin.class.php"); 

require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/tracking_code.class.php");
require_once("../classes/pagination.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();

$trackc			= new TrackingCode();
$page			= new Pagination();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_GET['id']))
{
	$track_id = $_GET['id'];

}
//$trackDtl = $trackc->getTrackingCodeData($track_id);

//Search
//if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
//{

	//$selStatus		= $utility->returnGetVar('selStatus','');
	//$keyword		= $utility->returnGetVar('keyword','');
	//$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	//$statVar	= "&selStatus=".$selStatus;
	//$numVar		= "&numResDisplay=".$numResDisplay;
	//$keyVar		= "&keyword=".$keyword;
	//$srchVar	= "&btnSearch=Search";
	//$resVar		= '&numResDisplay='.$_GET['numResDisplay'];
	
	//$link =	$keyVar.$statVar.$numVar.$srchVar;
	
	//$noOfNav = $nav->getNavSearch($keyword,$selStatus);

//}
//else
//{
	//$link = '';
	//$noOfNav	= $nav->getNavigationId();
	
	
//}

if(isset($_POST['btnEditTC']))
{ 
	//hold the post data
	$txtName 				= $_POST['txtName'];
	$jsCode	 				= $_POST['jsCode'];
	$selStatus  			= $_POST['selStatus'];
	
	
	
	
	//defining error variables
	$action		= 'edit_track_code';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $track_id;
	$id_var		= 'id';
	$anchor		= 'editTrackCode';
	$typeM		= 'ERROR';
	
	
	
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTRC002, $typeM, $anchor);
	}
	else
	{
		
		//update yogaPackage info
		$trackc->updateTrackingCode($track_id, $txtName, $jsCode, $selStatus);
		
		
		//forward
		$uMesg->showSuccessT('success', $track_id, 'id', $_SERVER['PHP_SELF'], SUTRC002, 'SUCCESS');

	}
}


//cancel button
if(isset($_POST['btnCancel']))
{
	//delete session
	$sess_arr	= array('txtName','jsCode');
	$utility->delSessArr($sess_arr);
		
	header("Location: ".$_SERVER['PHP_SELF']);
}

/*START PAGINATION*/
//$total = count($noOfNav);

//$pageArray = array_chunk($noOfNav, $numResDisplay);


//$newPage = array();
//$name = "Page";
//$numPages = ceil($total/$numResDisplay);

//if(isset($_GET['mypage']))
//{
 //$myPage = $_GET['mypage'];

//}
//else
//{
	//$myPage = 'Array0';
	
//}

//$arrayNum = explode("Array",$myPage);

//$pageNumber = (int)$arrayNum[1];


//if($total == 0)
//{
	//$total = (int)$total;
//}

//$link= $link."&Page=".$myPage;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Visitors Tracking Management</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/style.css" />

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>

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
                
				<?php 
                //display message
                $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
                
                //close button
                echo $utility->showCloseButton();
                ?>
             
                    
                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'edit_track_code')) 
					{	
						$trackDtl = $trackc->getTrackingCodeData($track_id);
						
					?>
                   
                    <h2><a name="addNavigation">Edit Tracking Code</a></h2>
                    <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                    
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    
                    <label>Title <span class="orangeLetter">*</span></label>
                    <input name="txtName" type="text" id="txtName" class="text_box_large"
                    value="<?php echo $trackDtl[0];?>" />
                    <div class="cl"></div>
                      
                    <label>JS Code</label>
                    <textarea name="jsCode" id="jsCode" cols="35" rows="7" class="textArA" >
                    	<?php echo stripslashes($trackDtl[1]);?>
                    </textarea>
                    <div class="cl"></div>
 					
                    <label>Select Status</label>
                       <?php 
                        $arr_value	= array('a','d','');
                        $arr_label	= array('active','inactive',' Status ');
                        ?>
                        <select class="textBoxA marT15" name="selStatus" id="selStatus">
                        <?php 
                         $utility->genDropDown($trackDtl[2], $arr_value, $arr_label);
                        ?>
                        </select>
                        <div class="cl"></div>                      
                       <label>&nbsp;</label>
                       <label>&nbsp;</label>
                       <div class="cl"></div>

                      <label>&nbsp;</label>
                      <input name="btnEditTC" id="btnEditTC" type="submit" class="button-add" value="Edit" /> 
                      <input name="btnCancel" id="btnCancel" type="submit" class="button-add" 
                      onClick="self.close()" value="cancel" />                   
                      <div class="cl"></div> 
                      
                      <label>&nbsp;</label>
                       <div class="cl"></div>
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