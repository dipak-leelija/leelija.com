<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/front_photo.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$frPhoto		= new FrontPhoto();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();

##############################################################################################################

//declare variables
$typeM				= $utility->returnGetVar('typeM','');
$id					= $utility->returnGetVar('id','');
$msg 		= '';

//get the sort order
if(isset($_GET['id']))
{
	$numOrder	= $uNum->genSortOrderNum('Y', $_GET['id'], 'static_id', 1, 'static_download');
}
else
{
	$numOrder	= $uNum->genSortOrderNum('Y', 0, 'static_id', 1, 'static_download');
}


if(isset($_POST['btnAddPhoto']))
{
	//get the vars
	$txtName		= $_POST['txtName'];
	$txtDesc 		= $_POST['txtDesc'];
	$selNum			= $_POST['selNum'];
	//status
	if(isset($_POST['radioStatus']))
	{
		$radioStatus		= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus		= 	'd';
	}
	

	//registering the post session variables
	$sess_arr	= array('txtName', 'txtDesc');				
	$utility->addPostSessArr($sess_arr);
	$stat->bannerSubInSess($selNum);
	
	//defining error variables
	$action		= 'add_banner';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addBanner';
	$typeM		= 'ERROR';
	
		
	if($txtName == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON005, $typeM, $anchor);
	}
	elseif($_FILES['txtUploadBanner']['name'] == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON006, $typeM, $anchor);
	}
	else
	{
		//adding the file information
		$bannerId = $stat->createStaticBanner($id,  $txtName, $txtDesc, '','Same Window', $radioStatus, 0);
		
		//uploading
		if($_FILES['txtUploadBanner']['name'] != '')
		{
			//image update
			$newName  = $utility->getNewName4($_FILES['txtUploadBanner'], '', $bannerId);
			
			//upload image					
			$uImg->imgUpdResize($_FILES['txtUploadBanner'],'',$newName,
								   '../images/static/banner/', 1010, 355, 
					  			   $bannerId, 'photo', 'static_banner_id', 'static_banner');
		}
		//
		//add the additional 			
		for($i=0; $i < $selNum; $i++)
		{
			if( ($_POST['txtSubTitle'][$i] != '') || ($_POST['txtSubDesc'][$i] != '') )
			{
				
			
				//add static detail
				$staticAdditionBannerId	= $stat->createStaticBanner($id,  $_POST['txtSubTitle'][$i], $_POST['txtSubDesc'][$i],
									                		'','Same Window',  $_POST['selSubStatus'][$i],  0);
													
					
				//uploading images
				if($_FILES['fileSubImg']['name'][$i] != '')
				{ 
					
					//rename the file
					$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'],'',
														   $staticAdditionBannerId);
					
					//upload in the server
					$uImg->imgUpdResizeArr($i, $_FILES['fileSubImg'], '', $newSubName, 
										   '../images/static/banner/', 1010, 355, 
										   $staticAdditionBannerId,'photo', 'static_banner_id', 'static_banner');
					
				}//upload
				
			}//if
		}//for
		
		//remove session
		$stat->delBannerSubInSess($selNum);
		
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON101, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?>- Add File</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../style/parent_style.css"/>


<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/address.js"></script>
<script type="text/javascript" src="../js/form.js"></script>
<script type="text/javascript" src="../js/banner.js"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="../js/utility.js"></script> 

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


    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	
            
            <!-- Inner  -->
            <!--<div id="admin-body">-->
            	
                
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
						<?php 
                        //display message
                        $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
                        
                        //close button
                        echo $utility->showCloseButton();
                        ?>
                        
                       <?php 
						if(isset($_GET['action']) && ($_GET['action'] == 'add_banner'))
						{
						?>
                    
                        <h2><a name="addFile">Add Banner</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?action=add_banner&id=".$_GET['id'];?>"
	 					 method="post"  enctype="multipart/form-data">
                        	
                            <label>Banner Heading <span class="required">*</span></label>
                            <input name="txtName" type="text" class="" id="txtName"
			 				value="<?php $utility->printSess2('txtName', ''); ?>" size="50" />
                            <div class="cl"></div>
                            
                            <label>Short Description</label>
                            <textarea name="txtDesc" cols="10" rows="8" wrap="physical" class="textAr" 
                            id="txtDesc"><?php $utility->printSess('txtDesc'); ?></textarea>
                            <div class="cl"></div>
                            
                            <label>Status<span class="orangeLetter">*</span></label>
                            <input name="radioStatus" type="radio" value="a" title="Status Active"
				            <?php echo $utility->checkSessStr('radioStatus','a', '');?> />
                            <label class="radio">Active</label>
                            
                            <input name="radioStatus" type="radio" value="d" title="Status Deactive"
							<?php echo $utility->checkSessStr('radioStatus','d', '');?> />
                            <label class="radio">Deactive</label>
                            
                            <div class="cl"></div>
                            
                            <label>Upload Banner</label>
                            <input name="txtUploadBanner" type="file" class="text_box_large" 
                            id="txtUploadBanner">	
                            <div class="cl"></div>
                             
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                            
                            <label>Select No. of Sub Banner.</label>
							<?php 
                            //gen number array
                            $arr_value	= range(1,3);
                            $arr_label	= range(1,3);
                            ?>
                          <select name="selNum" id="selNum" onchange="return getNumDescBanner();"
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
                                echo $stat->genFileImg($_SESSION['selNum']);
                            }
                            ?>					
                          </div>
                         
                            
                            <div class="cl"></div>
                          
                            <label>&nbsp;</label>
                           
                            <input name="btnAddPhoto" type="submit" class="button-add" value="add" />
							<input name="btnCancel" type="submit" class="button-cancel" value="cancel" onClick="self.close()" />
                            
						</form>
                    <?php 
					}//eof
					?>
                    
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
            <!--</div>-->
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
 