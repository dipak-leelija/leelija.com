<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/testimonial.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/rating.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$rating			= new Rating(); 
$dateUtil      	= new DateUtil();
$error 			= new Error();

$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$utility		= new Utility();

#####################################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');


if(isset($_POST['btnDelete']))
{	
	//delete the image 
	$utility->deleteFile($id, 'guest_id' ,'../images/upload/rating/', 'person_img', 'guest');

	//delete from region
	$delReg = $rating->deleteGuestRate($id);

	//forward
	$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUTESTM003, 'SUCCESS');
}
?> 

<title><?php echo COMPANY_S; ?> - Client's Testimonial Delete</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<div class="popup-form">
	<?php 
	//show message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'delete'))
	{
		$ratingDtl = $rating->getGuestData($id);
	?>

	  <h3>Delete Client's Testimonial </h3>

	  <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">

			Are you sure that you want to delete the Rating of 
			<span class="orangeLetter">"<?php echo $ratingDtl[0]; ?>"</span><br />

			<input name="btnDelete" type="submit" class="button-add" id="btnDelete" 
			value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel"
			onClick="self.close()" value="cancel" />

	  </form>

	<?php 
	}//eof
	?>
</div>