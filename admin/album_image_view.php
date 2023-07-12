<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");


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
$album_id		= $utility->returnGetVar('album_id',0);
$link			= '';
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);
$numVar			= "&numResDisplay=".$numResDisplay;



$albumVar	= "&album_id=".$album_id;
$link		= $link.$albumVar.$numVar ;

$noOfImg 	= $photo-> getImageId($album_id);
$albumDtl	= $album->showAlbum($_GET['album_id']);

/**
*	Add image
*/
if(isset($_POST['btnAddImage']))
{
	//hold post values
	$album_id		=  $_POST['album_id'];
	$txtName		=  $_POST['txtName'];
	$txtDesc		=  $_POST['txtDesc'];
	$cusId  		=  (int)($_POST['cusId']);
	$img			=  $_FILES['fileImage']['name'];
	$intOrder		=  $_POST['intOrder'];
	$dateShotOn		=  $_POST['dateShotOn'];
	
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
	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG202, $typeM, $anchor);
	}
	elseif( ($selMediaType == 'VIDEO') && ($_FILES['fileMedia']['name'] == ''))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG301, $typeM, $anchor);
	}
	elseif( ($selMediaType == 'AUDIO') && ($_FILES['fileMedia']['name'] == ''))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG301, $typeM, $anchor);
	}
	else
	{
		//add image
		$imageId = $photo->addImage($album_id,$txtName,$txtDesc,$cusId,'a', $dateShotOn, $intOrder, $selMediaType);
		
		//name of the image 
		$newName = $utility->getNewName4($_FILES['fileImage'], '',$imageId);
		
		
		//upload image
		if( ($selMediaType == 'IMG') && ($_FILES['fileImage']['name'] != '') )
		{
			//name of the image 
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$imageId);
			
			
			//start uploading images
			//gallery image	
			/*$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/gallery/', 
								   550, 252, $imageId, 'im_image', 'im_id', 'album_image');*/
			
			
			//thumbnail image	
			$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/thumbnail/', 
								   212, 157, $imageId, 'im_thumbnail', 'im_id', 'album_image');
							
								   
			//gallery image	
			$uImg->imgUpdResize($_FILES['fileImage'],'',$newName,'../images/gallery/gallery/', 
								   600, 600, $imageId, 'im_image', 'im_id', 'album_image');
			
			
			//800 by 800 	
			$uImg->imgUpdResize($_FILES['fileImage'],'',$newName,'../images/gallery/800/', 
								   800, 800, $imageId, 'im_800', 'im_id', 'album_image');
			
			//original image	
			//$utility->fileUpload2($_FILES['fileImage'], '', $newName , '../images/gallery/original/', 
								  // $imageId, 'im_original', 'im_id', 'album_image');	
		}
		
		
		//if media type is audio or video
		if( ( ($selMediaType == 'AUDIO') || ($selMediaType == 'VIDEO') ) && ($_FILES['fileMedia']['name'] != '') )
		{
			//upload the thumb
			if($_FILES['fileImage']['name'] != '') 
			{
				//name of the image 
				$newName = $utility->getNewName4($_FILES['fileImage'], '',$imageId);
				
				//thumbnail image	
				$uImg->imgCropResize($_FILES['fileImage'],'',$newName,'../images/gallery/thumbnail/', 
								   202, 151, $imageId, 'im_thumbnail', 'im_id', 'album_image');
			}
			
			//name of the audio or video 
			$newNameM = $utility->getNewName4($_FILES['fileMedia'], '',$imageId);
			
			//decide whether it is audio or video
			if($selMediaType == 'AUDIO')
			{
				//audio
				$utility->fileUpload2($_FILES['fileMedia'], '', $newNameM, '../images/gallery/audio/', 
									  $imageId, 'media_file', 'im_id', 'album_image');				 
			}
			else if($selMediaType == 'VIDEO')
			{
				//audio
				$utility->fileUpload2($_FILES['fileMedia'], '', $newNameM, '../images/gallery/video/', 
									  $imageId, 'media_file', 'im_id', 'album_image');
			}
		}
		
		
		
		//remove session
		$utility->delSessArr($sess_arr);
	
		//forward
		$uMesg->showSuccessT('success', $id, 'album_id', $_SERVER['PHP_SELF'], SUIMG201, 'SUCCESS');

	}
	
}//end of add image


/**
*	On pressing button cancel
*/
if(isset($_POST['btnCancel']))
{
	//hold in session array
	$sess_arr	= array('album_id', 'txtName','txtDesc','cusId', 'intOrder', 'dateShotOn', 'selMediaType');
	
	//delete the session
	$utility->delSessArr($sess_arr);
	
	//forward
	header("Location: ".$_SERVER['PHP_SELF']);
}

/* Start Pagination */
$total = count($noOfImg);

$pageArray = array_chunk($noOfImg, $numResDisplay);

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

$link = $link.$pageVar;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?>- Album and Image gallery</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/activity.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<!-- eof JS Libraries -->

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
                    	<a href="<?php echo "album.php"?>">View Main Gallery</a>
                    </div>
                    <div class="add-new-option">
                    	<a href="<?php echo "album.php?action=addAlbum#addAlbum"?>">Add New Album</a>
                    </div>
                    <div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=addImage&album_id=".$album_id."#addImage"?>">Add Media </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                <h2><a name="addUser">Photograph, Artwork Management</a></h2>
               <table class="single-column" cellpadding="0" cellspacing="0">
				<?php 
				
				if(count($noOfImg) == 0)
				{
					
				 ?>
				 <tr class="orangeLetter">
				  <td><?php echo ERIMG101; ?> </td>					 
				 </tr>
				<?php
				}
				else
				{	
				?>
				<thead align="center" class="tableHead">
				  <th width="4%">#</th>
				  <th width="15%">Title</th>
				  <th width="10%">Image</th>
				  <th width="9%">Status</th>
				  <th width="10%">Added On</th>
				  <th width="15%">Action</th>
				</thead>
				<?php 
					
					$x = $page->getSerialNum($numResDisplay);
					
					foreach($pageArray[$pageNumber] as $j => $value)
				    {
						//get the primary key
					    $k = $pageArray[$pageNumber][$j];
						
						//get image detail
						$imgDtl	= $photo->showImage($k);
						$cusId = 0;
						
						//get the background color of the row
						$bgColor 	= $utility->getRowColor($x);	
				?>
					<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);  ?>>
				  <td><?php echo $x++; ?></td>
				  <td>
					<strong><?php echo $imgDtl[1]; ?></strong><br />
					<div>Clicks: <?php echo $imgDtl[9]; ?></div>  </td>
				 
                  <td>
				  <?php 
				  if($imgDtl[14] == 'IMG')
				  {
					  if(($imgDtl[4] != '') && (file_exists("../images/gallery/thumbnail/".$imgDtl[4])))
					  {
					  echo "<div>
					  <img src='"."../images/gallery/thumbnail/".$imgDtl[4]."'  height='75', width='100' border='0'></div>"; 
					  }
					  else if(($imgDtl[3] != '') && (file_exists("../images/gallery/gallery/".$imgDtl[3])))
					  {
						 echo "<div>
						<img src='"."../images/gallery/gallery/".$imgDtl[3]."' border='0' height='75', width='100'
						alt='".$imgDtl[1]."'
						></div>"; 
					  }
				  }
				  else if($imgDtl[14] == 'VIDEO')
				  {
				  ?>
                  	<a href="javascript:void(0)" onClick="MM_openBrWindow('album_show_video.php?action=view_video&image_id=<?php echo $k; ?>','ChangeStatus','status=yes,scrollbars=yes,width=600,height=500')">
                    <?php 
					if(($imgDtl[4] != '') && (file_exists("../images/gallery/thumbnail/".$imgDtl[4])))
					{
					  echo "<div><img src='"."../images/gallery/thumbnail/".$imgDtl[4]."'  height='75' width='100' border='0'></div>"; 
					}
					else
					{
					 	echo $utility->imageDisplay2('../images/icon/', 'video-icon.png', 100, 100, 0, '', $imgDtl[1]); 
					}
					?>
                   </a>
				  <?php 								 
				  }
				  else if($imgDtl[14] == 'AUDIO')
				  {
				  ?>
                  	<a href="javascript:void(0)" onClick="MM_openBrWindow('album_play_audio.php?action=view_video&image_id=<?php echo $k; ?>','ChangeStatus','status=yes,scrollbars=yes,width=600,height=500')">
                    <?php 
					if(($imgDtl[4] != '') && (file_exists("../images/gallery/thumbnail/".$imgDtl[4])))
					{
					  echo "<div><img src='"."../images/gallery/thumbnail/".$imgDtl[4]."'  height='75' width='100' border='0'></div>"; 
					}
					else
					{
					 	echo $utility->imageDisplay2('../images/icon/', 'audio-icon.png', 100, 100, 0, '', $imgDtl[1]); 
					}
					?>
                   </a>
				  <?php 
				  }
				  else
				  {
					echo $utility->imageDisplay2('../images/icon/', 'noImage75.jpg', 75, 100, 0, '', 'No Image');
							
				  }
				  //$imageSize = $image->getImageSize("../images/gallery/gallery/", $imgDtl[3]);
				  ?>
                  </td>
				  <td>
					[ <a href="javascript:void(0)" onClick="MM_openBrWindow('album_img_status.php?action=change_status&image_id=<?php echo $k; ?>','ChangeStatus','status=yes,scrollbars=yes,width=400,height=350')">
				    <?php 
                    echo $utility->getStatusMesg($imgDtl[8]);
                    ?>
                    </a> ]					  
                  </td>
				  <td>
					 <?php echo $dateUtil->printDate($imgDtl[5]); ?>
                  </td>
				  <td>
				  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('albumImgView.php?image_id=<?php echo $k; ?>','ViewImage','status=yes,width=650,height=550')" class="curP">View</a> ] 
				  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('albumImgEdit.php?action=editImg&image_id=<?php echo $k; ?>','AlbumEdit','status=yes,scrollbars=yes,width=600,height=500')" class="curP">Edit</a> ]<br> 
				  [ <a href="javascript:void(0)" onClick="MM_openBrWindow('albumImgDelete.php?action=deleteImg&image_id=<?php echo $k; ?>','','status=yes,scrollbars=yes,width=500,height=300')" class="curP">Delete</a> ]</td>
				</tr> 
				<?php 
					}
				}//end of else
				?>
			  </table>
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <td class="blackLarge padT20">Total Photograph, Artwork : <?php echo count($noOfImg);?></td>
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
					if(isset($_GET['action']) && ($_GET['action'] == 'addImage')) 
					{	
					?>
                   
                        <h2><a name="addUser">Add Photograph</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <?php include_once('albumImgAdd.php'); ?>
                   
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