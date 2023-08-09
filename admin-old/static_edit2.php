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

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');

//language
$lang        = $utility->returnGetVar('lang','');
$tabName    = $utility->getTableName("static");

//parent ids
$pIds	= $utility->getAllId('categories_id', 'static_categories');


if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
}

if(isset($_POST['btnEditStatic']))
{
	
	$cat_id			= $_POST['cat_id'];
	$txtTitle		= $_POST['txtTitle'];
	$selPSId		= $_POST['selPSId'];
	$intSort 		= $_POST['intSort'];
	$txtBrief		= $_POST['txtBrief'];
	$txtDesc		= $_POST['txtDesc'];
	$txtImgTitle	= $_POST['txtImgTitle'];
	
	//added video on March 30, 2011
	$txtVideo		= $_POST['txtVideo'];
	
	//added image position on June15, 2011
	if(isset($_POST['radioImgPosition']))
	{
		$radioImgPosition	= 	$_POST['radioImgPosition'];
	}
	else
	{
		$radioImgPosition	= 	'left';
	}
	
	
	//added Display banner on Jan 5th, 2012
	if(isset($_POST['radioDisBanner']))
	{
		$radioDisBanner	= 	$_POST['radioDisBanner'];
	}
	else
	{
		$radioDisBanner	= 	'N';
	}

    //added Display slide show on Jan 5th, 2012
	if(isset($_POST['radioDisSlideShow']))
	{
		$radioDisSlideShow	= 	$_POST['radioDisSlideShow'];
	}
	else
	{
		$radioDisSlideShow	= 	'N';
	}

	
	//added on September 23, 2011
	$txtPageTitle	= $_POST['txtPageTitle'];
	$txtSEOURL		= $_POST['txtSEOURL'];
	$txtMetaTitle	= $_POST['txtMetaTitle'];
	$txtMetaKey		= $_POST['txtMetaKey'];
	$txtMetaDesc	= $_POST['txtMetaDesc'];
	
	$intDispWidth	= $_POST['intDispWidth'];
	$intDispHeight	= $_POST['intDispHeight'];
	
	
	//added on january 5th, 2012
	$txtURL			= $_POST['txtURL'];
	
	
	//defining error variables
	$action		= 'edit_static';
	$url		= $_SERVER['PHP_SELF'];
	$arr_id		= array($id, $lang);
	$arr_var	= array('id', 'lang');
	$anchor		= 'editStatic';
	$typeM		= 'ERROR';
	
	
	//check for the error
	$urlRes		= $error->checkHttpInURL($txtVideo);
	$curlRes	= $uCurl->validateURL($txtVideo);
		
	$msg = '';
		
	if($txtTitle == '')
	{ 
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERSTCON002, $typeM, $anchor);
	}
	else if(($cat_id == 0) || (!in_array($cat_id, $pIds)))
	{
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERSTCON004, $typeM, $anchor);;
	}
	elseif( ($txtVideo != '') && ($urlRes == 'ER') )
	{
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERURL001, $typeM, $anchor);
	}
	elseif( ($txtVideo != '') && ($curlRes == 'NOT_FOUND') )
	{
		$error->showErrorArrTL($action, $arr_id, $arr_var, $url, ERURL002, $typeM, $anchor);
	}
	else
	{

		//update static
		$stat->updateStatic($id, $cat_id, $selPSId, $txtTitle, $txtPageTitle, $txtSEOURL, $txtURL, $txtBrief, $txtDesc, 
							$txtImgTitle, $radioImgPosition, $intSort, $intDispWidth, $intDispHeight, $txtMetaTitle, $txtMetaKey,
							$txtMetaDesc, $radioDisBanner, $radioDisSlideShow, $tabName);
	
		
		if($txtVideo != '')
		{
			//convert video to embedded one 
			$videoURL = $uImg->generateYoutubeEmbedURL($txtVideo);
			
			//add the embedded video
			$videoUpdRes = $uImg->videoUpdate($videoURL, $id, 'static_id', 'video', 'static');
		}
		else
		{
			//add the embedded video
			$videoUpdRes = $uImg->videoUpdate('', $id, 'static_id', 'video', 'static');
		}
		
		//update static image field		
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($id, 'static_id' ,'../images/static/', 'image', 'static');
		}
		
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			//delete the image first
			$utility->deleteFile($id, 'static_id' ,'../images/static/', 'image', 'static');
			
			//generate new name
			$newName = $utility->getNewName4($_FILES['fileImg'], '',$id);
			
			//upload and save image
			$uImg->imgCropResize($_FILES['fileImg'], '', $newName, '../images/static/', 400, 400, 
						  		   $id,'image', 'static_id', 'static');		
								   
			//bengali language table
			$utility->updateField($id, 'static_id',$newName, 'image', 'static_bn', 'NO', '');
			
			//hindi language table
			$utility->updateField($id, 'static_id',$newName, 'image', 'static_hi', 'NO', '');
				
		}
		
		//uploading video
		if($_FILES['fileVideo']['name'] != '')
		{
			//delete the image first
			$utility->deleteFile($id, 'static_id' ,'../images/static/video/', 'upload_video', 'static');
			
			//generate new name
			$newName = $utility->getNewName4($_FILES['fileVideo'], '', $staticId);
			
			//upload and save video
			$utility->fileUpload2($_FILES['fileVideo'], '', $newName, '../images/static/video/', 
								$id,'upload_video', 'static_id', 'static');
		
		}
		
		//static detail content
		$statDtlIds	= $stat->getStaticDtlId($id);
		
		//delete options ids
		$delOptionIds	= array();
		$remainIds		= array();
		
		$txtSubTitle   	= $_POST['txtSubTitle'];
		$txtSubDesc		= $_POST['txtSubDesc'];
		$txtSubImgTitle	= $_POST['txtSubImgTitle'];
		$fileSubImg		= $_FILES['fileSubImg'];
		
		//Added On: October 14, 2011
		$selSubImgPos	= $_POST['selSubImgPos'];
		$intSubImgW		= $_POST['intSubImgW'];
		$intSubImgH		= $_POST['intSubImgH'];
		
		//update the values
		for($i = 0; $i< count($statDtlIds) ; $i++)
		{ 
			//update 
			$stat->updateStaticDtl($statDtlIds[$i], $txtSubTitle[$i], '', $txtSubDesc[$i],
								   $txtSubImgTitle[$i], $selSubImgPos[$i], $intSubImgW[$i], $intSubImgH[$i]);
								   
			//delete images	
			if(isset($_POST['delSubImg'][$i]) && ($_POST['delSubImg'][$i] == 1))
			{
				//delete files
				$utility->deleteFile($statDtlIds[$i], 'static_detail_id' ,'../images/static/', 
									 'image', 'static_detail');
			}
			
			//uploading images
			if($_FILES['fileSubImg']['name'][$i] != '')
			{
			
				//delete files
				$utility->deleteFile($statDtlIds[$i], 'static_detail_id' ,'../images/static/', 
									 'image', 'static_detail');
				
				//rename the file
				$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'], '',
													   $statDtlIds[$i]);
				
				//upload in the server
				$uImg->imgCropResizeArr($i, $_FILES['fileSubImg'], '', $newSubName, 
									   '../images/static/', 400, 400, 
									   $statDtlIds[$i],'image', 'static_detail_id', 'static_detail');
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
				$stat->deleteStaticDtl($k, '../images/static/');
			}
			
		}//if paragraphs
			
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Static Content Edit</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery-1.9.1.min.js"></script>

 <!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "image,fontsizeselect,forecolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,table,|,link,unlink,|,bullist,numlist,|,outdent,indent",
		theme_advanced_buttons2 :
"undo,redo,|,emotions,|,pasteword,|,code",
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


<script type="text/javascript">
function contentTitleCopy()
{
	var x=document.getElementById("txtTitle").value;
	document.getElementById("txtPageTitle").value=x;
}
</script>



<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	
	<?php 
	//CREATING NEW USER FORM
	if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_static') )
	{
		//static detail
		$staticDtl 	= $stat->getStaticData($id);
			
	?>

	  	<h3>Edit Static Content</h3>
        
        <form action="<?php echo $_SERVER['PHP_SELF']."?action=edit_static&id=".$_GET['id'];?>&lang=<?php echo $lang; ?>"
	  	method="post"  enctype="multipart/form-data">
        
            <label>Title<span class="orangeLetter">*</span>	</label>
            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
            onblur="makeContentSEOURL()" onkeyup="contentTitleCopy('txtTitle','txtPageTitle')" value="<?php echo $staticDtl[1]; ?>" size="50" />
            <div class="cl"></div>
             

            <label>Web Page Title (h1 Tag)</label>
            <input name="txtPageTitle" type="text" class="text_box_large" id="txtPageTitle"
            value="<?php echo $staticDtl[13]; ?>" size="50" />
            (leave empty it is same as title)
            <div class="cl"></div>
            
            <label>SEO URL</label>
            <input name="txtSEOURL" type="text" class="text_box_large" id="txtSEOURL"
             value="<?php echo $staticDtl[14]; ?>" size="50" />
             <div class="cl"></div>

            <label>External/Internal URL</label>
            <input name="txtURL" type="text" class="text_box_large" id="txtURL"
             value="<?php echo $staticDtl[20]; ?>" size="50" />
             <div class="cl"></div>

            <label>Category</label>
            <select name="cat_id" id="cat_id" class="textBoxA">
            <?php
                $category->categoryDropDown(0, 0, $staticDtl[0], 'ADD', 0, 'static_categories');
            ?>
            </select>	
            <div class="cl"></div>	
            
            <label>Parent Content</label>
            <select name="selPSId" class="textBoxA" id="selPSId">
            <option value="0">--Select One--</option>
            <?php
            if(isset($_SESSION['selPSId']))
            {
               $stat->populateContentList(0, 0, $_SESSION['selPSId'], 'ADD', 0);
                                           
            }
            elseif(isset($_GET['selPSId']) && ((int)$_GET['selPSId'] > 0))
            {
                $stat->populateContentList(0, 0,$_GET['selPSId'], 'ADD', 0);
                                           
            }
            else
            {
               $stat->populateContentList(0, 0, $staticDtl[23], 'ADD', 0);
            }
            ?>
            </select>
            <div class="cl"></div>	

            <label>Sort Order </label>
              <input name="intSort" type="text" class="text_box_large" id="intSort"
             value="<?php echo $staticDtl[7]; ?>" size="5" maxlength="3" />
             <div class="cl"></div>
            
            <label>Brief</label>
            <textarea  name="txtBrief" cols="40" rows="6" class="textAr" id="txtBrief" 
            wrap="physical"><?php echo str_replace("<br />", "", trim(stripslashes($staticDtl[2])) ); ?></textarea>		
            <div class="cl"></div>	

            <label>Description<span class="orangeLetter">*</span></label>
            <textarea  name="txtDesc" class="textAr" id="txtDesc">
            <?php echo trim(stripslashes($staticDtl[3])); ?>
            </textarea>
            <div class="cl"></div>
            

            <label>Image Title </label>
            <input name="txtImgTitle" type="text" class="text_box_large" id="txtImgTitle" 
             value="<?php echo $staticDtl[5]; ?>" />
            <div class="cl"></div>
             
            <label>Page Position</span></label>
            <input  class="radio" name="radioImgPosition" type="radio" value="l" title="ImgPosition Left"
            <?php echo $utility->checkString($staticDtl[11],'l');?>><label  class="radio">Left</label>
                
            <input  class="radio" name="radioImgPosition" type="radio" value="c" title="ImgPosition Centre"
            <?php echo $utility->checkString($staticDtl[11],'c');?>><label  class="radio">Centre</label>
            
             <input  class="radio" name="radioImgPosition" type="radio" value="r" title="ImgPosition Right"
            <?php echo $utility->checkString($staticDtl[11],'r');?>><label  class="radio">Right</label>
            <div class="cl"></div>
            

            <label>Image/Photo</label>
            <div class="fr">
            <?php 
                echo $utility->imageDisplay2('../images/static/', $staticDtl[4], 100, 100, 0,
                                               'greyBorder', $staticDtl[5]); 
            ?>
            </div>
            <input name="fileImg" type="file" class="text_box_large" id="fileImg">
            <span class="menuText">(800 X 800 pixels in width by height)</span><br />
        
            <?php 
            if( ($staticDtl[4] != '' ) && (file_exists("../images/static/".$staticDtl[4])) )
            {
                echo "<input name=\"delImg\" type=\"checkbox\" value=\"1\"> 
                <span class='blackLarge'>Delete this image</span>"; 
            }
            ?>
            
            <div class="cl"></div>	
            
            <label>Image Display Size in Pixels</label>
            <div class="cl"></div>
            <label>Display Width</label>
             <input name="intDispWidth" type="text" class="text_box_large" id="intDispWidth" maxlength="4" size="6" 
             value="<?php echo $staticDtl[15]; ?>" />
             <div class="cl"></div>
                 
             <label>Display Height</label>
             <input name="intDispHeight" type="text" class="text_box_large" id="intDispHeight" maxlength="4" size="6"
             value="<?php echo $staticDtl[16]; ?>" />
             <div class="cl"></div>
             

            <label>Link to Youtube Video</label>
            <input name="txtVideo" type="text" class="text_box_large" id="txtVideo" 
             value="<?php echo $staticDtl[10]; ?>" size="25" /><!--$staticDtl[10]-->
            <div class="cl"></div>

            <label>Video</label>
            <input name="fileVideo" type="file" class="text_box_large" id="fileVideo" />
            <div class="cl"></div>
         
          <label>Meta Title</label>
          <input name="txtMetaTitle" type="text" class="text_box_large" id="txtMetaTitle" 
          value="<?php echo $staticDtl[17]; ?>" size="40" />
            <div class="cl"></div>
          <label>Meta Keywords/Tags</label>
            
                <input name="txtMetaKey" type="text" class="text_box_large" id="txtMetaKey" 
                 value="<?php echo $staticDtl[18]; ?>" size="40" />
            <div class="cl"></div>
          <label>Meta Description</label>
            
                <input name="txtMetaDesc" type="text" class="text_box_large" id="txtMetaDesc" 
                 value="<?php echo $staticDtl[19]; ?>" size="40" />
            <div class="cl"></div>
          
            <label><span class="menuText">Display Banner</span></label>
            <input name="radioDisBanner" type="radio" value="Y" class="radio" title="Display Banner Yes" id="radioDisBanner"
            <?php echo $utility->checkString($staticDtl[21],'Y');?>><label class="radio">Yes</label>
                
            <input name="radioDisBanner" type="radio" value="N" class="radio" title="Display Banner No" id="radioDisBanner"
            <?php echo $utility->checkString($staticDtl[21],'N');?>><label class="radio">No</label>
                
            <div class="cl"></div>
          
            <label><span class="menuText">Display Slide Show</span></label>
            <input name="radioDisSlideShow" type="radio" value="Y" class="radio" title="Slide Show Yes" id="radioDisSlideShow"
            <?php echo $utility->checkString($staticDtl[22],'Y');?>><label class="radio">Yes</label>            
            <input name="radioDisSlideShow" type="radio" value="N" class="radio" title="Slide Show No" id="radioDisSlideShow"
            <?php echo $utility->checkString($staticDtl[22],'N');?>><label class="radio">No</label>
                
            <div class="cl"></div>
          

            <h4>Additional Sections</h4>
			
            <?php echo $stat->showDelStaticDtl($id, '../images/static/');?>   
               
           <div class="cl"></div>

            <input name="btnEditStatic" type="submit" class="button-add" value="edit" />
            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" onClick="self.close()" />	

        
        </form>

	<?php 
	}//eof
	?>
</div>
