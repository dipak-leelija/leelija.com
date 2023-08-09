<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/image.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/location.class.php");
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php");  
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$lc		 		= new Location();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

##########################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$album_id	= $utility->returnGetVar('album_id',0);


//get the sort order
$numOrder	= $uNum->genSortOrderNum('Y', $album_id, 'categories_id', 1, 'album_image');

/**
*	Add image
*/
if(isset($_POST['btnAddImage']))
{
	//hold post values
	$album_id		=  $_GET['album_id'];

	$cusId  		=  0;

	$dateShotOn		=  date('Y-m-d h:i:s', time());;
	$noOfMedia		=  $_POST['noOfMedia'];
	$txtName		= array();
	$txtDesc		= array();
	$img			= array();
	//echo $dateShotOn;exit;
	
	
	for($i=1; $i <= $noOfMedia; $i++)
	{
		$txtName[$i]		=  $_POST['txtName-'.$i];
		$txtDesc[$i]		=  $_POST['txtDesc-'.$i];
		$img[$i]			=  $_FILES['fileImage-'.$i]['name'];
	}
	
	//ADDED ON: December 7, 2010
	//media type
	$selMediaType	=  $_POST['selMediaType'];
	
	//registering the post session variables
	$sess_arr	= array('album_id', 'txtName','txtDesc','cusId', 'intOrder', 'dateShotOn', 'selMediaType');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'addImage';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $album_id;
	$id_var		= 'album_id';
	$anchor		= 'addImage';
	$typeM		= 'ERROR';
	
	
	if($album_id == 0)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG201, $typeM, $anchor);
	}
/*	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG202, $typeM, $anchor);
	}
	elseif( ($selMediaType == 'IMG') && ($_FILES['fileImage']['name'] == ''))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG203, $typeM, $anchor);
	}
	elseif( ($selMediaType == 'VIDEO') && ($_FILES['fileMedia']['name'] == ''))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG301, $typeM, $anchor);
	}
	elseif( ($selMediaType == 'AUDIO') && ($_FILES['fileMedia']['name'] == ''))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG301, $typeM, $anchor);
	}*/
	else
	{
		//add image
		//$imageId		= array();
		for($i=1; $i <= $noOfMedia; $i++)
		{
			$imageId = $photo->addImage($album_id, $txtName[$i], $txtDesc[$i], $cusId, 'a', $dateShotOn, 0, $selMediaType);
		
		
			//upload image
			if( ($selMediaType == 'IMG') && ($_FILES['fileImage-'.$i]['name'] != '') )
			{
				//name of the image 
				$newName = $utility->getNewName4($_FILES['fileImage-'.$i], '',$imageId);
				
				
				//start uploading images
				//gallery image	
				/*$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/gallery/', 
									   550, 252, $imageId, 'im_image', 'im_id', 'album_image');*/
				
				
				//thumbnail image	
				$uImg->imgCropResize($_FILES['fileImage-'.$i],'',$newName,'../images/gallery/thumbnail/', 
									   150, 112, $imageId, 'im_thumbnail', 'im_id', 'album_image');
								
									   
				//gallery image	
				$uImg->imgUpdResize($_FILES['fileImage-'.$i],'',$newName,'../images/gallery/gallery/', 
									   800, 600, $imageId, 'im_image', 'im_id', 'album_image');
				
				
				//800 by 800 	
				$uImg->imgUpdResize($_FILES['fileImage-'.$i],'',$newName,'../images/gallery/800/', 
									   800, 800, $imageId, 'im_800', 'im_id', 'album_image');
				
				//original image	
				//$utility->fileUpload2($_FILES['fileImage'], '', $newName , '../images/gallery/original/', 
									  // $imageId, 'im_original', 'im_id', 'album_image');	
			}
			
			
			//if media type is audio or video
			if( ( ($selMediaType == 'AUDIO') || ($selMediaType == 'VIDEO') ) && ($_FILES['fileMedia-'.$i]['name'] != '') )
			{
				//upload the thumb
				if($_FILES['fileImage-'.$i]['name'] != '') 
				{
					//name of the image 
					$newName = $utility->getNewName4($_FILES['fileImage-'.$i], '',$imageId);
					
					//thumbnail image	
					$uImg->imgCropResize($_FILES['fileImage-'.$i],'',$newName,'../images/gallery/thumbnail/', 
									   212, 157, $imageId, 'im_thumbnail', 'im_id', 'album_image');
				}
				
				//name of the audio or video 
				$newNameM = $utility->getNewName4($_FILES['fileMedia-'.$i], '',$imageId);
				
				//decide whether it is audio or video
				if($selMediaType == 'AUDIO')
				{
					//audio
					$utility->fileUpload2($_FILES['fileMedia-'.$i], '', $newNameM, '../images/gallery/audio/', 
										  $imageId, 'media_file', 'im_id', 'album_image');				 
				}
				else if($selMediaType == 'VIDEO')
				{
					//audio
					$utility->fileUpload2($_FILES['fileMedia-'.$i], '', $newNameM, '../images/gallery/video/', 
										  $imageId, 'media_file', 'im_id', 'album_image');
				}
			}
		
		}
		
		//remove session
		$utility->delSessArr($sess_arr);
	
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUIMG201, 'SUCCESS');

	}
	
}//end of add image


?>

<title><?php echo COMPANY_S; ?> - Add Photograph, Video, Audio</title>

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
<!-- eof JS Libraries -->

<script type="text/javascript" >

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

<div class="webform-area">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
	//form
	if( (isset($_GET['action'])) && ($_GET['action'] == 'addImage') )
	{
		
	?>

		<h4><a name="addImage">Add Photograph</a></h4>

        <form action="<?php $_SERVER['PHP_SELF']?>?album_id=<?php echo $album_id; ?>" 
        method="post" enctype="multipart/form-data" name="formAddImage" id="formAddImage">

              
            <label>Album</label>
            <select name="album_id" id="album_id" class="textBoxA">
            <?php 
                if(isset($_SESSION['album_id']))
                {
                   $utility->populateDropDown($_SESSION['album_id'],'categories_id',
                                              'categories_name','album'); 
                }
                else if(isset($_GET['album_id']))
                {
                    $utility->populateDropDown($_GET['album_id'],'categories_id',
                                               'categories_name','album');
                }
                else
                {
                    $utility->populateDropDown($albumId,'categories_id','categories_name',
                                               'album');
                }
                
            ?>
            </select>            
            <div class="cl"></div>
            
            <label>Meddia Type</label>
                <?php 
                $arr_value	= array('IMG', 'VIDEO', 'AUDIO'); 
                $arr_label  = array('Image', 'Video', 'Audio');
                
                ?>
                <select name="selMediaType" id="selMediaType" class="textBoxA">
                <?php 
                    if(isset($_SESSION['selMediaType']))
                    {
                       $utility->genDropDown($_SESSION['selMediaType'], $arr_value, $arr_label); 
                    }
                    else if(isset($_GET['selMediaType']))
                    {
                        $utility->genDropDown($_GET['selMediaType'], $arr_value, $arr_label); 
                    }
                    else
                    {
                        $utility->genDropDown('IMG', $arr_value, $arr_label);
                    }
                    
                ?>
              </select>
            <div class="cl"></div>


            
            <label>Select the no. of images</label>
			<?php 
				$arr_value2	= range(1,5);
                $arr_label2	= range(1,5);
            
            ?>
            <select name="noOfMedia" id="noOfMedia" class="textBoxA" onchange="displayMedia()">
            	<option value="0">--Select--</option>
				<?php 
					if(isset($_SESSION['noOfMedia']))
					{
					$utility->genDropDown($_SESSION['noOfMedia'], $arr_value2, $arr_label2); 
					}
					else if(isset($_GET['noOfMedia']))
					{
					$utility->genDropDown($_GET['noOfMedia'], $arr_value2, $arr_label2); 
					}
					else
					{
					$utility->genDropDown('0', $arr_value2, $arr_label2);
					}
                
                ?>
            </select>
            <div class="cl"></div>
            
			<div id="dispMedia">

            </div>

            <input name="btnAddImage" type="submit" class="button-add" id="btnAddImage" 
            value="add" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel"
            onClick="self.close()" value="cancel" />
        
        </form>

	<?php 
	}
	?>
</div>