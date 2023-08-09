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
$msg 				= '';


//get the static download id 
$bannerId	= $utility->getSingleValueByKey($id, 'static_id','static_banner_id','static_banner','');


if(isset($_POST['btnAddPhoto']))
{
	//get the vars
	$txtName		= $_POST['txtName'];
	$txtDesc 		= $_POST['txtDesc'];


	//added Display banner on Jan 5th, 2012
	if(isset($_POST['radioStatus']))
	{
		$radioStatus	= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus	= 	'd';
	}

	
	//defining error variables
	$action		= 'edit_banner';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'editBanner';
	$typeM		= 'ERROR';
	
		
	if($txtName == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON005, $typeM, $anchor);
	}
	else
	{
		//adding the file information
		$stat->editStaticBanner($bannerId,  $id,  $txtName,  $txtDesc, '','Same Window',0, $radioStatus);
		
		//uploading
		if($_FILES['txtUploadBanner']['name'] != '')
		{
			
			//delete the image first
			$utility->deleteFile($bannerId, 'static_banner_id' ,'../images/static/banner/', 'photo', 'static_banner');
			
			//image update
			$newName  = $utility->getNewName4($_FILES['txtUploadBanner'], '', $bannerId);
			
			//upload image					
			$uImg->imgUpdResize($_FILES['txtUploadBanner'],'',$newName,
								   '../images/static/banner/', 738, 238, 
					  			   $bannerId, 'photo', 'static_banner_id', 'static_banner');
		}
		
		
		//static detail content
		$statBanDtlIds	= $stat->getStatBannerActiveId($id);
		
		//delete options ids
		$delOptionIds	= array();
		$remainIds		= array();
		
		$txtSubTitle   	= $_POST['txtSubTitle'];
		$txtSubDesc		= $_POST['txtSubDesc'];
		$fileSubImg		= $_FILES['fileSubImg'];
		
		//Added On: October 14, 2011
		$selSubStatus	= $_POST['selSubStatus'];
		
		//update the values
		for($i = 0; $i< count($statBanDtlIds) ; $i++)
		{ 
			//update 
			$stat->editStaticBanner($statBanDtlIds[$i], $id, $txtSubTitle[$i], $txtSubDesc[$i], 
								   '', '',  0, $selSubStatus[$i]);
								   
			//delete images	
			if(isset($_POST['delSubImg'][$i]) && ($_POST['delSubImg'][$i] == 1))
			{
				//delete files
				$utility->deleteFile($statBanDtlIds[$i],  'static_banner_id' ,'../images/static/banner/', 
									 'photo', 'static_banner');
			}
			
			//uploading images
			if($_FILES['fileSubImg']['name'][$i] != '')
			{
			
				//delete files
				$utility->deleteFile($statBanDtlIds[$i], 'static_banner_id' ,'../images/static/banner/', 
									 'photo', 'static_banner');
				
				//rename the file
				$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'], '',
													   $statBanDtlIds[$i]);
				
				//upload in the server
				$uImg->imgUpdResizeArr($i, $_FILES['fileSubImg'], '', $newSubName, 
									   '../images/static/banner/', 738, 238, 
									   $statBanDtlIds[$i],'photo', 'static_banner_id', 'static_banner');
			}//upload
			
		}//for update values
		
		//delete the additional paragraphs
		if(isset($_POST['delOption']))
		{
			$delOptionIds	= $_POST['delOption'];
			
			//del options
			foreach($delOptionIds as $k)
			{
				//delete paragraphs
				$stat->delStaticBanner($k, '../images/static/banner/');
			}
			
		}//if paragraphs
		
		
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
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="../js/utility.js"></script> 

<script type="text/javascript" src="../js/jQuery/jquery.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery.colorbox.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.colorbox-min.js"></script>



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
						if(isset($_GET['action']) && ($_GET['action'] == 'edit_banner'))
						{
							$statBannerDtl	= $stat->getStaticBannerData($bannerId,$id);
						?>
                    
                   
                        <h2><a name="addFile">Add Banner</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="static_edit_banner.php<?php /*?><?php echo $_SERVER['PHP_SELF']."?action=edit_banner&id=".$_GET['id'];?><?php */?>" method="post"  enctype="multipart/form-data">
                        	
                            <label>Banner Heading <span class="required">*</span></label>
                            <input name="txtName" type="text" class="" id="txtName"
			 				value="<?php echo $statBannerDtl[0]; ?>" size="50" />
                            <div class="cl"></div>
                            
                            <label>Short Description</label>
                            <textarea name="txtDesc" cols="10" rows="8" wrap="physical" class="textAr" 
                            id="txtDesc"><?php echo $statBannerDtl[1]; ?></textarea>
                            <div class="cl"></div>
                            
                            <label>Status<span class="orangeLetter">*</span></label>
                            <input name="radioStatus" type="radio" value="a" title="Status Active"
				            <?php /*?><?php echo $utility->checkSessStr('radioStatus','a', '');?><?php */?>
                            <?php echo $utility->checkString($statBannerDtl[3],'a');?>
                             />
                            <label class="radio">Active</label>
                            
                            <input name="radioStatus" type="radio" value="d" title="Status Deactive"
							<?php /*?><?php echo $utility->checkSessStr('radioStatus','d', '');?> <?php */?>
                            <?php echo $utility->checkString($statBannerDtl[3],'d');?>
                            />
                            <label class="radio">Deactive</label>
                            
                            <div class="cl"></div>
                            
                            <label>Upload Banner</label>
                            <input name="txtUploadBanner" type="file" class="text_box_large" 
                            id="txtUploadBanner">	
                            <?php 
							if( ($statBannerDtl[2] != '' ) && (file_exists("../images/static/banner/".$statBannerDtl[2])) )
							{
								echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\"> 
								<span class='blackLarge'>Delete this image</span>"; 
							}
							?>
                            <div class="cl"></div>
                            
                            <label>&nbsp;</label>
		    				<label>&nbsp;</label>
	      
		    
							<h4>Additional Sections</h4>	
                			<div class="cl"></div>
                 
							 <div><?php echo $stat->showDelStaticBannerDtl($id, '../images/static/banner/');?> </div>	
            
		       
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                           
                            <input name="btnAddPhoto" type="submit" class="button-add" value="edit" />
							<input name="btnCancel" type="submit" class="button-cancel" value="cancel" onclick="parent.$.colorbox.close(); return false;" />
                            
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
 