<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/image.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");  
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


if(isset($_GET['album_id']))
{
	$album_id = $_GET['album_id'];
}

if(isset($_POST['btnDeleteAlbum']))
{	
	//defining error variables
	$action		= 'deleteAlbum';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $album_id;
	$id_var		= 'album_id';
	$typeM		= 'ERROR'; 
	$aname		= '';

	//check if sub category is there					 
	$subcat  = $error->checkChild($album_id, 'album');
	
	if(ereg("^ER",$subcat))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG107, $typeM, $aname);
	}
	else if($album_id == 1)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERIMG108, $typeM, $aname);
	}
	else
	{						     
		//delete album image
		$utility->deleteFile($_GET['album_id'],'categories_id','../images/gallery/album/', 
							 'categories_image', 'album');
							 
		//get all image id
		$imageIds = $photo->getImageId($_GET['album_id']);
		
		if(count($imageIds) > 0 )
		{
			foreach($imageIds as $j)
			{
				//delete thumbnail image
				$utility->deleteFile($j, 'im_id' ,'../images/gallery/thumbnail/', 
									 'im_thumbnail', 'album_image');
				
				//get the image detail
				$imgDetail	= $photo->showImage($j);
				
				if($imgDetail[14] == 'IMG')
				{
					//delete gallery image
					$utility->deleteFile($j, 'im_id' ,'../images/gallery/gallery/', 
										 'im_image', 'album_image');
					
					//delete 800 image
					$utility->deleteFile($j, 'im_id' ,'../images/gallery/800/', 'im_800', 'album_image');
			
					//delete main image
					//$utility->deleteFile($j, 'im_id' ,'../images/gallery/original/', 'im_original','album_image');
				}
				else if($imgDetail[14] == 'VIDEO')
				{
					//delete the video
					$utility->deleteFile($j, 'im_id' ,'../images/gallery/video/', 'media_file', 'album_image');
				}
				else
				{
					//delete audio
					$utility->deleteFile($j, 'im_id' ,'../images/gallery/audio/', 'media_file', 'album_image');
				}
									 
			
			}
		}
		
		//delete main info execept the album added inside the system
		if($_GET['album_id'] != 1)
		{
			$album->deleteAlbum($_GET['album_id']);
		}
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUIMG103, 'SUCCESS');
	}
}
?>

<title><?php echo COMPANY_S; ?> - Delete Album</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
	if( (isset($_GET['action'])) && ($_GET['action'] == 'deleteAlbum') )
	{
		$albumDtl = $album->showAlbum($album_id);
	?>
		<h3>Delete Album</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']."?album_id=".$_GET['album_id'];?>" 
        method="post">

			<div class="fl w325 padR10">
			Are you sure that you want to delete the album named <?php echo $albumDtl[0]; ?>
			<br /><br />
			
			<span class="orangeLetter bld padR10">NOTE:</span> 
			<span class="blackLarge">
			If you delete the album, the images belong to this album will be lost. 			
			</span>
			
			
			</div>
			<div class="fl w100">
				<?php 
				if(($albumDtl[2] != '') && (file_exists("../images/gallery/album/".$albumDtl[2])) )
				{
					echo $utility->imageDisplay2('../images/gallery/album/', $albumDtl[2],
										         100, 75, 0, 'greyBorder', $albumDtl[0]);
				}
				?>
			</div>
			
			<div class="cl"></div>

			<input name="btnDeleteAlbum" type="submit" class="button-add" 
			id="btnDeleteAlbum" value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="self.close()" value="cancel" />

	  </form>

	<?php 
	}//eof
	?>
</div>