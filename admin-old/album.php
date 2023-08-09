<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php");  
require_once("../includes/category.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");
require_once("../classes/category.class.php");


require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/pagination.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();
$category		= new Cat();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$page			= new Pagination();

#########################################################################################

//declare type 
$typeM			= $utility->returnGetVar('typeM','');

$link			= '';
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);
$numVar			= "&numResDisplay=".$numResDisplay;




//add album
if(isset($_POST['btnAddAlbum']))
{
	//post vars
	$txtParentId	=  $_POST['txtParentId'];
	$txtName		=  $_POST['txtName'];
	$txtDesc		=  $_POST['txtDesc'];
	$img			=  $_FILES['fileImage']['name'];
	$cusId  		=  0;//(int)($_POST['cusId'])
	$intOrder		=  $_POST['intOrder'];
	$dateShotOn		=  $_POST['dateShotOn'];
	
	//added on December 06, 2010
	$selType		=  $_POST['selType'];
	$selTypeId		=  1;//$_POST['selTypeId']

	
	
	//registering the post session variables
	$sess_arr	= array('txtName', 'txtDesc','cusId', 'intOrder', 'dateShotOn', 'txtParentId', 'selType', 'selTypeId');
	$utility->addPostSessArr($sess_arr);
	
	
	//defining error variables
	$action		= 'addAlbum';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addAlbum';
	$typeM		= 'ERROR';
	
	//check for error
	$duplicate = $error->duplicateCat($txtParentId, $txtName, 0, 'album');
	
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG102, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT201, $typeM, $aname);
	}
	else
	{
		//add album
		$albumId = $album->addAlbum($txtParentId, $txtName, $txtDesc, $cusId, 'a',
					   				$dateShotOn, $intOrder, $selType, $selTypeId);
		
		
		//add image
		if($_FILES['fileImage']['name'] != '')
		{
			//rename the file
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$albumId);
			
			//resizing the image
			$uImg->imgCropResize($_FILES['fileImage'], '', $newName, 
								   '../images/gallery/album/', 
								   800, 600, $albumId,'categories_image', 'categories_id', 'album');
			
		}
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUIMG101, 'SUCCESS');
	}
	
}//end of add album



/**
*	On pressing button cancel
*/
if(isset($_POST['btnCancel']))
{
	//hold in session array
	$sess_arr	= array('txtName', 'txtDesc','cusId', 'intOrder', 'dateShotOn', 'txtParentId', 'selType', 'selTypeId');
	
	//delete the session
	$utility->delSessArr($sess_arr);
	
	//forward
	header("Location: ".$_SERVER['PHP_SELF']);
}

/* Start Pagination */
$noOfAlbum = $album->getAlbumId();

$total = count($noOfAlbum);

$pageArray = array_chunk($noOfAlbum, $numResDisplay);

$newPage = array();
$name = "Page";
$numPages = ceil($total/$numResDisplay);

if(isset($_GET['mypage']))
{
 $myPage = $_GET['mypage'];
}
else
{
	$myPage = 'Array0';
}

$arrayNum = explode("Array",$myPage);

$pageNumber = (int)$arrayNum[1];


if($total == 0)
{
	$total = (int)$total;
}

//page variable
$pageVar	= "&Page=".$myPage;

//redeclare link
$link= $link.$pageVar.$numVar;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?>- Album and Image gallery</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
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
<script type="text/javascript" src="../js/image.js"></script>
<!-- eof JS Libraries -->

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
                	<h1>Photo Gallery</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo "album.php?action=addAlbum#addAlbum"?>">Add New Album</a>
                    </div>
                    
                    <div class="add-new-option">
                    	<a href="javascript:void(0)" onClick="MM_openBrWindow('albumImageAdd.php?action=addImage&albumId=<?php echo 0; ?>','ImageAdd','status=yes,scrollbars=yes,width=650,height=600')" class="curP">Add Media</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
             <table class="single-column" cellpadding="0" cellspacing="0">

				<?php 
				
				if(count($noOfAlbum) == 0)
				{
					
				 ?>
				 <tr class="orangeLetter">
				  <td colspan="3" class="padL10">
					<?php echo ERIMG101; ?>				  </td>
				 </tr>
				<?php
				}
				else
				{	
				?>
				<thead align="center" class="tableHead">
				  <th width="5%">#</th>
				  <th width="20%">Album</th>
				  <th width="27%">Image </th>
				  <th width="9%">Status</th>
				  <th width="13%">added on </th>
				  <th width="26%">Action</th>
				</thead>
				<?php 
					
					$x = $page->getSerialNum($numResDisplay);
					
					foreach($pageArray[$pageNumber] as $j => $value)
				    {
						//get the primary key
					    $k = $pageArray[$pageNumber][$j];
						
						//get album detail
						$albumDetail = $album->showAlbum($k);
						$cusId = 0;
						$imgIds	= $photo->getImageId($k);
						
						//get the background color of the row
						$bgColor 	= $utility->getRowColor($x);	
				?>
					<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);  ?>>
					  <td><?php echo $x++; ?></td>
					  <td>
						<strong><?php echo $albumDetail[0]; ?></strong>
                        <div class="blackLarge padT5">No. File: <?php echo count($imgIds); ?></div>
						<div class="greenLetter padT5">Clicks: <?php echo $albumDetail[7]; ?></div>					 
                     </td>
                     
					  <td>
					  <?php 
					  
					  if(($albumDetail[2] != '') && (file_exists("../images/gallery/album/".$albumDetail[2])))
					  {
						 echo "<div style='padding:3px;'>
						 <img src='../images/gallery/album/".$albumDetail[2]."' border='0' height='150' width='200' alt='".$albumDetail[0]."'>
						 </div>"; 
					  }
					  else
					  {
						echo $utility->imageDisplay2('../images/icon/', 'noImage75.jpg', 75, 75, 
							0, '', 'No Image');
					  }
					  ?>					 
                      </td>
                      
					  <td>
					  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('album_status.php?action=change_status&album_id=<?php echo $k; ?>','ChangeStatus','status=yes,scrollbars=yes,width=450,height=500')">
					  <?php 
					  echo $utility->getStatusMesg($albumDetail[6]);
					  ?>
					  </a> ]					  
                      </td>
					  <td>
					  	<?php echo $dateUtil->printDate($albumDetail[3]); ?>					  
                      </td>
					  <td>
					  <div>
					  [ <a href="<?php echo "album_image_view.php?action=viewAlbum&album_id=".$k.$link;?>#viewAlbum">Album View</a> ] 
					  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('albumEdit.php?action=editAlbum&album_id=<?php echo $k; ?>','AlbumEdit','status=yes,scrollbars=yes,width=650,height=500')" class="curP">Edit</a> ]					  </div>
					  
					  <?php
					  //don't allow to delete album id 1 
					  if($k != 1)
					  {
					  ?>
					  <div class="padT5">
					  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('albumDelete.php?action=deleteAlbum&album_id=<?php echo $k; ?>','','status=yes,scrollbars=yes,width=500,height=400')" class="curP">Delete</a> ]					  </div>
					  <?php 
					  }
					  ?>
					  
					  <div class="padT5">
					  [
					  <a href="javascript:void(0)" onClick="MM_openBrWindow('albumImageAdd.php?action=addImage&album_id=<?php echo $k; ?>','ImageAdd','status=yes,scrollbars=yes,width=800,height=700')" class="curP">add media</a>   
					  ]					  </div>
					  
					  <div class="padT5">
					  [
					  <a title="add sub album"
					  href="<?php echo "album.php?action=addAlbum&txtParentId=".$k."#addAlbum"?>"> 
					  	Add New Album					  </a>
					  ]					  </div>					 
                    </td>
					</tr> 
				<?php 

					}
				}//end of else
				?>
			  </table>
                    
                	
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <td class="blackLarge padT20">Total  Album: <?php echo count($noOfAlbum);?></td>
                            <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'addAlbum')) 
					{	
					?>
                   
                        <h2><a name="addUser">Add Album</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <?php include_once('albumAdd.php'); ?>

                    <?php 
					}
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