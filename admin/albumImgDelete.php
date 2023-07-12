<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php"); 
include_once('../classes/image.class.php');
 
require_once("../classes/date.class.php");
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php");



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$album			= new Album();
$photo  		= new Photo();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


if(isset($_GET['image_id']))
{
	$image_id = $_GET['image_id'];
	
}

if(isset($_POST['btnDeleteImg']))
{	
	//delete thumbnail image
	$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/thumbnail/', 'im_thumbnail', 'album_image');
	
	//delete gallery image
	$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/gallery/', 'im_image', 'album_image');
	
	//delete 800 image
	$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/800/', 'im_800', 'album_image');
	
	//delete main image
	$utility->deleteFile($_GET['image_id'], 'im_id' ,'../images/gallery/original/', 'im_original', 'album_image');
						
		
	//delete main info
	$photo->deleteImage($_GET['image_id']);
	
	//forward
	$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUIMG203, 'SUCCESS');
	
}
?>
<title><?php echo COMPANY_S; ?> - Delete Photograph</title>
<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    if( (isset($_GET['action'])) && ($_GET['action'] == 'deleteImg') )
    {
        $imageDtl = $photo->showImage($image_id);
    ?>

      <h3>Delete Photograph</h3>

      <form action="<?php echo $_SERVER['PHP_SELF']."?image_id=".$_GET['image_id'];?>" method="post">
			Are you sure	that	you	want	to delete the image named <?php echo $imageDtl[1]; ?>
            <div class="fr">
            
            

              <?php 
                if(($imageDtl[3] != '') || ($imageDtl[3] != NULL) && (file_exists("../images/gallery/gallery/".$imageDtl[3])))
                {
				  echo $utility->imageDisplay2('../images/gallery/gallery/', $imageDtl[3], 86, 140, 0, '', 'No Image');	
                }
            ?>   </div> <div class="cl"></div>        

            <input name="btnDeleteImg" type="submit" class="button-add" id="btnDeleteCat" value="delete" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />

      </form>

    <?php 
    }//if
    ?>
</div>