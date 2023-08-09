<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/services.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$services		= new Services();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
//admin detail
$userData 		=  $adminLogin->getUserDetail($_SESSION[ADM_SESS]);
//parent ids
$pIds	= $utility->getAllId('categories_id', 'static_categories');


if(isset($_POST['btnAddServices']))
{
	
	$ServiceCat		= $_POST['ServiceCat'];
	$txtTitle		= $_POST['txtTitle'];
	$txtServDesc	= $_POST['txtServDesc'];
	
	$txtPageTitle	= $_POST['txtPageTitle'];
	$txtSEOURL		= $_POST['txtSEOURL'];
	
	
	$txtMetaTitle	= $_POST['txtMetaTitle'];
	$txtMetaKey		= $_POST['txtMetaKey'];
	$txtMetaDesc	= $_POST['txtMetaDesc'];
	
	$txtCANO		= $_POST['txtCANO'];
	$intSort		= $_POST['intSort'];
	$selNum 	    = $_POST['selNum'];
	
	//defining error variables
	$action		= 'addServices';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'editStatic';
	$typeM		= 'ERROR';
	$msg = '';
	
	$duplicateId	= $error->duplicateUser($txtDomainUrl, 'txtTitle', 'services');

	if(preg_match("^ER^",$duplicateId))
	{
		//echo "<span class='orangeLetter'>Error: Domain is already taken</span >";
		$error->showErrorTA($action, $id, $id_var, $url, 'Service Name Url is already taken', $typeM, $anchor);
	}
	else if($txtTitle == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON002, $typeM, $anchor);
	}
	/*else if(($cat_id == 0) || (!in_array($cat_id, $pIds)))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON004, $typeM, $anchor);;
	}
	elseif( ($txtVideo != '') && ($urlRes == 'ER') )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERURL001, $typeM, $anchor);
	}
	elseif( ($txtVideo != '') && ($curlRes == 'NOT_FOUND') )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERURL002, $typeM, $anchor);
	}*/
	else
	{
		
		//Services Add
		$servId = $services->addServices($ServiceCat, $txtTitle, $txtServDesc, $txtPageTitle, $txtSEOURL, $txtMetaTitle, $txtMetaKey, $txtMetaDesc, 
					        $txtCANO, $intSort, $userData[10]);
	
		//uploading images
		if($_FILES['serviceIcon']['name'] != '')
		{
			//delete the image first
			$utility->deleteFile($id, 'id' ,'../images/services/', 'image', 'services');
			
			//generate new name
			$newName = $utility->getNewName4($_FILES['serviceIcon'], '',$servId);
			
			//upload and save image
			$uImg->imgUpdResize($_FILES['serviceIcon'], '', $newName, '../images/services/',400, 400, 
						  		   $servId,'image', 'id', 'services');			
		}
		
		
		for($i=0; $i < $selNum; $i++)
			{
				$txtFeaturedName 		= $_POST['txtFeaturedName'][$i];
				$txtFeaturedDesc 		= $_POST['txtFeaturedDesc'][$i];
				
				$servFeaturedId 	=   $services->addServicesfeatued($servId, $txtFeaturedName, $txtFeaturedDesc, $userData[10]);
				//uploading images
				if($_FILES['fileImg']['name'][$i] != '')
				{ 
					
					//rename the file
					$newSubName = $utility->getNewName4Arr($i, $_FILES['fileImg'], '',
														   $servFeaturedId);
					
					//upload in the server
					$uImg->imgUpdResizeArr($i, $_FILES['fileImg'], '', $newSubName, 
										   '../images/services/', 800, 800, 
										   $servFeaturedId,'images', 'id', 'service_featured');
					
				}//upload
			}	
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', 'services.php', SUSTCON002, 'SUCCESS');
	}
	
}
else if(isset($_POST['btnCancel']))
{
	header("Location: services.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Services Add</title>
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
<script type="text/javascript" src="js/service-featured.js"></script>
<script type="text/javascript" src="../js/services.js"></script>


<script type="text/javascript" src="../js/jQuery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.min.js"></script>
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
$(document).ready(function()
{
		$('.form-heading img').click(function()
	{
		var imgId		= $(this).attr('id');
		var imgArr		= imgId.split('-');
		var id			= imgArr[0];
		if(imgArr[1] == 'minus')
		{
			$('#'+imgArr[0]+'-body').slideUp();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-plus').removeClass('hide-dtl').addClass('form-img');
		}
		else if(imgArr[1] == 'plus')
		{
			$('#'+imgArr[0]+'-body').slideDown();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-minus').removeClass('hide-dtl').addClass('form-img');
		}

	})
	
	
	
});
</script>


<script type="text/javascript">
function contentTitleCopy()
{
	var x=document.getElementById("txtTitle").value;
	document.getElementById("txtPageTitle").value=x;
}
</script>

</head>

<body>


    <!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<div id="admin-menu">
				<?php require_once('menu.inc.php'); ?>
            </div>
            
            <!-- Inner  -->
            <div id="admin-body">
            	
                <div id="admin-top">
                	<h1>Add New Services</h1>
                </div>
               
                <!-- Form -->
                <div class="webform-area">
					<?php 
                    //display message
                    $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
                    
                    //close button
                    echo $utility->showCloseButton();
                    ?>
                    
                    <?php 
                    //CREATING NEW USER FORM
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'addServices') )
                    {
            
                    ?>
                               
                        <form action="<?php echo $_SERVER['PHP_SELF']."?action=addServices"?>"
                        method="post"  enctype="multipart/form-data">
                        
                        	<div class="form-section" id="title">
                                <div class="form-heading" id="title-heading">
                                    <!--<img id="title-plus" class="hide-dtl" src="../images/admin/icon/plus-sign.png" />
                                    <img id="title-minus" class="form-img" src="../images/admin/icon/minus-sign.png" />-->
                                    <h2>Service Details</h2>
                                    <div class="cl"></div>
                                </div>
                                                                
                                <label>Category</label>
                                <select name="ServiceCat" id="ServiceCat" class="textBoxA">
                                <?php
									$serCat = $services->ShowServicesCatData();
									foreach($serCat as $eachRecord)
										{
                                ?>
										<option value="<?php echo $eachRecord['id']; ?>"><?php echo $eachRecord['cat_name']; ?></option>
								<?php
										}
										
                                ?>
                                </select>	
                                <div class="cl"></div>	
                              
								<label>Service Name<span class="orangeLetter">*</span></label>
                                <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
                                onblur="makeServContentSEOURL()" onkeyup="contentTitleCopy()"
                                 value="<?php $utility->printSess('txtTitle'); ?>" size="50" />				
                                <div class="cl"></div>
                                
                                <label>Service Description<span class="orangeLetter">*</span></label>
                                <textarea  name="txtServDesc" class="textAr" id="txtServDesc">
                                </textarea>
                                <div class="cl"></div>
								
								<label>Service Icon<span class="required">*</span></label>
								<input name="serviceIcon" type="file" class="text_box_large" 
								id="serviceIcon" ">	
								<div class="cl"></div>
                            
                            </div>
							
							
                            <div class="form-section" id="advance">
                                <div class="form-heading" id="advance-heading">
                                    <img id="advance-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                    <img id="advance-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                    <h2>Service Features</h2>
                                    <div class="cl"></div>
                                </div>
                                <div id="advance-body" class="hide-dtl">
								
                            		<div class="cl"></div>
										<tr>
											<label>Select No. of Features </label>
											<!--<td align="left" class="menuText">Select No. Type </td>-->
											<td align="left" class="bodyText pad5">
												<?php 
												//gen number array
												$arr_value	= range(1,15);
												$arr_label	= range(1,15);
												?>
												  <select name="selNum" id="selNum" onchange="return getServiceFeatured();"
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
											</td>
										</tr>
										<div class="cl"></div>
										<div id="showServicesFeaturd"></div>
										
                                    <div class="cl"></div>
                                </div>
                            </div>	
                            
                            <div class="form-section" id="filter">
                                <div class="form-heading" id="filter-heading">
                                    <img id="filter-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                    <img id="filter-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                    <h2>Additional Filter</h2>
                                    <div class="cl"></div>
                                </div>
                                <div id="filter-body" class="hide-dtl">
                                	<label>Meta Title</label>
                                    <input name="txtMetaTitle" type="text" class="text_box_large" id="txtMetaTitle" 
                                     size="40" />
                                    <div class="cl"></div>
                                    <label>Meta Keywords/Tags</label>
                                    
                                    <input name="txtMetaKey" type="text" class="text_box_large" id="txtMetaKey" 
                                     size="40" />
                                    <div class="cl"></div>
                                    <label>Meta Description</label>
									<textarea  name="txtMetaDesc" class="textAr" id="txtMetaDesc" >
									</textarea>
                                    
                                    <div class="cl"></div>
                                </div>
                            </div>
                            
                            <div class="form-section" id="seo">
                                <div class="form-heading" id="seo-heading">
                                    <img id="seo-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                    <img id="seo-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                    <h2>Custom Seo</h2>
                                    <div class="cl"></div>
                                </div>
                                <div id="seo-body" class="hide-dtl">
                                	<label>Web Page Title (h1 Tag)</label>
                                    <input name="txtPageTitle" type="text" class="text_box_large" id="txtPageTitle"
                                     size="50" />
                                    (leave empty it is same as title)
                                    <div class="cl"></div>
                                    
									<label>SEO URL</label>
									<input name="txtSEOURL" type="text" class="text_box_large" id="txtSEOURL"
									value="<?php $utility->printSess('txtSEOURL'); ?>" size="50" maxlength="128" />
									<div class="cl"></div>
                                    
                                    <label>Canonical</label>
                                    <input name="txtCANO" type="text" class="text_box_large" id="txtCANO"
                                     size="50" />
                                    <div class="cl"></div>
                        
                                    <label>Sort Order </label>
                                    <input name="intSort" type="text" class="text_box_large" id="intSort"
                                    value="1" size="5" maxlength="3" />
                                    <div class="cl"></div>
                                </div>
                            </div>
                
                            
                            <?php /*?><label>Brief</label>
                            <textarea  name="txtBrief" cols="40" rows="6" class="textAr" id="txtBrief" 
                            wrap="physical"><?php echo str_replace("<br />", "", trim(stripslashes($staticDtl[2])) ); ?></textarea>		
                            <div class="cl"></div><?php */?>
                            
                            <input name="btnAddServices" type="submit" class="button-add" value="Add" />
                            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />	
                
                        
                        </form>
                
                    <?php 
                    }//eof
                    ?>
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
            </div>
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
    
</body>
</html>